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
          <span class="links_name" style="color: #F2E3DB; font-size:18px">List Booking</span>
        </a>
      </li>
      <li>
        <a href="adminpage_dokter.php" >
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Dokter</span>
        </a>
      </li>
      <li>
        <a href="adminpage_record.php" class="active">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Record Pasien</span>
        </a>
      </li>
      <li>
        <a href="adminpage_transaksi.php"  >
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Transaksi</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- home -->
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Record Pasien</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="isi">
          <div class="right-side">
            <h2>List Record</h2>
            <table id="example" class="table table-striped" style="width:100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>ID Record</th>
                        <th>ID Dokter</th>
                        <th>ID Pasien</th>
                        <th>Riwayat Obat</th>
                        <th>Gejala</th>
                        <th>Diagnosa</th>
                        <th>tindakan</th>
                        <th>Tanggal Rekam Mendis</th>
                        <th>ID Booking</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                  $connectionString = "mongodb://localhost:27017";
                  $databaseName = "clinic";
                  $collectionName = "dokter";
              
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
                      $foto= $document->foto;
                      $iddokter = $document->id_dokter;
                      $riwayatregister = $document->registered;
                      $spesialis= $document->spesialis;
                      $biodata = $document->biodata;
                      $hari = $document->hari;
                      $jadwal= $document->jadwal;
    
                      // Menampilkan data dalam format HTML
                      echo "<tr>";
                      
                      echo "<td>" . $count . "</td>";
                      echo "<td>" . $iddokter . "</td>";
                      echo "<td>" . $riwayatregister . "</td>";
                      echo "<td>" . $spesialis . "</td>";
                      echo "<td>";
                      foreach ($biodata as $key => $bo) {
                        echo $key . ": " . $bo . "<br>";
                      }
                      echo "</td>";echo "<td>";
                      foreach ($hari as $key => $hr) {
                          echo $hr . "<br>";
                      }
                      echo "</td>";echo "<td>";
                      foreach ($jadwal as $key => $jd) {
                          echo $jd . "<br>";
                      }
                      echo "</td>";
                      
                      echo "</tr>";

                      // Increment count
                      $count++;
                  }
                  ?>



            
                </tbody>
           </table>
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