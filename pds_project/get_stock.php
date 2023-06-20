<?php
include 'connect.php';

if (isset($_POST['query'])) {
    $medicineName = $_POST['query'];

    // Execute the SQL query to retrieve the stock information for the given medicine name
    $query = "SELECT stock_medicine FROM medicine WHERE name_medicine = '$medicineName'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stock = $row['stock_medicine'];
        echo intval($stock);
    }
}
?>