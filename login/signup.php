<!DOCTYPE html>
<?php
include "connect.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Retrieve user input from the signup form
$nama = $_POST['nama'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$alamat = $_POST['alamat'];
$contact = $_POST['contact'];
$username = $_POST['username'];
$password = $_POST['password'];

// Validate input fields
if (empty($username) || empty($password)) {
    echo "Username and password are required.";
    exit();
}


// Check if the username already exists
$query = "SELECT * FROM login_table WHERE username = '$username'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo "Username already exists. Please choose a different username.";
    $mysqli->close();
    exit();
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user into the database
$query = "INSERT INTO login_table (nama, tanggal_lahir, gender, alamat, contact, username, password) VALUES ('$nama', '$dob', '$gender', '$alamat', '$contact', '$username', '$hashedPassword')";

if ($mysqli->query($query)) {
    header('location:loginform.php');
    echo "<div class='alert alert-success'>
    <strong>Success!</strong> Your account has been created
  </div>";
} else {
    echo "Error: " . $query . "<br>" . $mysqli->$error;
}

$mysqli->close();
}
?>

