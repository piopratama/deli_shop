<?php
	session_start();
	if(empty($_SESSION['username'])){
		header("location:index.php");
	}
	ini_set("session.auto_start", 0);
	require('./fpdf181/fpdf.php');

	class PDF extends FPDF
	{
		// Colored table
		function FancyTable($header, $data, $sum, $nama, $invoice)
		{
		    // Colors, line width and bold font
		    $this->SetFillColor(255,0,0);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(128,0,0);
		    $this->SetLineWidth(.3);
		    $this->SetFont('','B');
		    $this->SetTextColor(0);
		    // Header
		    // Move to the right
		    $this->Cell(80);
		    // Title
			$this->Cell(30,10,'Deli Shop',0,0,'C');
			$this->Cell(30,30,$nama,0,0,'C');
			$this->Cell(30,30,$invoice,0,0,'C');
			
		    // Line break
		    $this->Ln(20);
		    $w = array(35, 20, 60, 9, 25, 30, 12);
		    for($i=0;$i<count($header);$i++)
		        $this->Cell($w[$i],6,$header[$i],1,0,'C',true);
		    $this->Ln();
		    // Color and font restoration
		    $this->SetFillColor(224,235,255);
		    $this->SetTextColor(0);
		    $this->SetFont('');
		    // Data
		    $fill = false;
		    foreach($data as $row)
		    {
		        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
		        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
		        $this->Cell($w[4],6,number_format($row[4]),'LR',0,'R',$fill);
		        $this->Cell($w[5],6,number_format($row[5]),'LR',0,'R',$fill);
				$this->Cell($w[6],6,$row[6],'LR',0,'L',$fill);
				
				
		        $this->Ln();
		        $fill = !$fill;
		    }
		    // Closing line
		    $this->Cell(array_sum($w),0,'','T');
		    $this->Ln();
		    $this->Cell(80);
		    $sum=$sum;
			$this->Cell(30,10,'Total (include tax 10%) : '.$sum,0,0,'C');

		}
	}


	$invoice=$_POST["invoice"];
	$item=$_POST["item"];
	$qty=$_POST["qty"];
	$deposit=$_POST["deposit"];
	$method= $_POST["method"];
	$nama=$_POST["name"];
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
					$data[$k]["tnggl"]=$date;
					$data[$k]["id_employee"]=$id_kasir;
					$data[$k]["method"]=$method;
					$data[$k]["total_price"]=$qty[$j]*$row["price"];
					$data[$k]["deposit"]=$deposit;
					$data[$k]["rest_total"]=$qty[$j]*$row["price"]-$deposit;
					$data[$k]["description"]="";
					$data[$k]["statuss"]=0;
					$data[$k]["nama"]=$nama;
					$k=$k+1;
				}
			}
		}

		if($check==0)
		{
			$pdf = new PDF();
			$header = array('Date', 'Employee', 'Item', 'Qty', 'Price', 'Total Price', 'Status');
			require 'koneksi.php';
			$sql = "SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee WHERE invoice='".$invoice."';";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				$i=0;
				$sum=0;
				while($row = $result->fetch_assoc()) {
					$data[$i][0]=$row["tnggl"];
					$data[$i][1]=$row["nama"];
					$data[$i][2]=$row["item"];
					$data[$i][3]=$row["qty"];
					$data[$i][4]=$row["price"];
					$data[$i][5]=$row["total_price"];
					$data[$i][6]=$row["statuss"];
					if($row["nama"]="0")
					{
						$data[$i][8]="unpaid";
					}
					$sum=$sum+$row["total_price"];
					$i=$i+1;
				}
				$pdf->SetFont('Arial','',9);
				$pdf->AddPage();
				$pdf->FancyTable($header,$data,$sum,$nama,$invoice);
				$pdf->Output();
			}
			else 
			{
				echo "Error";
			}
		}
	}

	//header("location:mainMenu.php");
	$conn->close();
?>