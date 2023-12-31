<?php
if (isset($_POST['submit'])) {
    $connectionString = "mongodb://localhost:27017";
    $databaseName = "clinic";
    $collectionName = "dokter";
    $iddokter = $_POST['iddok'];
    $foto = $_POST['foto'];
    $spesialis = $_POST['specialization'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $phone = $_POST['phone'];
    $days = isset($_POST['days']) ? $_POST['days'] : array();
    $starttime = $_POST['start_time'];
    $endtime = $_POST['end_time'];

    $arrayjam = [];
    array_push($arrayjam, $starttime);
    array_push($arrayjam, $endtime);
    $availability = $_POST['availability'];

    $manager = new MongoDB\Driver\Manager($connectionString);

    // Update data dokter
    $filter = ['id_dokter' => $iddokter];
    $update = [
        '$set' => [
            'foto' => $foto,
            'spesialis' => $spesialis,
            'biodata.name' => $nama,
            'biodata.gender' => $gender,
            'biodata.DOB' => $dob,
            'biodata.email' => $email,
            'biodata.address' => $alamat,
            'biodata.phone' => $phone,
            'hari' => $days,
            'jadwal' => $arrayjam,
            'availability' => $availability
        ]
    ];
    $options = ['multi' => false, 'upsert' => false];
    $query = new MongoDB\Driver\Query($filter);
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update($filter, $update, $options);
    $result = $manager->executeBulkWrite("$databaseName.$collectionName", $bulk);

    if ($result->getModifiedCount() > 0) {
        echo "<script>alert('Update data dokter berhasill!'); window.location.href = 'adminpage_dokter.php';</script>";
    } else {
        echo "<script>alert('Update gagal!'); window.location.href = 'adminpage_dokter.php';</script>";
    }
}
?>





