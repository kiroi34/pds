

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Daftar Jemaat yang Mendaftar Pelayanan</title>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
     <link rel="stylesheet" href="homeAdmin.css"> 
     <link rel="stylesheet" href="fa_icons/css/all.css">
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
        });
    </script>
     <style>
 
     </style>
   </head>

<body>

  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-user'></i>
      <span class="logo_name">Admin</span>
    </div>
      <ul class="nav-links" style="margin-left:-32px">
        <li>
          <a href="homeAdmin.php" class="active">
            <i class='bx bx-home-alt' ></i>
            <span class="links_name">Home</span>
          </a>
        </li>
        <li>
          <a href="postingNews.php">
            <i class='bx bx-news' ></i>
            <span class="links_name">Posting News</span>
          </a>
        </li>
        <li>
          <a href="inputGaleri.php">
            <i class='bx bx-photo-album' ></i>
            <span class="links_name">Input Galeri</span>
          </a>
        </li>
        
       
      
       
       
        <br>
        
      </ul>
  </div>
  
     <!-- home -->
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Data Booking Pasien</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="isi">
          <div class="right-side">
            <h2>List Pasien</h2>
            <div class="table-responsive">
          <div style="overflow-x: auto;">
            <table id="example" class="table table-striped" style="width:100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Queue Number</th>
                        <th>Id Pasient</th>
                        <th>Patient Name</th>
                        <th>Gender</th>
                        <th>Date Of Birth</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>ID Booking</th>
                    </tr>
                </thead> 
                <tbody>
                  <?php
                  $connectionString = "mongodb://localhost:27017";
                  $databaseName = "clinic";
                  $collectionName = "pasien";
              
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
                      $idpasien= $document->id_pasien;
                      $patientName = $document->name_pasien;
                      $gender = $document->gender_pasien;
                      $dob = $document->DOB_pasien;
                      $phoneNumber = $document->phone_pasien;
                      $address = $document->address_pasien;

                      // Menampilkan data dalam format HTML
                      echo "<tr>";
                      echo "<td>" . $count . "</td>";
                      echo "<td>" . '0' . "</td>";
                      echo "<td>" . $idpasien. "</td>";
                      echo "<td>" . $patientName. "</td>";
                      echo "<td>" . $gender . "</td>";
                      echo "<td>" . $dob . "</td>";
                      echo "<td>" . $phoneNumber . "</td>";
                      echo "<td>" . $address . "</td>";
                      echo "<td>" . '0' . "</td>";
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
      </div>
    </div>

  </section>



  <script>
     
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")){
        sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
        }else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
 </script>
</body>
</html>

