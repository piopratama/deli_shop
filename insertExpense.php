<?php
session_start();
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
date_default_timezone_set('Asia/Jakarta');


$item=$_POST["item"];
$date_buy=$_POST["date_buy"];
$buyer=$_POST["buyer"];
$qty=$_POST["qty"];
$unit=$_POST["unit"];
$price=$_POST["price"];
$total=$_POST["total"];
$description=$_POST["description"];

$date_insert = date('Y-m-d h:i:s a', time());

include 'koneksi.php';
$sql="INSERT INTO tb_expenses(buyer,`date`,date_insert,item,qty,unit,price,total, `description`) VALUES($buyer,'$date_buy','$date_insert','$item',$qty,'$unit',$price,$total, '$description')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message']="Insert Successfully";
} else {
    $_SESSION['message']="Insert Failed".$conn->error;
}
header("location:expenses.php");
?>