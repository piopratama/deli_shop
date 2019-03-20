<?php 
session_start();
date_default_timezone_set('Asia/Singapore');
if(empty($_SESSION['username'])){
    header("location:index.php");
}
else
{
    if(!empty($_SESSION['level_user']))
    {
        if($_SESSION["level_user"]==0)
        {
            header("location:index.php");
        }
    }
}

include 'koneksi.php';
$id=$_POST['id'];
$buyer=$_POST['buyer'];
$date=$_POST['date'];
$item=$_POST['item'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$total=$_POST['total'];
$unit=$_POST['unit'];
$category=$_POST['category'];
$date_insert = date('Y-m-d H:i:s', time());

mysqli_query($conn, "UPDATE tb_expenses SET buyer='$buyer', item='$item', qty='$qty', price='$price', total='$total', category='$category', date_insert='$date_insert', unit='$unit' WHERE id='$id'"); 
header("location:expenses.php");
?>