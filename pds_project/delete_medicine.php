<?php
    require_once "connect.php";
    session_start();
    $id = $_POST['id'];

    $sql = "DELETE FROM `medicine`
    WHERE id_medicine = ".$id;
    $stmt = $conn->query($sql);
?>