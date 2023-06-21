<html>
<head>
    <title>Sign Up Page</title>
    <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>HomeCare</title>
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
            /* display: block; */
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

        input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST">
        <label for="nama">Full Name:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="umur">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required><br><br>

        <label for="gender">Gender:</label><br>

            <input type="radio" id="male" name="gender" value="male"><label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female"><label for="female">Female</label>
    
        <br>

        <label for="alamat">Home Address:</label>
        <input type="text" id="alamat" name="alamat" required><br>

        <label for="contact">Contact Number:</label>
        <input type="number" id="contact" name="contact" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Sign Up" style="margin: 0 auto; display: block; background-color: #4BC5B8" onclick="showAlert()">
        <h5>Already have an account? </h5> <a href="loginform.php" style="margin: 0 auto; display: block; font-weight: bold; font-size: 13px" >Click Here</a>
    </form>
    </div>
    <br>
    <br>
    <br>
    <!-- <script>
        function showAlert() {
            alert("Account Created");
        }
        </script> -->
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