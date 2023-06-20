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
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
 

  <style>
    .horizontal-container {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
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
          <i class='bx bx-book-open'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Booking List</span>
        </a>
      </li>
      <li>
        <a href="adminpage_dokter.php" class="active">
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
        <a href="adminpage_kasir.php">
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
        <span class="dashboard">Dokter </span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="box-topic"><a href="#" onclick="showInput()" style="color: #080710">Input New Doctor Data</a></div>
          <i class='bx bx-right-arrow-alt' href="#"></i>
        </div>
      </div>



      <div class="home-content">
        <div class="isi" id="divInput" style="display:none">

          <form action="process_insert_doctor.php" method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
            <i class="fas fa-times" onclick="closeInput()" style="font-size:20px;color:red; float: right;"></i>
            <h1 style="padding-left:2px">Insert new doctor data</h1>
            <br>
            <h2 style="padding-left:2px">Technical Detail</h2>
            <label for="foto">Photo</label>
            <input type="text" id="foto" name="foto" placeholder="Insert Doctor Photo..." required>

            <label for="specialization">Specialization</label>
            <input type="text" id="specialization" name="specialization" placeholder="Insert Doctor Specialization..." required>

            <br>
            <h2 style="padding-left:2px">Biodata</h2>

            <label for="nama">Name</label>
            <input type="text" id="nama" name="nama" placeholder="Insert Doctor Name..." required>

            <label>Gender</label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>
            <br>

            <label for="dob">Date Of Birth</label>
            <br>
            <input type="date" id="dob" name="dob" required>
            <br>
            <br>
            <label for="email">Email</label>
            <input type="textarea" id="email" name="email" placeholder="Insert Doctor email..." required>

            <label for="alamat">Address</label>
            <input type="textarea" id="alamat" name="alamat" placeholder="Insert Doctor Address..." required>

            <label for="phone">Phone Number</label>
            <input type="textarea" id="phone" name="phone" placeholder="Insert Doctor Phone Number..." required>
            <br>
            <h2 style="padding-left:2px">Schedule</h2>
            <!-- Hari -->
            <h5>Available days</h5>
            <input type="checkbox" id="sunday" name="days[]" value="0">
            <label for="sunday">Sunday</label><br>
            <input type="checkbox" id="monday" name="days[]" value="1">
            <label for="monday">Monday</label><br>
            <input type="checkbox" id="tuesday" name="days[]" value="2">
            <label for="tuesday">Tuesday</label><br>
            <input type="checkbox" id="wednesday" name="days[]" value="3">
            <label for="wednesday">Wednesday</label><br>
            <input type="checkbox" id="thursday" name="days[]" value="4">
            <label for="thursday">Thursday</label><br>
            <input type="checkbox" id="friday" name="days[]" value="5">
            <label for="friday">Friday</label><br>
            <input type="checkbox" id="saturday" name="days[]" value="6">
            <label for="saturday">Saturday</label><br>

            <!-- Jam -->
            <h5>Available hours</h5>
            <label for='start_time'>Start : </label>
            <input type="time" id="start_time" name="start_time" required>
            <label for='end_time'>End : </label>
            <input type="time" id="end_time" name="end_time" required>


            <br>
            <br>
            <input type="submit" value="Submit" name="submit">
          </form>
        </div>
      </div>
      <br>
      <br>
      <br>

      <input style="float:right;width:300px" type="text" id="searchInput" placeholder="Search" onkeyup="filterArticles()">
      <section class="articles">

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
          // Mengakses properti dokumen
          $iddokter = $document->id_dokter;
          $riwayatregister = $document->registered;
          $spesialis = $document->spesialis;
          $biodata = $document->biodata;
          $hari = $document->hari;
          $jadwal = $document->jadwal;
        ?>

          <article>
            <div class="article-wrapper" style="margin-left:20px">

              <?php echo "<img src='" . $foto[$counter] . "'>"; ?>
              <br>
              <br>
              <div class="details">

                <?php
                echo "<h3>ID : " . $iddokter . "</h3>";
                echo "<h3>Registered : " . $riwayatregister . "</h3>";

                echo "<h3>" . "Specialization : " . $spesialis . "</h3><br>";

                foreach ($biodata as $key => $bo) {
                  echo "<h3>" . $key . " : " . $bo . "<br>" . "</h3>";;
                }
                echo "<br>";
                echo "<h3>" . "Schedule : " . "</h3>";

                echo "<div class='horizontal-container'>";
                $check = count($hari);
                $checkk = 1;
                foreach ($hari as  $hr) {
                  if ($checkk < $check) {
                    echo "<h4>" . date('l', strtotime("Sunday +{$hr} days")) . ",  " . "</h4>";
                  } else {
                    echo "<h4>" . date('l', strtotime("Sunday +{$hr} days")) . "</h4>";
                  }
                  $checkk++;
                }
                echo "</div>";
                echo "<br>";
                echo "<div class='grid-container'>";
                $countt = 0;
                foreach ($jadwal as $jd) {
                  if ($countt == 0) {
                    echo "<h4>Start shift : " . $jd .  "</h4>";
                  } elseif ($countt == 1) {
                    echo "<h4>End shift : " . $jd .  "</h4>";
                  }
                  $countt++;
                }
                echo "</div>";
                echo "<br>";

                ?>
              </div>

              <br>

              
              <div class="btn-group" style="width:100%">
                <form action="adminpage_edit_dokter.php" method="post">
                  <input type="hidden" name="dapetinID" value="<?php echo $iddokter ?>">
                  <button class="edit" value="update" name="update" style="width: 45%;">Edit Biodata</button>
                </form>

                <form action="delete_doctor.php" method="post">
                  <input type="hidden" name="dapetinNama" value="<?php echo $iddokter ?>">
                  <button class="edit" value="delete" name="delete" style="width: 45%; background-color: #FF4136;">Delete</button>
                </form>
              </div>
            </div>

          </article>





        <?php
          $counter++;
        }
        ?>


      </section>
  </section>
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
  <script>
    function showInput() {
      document.getElementById("divInput").style.display = '';
    }

    function closeInput() {
      document.getElementById("divInput").style.display = 'none';
    }

    function filterArticles() {
      var input, filter, articles, i, article;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      articles = document.getElementsByClassName("articles")[0].getElementsByTagName("article");

      for (i = 0; i < articles.length; i++) {
        article = articles[i];
        if (article.innerHTML.toUpperCase().indexOf(filter) > -1) {
          article.style.display = "";
        } else {
          article.style.display = "none";
        }
      }
    }
  </script>

</body>

</html>