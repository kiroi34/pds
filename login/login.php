<!DOCTYPE html>
<?php
include "connect.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Retrieve user input from the form
$username = $_POST['username'];
$password = $_POST['password'];



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

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Password is correct, create a session
        $_SESSION['username'] = $username;
        header("Location: ../homepage/index.html"); // Redirect to the welcome page
        exit();
    }
}

// Invalid credentials
echo "Invalid username or password.";
$mysqli->close();
}
?>


