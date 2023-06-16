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
  <link rel="stylesheet" href="inputDokter.css">
  <link rel="stylesheet" href="fa_icons/css/all.css"> 

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
        <a href="adminpage_dokter.php" class="active" >
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Dokter</span>
        </a>
      </li>
      <li>
        <a href="adminpage_record.php">
          <i class='bx bx-home-alt'></i>
          <span class="links_name" style="color: #F2E3DB; font-size:18px">Record Pasien</span>
        </a>
      </li>
      <li>
        <a href="adminpage_transaksi.php" >
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
    
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
            <div class="box-topic"><a href="#" onclick="showInput()" style="color: #080710;">Input Data Dokter Baru</a></div>
            <i class='bx bx-right-arrow-alt' href="#"></i>
        </div>
      </div>
      


      <div class="home-content">
        <div class="isi" id="divInput" style="display:none">
          
            <form action="inputPendeta.php" method="post" onsubmit="return validateForm()" name="myForm" enctype="multipart/form-data">
              <i class="fas fa-times" onclick="closeInput()" style="font-size:20px;color:red; float: right;"></i> 
              <h2 style="padding-left:2px">Inputkan Data Dokter Baru</h2>
              <br>
                <label for="jabatan">Jabatan</label>
                <select id="jabatan" name="jabatan" required>
                  <option value="pilihan">--Pilih Jabatan--</option>
                </select>

                <label for="nama">Nama Lengkap Pengurus</label>
                <input type="text" id="nama" name="nama" placeholder="Masukan Nama Pengurus..." required>
            
                <label for="biodata">Biodata</label>
                <input type="textarea" id="biodata" name="biodata" placeholder="Biodata Pengurus..." required>

                <br>
                <br>
                
                <label for="foto">Upload Foto</label>
                <br>
                <input type="file" id="foto" name="foto">

                <br>
                <br>
                <input type="submit" value="Submit" name="submit">
              </form>
        </div>
</div>
<br>
<Br>
<br>


      
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
</body>

</html>