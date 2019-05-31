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
	
	// Check If form submitted, insert form data into users table.
	$name = addslashes($_POST['name']);
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$unit = $_POST['unit'];
	$kategori = $_POST['category'];
	$supplier = $_POST['supplier'];
	$purchase = $_POST['purchase_price'];
	$barcode=$_POST['barcode'];
	$date=date('Y-m-d H:i:s');

	// include database connection file
	include 'koneksi.php';
							
	$conn->autocommit(FALSE);
	$conn->query("START TRANSACTION");

	// Insert user data into table
	$result = mysqli_query($conn, "INSERT INTO tb_barang(item,price,stock,unit,kategori,supplier,pur_price,barcode, `date`) VALUES('$name','$price','$stock','$unit','$kategori','$supplier','$purchase','$barcode', '$date')");
	
	$id=$conn->insert_id;

	$sql3 = "INSERT INTO tb_stock values('".$date."', ".$id.", 0, ".$stock.", ".$stock.", 1, '".$_SESSION['username']."')";
	if ($conn->query($sql3) === TRUE) {
		$check=TRUE;
	} else {
		echo "Error: " . $sql2s . "<br>" . $conn->error;
	}
	if(!$result || !$check)
	{
		$_SESSION["message"]="Transaksi gagal, silahkan ulangi transaksi";
		$conn->rollback();
	}
	else
	{
		$conn->commit();
	}		
	header("location:stock.php");
?>