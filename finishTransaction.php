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

ini_set("session.auto_start", 0);
	require('./fpdf181/fpdf.php');

	class PDF extends FPDF
	{
		// Colored table
		function FancyTable($header, $data, $sum, $invoice, $nama, $remaining_payment, $method, $payment, $deposit, $change)
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
			$this->Cell(40,20,$nama,0,0,'C');
			$this->Cell(40,20,$invoice,0,0,'C');
			
		    // Line break
		    $this->Ln(20);
		    $w = array(35, 20, 55, 9, 9, 25, 30, 13);
		    for($i=0;$i<count($header);$i++)
		        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
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
				$this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
		        $this->Cell($w[5],6,number_format($row[5]),'LR',0,'R',$fill);
		        $this->Cell($w[6],6,number_format($row[6]),'LR',0,'R',$fill);
		        $this->Cell($w[7],6,$row[7],'LR',0,'L',$fill);
		        $this->Ln();
		        $fill = !$fill;
		    }
		    // Closing line
			$this->Cell(array_sum($w),0,'','T');
			$this->Ln();
		    $this->Cell(80);
		    $this->Cell(30,10,'Method : '.$method,0,0,'C');
			$this->Ln();
		    $this->Cell(80);
		    $this->Cell(30,10,'Deposit : '.$deposit,0,0,'C');
			$this->Ln();
		    $this->Cell(80);
			$this->Cell(30,10,'Remaining Payment : '.$remaining_payment,0,0,'C');
			$this->Ln();
		    $this->Cell(80);
			$this->Cell(30,10,'Payment : '.$payment,0,0,'C');
			$this->Ln();
		    $this->Cell(80);
		    $this->Cell(30,10,'Change : '.$change,0,0,'C');
		    $this->Ln();
		    $this->Cell(80);
		    $sum=$sum+$sum*0;
		    $this->Cell(30,10,'Total : '.$sum,0,0,'C');
		}
	}


$invoice=$_POST['invoice'];
$deposit=$_POST['deposit'];
$remaining_payment=$_POST['remaining_payment'];
$grand_total=$_POST['grand_total'];
$method=$_POST['method'];
$payment=$_POST['payment'];
$change=$_POST['change'];
$date=date('Y-m-d H:i:s');
$pdf = new PDF();
			$header = array('Date', 'Customer', 'Item', 'Qty', 'Dsc', 'Price', 'Total Price', 'Status');
			require 'koneksi.php';
			$sql = "SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee WHERE invoice='".$invoice."';";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				$i=0;
				$sum=0;
				while($row = $result->fetch_assoc()) {
					$data[$i][0]=$row["tnggl"];
					$data[$i][1]=$row["nm_transaksi"];
					$data[$i][2]=$row["item"];
					$data[$i][3]=$row["qty"];
					$data[$i][4]=$row["discount"];
					$data[$i][5]=$row["price"];
					$data[$i][6]=$row["total_price"];
					if($row["statuss"]==1)
					{
						$data[$i][7]="paid";
					}
					else{
						$data[$i][7]="not paid";
					}
					$sum=$sum+$row["total_price"];
					$nama=$row["nama"];
					$i=$i+1;
				}
				$pdf->SetFont('Arial','',9);
				$pdf->AddPage();
				$pdf->FancyTable($header,$data, $sum, $invoice, $nama, $remaining_payment, $method, $payment, $deposit, $change);
				$pdf->Output();
			}
			else 
			{
				echo "Error";
			}


require 'koneksi.php';
$sql="select * from tb_transaksi where invoice='".$invoice."' and statuss=0;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$sql = "UPDATE tb_transaksi SET statuss=1 WHERE invoice='".$invoice."' and statuss=0";
	if ($conn->query($sql) === TRUE) {
		$sql="INSERT INTO tb_deposit (`date`,invoice, deposit, payment, method) VALUES ('".$date."','".$invoice."', 0, ".$remaining_payment.",'".$method."')";
		if($conn->query($sql)===TRUE)
		{
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
					$data[$i][5]=$row["discount"];
					$data[$i][6]=$row["price"];
					$data[$i][7]=$row["total_price"];
					if($row["status"]==1)
					{
						$data[$i][8]="paid";
					}
					else{
						$data[$i][8]="not paid";
					}
					$sum=$sum+$row["total_price"];
					$i=$i+1;
				}
			} else {
				echo "Error";
				}
		}
		else
		{
			echo "Error";
		}
	}
	else
	{
		echo "Error";
	}	
}
//header("location:paymentUnDirect.php")
?>