<?php
$connectionString = "mongodb://localhost:27017";
$databaseName = "clinic";
$collectionName = "record";

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
        if ($key == 'id_record') {
            $latest_id = $value;
        }
    }
}
// Ambil numeric value
$latest_id_num = intval(substr($latest_id, 1)) + 1;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $idDokter = $_POST['idDoc'];
    $idPasien = $_POST['idPatient'];
    $riwayatObat = explode(", ", $_POST['riwayatobat']); // Memisahkan obat-obat yang diinputkan
    $gejala= $_POST['gejala'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];
    $tanggalperiksa = $_POST['tanggal'];
    $id_record = "r" . "$latest_id_num";
    // Create document
    $document = [
        'id_record' => $id_record,
        'id_dokter' => $idDokter,
        'id_pasien' => $idPasien,
        'riwayatObat' => $riwayatObat,
        'gejala_pasien' => $gejala,
        'diagnosa_pasien' => $diagnosa,
        'tindakan_dilakukan' => $tindakan,
        'tanggal_rekam_medis' => $tanggalperiksa
    ];

    // Specify the collection
    $collection = "record";

    // Create insert command
    $command = new MongoDB\Driver\Command([
        'insert' => $collection,
        'documents' => [$document]
    ]);

    // Execute the insert command
    $manager->executeCommand('clinic', $command);

    // Redirect or display success message
    header('location:adminpage_record.php');
}
