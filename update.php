<?php 
include 'koneksi.php';
$id=$_POST['id'];
$name=$_POST['name'];
$price=$_POST['price'];
$stock=$_POST['stock'];
$unit=$_POST['unit'];
$deskripsi=$_POST['description'];
echo $name;
echo $price;
echo $stock;
echo $unit;
echo $deskripsi;
mysqli_query($conn, "UPDATE tb_barang SET item='$name', price='$price', stock='$stock', unit='$unit', description='$deskripsi' WHERE id='$id'");
header("location:stock.php");
?>