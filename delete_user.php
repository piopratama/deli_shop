<?php
include "koneksi.php";
$id=$_POST['id_delete'];
mysqli_query($conn,"DELETE FROM tb_employee WHERE id='$id'");
header("location:user.php");
 ?>
