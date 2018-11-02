<?php 
include 'koneksi.php';
$id=$_POST['id'];
$name=$_POST['name'];
$address=$_POST['address'];
$sallary=$_POST['sallary'];
$phone=$_POST['phone'];
$usernamed=$_POST['username'];
$passworde=$_POST['password'];
$level=$_POST['level'];

mysqli_query($conn, "UPDATE tb_employee SET nama='$name', address='$address', sallary='$sallary',tlp='$phone',username='$usernamed',password='$passworde', level='$level' WHERE id='$id'"); 
header("location:user.php");
?>