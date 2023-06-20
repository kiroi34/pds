<?php
include 'connect.php';

// Clear the table
$sql = "TRUNCATE TABLE bookings";
if ($conn->query($sql) === TRUE) {
    echo "Table cleared successfully.";
} else {
    echo "Error clearing table: " . $conn->error;
}

// Close the database connection
$conn->close();

header('location:adminpage.php')
?>