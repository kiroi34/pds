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
  <link rel="stylesheet" href="inputCashier.css">
  <!-- css untuk csv dan search -->
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
 
        $(document).ready(function() {
            var table = $('#example').DataTable( {
            dom: "B<'row'<'col-sm-6'l><'col-sm-6'f>>tipr",
                buttons: [
                'copy','csv','excel'
                ],
                buttons: {
                dom: {
                    button:{
                    tag: "button",
                    className: "btn btn-outline-dark mb-3 mx-1 rounded p-2"
                    },
                    buttonLiner: {
                    tag: null
                    }
                }
                },
            } );
          }
    );

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
    <ul class="nav-links" style="margin-left:-20px">
    <li>
        <a href="adminpage.php">
          <i class='bx bx-book-open'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Booking List</span>
        </a>
      </li>
      <li>
        <a href="adminpage_dokter.php" >
          <i class='bx bxs-user-detail'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Dokter</span>
        </a>
      </li>
      <li>
        <a href="adminpage_record.php">
          <i class='bx bx-data'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Patient records</span>
        </a>
      </li>
      <li>
        <a href="adminpage_transaksi.php" class="active">
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
                        <th>Count</th>
                        <th>ID Transaksi</th>
                        <th>Date Transaksi</th>
                        <th>ID Pasien</th>
                        <th>ID Dokter</th>
                        <th>Nama Obat</th>
                        <th>Jumlah Obat</th>
                        <th>Harga Dokter</th>
                        <th>Total Harga </th>
                        <th>Status</th>
                   


                    </tr>
                </thead>
                <tbody>
                  <?php
                  $connectionString = "mongodb://localhost:27017";
                  $databaseName = "clinic";
                  $collectionName = "transaksi";
              
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
                      $idtransaksi= $document->transaction_id;
                      $datetransaksi= $document->transaction_date;
                      $idpasien= $document->patient_id;
                      $iddokter= $document->doctor_id;
                      $hargaDokter = $document->doctor_fee;
                      $totalHarga = $document->transaction_total;
                      $status = $document->payment_status;
                      $jumlahobat = $document->medicine_qty;

                      // Menampilkan data dalam format HTML
                      echo "<tr>";
                      echo "<td>" . $count . "</td>";
                      echo "<td>" . $idtransaksi. "</td>";
                      echo "<td>" . $datetransaksi. "</td>";
                      echo "<td>" . $idpasien . "</td>";
                      echo "<td>" . $iddokter . "</td>";
                      echo "<td>";
                      foreach ($jumlahobat as $key => $nm) {
                        echo $key . "<br>";
                    }
                    echo "</td>";
                      echo "<td>";
                      foreach ($jumlahobat as $jo) {
                        echo $jo . "<br>";
                    }
                    echo "</td>";
                      echo "<td>" . $hargaDokter . "</td>";
                      echo "<td>" . $totalHarga . "</td>";
                      echo "<td>" . $status . "</td>";
                      echo "</tr>";

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