<?php 
include 'koneksi.php';
$id=$_POST['id'];
$date_insert=$_POST['date_insert'];
$kategori=$_POST['catagory'];
$description=$_POST['description'];

mysqli_query($conn, "UPDATE tb_kategori SET date_insert='$date_insert', kategori='$kategori', description='$description' WHERE id='$id';"); 
header("location:kategori.php");
?>