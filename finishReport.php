<?php
session_start();
	if(empty($_SESSION['username'])){
		header("location:index.php");
	}
ini_set("session.auto_start", 0);
require('./fpdf181/fpdf.php');
$start = $_POST['start'];
$end = $_POST['end'];

if($_POST['Submit']=='Print'){
	
class PDF extends FPDF
{
	// Colored table
	function FancyTable($header, $data)
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
	    // Line break
	    $this->Ln(20);
	    $w = array(20, 35, 18, 25, 35, 9, 13, 20, 20);
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],8,$header[$i],1,0,'C',true);
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
			$this->Cell($w[5],6,$row[5],'LR',0,'L',$fill);
	        $this->Cell($w[6],6,number_format($row[6]),'LR',0,'R',$fill);
	        $this->Cell($w[7],6,number_format($row[7]),'LR',0,'R',$fill);
	        $this->Cell($w[8],6,$row[8],'LR',0,'L',$fill);
	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	    $this->Ln();
	    $this->Cell(80);
	}
}

$pdf = new PDF();
// Column headings
$header = array('Date', 'Invoice', 'Employee', 'Customer', 'Item', 'Qty', 'Price', 'Total Price', 'Status');
// Data loading


//$invoice=$_POST['invoice'];
require 'koneksi.php';
	if($start&&$end!=null){
			$sql = "SELECT DATE(tnggl) as tnggl, invoice, tb_employee.nama, nm_transaksi, tb_barang.item, qty, tb_barang.price, total_price, statuss FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee WHERE DATE(tnggl) BETWEEN '".$start."' AND '".$end."' ";
		}elseif($start!=null&&$end==null){
			$sql = "SELECT DATE(tnggl) as tnggl, invoice, tb_employee.nama, nm_transaksi, tb_barang.item, qty, tb_barang.price, total_price, statuss FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee WHERE DATE(tnggl)='".$start."' ";
		}else{
			$sql = "SELECT DATE(tnggl) as tnggl, invoice, tb_employee.nama, nm_transaksi, tb_barang.item, qty, tb_barang.price, total_price, statuss FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee";
		}
	//$sql = "SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$i=0;
		$sum=0;
		while($row = $result->fetch_assoc()) {
			$data[$i][0]=$row["tnggl"];
			$data[$i][1]=$row["invoice"];
			$data[$i][2]=$row["nama"];
			$data[$i][3]=$row["nm_transaksi"];
			$data[$i][4]=$row["item"];
			$data[$i][5]=$row["qty"];
			$data[$i][6]=$row["price"];
			$data[$i][7]=$row["total_price"];
			if($row["statuss"]==1)
			{
				$data[$i][8]="paid";
			}
			else{
				$data[$i][8]="not paid";
			}
			$i=$i+1;
		}
		$pdf->SetFont('Arial','',9);
		$pdf->AddPage();
		$pdf->FancyTable($header,$data);
		$pdf->Output('I',date('Y-m-d').".pdf");
	} else {
		$_SESSION["message"]="No Data to Report";
		header("location:report.php");
		}
}elseif($_POST['Submit']=='Pajak'){
	class PDF extends FPDF
{
	// Colored table
	function FancyTable($header, $data)
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
	    $this->Cell(30,10,'Laporan Pajak Deli Shop',0,0,'C');
	    // Line break
	    $this->Ln(20);
	    $w = array(35, 35);
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],8,$header[$i],1,0,'C',true);
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
	        $this->Cell($w[1],6,number_format($row[1]),'LR',0,'R',$fill);
	        
	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	    $this->Ln();
	    $this->Cell(80);
	}
}

$pdf = new PDF();
// Column headings
$header = array('Category', 'Total Penjualan' );
// Data loading


//$invoice=$_POST['invoice'];
require 'koneksi.php';
	if($start&&$end!=null){
			$sql = "SELECT tb_kategori.`nm_kategori`, SUM(tb_transaksi.`total_price`) AS total FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.`id`=tb_transaksi.`id_item` 
			LEFT JOIN tb_kategori ON tb_kategori.`id`=tb_barang.`kategori` WHERE DATE(tnggl) BETWEEN '$start' AND '$end' GROUP BY tb_kategori.`id`";
		}elseif($start!=null&&$end==null){
			$sql = "SELECT tb_kategori.`nm_kategori`, SUM(tb_transaksi.`total_price`) AS total FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.`id`=tb_transaksi.`id_item` 
			LEFT JOIN tb_kategori ON tb_kategori.`id`=tb_barang.`kategori` WHERE DATE(tnggl)='$start' GROUP BY tb_kategori.`id`";
		}else{
			$sql = "SELECT tb_kategori.`nm_kategori`, SUM(tb_transaksi.`total_price`) AS total FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.`id`=tb_transaksi.`id_item` 
			LEFT JOIN tb_kategori ON tb_kategori.`id`=tb_barang.`kategori` GROUP BY tb_kategori.`id`";
		}
	//$sql = "SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$i=0;
		$sum=0;
		while($row = $result->fetch_assoc()) {
			$data[$i][0]=$row["nm_kategori"];
			$data[$i][1]=$row["total"];
			
			$i=$i+1;
		}
		$pdf->SetFont('Arial','',9);
		$pdf->AddPage();
		$pdf->FancyTable($header,$data);
		$pdf->Output('I',date('Y-m-d').".pdf");
	} else {
		$_SESSION["message"]="No Data to Report";
		header("location:report.php");
		}
}


	
//header("location:mainMenu.php")
?>