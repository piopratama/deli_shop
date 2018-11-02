<?php
include "koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tb_employee WHERE id='$id'");
header("location:user.php");
 ?>
