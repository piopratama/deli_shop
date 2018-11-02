<?php

	session_start();

	if(empty($_SESSION['username'])){
		header("location:index.php");
	}
	$invoice=$_POST["invoice"];
	$item=$_POST["item"];
	$qty=$_POST["qty"];
	$deposit=$_POST["deposit"];
	$method= $_POST["method"];
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
			$invoice=$date."".$id_kasir;
		}
		$k=0;
		while($row = $result->fetch_assoc()) {
			for($j=0;$j<count($item);$j++)
			{
				if($row["id"]==$item[$j])
				{
					$data[$k]["id_item"]=$item[$j];
					$data[$k]["price"]=$row["price"];
					$data[$k]["qty"]=$qty[$j];
					$data[$k]["invoice"]=$invoice;
					$data[$k]["date"]=$date;
					$data[$k]["id_employee"]=$id_kasir;
					$data[$k]["type"]="direct";
					$data[$k]["method"]=$method;
					$data[$k]["total_price"]=$qty[$j]*$row["price"];
					$data[$k]["deposit"]=$deposit;
					$data[$k]["rest_total"]=$qty[$j]*$row["price"]-$deposit;
					$data[$k]["description"]="";
					$data[$k]["status"]=0;
					$k=$k+1;
				}
			}
		}
		
		for($i=0;$i<count($data);$i++)
		{
			$sql = "INSERT INTO tb_transaksi (invoice, `date`, id_employee, id_item, qty, total_price, rest_total, description, type, method, status) VALUES ('".$data[$i]["invoice"]."', '".$data[$i]["date"]."', ".$data[$i]["id_employee"].", ".$data[$i]["id_item"].", ".$data[$i]["qty"].", ".$data[$i]["total_price"].", ".$data[$i]["rest_total"].", '".$data[$i]["description"]."', '".$data[$i]["type"]."', '".$data[$i]["method"]."', ".$data[$i]["status"].")";
			if ($conn->query($sql) === TRUE) {
			    $last_id = $conn->insert_id;
			    echo "New record created successfully. Last inserted ID is: " . $last_id;
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
		$sql="INSERT INTO tb_deposit (invoice, deposit) VALUES ('".$invoice."', ".$deposit.")";
		if ($conn->query($sql) === TRUE) {
		    $last_id = $conn->insert_id;
		    echo "New record created successfully. Last inserted ID is: " . $last_id;
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	$conn->close();
?>