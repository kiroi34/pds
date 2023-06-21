<?php
if (isset($_POST['submit'])) {
    $connectionString = "mongodb://localhost:27017";
    $databaseName = "clinic";
    $collectionName = "transaksi";
    $transaction_date = $_POST['transaction_date'];
    $transaction_id = $_POST['transaction_id'];
    $transaction_total = $_POST['transaction_total'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $doctor_fee = $_POST['doctor_fee'];
    $medicine = $_POST['medicine'];
    $medicine_array = [];
    // Masukkan ke array
    foreach($medicine as $value){
        array_push($medicine_array,$value);
    }
    $quantity = $_POST['quantity'];
    $quantity_array = [];
    // Masukkan ke array
    foreach($quantity as $value){
        array_push($quantity_array,$value);
    }
    // Bikin object medicine_qty
    $data = array_combine($medicine_array, $quantity_array);
    $obj = (object) $data;

    $transaction_total = $_POST['transaction_total'];
    $payment_status = $_POST['payment_status'];

    $manager = new MongoDB\Driver\Manager($connectionString);

    // Update data dokter
    $filter = ['transaction_id' => $transaction_id];
    $update = [
        '$set' => [
            'patient_id'=>$patient_id,
            'doctor_id'=>$doctor_id,
            'doctor_fee'=>$doctor_fee,
            'medicine_qty'=>$obj,
            'transaction_total'=>$transaction_total,
            'payment_status'=>$payment_status
        ]
    ];
    $options = ['multi' => false, 'upsert' => false];
    $query = new MongoDB\Driver\Query($filter);
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update($filter, $update, $options);
    $result = $manager->executeBulkWrite("$databaseName.$collectionName", $bulk);

    if ($result->getModifiedCount() > 0) {
        echo "<script>alert('Transaction data update successful!'); window.location.href = 'adminpage_transaksi.php';</script>";
    } else {
        echo "<script>alert('Transaction data update failed!'); window.location.href = 'adminpage_transaksi.php';</script>";
    }
}
?>