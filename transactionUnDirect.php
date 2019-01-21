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

	require ("koneksi.php");
	$invoice=$_POST["invoice"];
	$name=$_POST["name"];
	$item=$_POST["item"];
	$qty=$_POST["qty"];
	$deposit=$_POST["deposit"];
	$method= $_POST["method"];
	$discount=$_POST["discount"];
	$grand_total=0;

	$new_transaction=0;
	
	if($name=="")
	{
		$_SESSION["message"]="Name can`t be empty";		
		header("location:unDirectPay.php");
		return;
	}
	else
	{
		if(count($item)>0)
		{
			$where_in=$item[0];
			for($i=1;$i<count($item);$i++)
			{
				$where_in=$where_in.",".$item[$i];
			}
		}
		//echo $where_in;
		require 'koneksi.php';
		$sql = "SELECT id,price FROM tb_barang WHERE id in(".$where_in.");";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			$id_kasir=$_SESSION["id_kasir"];
			$date=date('Y-m-d H:i:s');

			if(trim($invoice)=="")
			{
				$new_transaction=1;
				$invoice=$date."".$id_kasir;
			}
			$k=0;
			while($row = $result->fetch_assoc()) {
				for($j=0;$j<count($item);$j++)
				{
					if($row["id"]==$item[$j])
					{
						$data[$k]["id_item"]=$item[$j];
						$data[$k]["nm_transaksi"]=$name;
						$data[$k]["price"]=$row["price"];
						$data[$k]["qty"]=$qty[$j];
						$data[$k]["invoice"]=$invoice;
						$data[$k]["tnggl"]=$date;
						$data[$k]["id_employee"]=$id_kasir;
						$data[$k]["method"]=$method;
						$data[$k]["total_price"]=$qty[$j]*$row["price"]-($qty[$j]*$row["price"]*$discount[$j]/100.0);
						$data[$k]["discount"]=$discount[$j];
						$data[$k]["deposit"]=$deposit;
						$data[$k]["rest_total"]=$qty[$j]*$row["price"]-$deposit;
						$data[$k]["description"]="";
						$data[$k]["statuss"]=0;
						$grand_total=$grand_total+($qty[$j]*$row["price"]-$qty[$j]*$row["price"]*$discount[$j]/100.0);
						$k=$k+1;
					}
				}
			}
			
			$check=0;
			for($i=0;$i<count($data);$i++)
			{
				$sql = "INSERT INTO tb_transaksi (invoice, `nm_transaksi`, `tnggl`, id_employee, id_item, qty, discount, total_price, description, statuss) VALUES ('".$data[$i]["invoice"]."', '".$data[$i]["nm_transaksi"]."','".$data[$i]["tnggl"]."', ".$data[$i]["id_employee"].", ".$data[$i]["id_item"].", ".$data[$i]["qty"].", ".$data[$i]["discount"].", ".$data[$i]["total_price"].", '".$data[$i]["description"]."', ".$data[$i]["statuss"].")";
				if ($conn->query($sql) === TRUE) {
					$last_id = $conn->insert_id;
					//echo "New record created successfully. Last inserted ID is: " . $last_id;
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
					$check=1;
				}
			}

			if($deposit!="" && $check==0)
			{

				if($new_transaction==1)
				{
					$sql="INSERT INTO tb_deposit (invoice, deposit, method, rest_total) VALUES ('".$invoice."', ".$deposit.", '".$method."', ".($grand_total-$deposit).")";
				}
				else
				{
					$sql="UPDATE tb_deposit set deposit=deposit+".$deposit.", rest_total=rest_total-".$deposit." where invoice='".$invoice."'";
				}
				if ($conn->query($sql) === TRUE) {
					//$last_id = $conn->insert_id;
					//echo "New record created successfully. Last inserted ID is: " . $last_id;
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}

			if($check==0)
			{	
				$_SESSION["invoice"]=$invoice;
				$_SESSION["message"]="Insert Successfully";
			}
			else
			{
				$_SESSION["message"]="Error";
			}
		}
		else if(trim($invoice)!="" && $deposit!="")
		{
			$total=0;
			$sql2="SELECT SUM(total_price) AS total, rest_total FROM tb_transaksi INNER JOIN tb_deposit ON tb_deposit.invoice=tb_transaksi.invoice 
			WHERE tb_transaksi.invoice ='2019-01-20 10:46:304' AND tb_deposit.invoice='2019-01-20 10:46:304';";
			$result = $conn->query($sql2);
			if($result->num_rows > 0)
			{
				
				while($row = $result->fetch_assoc()){
					$total=$row["total"];
					$rest_total=$row["rest_total"];
					echo ("hy");
					echo ($total);
					echo ($rest_total);
					echo (".$deposit.");
					echo (".$deposit.");
				}
			}
			else{
			}
			$sql3="UPDATE tb_deposit set deposit=deposit+".$deposit.", rest_total=rest_total-".$deposit." where invoice='".$invoice."'";
			if ($conn->query($sql3) === TRUE) {
				$_SESSION["message"]="Insert Successfully";
				//$last_id = $conn->insert_id;
				//echo "New record created successfully. Last inserted ID is: " . $last_id;
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
		$conn->close();
		//header("location:unDirectPay.php");
	}
?>