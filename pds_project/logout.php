<?php
session_start(); // Start the session

// Destroy the session data
session_unset();
session_destroy();

// Redirect to the desired page after logout
header("Location: ../homepage/index.html");
exit();
?>
