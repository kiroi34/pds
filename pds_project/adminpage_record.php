<?php include 'connect.php';

$timesql = "SELECT login_id FROM login_table ";
$timestmt = $pdo->prepare($timesql);
$timestmt->execute();

?>
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
  <link rel="stylesheet" href="fa_icons/css/all.css">
  <link rel="stylesheet" href="inputDokter.css">
  <link rel="stylesheet" href="bootstrap.css">


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



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
  </style>
  <script>

  </script>


</head>
<script>
  $(document).ready(function() {
    var table = $('#example').DataTable({
      dom: "B<'row'<'col-sm-6'l><'col-sm-6'f>>tipr",
      buttons: [
        'copy', 'csv', 'excel'
      ],
      buttons: {
        dom: {
          button: {
            tag: "button",
            className: "btn btn-outline-dark mb-3 mx-1 rounded p-2"
          },
          buttonLiner: {
            tag: null
          }
        }
      },
    });
  });
</script>

<body>

  <!-- navbar -->
  <div class="sidebar" style="width:100%">
    <div class="logo-details">
      <i class='bx bx-user'></i>
      <br>
      <span class="logo_name"><b>Admin</b><br>XYZ CLINIC</span>
    </div>
    <ul class="nav-links" style="margin-left:-20px">
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
        <a href="adminpage_record.php" class="active">
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
        <span class="dashboard">Patient Records</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="box-topic"><a href="#" onclick="showInput()" style="color: #080710">Input New Patient Record Data</a></div>
          <i class='bx bx-right-arrow-alt' href="#"></i>
        </div>
      </div>

      <div class="home-content" >
        <div class="isi" id="divInput" style="display:none" >
          <form action="process_insert_record.php" method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
            <i class="fas fa-times" onclick="closeInput()" style="font-size:20px;color:red; float: right;"></i>

            <h1 style="padding-left:2px">Insert new Record data</h1>
            <br>

            <label for="type">ID Pasien</label>
            <select id="type" name="idPatient" required>
              <option value="pilihan">--Choose Patient ID --</option>
              <?php
              while ($data = $timestmt->fetch()) {
                echo "<option value='" . $data['login_id'] . "'>" . $data['login_id'] . "</option>";
              }
              ?>
            </select>
            <br>
            <br>
            <label for="type">ID Doctor</label>
            <select id="type" name="idDoc" required>
              <option value="pilihan">--Choose Doctor ID --</option>
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

              $array_dokter = [];

              // Looping untuk setiap dokumen
              foreach ($cursor as $document) {
                // Mengakses properti dokumen
                $iddokter = $document->id_dokter;
                array_push($array_dokter, $iddokter);
              }

              foreach ($array_dokter as $arraydoktervalue) {
                echo "<option value='" . $arraydoktervalue . "'>" . $arraydoktervalue . "</option>";
              }
              ?>
            </select>

            <br>
            <br>
            <label for="riwayatobat">Riwayat Obat</label>
            <div id="riwayatobatContainer">
              <input type="textarea" id="riwayatobat" name="riwayatobat[]" placeholder="Insert Riwayat Obat..." required>
              <br>
            </div>
            <button class='btn btn-primary' type="button" onclick="addRiwayatObat()">Add another</button>
            <br>
            <br>
            <label for="gejala">Gejala Pasien</label>
            <input type="textarea" id="gejala" name="gejala" placeholder="Insert Gejala Pasien..." required>
            <br>
            <label for="diagnosa">Diagnosa Pasien</label>
            <input type="textarea" id="diagnosa" name="diagnosa" placeholder="Insert diagnosa pasien..." required>
            <br>
            <label for="tindakan">Tindakan Dilakukan</label>
            <input type="textarea" id="tindakan" name="tindakan" placeholder="Insert tindakan dilakukan..." required>
            <br>
            <label for="tanggal">Tanggal Rekam Medis</label>
            <br>
            <input type="date" id="tanggal" name="tanggal" placeholder="Insert tanggal rekam medis..." required>
            <br>
            <br>
            <input type="submit" value="Submit" name="submit">
          </form>
        </div>
      </div>



      <div class="home-content">
        <div class="overview-boxes">
          <div class="isi">
            <div class="right-side">
              <h2>List Record</h2>
              <table id="example" class="table table-striped" style="width:100%; text-align: center;">
                <thead>
                  <tr>
                    <th>Number</th>
                    <th>Record ID </th>
                    <th>Doctor ID </th>
                    <th>Patient ID</th>
                    <th>Medicine History</th>
                    <th>Symptoms</th>
                    <th>Diagnosis</th>
                    <th>Action</th>
                    <th>Record Date</th>
                    <th>Delete</th>
                    <th>Update</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $connectionString = "mongodb://localhost:27017";
                  $databaseName = "clinic";
                  $collectionName = "record";

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
                    $idrecord = $document->id_record;
                    $iddokter = $document->id_dokter;
                    $idpasien = $document->id_pasien;
                    $riwayatobat = $document->riwayat_obat;
                    $gejala = $document->gejala_pasien;
                    $diagnosa = $document->diagnosa_pasien;
                    $tindakan = $document->tindakan_dilakukan;
                    $tanggalrm = $document->tanggal_rekam_medis;

                    // Menampilkan data dalam format HTML
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    echo "<td>" . $idrecord . "</td>";
                    echo "<td>" . $iddokter . "</td>";
                    echo "<td>" . $idpasien . "</td>";
                    echo "<td>";
                    foreach ($riwayatobat as $ro) {
                      echo $ro . "<br>";
                    }
                    echo "</td>";
                    echo "<td>" . $gejala . "</td>";
                    echo "<td>" . $diagnosa . "</td>";
                    echo "<td>" . $tindakan . "</td>";
                    echo "<td>" . $tanggalrm . "</td>";
                    echo "<td id='btnn".$idrecord."'><a type='button' class='btn btn-danger' href='delete_record.php?id=".$idrecord."'>Delete</a></td>";
                    
                    echo "<form action='adminpage_edit_record.php' method='post'>";
                    echo "<input type='hidden' name='dapetinID' value=".$idrecord.">";
                    echo"<td><button type='submit'  value='update' name='update' class='btn btn-warning stlye'>Update</button></td>";
                   echo "</form>";
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
    function addRiwayatObat() {
      const container = document.getElementById("riwayatobatContainer");
      const input = document.createElement("input");
      input.type = "textarea";
      input.name = "riwayatobat[]";
      input.placeholder = "Insert Riwayat Obat...";
      input.required = true;
      container.appendChild(input);
      container.appendChild(document.createElement("br"));
    }
  </script>
</body>

</html>