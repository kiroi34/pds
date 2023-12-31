<!DOCTYPE html>
<?php
include "connect.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Retrieve user input from the form
$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['username'] = $username;




// Validate input fields
if (empty($username) || empty($password)) {
    echo "Username and password are required.";
    exit();
}


// Query the database
$query = "SELECT * FROM login_table WHERE username = '$username'";
$result = $mysqli->query($query);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];
    $id_pasien = $row['login_id']; 

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Password is correct, create a session
        $_SESSION['username'] = $username;
        header("Location: ../homepage/index.php"); // Redirect to the welcome page
        $_SESSION['id_pasien'] = $id_pasien; 
        exit();
    }
}

// Invalid credentials
echo "<script>alert('Account not Found'); window.location.href = 'loginform.php';</script>";
$mysqli->close();
}
?>


