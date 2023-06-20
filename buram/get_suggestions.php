<?php
// Retrieve the input term
if (isset($_GET['term'])) {
    $term = $_GET['term'];

    // Replace 'hostname', 'username', 'password', and 'database' with your database credentials
    $connection = mysqli_connect('localhost', 'root', '', 'clinic');

    // Check connection
    if (!$connection) {
        die('Database connection error: ' . mysqli_connect_error());
    }

    $query = "SELECT name_medicine FROM medicine WHERE name_medicine LIKE '%{$term}%'";
    $result = mysqli_query($connection, $query);
    $suggestions = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $suggestions[] = $row['suggestion_column'];
    }

    echo json_encode($suggestions);

    mysqli_close($connection);
}
?>