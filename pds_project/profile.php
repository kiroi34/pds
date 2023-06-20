<!DOCTYPE html>
<?php
include "../login/connect.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../login/loginform.php');
    exit();
}

// Retrieve the existing user profile information from the database
$username = $_SESSION['username'];
$query = "SELECT nama, tanggal_lahir, gender, alamat, contact FROM login_table WHERE username = '$username'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama = $row['nama'];
    $dob = $row['tanggal_lahir'];
    $gender = $row['gender'];
    $alamat = $row['alamat'];
    $contact = $row['contact'];
} else {
    header('Location: ../login/loginform.php');
    echo "User profile not found.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $alamat = $_POST['alamat'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    // Validate input fields
    if (empty($password)) {
        echo "Password is required.";
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update the user profile in the database
    $query = "UPDATE login_table SET
                alamat = '$alamat',
                contact = '$contact',
                password = '$hashedPassword'
              WHERE username = '$username'";

    if ($mysqli->query($query)) {
        header('Location: ../homepage/profile.php');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
        exit();
    }
}

$mysqli->close();
?>

<head>
<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>News</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
     
    <style>
        body {
            /* font-family: Arial, sans-serif; */
            background-color: #CEEBED;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
        }

        h5 {
            text-align: center;
            margin-top: 50px;
        }

        a {
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            
        }

        button[type="button"] {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>

<body>
<div class="container">
  <h2>My Profile</h2>
  <form action="profile_edit.php" method="POST">
    <label for="nama">Fullname:</label>
    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" disabled><br>

    <label for="dob">Date of Birth:</label>
    <input type="text" id="dob" name="dob" value="<?php echo $dob; ?>" disabled><br>

    <label for="gender">Gender:</label>
    <input type="text" id="gender" name="gender" value="<?php echo $gender; ?>" disabled><br>

    <label for="alamat">Home Address:</label>
    <input type="text" id="alamat" name="alamat" value="<?php echo $alamat; ?>" disabled><br>

    <label for="contact">Contact Number:</label>
    <input type="text" id="contact" name="contact" value="<?php echo $contact; ?>" disabled><br>

    <button type="button" class="btn btn-danger" style="background-color: black" onclick="window.location.href='../homepage/index.php'">Back</button>
    <button type="button" class="btn btn-danger" style="background-color: #4BC5B8" onclick="window.location.href='profile_edit.php'">Edit My Profile</button>
    <button type="button" class="btn btn-danger" style="background-color: #4BC5B8" onclick="logout()">Log Out</button>
    <br>
    <script>
      function logout() {
        // Make an AJAX request to the logout.php script
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "logout.php", true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Redirect to the desired page after successful logout
            window.location.href = "../homepage/index.php";
          }
        };
        xhr.send();
      }
    </script>
  </form>
  <br>
  <br>
  <br>
</div>

    <!-- rest of your HTML body content -->
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
</body>

</html>
