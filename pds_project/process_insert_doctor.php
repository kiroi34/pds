<?php
$connectionString = "mongodb://localhost:27017";
$databaseName = "clinic";
$collectionName = "dokter";

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TECHNICAL DETAILS
    // Foto
    $foto = $_POST['foto'];
    // Spesialis
    $specialization = $_POST['specialization'];
    // ID dokter
    $id_dokter = "d" . "$latest_id_num";
    // Registered
    $registered = date("d-m-Y");

    // BIODATA
    // Nama
    $nama = $_POST['nama'];
    // Gender
    $gender = $_POST['gender'];
    // DOB
    $dob = $_POST['dob'];
    // Email
    $email = $_POST['email'];
    // Address
    $address = $_POST['alamat'];
    // Phone number
    $phone = $_POST['phone'];

    // JADWAL
    // Hari
    $list_hari = [];
    $selectedOptions = $_POST['days'] ?? [];

    // availability
    $availability = $_POST['availability'];

    // Loop through selected checkboxes
    foreach ($selectedOptions as $option) {
        array_push($list_hari, $option);
    }
    // Jam
    $work_hours = [];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    array_push($work_hours, $start_time);
    array_push($work_hours, $end_time);

    // Masukkan ke mongodb
    // Create document
    $document = [
        'foto' => $foto,
        'id_dokter' => $id_dokter,
        'registered' => $registered,
        'spesialis' => $specialization,
        'biodata' => [
            'name' => $nama,
            'gender' => $gender,
            'DOB' => $dob,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ],
        'hari' => $list_hari,
        'jadwal' => $work_hours,
        'availability' => $availability
    ];

    // Specify the collection
    $collection = "dokter";

    // Create insert command
    $command = new MongoDB\Driver\Command([
        'insert' => $collection,
        'documents' => [$document]
    ]);

    // Execute the insert command
    $manager->executeCommand('clinic', $command);

    // Redirect or display success message
    header('location:adminpage_dokter.php');
}
