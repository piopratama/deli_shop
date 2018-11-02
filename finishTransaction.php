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

$invoice=$_POST['invoice'];
require 'koneksi.php';

$sql = "UPDATE tb_transaksi SET `status`=1 WHERE invoice='".$invoice."'";
if ($conn->query($sql) === TRUE) {
	$sql = "SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee WHERE invoice='".$invoice."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$i=0;
		$sum=0;
		while($row = $result->fetch_assoc()) {
			$data[$i][0]=$row["date"];
			$data[$i][1]=$row["invoice"];
			$data[$i][2]=$row["name"];
			$data[$i][3]=$row["item"];
			$data[$i][4]=$row["qty"];
			$data[$i][5]=$row["price"];
			$data[$i][6]=$row["total_price"];
			if($row["status"]==1)
			{
				$data[$i][7]="paid";
			}
			else{
				$data[$i][7]="not paid";
			}
			$sum=$sum+$row["total_price"];
			$i=$i+1;
		}
	} else {
		echo "Error";
		}
}
header("location:paymentUnDirect.php")
?>