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
<!-- tabel -->
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
     function hapus(id) {
            Swal.fire({
                title: 'are you sure delete this medicine?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                denyButtonText: `Delete`,
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url: 'delete_medicine.php',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(result) {
                      location.reload();
                    }  
                  });
                }
              })
          }
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
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Booking List</span>
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
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Patient Records</span>
        </a>
      </li>
      <li>
        <a href="adminpage_transaksi.php">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Transaction</span>
        </a>
      </li>
      <li>
        <a href="adminpage_medicine.php" class="active">
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
        <span class="dashboard">Medicine </span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="box-topic"><a href="#" onclick="showInput()" style="color: #080710;">Insert New Medicine Data</a></div>
          <i class='bx bx-right-arrow-alt' href="#"></i>
        </div>
      </div>



      <div class="home-content">
        <div class="isi" id="divInput" style="display:none">

          <form action="process_insert_medicine.php" method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
            <i class="fas fa-times" onclick="closeInput()" style="font-size:20px;color:red; float: right;"></i>
            <h1 style="padding-left:2px">Insert New Medicine Data</h1>
          
            <h2 style="padding-left:2px">Technical Detail</h2>
            
            <label for="namaObat">Medicine Name</label>
            <input type="text" id="namaObat" name="namaObat" placeholder="Insert Medicine Name..." required>
            <br>

            <label for="type">Medicine Type</label>
            <select id="type" name="type" required>
                  <option value="pilihan">--Choose Type --</option>
                  <?php
                  while ($data = $timestmt->fetch()){
                      echo "<option value='" . $data['id_obat'] . "'>" . $data['jenis_obat'] . "</option>";
                      }
                  ?>
                </select>

            <br>
            <label for="harga">Medicine Price </label>
            <input type="number" id="harga" name="harga" placeholder="Insert Medicine Price..." required>
            <br>
            <label for="stock">Medicine Stock </label>
            <input type="number" id="stock" name="stock" placeholder="Insert Medicine Price..." required>
            <br>
            <input type="submit" value="Submit" name="submit">
          </form>
        </div>
      </div>
      <br>



      <!-- read data -->
    <div class="home-content">
      <div class="overview-boxes">
        <div class="isi">
          <div class="right-side">
            <h2>List Obat</h2>
          <div class="table-responsive">
          <div style="overflow-x: auto;">
            <table id="example" class="table table-striped" style="width:100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Medicine ID</th>
                        <th>Medicine Name</th>
                        <th>Medicine Type</th>
                        <th>Medicine Price</th>
                        <th>Stock Medicine</th>
                    </tr>
                </thead> 
                <tbody>
                <?php
                      include 'connect.php';
                        $sql =  'SELECT id_medicine, name_medicine, type_obat.jenis_obat, price_medicine, stock_medicine 
                        FROM medicine inner join type_obat on type_obat.id_obat=medicine.type_medicine';
                        $stmt = $conn->query($sql);
                    
                      while($data = mysqli_fetch_array($stmt))
                      { 
                ?>
                    <tr>
                    <td><?php echo $data['id_medicine']; ?></td>
                    <td><?php echo $data['name_medicine']; ?></td>
                    <td><?php echo $data['jenis_obat']; ?></td>
                    <td><?php echo $data['price_medicine']; ?></td>
                    <td><?php echo $data['stock_medicine']; ?></td>
                    <td id="btnn<?php echo $data['id_medicine'];?>"><button type="button" class="btn btn-danger" onclick="hapus('<?php echo $data['id_medicine']; ?>')">Hapus</button></td>
                    </tr>
                <?php
                      }
                ?>



            
                </tbody>
                
           </table>
           </div>
                </div>
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
</body>

</html>