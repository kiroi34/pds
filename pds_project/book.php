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
        body {
            background-color: #1b262c;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #ffffff;
        }

        .jadwal {
            border: none;
            background-image: linear-gradient(to right, #3282B8, #BBE1FA);
        }

        .jumbotron {
            padding: 2rem;
            background-color: #e9ecef;

        }

        #spec {
            font-size: 6.5em;
        }
    </style>
</head>

<body>
    <?php
    $connectionString = "mongodb://localhost:27017";
    $databaseName = "clinic";
    $collectionName = "dokter";

    $manager = new MongoDB\Driver\Manager($connectionString);

    $query = new MongoDB\Driver\Query([]);

    $database = $databaseName;
    $collection = $collectionName;

    $cursor = $manager->executeQuery("$database.$collection", $query);

    $spesialis = [];
    $nama_dokter = [];
    $hari = [];
    $jadwal = [];

    // Masukkan ke array spesialis
    foreach ($cursor as $document) {
        // Spesialis
        array_push($spesialis, $document->spesialis);
        // Nama dokter
        $fieldObject = $document->biodata;
        $nestedField = $fieldObject->name;
        array_push($nama_dokter, $nestedField);
        // Hari
        array_push($hari, $document->hari);
        // Jadwal
        array_push($jadwal, $document->jadwal);
    }


    $q = 0;
    // Echo spesialis dan dokternya
    for ($i = 0; $i < count($spesialis); $i++) {
        // ambil nama spesialis
        $nama_spesialis = $spesialis[$i];
        $temp = [];
        if ($nama_spesialis != 'done') {
            $q++;
            if ($q % 2 == 0) {
                echo "<div class='row g-0'><div id='pengisi' class='col-lg-5 d-flex align-items-center justify-content-center' style='background-color:#BBE1FA'><h1 id='spec' class='text-center' style='color:#0F4C75'><b> Sp. " . ucwords($nama_spesialis) . "</b></h1></div><div id='keterangan' class='col-lg-7'>";
                echo "<div class='jumbotron' style='background-color:#0F4C75'>";
            } else {
                echo "<div class='row g-0'><div id='pengisi' class='col-lg-5 d-flex align-items-center justify-content-center' style='background-color:#3282B8'><h1 id='spec' class='text-center'><b>Sp. " . ucwords($nama_spesialis) . "</b></h1></div><div id='keterangan' class='col-lg-7'>";
                echo "<div class='jumbotron' style='background-color:#0F4C75'>";
            }

            for ($j = 0; $j < count($spesialis); $j++) { // cari yang sama dengan $nama_spesialis
                if ($spesialis[$j] == $nama_spesialis && $spesialis[$j] != 'done') {
                    array_push($temp, $j);
                    $spesialis[$j] = 'done';
                }
            }
            for ($k = 0; $k < count($temp); $k++) { //echo semua yg diperlukan di dokter itu
                echo "<div class='row g-0'><div class='col-lg-6'>";
                echo "<img src='https://drive.google.com/uc?export=view&id=1dAEbPNhBnXC1wU16elJYHfIhPlirR-77' width='300' height='380'>";
                echo "</div>";
                echo "<div class='col-lg-6'>";
                // Echo nama dokter
                echo "<br><h1>" . $nama_dokter[$temp[$k]] . "</h1><br>";
                echo "<h5>Schedule : </h5>";
                // Echo hari dokter
                $harih = $hari[$k];
                $checkk = 0;
                echo "<h5>";
                for ($l = 0; $l < count($harih); $l++) {
                  if ($checkk != count($harih)-1) {
                    echo date('l', strtotime("Sunday +{$harih[$l]} days")) . ",  ";
                    $checkk++;
                  } else {
                    echo date('l', strtotime("Sunday +{$harih[$l]} days"));
                  }
                  
                }
                echo "</h5>";
                // Echo jadwal dokter
                $jadual = '';
                $checkkk=0;
                $tempjadwal = $jadwal[$temp[$k]];
                for ($m = 0; $m < count($tempjadwal); $m++) {
                    if ($checkkk == 0) {
                        $jadual .= $tempjadwal[$m];
                        $checkkk++;
                    } else {
                        $jadual .= ' - '.$tempjadwal[$m];
                        
                    }
                    
                }
                
                $modalId = "exampleModal" . $temp[$k];
                echo "<button type='button' class='btn btn-primary btn-lg jadwal' data-bs-toggle='modal' data-bs-target='#$modalId'>" . $jadual . "</button>";
                // Modal content
                echo "<div class='modal fade' id='$modalId' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                echo "<div class='modal-dialog' role='document'>";
                echo "<div class='modal-content' style='background-color:#0F4C75'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='exampleModalLabel'>Please confirm your appointment</h5>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>";
                echo "</button>";
                echo "</div>";
                echo "<div class='modal-body'>";
                echo "<h2>" . $nama_dokter[$temp[$k]] . "</h2>";
                echo "<h5>Specializes in: " . $nama_spesialis . "</h5>";
                echo "<br><h6>Time: " . $jadual . "</h6>";
                echo "</div>";
                echo "<div class='modal-footer'>";
                echo "<button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>";
                echo "<a class='btn btn-primary' href='process_book.php?dokter=".$nama_dokter[$temp[$k]]."&spesialis=".$nama_spesialis."'>Confirm</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                

                // for ($l = 0; $l < 10; $l++) {
                //     $tempp = $jadwal[$temp[$k]];
                //     $modalId = "exampleModal" . $temp[$k] . $l; // Generate unique modal id
                //     echo "<button type='button' class='btn btn-primary btn-lg jadwal' data-bs-toggle='modal' data-bs-target='#$modalId'>" . $tempp[$l] . "</button>";
                //     echo '<br><br>';
                //     // Modal content
                //     echo "<div class='modal fade' id='$modalId' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                //     echo "<div class='modal-dialog' role='document'>";
                //     echo "<div class='modal-content' style='background-color:#0F4C75'>";
                //     echo "<div class='modal-header'>";
                //     echo "<h5 class='modal-title' id='exampleModalLabel'>Please confirm your appointment</h5>";
                //     echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>";
                //     echo "</button>";
                //     echo "</div>";
                //     echo "<div class='modal-body'>";
                //     echo "<h2>" . $nama_dokter[$temp[$k]] . "</h2>";
                //     echo "<h5>Specializes in: " . $nama_spesialis . "</h5>";
                //     echo "<br><h6>Time: " . $tempp[$l] . "</h6>";
                //     echo "</div>";
                //     echo "<div class='modal-footer'>";
                //     echo "<button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>";
                //     echo "<a class='btn btn-primary' href='process_book.php?dokter=".$nama_dokter[$temp[$k]]."&spesialis=".$nama_spesialis."&time=".$tempp[$l]."'>Confirm</a>";
                //     echo "</div>";
                //     echo "</div>";
                //     echo "</div>";
                //     echo "</div>";
                // }
                echo "<br><br>";
                echo "</div></div><br><br>"; // Close the row and col-lg-3 divs
            }

            echo "</div></div></div>"; // Close the jumbotron div
        }
    }
    ?>

</body>

</html>