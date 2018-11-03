<?php
	session_start();
	if(empty($_SESSION['username'])){
		header("location:index.php");
	}
	else
	{
		if(!empty($_SESSION['level_user']))
		{
			if($_SESSION["level_user"]==1)
			{
				header("location:index.php");
			}
		}
	}
	$invoice=$_POST['invoice'];
	require 'koneksi.php';
	$sql = "SELECT sum(tb_deposit.deposit) as deposit FROM tb_transaksi INNER JOIN tb_deposit ON tb_deposit.invoice=tb_transaksi.invoice WHERE tb_transaksi.invoice='".$invoice."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo $row["deposit"];
		}
	}
	
?>