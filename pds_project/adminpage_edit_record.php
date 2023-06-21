<!DOCTYPE html>
<html lang="en">

<head>
  <title>Doctors Data</title>

  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="fa_icons/css/all.css">
  <link rel="stylesheet" href="inputDokter.css">
  <link rel="stylesheet" href="bootstrap.css">

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
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Doctor</span>
        </a>
      </li>
      <li>
        <a href="adminpage_record.php" class="active">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px"> Update Record Pasien</span>
        </a>
      </li>
      <li>
        <a href="adminpage_transaksi.php">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Transaksi</span>
        </a>
      </li>
      <li>
        <a href="adminpage_medicine.php">
          <i class='bx bx-capsule'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Medicine</span>
        </a>
      </li>
      <li>
        <a href="adminpage_kasir.php" >
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
        <span class="dashboard">Update Record </span>
      </div>
    </nav>

    <?php
    $connectionString = "mongodb://localhost:27017";
    $databaseName = "clinic";
    $collectionName = "record";
    $idrecord = $_POST['dapetinID'];
    $filter = ['id_record' => $idrecord];

    $manager = new MongoDB\Driver\Manager($connectionString);

    $query = new MongoDB\Driver\Query($filter);

    $database = $databaseName;
    $collection = $collectionName;

    $cursor = $manager->executeQuery("$database.$collection", $query);
    $cursor2 = $manager->executeQuery("$database.$collection", $query);

    $counter = 0;
    foreach ($cursor2 as $document) {
      $printed = 0;
      $printedd = 0;
      $jsonString = json_encode($document); // Convert the document object to a JSON string
      $decoded = json_decode($jsonString); // Decode the JSON string

      // Mengakses properti dokumen
      $idrecord= $document->id_record;
      $iddokter = $document->id_dokter;
      $idpasien = $document->id_pasien;
      $ro = $document->riwayat_obat;
      
      $gejala= $document->gejala_pasien;
      $diagnosa = $document->diagnosa_pasien;
      $tindakan = $document->tindakan_dilakukan;
      $tanggalrm = $document->tanggal_rekam_medis;
      
   
    ?>


      <div class="home-content">
        <div class="isi" id="divInput">

          <form action="process_edit_record.php" method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
            <h1 style="padding-left:2px">Update Data Dokter Baru</h1>

            <label for="idrecord">Record ID</label>
            <input type="text" id="idrecord" name="idrecord"  value="<?php echo $idrecord; ?>" readonly>
            <br>
            <label for="iddoktor">Doctor ID</label>
            <input type="text" id="iddoktor" name="iddoktor" value="<?php echo $iddokter; ?>" required>

            <br>
         

            <label for="idpasien">Patient ID</label>
            <input type="text" id="idpasien" name="idpasien" value="<?php echo $idpasien; ?>" required>

            <br>
            <label for="history">Medical History</label>
            <?php
            $arrayriwayat = [];
            foreach($ro as $val){
                array_push($arrayriwayat, $val);
            }

            foreach($arrayriwayat as $vall){
                echo '<input type="textarea" id="history" name="history[]" value="'.$vall.'" required>';
            }

            ?>

            <label for="symptos">Symptoms</label>
            <input type="textarea" id="symptos" name="symptos" value="<?php echo $gejala; ?>" required>

            <label for="diagnosis">Diagnosis</label>
            <input type="textarea" id="diagnosis" name="diagnosis" value="<?php echo $diagnosa; ?>" required>
            <br>
            <label for="tindakan">action</label>
            <input type="textarea" id="tindakan" name="tindakan" value="<?php echo $tindakan; ?>" required>
            <br>
            <label for="tanggal">Record Date</label>
            <br>
            
            <input type="text" id="tanggal" name="tanggal" value="<?php echo $tanggalrm ?>" required>
            <br>
        
           
            <!-- Availability -->
          

            <br>
            <br>
            <input type="submit" value="update" name="update">
          </form>
        </div>
      </div>
      <br>
      <Br>
      <br>

    <?php
    
    }
    ?>
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