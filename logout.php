<?php


require 'koneksi.php';
$a=$_GET['usernamed'];

$sql = mysqli_query($conn, "update tb_employee set online_status='0' where username='$a'");
session_start();
session_destroy();
header("location:index.php");

?>