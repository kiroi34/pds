<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <?php
    // include 'connect.php';
    session_start();
    ?>
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
    ?>
    
    <!-- detail  -->
    <h1>Appointment details</h1>
    <h6>Doctor : <?php echo $dokter ?></h6>
    <h6>Specialization : <?php echo $spesialis ?></h6>
    <h6>Time : <?php echo $waktu ?></h6>


</body>

</html>