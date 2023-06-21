<?php
include 'connect.php';
session_start();
$id = $_POST['id'];
$nama = $_POST['namaObat'];
$jenis = $_POST['type'];
$harga = $_POST['harga'];
$stock = $_POST['stock'];



if (isset($_POST['update'])) { 
        mysqli_query($conn, "UPDATE medicine SET name_medicine='$nama',  type_medicine='$jenis', price_medicine='$harga', stock_medicine='$stock' WHERE id_medicine='$id'");
        echo "<script>alert('Update Data Berhasil'); window.location.href = 'adminpage_medicine.php';</script>";
        }else {
            echo "<script>alert('Update Gagal '); window.location.href = 'adminpage_medicine.php';</script>";
         }
        

?>