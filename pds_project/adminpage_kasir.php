<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctors Data</title>
    <?php
    include 'connect.php';
    require '../../../php/vendor/autoload.php'; // Include the MongoDB PHP Library

    // MongoDB connection parameters
    $mongoHost = 'localhost';
    $mongoPort = 27017;
    $databaseName = 'clinic';
    $collectionName = 'dokter';

    // Connect to MongoDB
    $manager = new MongoDB\Driver\Manager("mongodb://$mongoHost:$mongoPort");

    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fa_icons/css/all.css">
    <link rel="stylesheet" href="inputCashier.css">
    <link rel="stylesheet" href="bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .horizontal-container {
            display: flex;
            flex-direction: row;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
        }
    </style>
    <script>
        $(document).ready(function() {
            var wrapper = $("#input_fields_wrapper"); // Input fields wrapper
            var addButton = $("#add_field_button"); // Add button ID

            var fieldHTML =
                '<div class="input-wrapper"><input type="text" name="medicine[]" class="form-control mt-2 user" placeholder="Enter medicine name.." /><input min=1 type="number" name="amount[]" class="form-control mt-2 amount" placeholder="Enter amount.." /><div class="medicinelist"></div><button class="remove">Remove</button></div>'; // New input field HTML

            // Triggered when "Add Field" button is clicked
            $(addButton).click(function(e) {
                e.preventDefault();
                $(wrapper).append(fieldHTML); // Add new field
            });

            // Triggered when "Remove" button is clicked
            $(wrapper).on("click", ".remove_field", function(e) {
                e.preventDefault();
                $(this).closest('.input-wrapper').remove(); // Remove field
            });

            $(document).on('keyup', '.user', function() {
                var query = $(this).val();
                var inputWrapper = $(this).closest('.input-wrapper');
                var medicinelist = $(inputWrapper).find('.medicinelist');

                if (query != '') {
                    $.ajax({
                        url: "search_medicine.php",
                        method: "POST",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $(medicinelist).fadeIn();
                            $(medicinelist).html(data);
                        }
                    });
                } else {
                    $(medicinelist).fadeOut();
                }
            });

            $(document).on('click', '.medicinelist li', function() {
                var userValue = $(this).text();
                $(this).closest('.input-wrapper').find('.user').val(userValue);
                $(this).closest('.medicinelist').fadeOut();
            });
        });
    </script>

</head>

<body>
      <!-- navbar -->
  <div class="sidebar" style="width:100%">
    <div class="logo-details">
      <i class='bx bx-user'></i>
      <br>
      <span class="logo_name"><b>Admin</b><br>XYZ CLINIC</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="adminpage.php">
          <i class='bx bx-book-open'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Booking List</span>
        </a>
      </li>
      <li>
        <a href="adminpage_dokter.php">
          <i class='bx bxs-user-detail'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Doctor</span>
        </a>
      </li>
      <li>
        <a href="adminpage_record.php">
          <i class='bx bx-data'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Patient Records</span>
        </a>
      </li>
      <li>
        <a href="adminpage_transaksi.php">
          <i class='bx bx-transfer'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Transaction</span>
        </a>
      </li>
      <li>
        <a href="adminpage_medicine.php">
          <i class='bx bx-capsule'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Medicine</span>
        </a>
      </li>
      <li>
        <a href="adminpage_kasir.php" class="active">
          <i class='bx bx-credit-card'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Cashier</span>
        </a>
      </li>
    </ul>
  </div>

  <!-- home -->
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Cashier </span>
      </div>
    </nav>

    <div class="home-content">
      <div class="home-content">
        <div class="isi" id="divInput" >
        <form method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
        <h1 style="padding-left:2px">Insert payment</h1>
        <br>
        <h2 style="padding-left:2px">Input Bill Details</h2>
        <!-- ID Pasien -->
        <label for="id_pasien">Patient ID</label>
        <input type="text" id="id_pasien" name="id_pasien" placeholder="Insert Patient ID..." required>

        <!-- ID dokter -->
        <label for="id_dokter">Doctor ID</label>
        <input type="text" id="id_dokter" name="id_dokter" placeholder="Insert Doctor ID..." required>

        <!-- Obat yang dibeli -->
        <label>Medicine</label>
        <div id="input_fields_wrapper">
            <div class="input-wrapper">
                <input required type="text" name="medicine[]" class="form-control mt-2 user" placeholder="Enter medicine name.." />
                <div class="medicinelist"></div>
                <input required min=1 type="number" name="amount[]" class="form-control mt-2 amount" placeholder="Enter amount.." />

            </div>
        </div>
        <button class="edit" id="add_field_button">Add Field</button>

        <!-- Status pembayaran -->
        <br><br><label>Payment Status</label><br>
        <input type="radio" id="paid" name="payment" value="paid">
        <label for="paid">Paid</label>
        <input type="radio" id="unpaid" name="payment" value="unpaid">
        <label for="unpaid">Unpaid</label><br>

        <br>
        <br>
        <input type="submit" value="Submit" name="submit">
    </form>
    </div>
      </div>
      <br>
      <Br>
      <br>

    <?php
    if (isset($_POST['submit'])) {
        $listmedicine = $_POST['medicine'];
        $listamount = $_POST['amount'];
        for ($i = 0; $i < count($listmedicine); $i++) {
            $ambil = explode("-", $listmedicine[$i]);
            $listmedicine[$i] = $ambil[0];
        }
        // Validasi input
        // Cek dokter dan pasien
        $iddokter = $_POST['id_dokter'];
        $idpasien = $_POST['id_pasien'];
        $query = ['id_dokter' => $iddokter];
        $filter = new MongoDB\Driver\Query($query);
        $result = $manager->executeQuery("$databaseName.$collectionName", $filter)->toArray();
        if (!empty($result)) {
            // Lanjut cek pasien
            $sql = "SELECT * FROM login_table WHERE login_id = $idpasien";
            $result = $conn->query($sql);
            if ($result->num_rows <= 0) {
                echo '<script type="text/javascript">
                alert("Patient ID not found");
                window.location.href = window.location.href; // Refresh the page
              </script>';
                exit(); // Stop execution to prevent further processing
            }
        } else {
            echo '<script type="text/javascript">
            alert("Doctor ID not found");
            window.location.href = window.location.href; // Refresh the page
          </script>';
            exit(); // Stop execution to prevent further processing
        }
        // Cek ada atau ga nama obat itu
        $placeholders = implode(',', array_fill(0, count($listmedicine), '?'));
        $query = "SELECT * FROM medicine WHERE name_medicine IN ($placeholders)";
        $statement = $pdo->prepare($query);
        foreach ($listmedicine as $index => $value) {
            $statement->bindValue($index + 1, $value);
        }
        // Execute the query
        $statement->execute();

        // Fetch the results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Output the results
        if (count($results) > 0) {
            // Cek stok
            $counter = 0;
            foreach ($results as $row) {
                $intstock = (int)$row["stock_medicine"];
                $intstockinput = (int)$listamount[$counter];
                if ($intstock < $intstockinput) {
                    echo '<script type="text/javascript">
                            alert("Insufficient stock: ' . $row["name_medicine"] . '");
                            window.location.href = window.location.href; // Refresh the page
                          </script>';
                    exit(); // Stop execution to prevent further processing
                }
                $counter++;
            }
        } else {
            echo '<script type="text/javascript"> window.onload = function () { alert("No medicine found with that name"); } </script>';
        }
        echo "<div class='home-content'>";
        echo "<div class='isi' id='divInput'>";
        echo "<form action='process_insert_transaksi.php' method='post' name='myForm' enctype='multipart/form-data'>";
        echo "<h1>Bill Summary</h1>";
        // Tanggal transaksi
        echo "<h3>Transaction date</h3>";
        $currentDateTime = date('d-m-Y H:i:s');
        echo '<input type="text" name="transaction_date" class="form-control mt-2 user" value="' . $currentDateTime . '"/>';
        // ID Pasien
        echo "<h3>Patient ID</h3>";
        echo '<input type="text" name="patient_id" class="form-control mt-2 user" value="' . $_POST['id_pasien'] . '"/>';
        // ID Dokter
        echo "<h3>Doctor ID</h3>";
        echo '<input type="text" name="doctor_id" class="form-control mt-2 user" value="' . $_POST['id_dokter'] . '"/>';
        // List obat
        echo "<h3>Medicine list</h3>";
        for ($i = 0; $i < count($listmedicine); $i++) {
            echo '<input type="text" name="medicines[]" class="form-control mt-2 user" value="' . $listmedicine[$i] . '"/>';
            echo '<input type="text" name="amount[]" class="form-control mt-2 user" value="' . $listamount[$i] . '"/>';
        }
        // Status pembayaran
        echo '<h3>Payment Status</h3>';
        echo '<input type="text" name="payment" class="form-control mt-2 user" value="' . $_POST['payment'] . '"/>';
        echo '<input type="submit" value="Confirm" name="submit">';
        echo '</form>';
    }
    ?>

    <script>
          function showInput() {
      document.getElementById("divInput").style.display = '';
    }

    function closeInput() {
      document.getElementById("divInput").style.display = 'none';
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
        </script>
</body>

</html>