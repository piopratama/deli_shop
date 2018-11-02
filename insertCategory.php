<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
if(empty($_SESSION['username'])){
	header("location:index.php");
}

$category=$_POST["category"];
$description=$_POST["description"];

$date_insert = date('Y-m-d h:i:s a', time());

include 'koneksi.php';
$sql="INSERT INTO tb_kategori(date_insert, kategori, `description`) VALUES('$date_insert', '$category', '$description')";
if ($conn->query($sql) === TRUE) {
    $_SESSION['message']="Insert Successfully";
} else {
    $_SESSION['message']="Insert Failed".$conn->error;
}
header("location:kategori.php");
?>