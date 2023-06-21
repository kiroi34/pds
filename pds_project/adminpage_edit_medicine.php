<?php
require_once "connect.php";
  
  $timesql = "SELECT * FROM type_obat ";
  $timestmt = $pdo->prepare($timesql);
  $timestmt->execute();

?>

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
      <li>
        <a href="adminpage_medicine.php" class="active">
          <i class='bx bx-capsule' ></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Update Medicine</span>
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
        <span class="dashboard">Update Medicine </span>
      </div>
    </nav>

<!-- coba tarik dari database ke admin page -->
<?php

include 'connect.php'; // Using database connection file here
$id = $_POST['dapetinID'];
$records = mysqli_query($conn,"SELECT id_medicine, name_medicine, type_obat.jenis_obat, price_medicine, stock_medicine 
FROM medicine inner join type_obat on type_obat.id_obat=medicine.type_medicine WHERE id_medicine='$id'"); // fetch data from database harus pakai join buat jabatan
while($data = mysqli_fetch_array($records))
{
?>

      <div class="home-content">
        <div class="isi" id="divInput">

          <form action="update_medicine.php" method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
            <h1 style="padding-left:2px">Insert New Medicine Data</h1>
          
            <h2 style="padding-left:2px">Technical Detail</h2>
            
            <label for="id">Medicine ID </label>
            <input type="text" id="id" name="id" value="<?php echo $data['id_medicine']; ?> " readonly>

            <label for="namaObat">Medicine Name</label>
            <input type="text" id="namaObat" name="namaObat" value="<?php echo $data['name_medicine']; ?> "required>
            <br>

            <label for="type">Medicine Type</label>
            <select id="type" name="type" required>
            <option value="pilihan"><?php echo $data['jenis_obat']; ?></option>
                  <?php
                  while ($data2 = $timestmt->fetch()){
                      echo "<option value='" . $data2['id_obat'] . "'>" . $data2['jenis_obat'] . "</option>";
                      }
                  ?>
            </select>
            <br>
            <label for="harga">Medicine Price </label>
            <input type="text" id="harga" name="harga" value="<?php echo $data['price_medicine']; ?> " required>
            <br>
            <label for="stock">Medicine Stock </label>
            <input type="text" id="stock" name="stock" value="<?php echo $data['stock_medicine']; ?> "required>
          
            <br>
            <input type="submit" value="update" name="update">
          </form>
        </div>
      </div>

   
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