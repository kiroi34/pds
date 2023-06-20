<script>
        // Function to clear the table
        function clearTable() {
            $.ajax({
                url: "clear_table.php",
                type: "POST",
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error clearing table: " + error);
                }
            });
        }

        // Function to check if it's 00:00
        function checkTime() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();

            if (hours === 0 && minutes === 0) {
                clearTable();
            }
        }

        // Run the checkTime function every minute
        setInterval(checkTime, 60000);
    </script>
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
    <a class='btn btn-primary' href='../homepage/index.php'>Return to home page </a> 
    