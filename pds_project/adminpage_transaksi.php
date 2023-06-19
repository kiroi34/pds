<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>

  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="homeAdmin.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

    .btn-fill {
      width: 100%;
      background-color: #41644A;
      color: white;
      padding: 15px 15px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-fill:hover {
      --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    .isi {
      background-color: #f2f2f2;
      padding: 20px;
      margin: auto;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      width: 85%;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    input[type=number],
    select {
      height: 30px;
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=text],
    select {
      height: 30px;
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
  </style>
  <script>
    
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
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Booking List</span>
        </a>
      </li>
      <li>
        <a href="adminpage_dokter.php" >
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Dokter</span>
        </a>
      </li>
      <li>
        <a href="adminpage_record.php">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Patient records</span>
        </a>
      </li>
      <li>
        <a href="adminpage_transaksi.php" class="active">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Transaction</span>
        </a>
      </li>
      <li>
        <a href="adminpage_medicine.php">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Medicine</span>
        </a>
      </li>
      <li>
        <a href="adminpage_kasir.php">
          <i class='bx bx-home-alt'></i>
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
        <span class="dashboard">Data Tansaksi</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="isi">
          <div class="right-side">
            <h2>List Transaksi</h2>
            <table id="example" class="table table-striped" style="width:100%; text-align: center;">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>ID Pasien</th>
                        <th>ID Dokter</th>
                        <th>Biaya Obat</th>
                        <th>Biaya Transaksi</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>ID Booking</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                  $connectionString = "mongodb://localhost:27017";
                  $databaseName = "clinic";
                  $collectionName = "transaction";
              
                  $manager = new MongoDB\Driver\Manager($connectionString);
              
                  $query = new MongoDB\Driver\Query([]);
              
                  $database = $databaseName;
                  $collection = $collectionName;
              
                  $cursor = $manager->executeQuery("$database.$collection", $query);

                  // Menginisialisasi variabel count
                  $count = 1;

                  // Looping untuk setiap dokumen
                  foreach ($cursor as $document) {
                      // Mengakses properti dokumen
                      $idtransaksi= $document->id_pasien;
                      $idpasien= $document->id_pasien;
                      $iddokter= $document->id_pasien;
                      $gender = $document->gender_pasien;
                      $dob = $document->DOB_pasien;
                      $phoneNumber = $document->phone_pasien;
                      $address = $document->address_pasien;

                      // Menampilkan data dalam format HTML
                      // echo "<tr>";
                      // echo "<td>" . $count . "</td>";
                      // echo "<td>" . '0' . "</td>";
                      // echo "<td>" . $idpasien. "</td>";
                      // echo "<td>" . $patientName. "</td>";
                      // echo "<td>" . $gender . "</td>";
                      // echo "<td>" . $dob . "</td>";
                      // echo "<td>" . $phoneNumber . "</td>";
                      // echo "<td>" . $address . "</td>";
                      // echo "<td>" . '0' . "</td>";
                      // echo "</tr>";

                      // Increment count
                      $count++;
                  }
                  ?>
          </div>
        </div>
      </div>
    </div>

  </section>
  <script>
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