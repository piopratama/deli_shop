<?php
include "koneksi.php";
$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM tb_barang WHERE id='$id'");
header("location:stock.php");
 ?>
