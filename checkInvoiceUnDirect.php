<?php
	session_start();
	/*if(empty($_SESSION['username'])){
		header("location:index.php");
	}*/
	require ("koneksi.php");
	$invoice=$_POST["invoice"];
	$invoice=$_SESSION['invoice'];
	echo $invoice;
	
?>