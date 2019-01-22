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
		function FancyTable($header, $data, $sum, $invoice, $nama, $remaining_payment, $method, $payment, $deposit, $change, $date, $customer)
		{
            $this->SetAutoPageBreak(true,10);
		    // Colors, line width and bold font
		    $this->SetFillColor(255,0,0);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(128,0,0);
		    $this->SetLineWidth(.3);
            $this->SetFont('','B', 6);
		    $this->SetTextColor(0);
		    // Header
		    // Move to the right
		    //$this->Cell(80);
            // Title
            //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
            //$this->Image('logo.jpg',10,10,10);
            $this->Cell(0,4,'Deli Point',0,1,'C');
            $this->Cell(0,4,'Jalan Puncak Waringin',0,1,'C');
            $this->Cell(0,4,'+62 812 3605 8607',0,1,'C');
            $this->Cell(0,4,'delipointkomodo@gmail.com',0,1,'C');
            $this->Cell(0,4,'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,1,'C');
            $this->Cell(0,4,"Invoice : ".$invoice,0,1,'L');
            $this->Cell(0,4,"Date : ".$date,0,1,'L');
            $this->Cell(0,4,"Cashier : ".$nama,0,0,'L');
            $this->Cell(0,4,"To : ".$customer,0,1,'C');
			
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
            $this->Cell($w[7],6,'Rp. '.number_format($deposit),'T',0,'L');
            $this->Ln();
            $this->Cell($w[0],6,'Deposit',0,0,'L');
            $this->Cell($w[1],6,'',0,0,'L');
            $this->Cell($w[2],6,'',0,0,'L');
            $this->Cell($w[3],6,'',0,0,'L');
            $this->Cell($w[4],6,'',0,0,'L');
            $this->Cell($w[5],6,'',0,0,'R');
            $this->Cell($w[6],6,'',0,0,'R');
            $this->Cell($w[7],6,'Rp. '.number_format($remaining_payment),0,0,'L');
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


$invoice='2019-01-22 14:37:154';
$deposit=10000;
$remaining_payment=26000;
$grand_total=126000;
$method='transfer';
$payment=26000;
$change=0;
$date=date('d/m/Y');
$customer='';
$pdf = new PDF();
$header = array('No', 'Date', 'Item', 'Qty', 'Dsc', 'Price (Rp.)', 'Total Price (Rp.)', 'Status');
require 'koneksi.php';
$sql = "SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee WHERE invoice='".$invoice."';";
//echo $sql;
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
    $pdf->FancyTable($header,$data, $sum, $invoice, $nama, $remaining_payment, $method, $payment, $deposit, $change, $date, $customer);
    $pdf->Output();
}
else 
{
    echo "Error";
}
?>