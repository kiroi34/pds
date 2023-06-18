<?php
require '../../../php/vendor/autoload.php'; // Include the MongoDB PHP library
include 'connect.php';
date_default_timezone_set("Asia/Bangkok");

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017"); // Replace with your MongoDB connection details

$databaseName = 'clinic'; // Replace with your database name
$collectionName = 'transaksi'; // Replace with your collection name

$command = new MongoDB\Driver\Command([
    'count' => $collectionName,
    'query' => (object) [],
]);

$cursor = $manager->executeCommand($databaseName, $command);
$result = current($cursor->toArray());

$count = $result->n;

if ($count === 0) {
    $latest_id_num = 0;
} else {
    $connectionString = "mongodb://localhost:27017";
    $databaseName = "clinic";
    $collectionName = "transaksi";

    $manager = new MongoDB\Driver\Manager($connectionString);

    $query = new MongoDB\Driver\Query([]);

    $database = $databaseName;
    $collection = $collectionName;

    $cursor = $manager->executeQuery("$database.$collection", $query);

    $latest_id = '';

    // Ambil ID
    foreach ($cursor as $document) {
        $jsonString = json_encode($document); // Convert the document object to a JSON string
        $decoded = json_decode($jsonString); // Decode the JSON string
        foreach ($decoded as $key => $value) {
            if ($key == 'id_dokter') {
                $latest_id = $value;
            }
        }
    }
    // Ambil numeric value
    $latest_id_num = intval(substr($latest_id, 1)) + 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_transaksi = 0;
    // ID Transaksi
    $transaction_id = "t" . "$latest_id_num";
    // Tanggal transaksi
    $transaction_date = $_POST['transaction_date'];
    // ID Pasien
    $patient_id = $_POST['patient_id'];
    // ID dokter
    $doctor_id = $_POST['doctor_id'];
    // Biaya dokter
    $biaya = 0;
    // (Query MongoDB)
    $fieldName = 'id_dokter';
    $fieldValue = "$doctor_id";
    $filter = [$fieldName => $fieldValue];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('clinic.dokter', $query);
    foreach ($cursor as $document) {
        // Access the specific field value
        $fieldValue = $document->biaya;
        $biaya = $fieldValue;
        break;
    }
    $total_transaksi = $total_transaksi + intval($biaya);
    // List obat
    $medicinelist = [];
    $amountlist = [];
    $input_medicine = $_POST['medicines'];
    $input_amount = $_POST['amount'];
    foreach ($input_medicine as $value) {
        array_push($medicinelist, $value);
    }
    foreach ($input_amount as $value) {
        array_push($amountlist, $value);
    }
    // Total transaksi
    // (Query SQL (AMBIL HARGA))
    $placeholders = implode(',', array_fill(0, count($medicinelist), '?'));
    $query = "SELECT * FROM medicine WHERE name_medicine IN ($placeholders)";
    $stmt = $pdo->prepare($query);
    $stmt->execute($medicinelist);
    $results = $stmt->fetchAll();
    $counter = 0;
    foreach ($results as $row) {
        $value = $row['price_medicine'];
        // Ambil harga dan kalikan
        $total_transaksi = $total_transaksi + ($value * $amountlist[$counter]);
        $counter++;
    }
    // (Query SQL (KURANGI STOK))
    $query = "UPDATE medicine SET stock_medicine = stock_medicine - :subtract_value WHERE name_medicine = :item_name";
    $stmt = $pdo->prepare($query);
    for ($i = 0; $i < count($medicinelist); $i++) {
        $medicinelistt = $medicinelist[$i];
        $amountlistt = $amountlist[$i];

        $stmt->bindParam(':subtract_value', $amountlistt, PDO::PARAM_INT);
        $stmt->bindParam(':item_name', $medicinelistt, PDO::PARAM_STR);
        $stmt->execute();
    }
    // Status pembayaran
    $payment = $_POST['payment'];

    // Masukkan ke mongodb
    // Create document
    $document = [
        'transaction_id' => $transaction_id,
        'transaction_date' => $transaction_date,
        'patient_id' => $patient_id,
        'doctor_id' => $doctor_id,
        'doctor_fee' => $biaya,
    ];
    $dynamicFields = [];
    for ($i = 0; $i < count($medicinelist); $i++) {
        $fieldName = $medicinelist[$i];
        $fieldValue = $amountlist[$i];
        $dynamicFields[$fieldName] = $fieldValue;
    }
    $document['medicine_qty'] = $dynamicFields;
    $document['transaction_total'] = $total_transaksi;
    $document['payment_status'] = $payment;

    // Specify the collection
    $collection = "transaksi";

    // Create insert command
    $command = new MongoDB\Driver\Command([
        'insert' => $collection,
        'documents' => [$document]
    ]);

    // Execute the insert command
    $manager->executeCommand('clinic', $command);

    // Redirect or display success message
    header('location:adminpage_kasir.php');
}
