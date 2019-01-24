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
		function WordWrap(&$text, $maxwidth)
		{
			$text = trim($text);
			if ($text==='')
				return 0;
			$space = $this->GetStringWidth(' ');
			$lines = explode("\n", $text);
			$text = '';
			$count = 0;

			foreach ($lines as $line)
			{
				$words = preg_split('/ +/', $line);
				$width = 0;

				foreach ($words as $word)
				{
					$wordwidth = $this->GetStringWidth($word);
					if ($wordwidth > $maxwidth)
					{
						// Word is too long, we cut it
						for($i=0; $i<strlen($word); $i++)
						{
							$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
							if($width + $wordwidth <= $maxwidth)
							{
								$width += $wordwidth;
								$text .= substr($word, $i, 1);
							}
							else
							{
								$width = $wordwidth;
								$text = rtrim($text)."\n".substr($word, $i, 1);
								$count++;
							}
						}
					}
					elseif($width + $wordwidth <= $maxwidth)
					{
						$width += $wordwidth + $space;
						$text .= $word.' ';
					}
					else
					{
						$width = $wordwidth + $space;
						$text = rtrim($text)."\n".$word.' ';
						$count++;
					}
				}
				$text = rtrim($text)."\n";
				$count++;
			}
			$text = rtrim($text);
			return $count;
		}
		// Colored table
		function FancyTable($header, $data, $sum, $invoice, $nama, $remaining_payment, $method, $payment, $deposit, $change, $date, $customer)
		{
            $this->SetAutoPageBreak(true,10);
		    // Colors, line width and bold font
		    $this->SetFillColor(29,159,1);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(21,21,21);
		    $this->SetLineWidth(.3);
            $this->SetFont('','B', 8);
		    $this->SetTextColor(0);
		    // Header
		    // Move to the right
		    //$this->Cell(80);
            // Title
            //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
            $this->Image('logo2.png',10,5,78);
            $this->Cell(0,4,'',0,1,'C');
            $this->Cell(0,4,'',0,1,'C');
            $this->Cell(0,4,'',0,1,'C');
            $this->Cell(0,4,'',0,1,'C');
            $this->Cell(0,4,'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',15,1,'C');
            $this->Cell(0,4,"Invoice : ".$invoice,0,1,'L');
            $this->Cell(0,4,"Date : ".$date,0,1,'L');
			$this->Cell(0,4,"Cashier : ".$nama,0,1,'L');
			//$this->Cell(0,4,"To : ".$customer,0,1,'C');
			$this->Cell(0,4,"To : ".$customer,0,1,'L');
			$this->Cell(0,4,"Method : ".$method,0,1,'L');
			
			
		    // Line break
		    $this->Ln();
		    $w = array(10, 20, 80, 9, 9, 25, 25, 13);
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
		        $this->Cell($w[2],6,$pdf->wordwrap($row[2],20),'LR',0,'L',$fill);
				$this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
				$this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
		        $this->Cell($w[5],6,number_format($row[5]),'LR',0,'R',$fill);
		        $this->Cell($w[6],6,number_format($row[6]),'LR',0,'R',$fill);
		        $this->Cell($w[7],6,$row[7],'LR',0,'L',$fill);
		        $this->Ln();
		        $fill = !$fill;
		    }
		    // Closing line
			/*$this->Cell(array_sum($w),0,'','T');
			$this->Ln();
		    $this->Cell(80);*/
		    $sum=$sum+$sum*0;
            //$this->Cell(100,10,'Grand Total : '.$sum,0,0,'R');
            
            $this->Cell($w[0],6,'Grand Total','T',0,'L');
            $this->Cell($w[1],6,'','T',0,'L');
            $this->Cell($w[2],6,'','T',0,'L');
            $this->Cell($w[3],6,'','T',0,'L');
            $this->Cell($w[4],6,'','T',0,'L');
            $this->Cell($w[5],6,'','T',0,'R');
            $this->Cell($w[6],6,'','T',0,'R');
            $this->Cell($w[7],6,'Rp. '.number_format($sum),'T',0,'L');
            $this->Ln();
            $this->Cell($w[0],6,'Deposit',0,0,'L');
            $this->Cell($w[1],6,'',0,0,'L');
            $this->Cell($w[2],6,'',0,0,'L');
            $this->Cell($w[3],6,'',0,0,'L');
            $this->Cell($w[4],6,'',0,0,'L');
            $this->Cell($w[5],6,'',0,0,'R');
            $this->Cell($w[6],6,'',0,0,'R');
            $this->Cell($w[7],6,'Rp. '.number_format($deposit),0,0,'L');
            $this->Ln();
            $this->Cell($w[0],6,'Remaining Payment','B',0,'L');
            $this->Cell($w[1],6,'','B',0,'L');
            $this->Cell($w[2],6,'','B',0,'L');
            $this->Cell($w[3],6,'','B',0,'L');
            $this->Cell($w[4],6,'','B',0,'L');
            $this->Cell($w[5],6,'','B',0,'R');
            $this->Cell($w[6],6,'','B',0,'R');
            $this->Cell($w[7],6,'Rp. '.number_format($remaining_payment),'B',0,'L');
            $this->Ln(10);
            $this->Cell($w[0],6,'',0,0,'');
            $this->Cell($w[1],6,'Supplier',0,0,'R');
            $this->Cell($w[2],6,'',0,0,'L');
            $this->Cell($w[3],6,'',0,0,'L');
            $this->Cell($w[4],6,'',0,0,'L');
            $this->Cell($w[5],6,'',0,0,'R');
            $this->Cell($w[6],6,'Buyer',0,0,'C');
            $this->Cell($w[7],6,'',0,0,'L');
            $this->Ln(15);
            $this->Cell($w[0],6,'',0,0,'C');
            $this->Cell($w[1],6,'(___________________________)',0,0,'L');
            $this->Cell($w[2],6,'',0,0,'L');
            $this->Cell($w[3],6,'',0,0,'L');
            $this->Cell($w[4],6,'',0,0,'L');
            $this->Cell($w[5],6,'',0,0,'R');
            $this->Cell($w[6],6,'(___________________________)',0,0,'C');
            $this->Cell($w[7],6,'',0,0,'L');

		}
	}


$invoice=$_POST['invoice'];
$deposit=$_POST['deposit'];
$remaining_payment=$_POST['remaining_payment'];
$grand_total=$_POST['grand_total'];
$method=$_POST['method'];
$payment=$_POST['payment'];
$change=$_POST['change'];
$date=date('d/m/Y H:i:s');
$customer='';
$pdf = new PDF();
$header = array('No', 'Date', 'Item', 'Qty', 'Dsc', 'Price (Rp.)', 'Total Price (Rp.)', 'Status');
require 'koneksi.php';
$sql = "SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee WHERE invoice='".$invoice."';";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
	$i=0;
	$sum=0;
	while($row = $result->fetch_assoc()) {
		$data[$i][0]=$i+1;
        $data[$i][1]=date("d/m/Y", strtotime($row["tnggl"]));
        $customer=$row["nm_transaksi"];
        $data[$i][2]=$row["item"];
        $data[$i][3]=$row["qty"]." ".$row["unit"];
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
	$pdf->FancyTable($header,$data, $sum, $invoice, $nama, $remaining_payment, $method, $payment, $deposit, $change, $date, $customer);
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