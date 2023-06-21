<!DOCTYPE html>
<html lang="en">

<head>
  <title>Transaction Data</title>

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
        <a href="adminpage_transaksi.php" class="active">
          <i class='bx bx-transfer'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Update transaction</span>
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
        <span class="dashboard">Transaction</span>
      </div>
    </nav>

    <?php
    $connectionString = "mongodb://localhost:27017";
    $databaseName = "clinic";
    $collectionName = "transaksi";
    $idtransaksi = $_GET['id'];
    $filter = ['transaction_id' => $idtransaksi];

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
      $transaction_id = $document->transaction_id;
      $transaction_date = $document->transaction_date;
      $patient_id = $document->patient_id;
      $doctor_id = $document->doctor_id;
      $doctor_fee = $document->doctor_fee;
      $medicine_qty = $document->medicine_qty;
      $transaction_total = $document->transaction_total;
      $payment_status = $document->payment_status;
     
    ?>



      <div class="home-content">
        <div class="isi" id="divInput">

          <form action="process_edit_transaksi.php" method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
            <h1 style="padding-left:2px">Update New Transaction Data</h1>

            <!-- Transaction ID -->
            <label for="transaction_id">Transaction ID</label>
            <input type="text" id="transaction_id" name="transaction_id" value="<?php echo $transaction_id; ?>" readonly>
            <br>
            <!-- Transaction date -->
            <label for="transaction_date">Transaction Date</label>
            <input type="text" id="transaction_date" name="transaction_date" value="<?php echo $transaction_date; ?>" readonly>
            <br>
            <!-- Patient ID -->
            <label for="patient_id">Patient ID</label>
            <input type="text" id="patient_id" name="patient_id" placeholder="Insert Patient ID..." value="<?php echo $patient_id; ?>" required>

            <!-- Doctor ID -->
            <label for="doctor_id">Doctor ID</label>
            <input type="text" id="doctor_id" name="doctor_id" value="<?php echo $doctor_id; ?>" required>

            <!-- Doctor fee -->
            <label for="doctor_fee">Doctor Fee</label>
            <input type="number" id="doctor_fee" name="doctor_fee" value="<?php echo $doctor_fee; ?>" required>

            <!-- Obat yang dibeli -->
            <label for="doctor_fee">Medicine & Quantity</label>
            <?php 
            foreach (get_object_vars($medicine_qty) as $property => $value) {
                echo '<div style="display: flex;">';
                echo '<input placeholder="Insert medicine name.." type="text" id="medicine" name="medicine[]" value="'.$property.'" required>';
                echo '<input placeholder="Insert medicine quantity.." type="number" id="quantity" name="quantity[]" value="'.$value.'" required>';
                echo '</div>';
              }
            ?>

            <!-- Transaction total -->
            <label for="transaction_total">Transaction Total</label>
            <input type="number" id="transaction_total" name="transaction_total" value="<?php echo $transaction_total; ?>" required>

            <!-- Payment status -->
            <label>Payment status</label><br>
            <input type="radio" id="paid" name="payment_status" value="paid" <?php if ($payment_status == "paid") {
                                                                        echo " checked='checked'";
                                                                      } ?>>
            <label for="paid">Paid</label>
            <input type="radio" id="unpaid" name="payment_status" value="unpaid" <?php if ($payment_status == "unpaid") {
                                                                            echo " checked='checked'";
                                                                          } ?>>
            <label for="unpaid">Unpaid</label>
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