<!DOCTYPE html>
<?php
include "connectadmin.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Retrieve user input from the signup form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Validate input fields
if (empty($username) || empty($password)) {
    echo "Username and password are required.";
    exit();
}


// Check if the username already exists
$query = "SELECT * FROM admin_table WHERE username = '$username'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo "Username already exists. Please choose a different username.";
    $mysqli->close();
    exit();
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user into the database
$query = "INSERT INTO admin_table (nama, username, password) VALUES ('$nama', '$username', '$hashedPassword')";

if ($mysqli->query($query)) {
    header('location:adminform.php');
    echo "<div class='alert alert-success'>
    <strong>Success!</strong> Your account has been created
  </div>";
} else {
    echo "Error: " . $query . "<br>" . $mysqli->$error;
}

$mysqli->close();
}
?>

