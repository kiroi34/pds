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
        <a href="adminpage_dokter.php" class="active">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Update Dokter</span>
        </a>
      </li>
      <li>
        <a href="adminpage_record.php">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Record Pasien</span>
        </a>
      </li>
      <li>
        <a href="adminpage_transaksi.php">
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
        <span class="dashboard">Dokter </span>
      </div>
    </nav>

    <?php
    $connectionString = "mongodb://localhost:27017";
    $databaseName = "clinic";
    $collectionName = "dokter";
    $iddokter = $_POST['dapetinID'];
    $filter = ['id_dokter' => $iddokter];

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
      $foto = $document->foto;
      $iddokter = $document->id_dokter;
      $riwayatregister = $document->registered;
      $spesialis = $document->spesialis;
      $biodata = $document->biodata;
      $hari = $document->hari;
      $jadwal = $document->jadwal;

      $jadwalcontainer = [];
      foreach ($jadwal as $value) {
        array_push($jadwalcontainer, $value);
      }

    ?>


      <div class="home-content">
        <div class="isi" id="divInput">

          <form action="process_edit_doctor.php" method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
            <h1 style="padding-left:2px">Update Data Dokter Baru</h1>
            <label for="iddok">Id Dokter</label>
            <input type="text" id="iddok" name="iddok" value="<?php echo $iddokter; ?>" readonly>
            <br>
            <h2 style="padding-left:2px">Technical Detail</h2>
            <label for="foto">Photo</label>
            <input type="text" id="foto" name="foto" placeholder="Insert Doctor Photo..." value="<?php echo $foto; ?>" required>

            <label for="specialization">Specialization</label>
            <input type="text" id="specialization" name="specialization" value="<?php echo $spesialis; ?>" required>

            <br>
            <h2 style="padding-left:2px">Biodata</h2>

            <label for="nama">Name</label>
            <input type="text" id="nama" name="nama" value="<?php echo $biodata->name; ?>" required>

            <label>Gender</label><br>
            <input type="radio" id="male" name="gender" value="male" <?php if ($biodata->gender == "male") {
                                                                        echo " checked='checked'";
                                                                      } ?>>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" <?php if ($biodata->gender == "female") {
                                                                            echo " checked='checked'";
                                                                          } ?>>
            <label for="female">Female</label><br>
            <br>

            <label for="dob">Date Of Birth</label>
            <br>
            <input type="date" id="dob" name="dob" value="<?php echo date("Y-m-d", strtotime($biodata->DOB)); ?>" required>
            <br>
            <br>
            <label for="email">Email</label>
            <input type="textarea" id="email" name="email" value="<?php echo $biodata->email; ?>" required>

            <label for="alamat">Address</label>
            <input type="textarea" id="alamat" name="alamat" value="<?php echo $biodata->address; ?>" required>

            <label for="phone">Phone Number</label>
            <input type="textarea" id="phone" name="phone" value="<?php echo $biodata->phone; ?>" required>
            <br>
            <h2 style="padding-left:2px">Schedule</h2>
            <!-- Hari -->
            <h5>Available days</h5>
            <input type="checkbox" id="day0" name="days[]" value="0">
            <label for="sunday">Sunday</label><br>
            <input type="checkbox" id="day1" name="days[]" value="1">
            <label for="monday">Monday</label><br>
            <input type="checkbox" id="day2" name="days[]" value="2">
            <label for="tuesday">Tuesday</label><br>
            <input type="checkbox" id="day3" name="days[]" value="3">
            <label for="wednesday">Wednesday</label><br>
            <input type="checkbox" id="day4" name="days[]" value="4">
            <label for="thursday">Thursday</label><br>
            <input type="checkbox" id="day5" name="days[]" value="5">
            <label for="friday">Friday</label><br>
            <input type="checkbox" id="day6" name="days[]" value="6">
            <label for="saturday">Saturday</label><br>

            <br>
            <!-- Jam -->
            <h5>Available hours</h5>
            <label for='start_time'>Start : </label>
            <input type="time" id="start_time" name="start_time" value='<?php echo $jadwalcontainer[0] ?>' required>
            <label for='end_time'>End : </label>
            <input type="time" id="end_time" name="end_time" value='<?php echo $jadwalcontainer[1] ?>' required>

            <br>
            <br>
            <!-- Availability -->
            <h5>Availability</h5>
            <input type="radio" id="available" name="availability" value="1" <?php if ($document->availability == "1") {
                                                                        echo " checked='checked'";
                                                                      } ?>>
            <label for="available">Available today</label>
            <input type="radio" id="unavailable" name="availability" value="0" <?php if ($document->availability == "0") {
                                                                            echo " checked='checked'";
                                                                          } ?>>
            <label for="female">Not available for today</label><br>
            <br>

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
      $counter++;
      foreach ($hari as $value) {
        echo "<script> document.getElementById('day" . $value . "').checked = true;</script>";
      }
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