<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Client</title>

   <!-- bootstrap css -->
   <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
   <!-- style css -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->
   <!-- Responsive-->
   <!-- <link rel="stylesheet" href="css/responsive.css"> -->
   <!-- fevicon -->
   <!-- <link rel="icon" href="images/fevicon.png" type="image/gif" /> -->
   <!-- Scrollbar Custom CSS -->
   <!-- <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css"> -->
   <!-- Tweaks for older IEs-->
   <!-- <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"> -->
   <!-- owl stylesheets -->
   <!-- <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->
   <!-- Tambahan -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


   <style>
      body {
         background-color: #1b262c;
      }

      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
         color: #ffffff;
      }

      .jadwal {
         border: none;
         background-image: linear-gradient(to right, #3282B8, #BBE1FA);
      }

      .jumbotron {
         padding: 2rem;
         background-color: #e9ecef;

      }

      #spec {
         font-size: 6.5em;
      }
   </style>
</head>

<body>
   <!-- header section start -->
   <div class="header_section">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item ">
                  <a class="nav-link" href="index.html">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Profile.html">Profile</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Speciality.html">Speciality</a>
               </li>
               <li class="nav-item active ">
                  <a class="nav-link" href="Book.php">Book</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#"><img src="images/search-icon.png"></a>
               </li>
            </ul>
         </div>
      </nav>
   </div>
   <!-- header section end -->

   <?php
   date_default_timezone_set('Asia/Jakarta');
   $connectionString = "mongodb://localhost:27017";
   $databaseName = "clinic";
   $collectionName = "dokter";

   $manager = new MongoDB\Driver\Manager($connectionString);

   $query = new MongoDB\Driver\Query([]);

   $database = $databaseName;
   $collection = $collectionName;

   $cursor = $manager->executeQuery("$database.$collection", $query);

   $spesialis = [];
   $nama_dokter = [];
   $jadwal = [];
   $hari = [];
   $foto = [];

   // Masukkan ke array spesialis
   foreach ($cursor as $document) {
      // Spesialis
      array_push($spesialis, $document->spesialis);
      // Nama dokter
      $fieldObject = $document->biodata;
      $nestedField = $fieldObject->name;
      array_push($nama_dokter, $nestedField);
      // Jadwal
      array_push($jadwal, $document->jadwal);
      // Hari
      array_push($hari, $document->hari);
      // Foto
      array_push($foto, $document->foto);
   }

   $q = 0;

   // Echo spesialis dan dokternya
   for ($i = 0; $i < count($spesialis); $i++) {
      // ambil nama spesialis
      $nama_spesialis = $spesialis[$i];
      $temp = [];
      if ($nama_spesialis != 'done') {
         $q++;
         if ($q % 2 == 0) {
            echo "<div class='row g-0'><div id='pengisi' class='col-lg-5 d-flex align-items-center justify-content-center' 
                  style='background-color:#BBE1FA'><h1 id='spec' class='text-center' style='color:#0F4C75'><b> Sp. " . ucwords($nama_spesialis) .
               "</b></h1></div><div id='keterangan' class='col-lg-7 g-0'>";
            echo "<div class='jumbotron' style='background-color:#0F4C75'>";
         } else {
            echo "<div class='row g-0'><div id='pengisi' class='col-lg-5 d-flex align-items-center justify-content-center' 
                  style='background-color:#3282B8'><h1 id='spec' class='text-center'><b>Sp. " . ucwords($nama_spesialis) .
               "</b></h1></div><div id='keterangan' class='col-lg-7 g-0'>";

            echo "<div class='jumbotron' style='background-color:#0F4C75'>";
         }

         for ($j = 0; $j < count($spesialis); $j++) { // cari yang sama dengan $nama_spesialis
            if ($spesialis[$j] == $nama_spesialis && $spesialis[$j] != 'done') {
               array_push($temp, $j);
               $spesialis[$j] = 'done';
            }
         }

         // Hari ini
         $currentDayOfWeek = date('w');

         for ($k = 0; $k < count($temp); $k++) { //echo semua yg diperlukan di dokter itu
            echo "<div class='row g-0'><div class='col-lg-6'>";
            // Echo photo
            echo "<img src='" . $foto[$temp[$k]] . "' width='300' height='380'>";
            echo "</div>";
            echo "<div class='col-lg-6'>";
            // Echo nama dokter
            echo "<h1>" . $nama_dokter[$temp[$k]] . "</h1><br>";
            echo "<h5>Schedule : </h5>";
            echo "<h6>";
            // Echo hari dokter kerja
            for ($l = 0; $l < count($hari[$temp[$k]]); $l++) {
               $temppp = $hari[$temp[$k]];
               $dayOfWeekName = date('l', strtotime("Sunday +{$temppp[$l]} days"));
               if ($l < count($hari[$temp[$k]]) && $l != count($hari[$temp[$k]]) - 1) {
                  echo $dayOfWeekName, ", ";
               } elseif ($l == count($hari[$temp[$k]]) - 1) {
                  echo $dayOfWeekName;
               }
            }
            echo "</h6>";
            // Echo jadwal dokter
            $tempHari = $hari[$temp[$k]];

            echo "<div class='row'>";
            // Concat
            $jadual = '';
            $checkkk = 0;
            $tempjadwal = $jadwal[$temp[$k]];
            for ($m = 0; $m < count($tempjadwal); $m++) {
               if ($checkkk == 0) {
                  $jadual .= $tempjadwal[$m];
                  $checkkk++;
               } else {
                  $jadual .= ' - ' . $tempjadwal[$m];
               }
            }
            // button
            $modalId = "exampleModal" . $temp[$k];
            echo "<div class='col-lg-6'>";
            // Kalau hari ini kerja
            if (in_array($currentDayOfWeek, $tempHari)) {
               echo "<button type='button' class='btn btn-primary btn-lg jadwal' data-bs-toggle='modal' data-bs-target='#$modalId' style='margin-top:15px'>" . $jadual . "</button>";
            }
            // Kalau gak kerja
            else {
               echo "<button type='button' class='btn btn-secondary btn-lg' data-bs-toggle='tooltip' data-bs-placement='bottom' data-bs-title='Unavailable today' style='margin-top:15px'>" . $jadual . "</button>";
            }
            echo "</div>";
            // modal content
            echo "<div class='modal fade' id='$modalId' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
            echo "<div class='modal-dialog' role='document'>";
            echo "<div class='modal-content' style='background-color:#0F4C75'>";
            echo "<div class='modal-header'>";
            echo "<h5 class='modal-title' id='exampleModalLabel'>Please confirm your appointment</h5>";
            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>";
            echo "</button>";
            echo "</div>";
            echo "<div class='modal-body'>";
            echo "<h2>" . $nama_dokter[$temp[$k]] . "</h2>";
            echo "<h5>Specializes in: " . $nama_spesialis . "</h5>";
            echo "<br><h6>In-clinic hours : " . $jadual. "</h6>";
            echo "</div>";
            echo "<div class='modal-footer'>";
            echo "<button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>";
            echo "<a class='btn btn-primary' href='../pds_project/process_book.php?dokter=" . $nama_dokter[$temp[$k]] . "&spesialis=". $nama_spesialis ."'>Confirm</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<br><br>";
            echo "</div></div></div><br><br>"; // Close the row and col-lg-3 divs
         }
         echo "</div></div></div>"; // Close the jumbotron div
      }
   }
   ?>

   <!-- footer section start -->
   <div class="footer_section layout_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-3 col-sm-6">
               <div class="footer_logo"><a href="index.html"><img src="images/footer-logo.png"></a></div>
               <h1 class="adderss_text">Contact Us</h1>
               <div class="map_icon"><img src="images/map-icon.png"><span class="paddlin_left_0">Siwalankerto</span></div>
               <div class="map_icon"><img src="images/call-icon.png"><span class="paddlin_left_0">+62 821 34979750</span></div>
               <div class="map_icon"><img src="images/mail-icon.png"><span class="paddlin_left_0">XYZClinic@gmail.com</span></div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <h1 class="adderss_text">Our Speciality</h1>
               <div class="hiphop_text_1">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <h1 class="adderss_text">Facility</h1>
               <div class="Useful_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered ,</div>
            </div>
            <div class="col-lg-3 col-sm-6">

               <div class="social_icon">
                  <ul>
                     <li><a href="#"><img src="images/fb-icon.png"></a></li>
                     <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                     <li><a href="#"><img src="images/linkedin-icon.png"></a></li>
                     <li><a href="#"><img src="images/instagram-icon.png"></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- footer section end -->
   <!-- copyright section start -->
   <div class="copyright_section">
      <div class="container">
         <p class="copyright_text">2023 All Rights Reserved. Design by <a href="https://html.design">Alan Brandon Steffan</a></p>
      </div>
   </div>
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="js/plugin.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   <!-- javascript -->
   <script src="js/owl.carousel.js"></script>
   <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   <script>
      // Initialize tooltips
      $(function () {
         $('[data-bs-toggle="tooltip"]').tooltip();
      });
   </script>
</body>

</html>