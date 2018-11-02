<?php
session_start();
if(empty($_SESSION['username'])){
	header("location:index.php");
}

$id=$_POST["id_delete"];

include 'koneksi.php';
$sql="DELETE FROM tb_kategori WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    $_SESSION['message']="Delete Successfully";
} else {
    $_SESSION['message']="Delete Failed".$conn->error;
}
header("location:kategori.php");
?>