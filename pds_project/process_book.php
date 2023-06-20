<?php
include 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* body {
            background-color: #1b262c;
        }         */
    </style>
</head>

<body>
    <?php
    $dokter = $_GET['dokter'];
    $spesialis = $_GET['spesialis'];
    $waktu = $_GET['time'];
    $id_dokter = $_GET['iddokter'];
    $id_pasien = $_SESSION['id_pasien'];
    ?>

    <!-- detail  -->
    <h1>Appointment details</h1>
    <h6>Doctor : <?php echo $dokter ?></h6>
    <h6>Specialization : <?php echo $spesialis ?></h6>
    <h6>Time : <?php echo $waktu ?></h6>

    <!-- cetak nomor antrian -->
    <?php
    $sql = "SELECT * FROM bookings where id_dokter='$id_dokter' and id_pasien='$id_pasien'";
    $result = $conn->query($sql);
    $latest_queue = 1;
    if ($result !== false && $result->num_rows == 1) { // Pasien udah daftar
        echo "<script>alert('You have already made an appointment with this doctor !'); window.location.href = '../homepage/Book.php';</script>";
    } elseif($result !== false && $result->num_rows <= 0) { // Pasien blm daftar
        // Cari no antrian terbaru
        $sql3 = "SELECT * FROM bookings where id_dokter='$id_dokter'";
        $result3 = $conn->query($sql3);
        $latest_queue3 = 1;
        // Kalo sudah ada antrian di dokter itu
        if ($result3 !== false && $result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {
                $latest_queue3 = $row3['nomor_antrian'];
            }
            $latest_queue += 1; // Nomor antrian terbaru didapat
        }
        // Kalo belum ada antrian di dokter itu
        else{
            $latest_queue3 = 1;
        }
        // Masukkan antrian dan data
        $sql2 = "INSERT INTO bookings (id_dokter, id_pasien, nomor_antrian) VALUES ('$id_dokter', '$id_pasien', '$latest_queue3')";
        if ($conn->query($sql2) === TRUE) {
            echo "<h1>Your queue number: " . $latest_queue . "</h1>";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    }

    ?>
    <a class='btn btn-primary' href='../homepage/index.html'>Return to home page</a>

</body>

</html>