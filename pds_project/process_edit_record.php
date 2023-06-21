<?php
if (isset($_POST['update'])) {
    $connectionString = "mongodb://localhost:27017";
    $databaseName = "clinic";
    $collectionName = "record";


    $idrecord= $_POST['idrecord'];
    $iddokter =$_POST['iddoktor'];
    $idpasien = $_POST['idpasien'];

    $ro = $_POST['history'];

    $gejala= $_POST['symptos'];
    $diagnosa =$_POST['diagnosis'];
    $tindakan = $_POST['tindakan'];
    $tanggal = $_POST['tanggal'];


    $ro_array = [];


 
    // Masukkan ke array
    foreach($ro as $value){
        array_push($ro_array,$value);
    };
  
   

    $manager = new MongoDB\Driver\Manager($connectionString);

    // Update data dokter
    $filter = ['id_record' => $idrecord];
    $update = [
        '$set' => [
            'id_dokter'=>$iddokter,
            'id_pasien'=>$idpasien,
            'riwayat_obat'=>$ro_array,
            'gejala_pasien'=>$gejala,
            'diagnosa_pasien'=>$diagnosa,
            'tindakan_dilakukan'=>$tindakan,
            'tanggal_rekam_medis'=>$tanggal
        ]
    ];
    $options = ['multi' => false, 'upsert' => false];
    $query = new MongoDB\Driver\Query($filter);
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update($filter, $update, $options);
    $result = $manager->executeBulkWrite("$databaseName.$collectionName", $bulk);

    if ($result->getModifiedCount() > 0) {
        echo "<script>alert('Record data update successful!'); window.location.href = 'adminpage_record.php';</script>";
    } else {
        echo "<script>alert('Record data update failed!'); window.location.href = 'adminpage_record.php';</script>";
    }
}
?>