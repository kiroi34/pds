<?php
include 'connect.php';
session_start();

$namaObat = $_POST['namaObat'];
$jenisObat = $_POST['type'];
$hargaObat = $_POST['harga'];
$stockObat= $_POST['stock'];

if (isset($_POST['submit'])) { 
                mysqli_query($conn, "INSERT INTO medicine VALUES ('','$namaObat','$jenisObat','$hargaObat','$stockObat')");
                echo "<script>alert('Input Obat Baru Berhasil'); window.location.href = 'adminpage_medicine.php';</script>";
            }else {
                echo "<script>alert('Input Obat Baru Gagal '); window.location.href = 'adminpage_medicine.php';</script>";
            }
            
?>