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
        } */

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #ffffff;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
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
    $cursor2 = $manager->executeQuery("$database.$collection", $query);

    $foto = [];
    $id_dokter = [];
    $printed = 0;
    $printedd = 0;
    echo "<a href='insert_doctor.php'>Insert</a>";

    // Ambil foto
    foreach ($cursor as $document) {
        $jsonString = json_encode($document); // Convert the document object to a JSON string
        $decoded = json_decode($jsonString); // Decode the JSON string
        foreach ($decoded as $key => $value) {
            if ($key == 'foto') {
                array_push($foto, $value);
            }
            if ($key == 'id_dokter') {
                array_push($id_dokter, $value);
            }
        }
    }

    $counter = 0;
    foreach ($cursor2 as $document) {
        $printed = 0;
        $printedd = 0;
        $jsonString = json_encode($document); // Convert the document object to a JSON string
        $decoded = json_decode($jsonString); // Decode the JSON string

        echo "<div class=row>";
        echo "<div class='col-lg-2'>";
        echo "<img src='" . $foto[$counter] . "' width='200' height='260'>";
        echo "<br><br>";
        // Tombol update/edit
        echo "<a class='btn btn-warning' href='../pds_project/edit_doctor.php?dokter=" . $id_dokter[$counter] . "'>Edit</a>";
        // Tombol delete
        echo "<a style='margin-left:10px' class='btn btn-danger' href='../pds_project/delete_doctor.php?dokter=" . $id_dokter[$counter] . "'>Delete</a>";
        echo "</div>";
        $counter++;
        foreach ($decoded as $key => $value) {
            // Skip kalo id
            if ($key == '_id') {
                continue;
            }
            // Hari dan jam praktek
            elseif (is_array($value)) { // Untuk hari dan jam praktek
                // Cetak table header sekali saja
                if ($printedd != 1) { //Cetak hari kerja
                    echo "<div class='col-lg-2'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th colspan='2'>Schedule</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>" . $key . "</td>";
                    echo "<td>";
                    foreach ($value as $item) {
                        echo "<li>" . date('l', strtotime("Sunday +{$item} days")) . "</li>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    $printedd = 1;
                } else { // Cetak jam kerja
                    echo "<tr>";
                    echo "<td>" . $key . "</td>";
                    echo "<td>";
                    foreach ($value as $item) {
                        echo "<li>" . $item . "</li>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
                }
            }
            // Biodata dokter
            elseif (is_object($value)) { // Biodata dokter
                echo "<table>";
                echo "<tr>";
                echo "<th colspan='2'>Biodata</th>";
                echo "</tr>";
                foreach ($value as $property => $propertyValue) {
                    echo "<tr>";
                    echo "<td>" . $property . "</td>";
                    echo "<td>" . $propertyValue . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            } else { // detail teknis
                // Cetak table header sekali saja
                if ($printed != 1) {
                    echo "<div class='col-lg-4'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th colspan='2'>Technical data</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>" . $key . "</td>";
                    echo "<td>" . $value . "</td>";
                    echo "</tr>";
                    $printed = 1;
                } else {
                    echo "<tr>";
                    echo "<td>" . $key . "</td>";
                    echo "<td>" . $value . "</td>";
                    echo "</tr>";
                }
                if ($key == 'spesialis') {
                    echo "</table><br>"; //nutup table dan div col
                }
            }
        }
        echo "</div></div><br>";
    }
    ?>

</body>

</html>