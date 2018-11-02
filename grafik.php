<?php 
include 'koneksi.php';

$year=$_POST['year'];

$sql="SELECT MONTHNAME(tnggl) as `labels`,SUM(total_price)/100 as `series` FROM tb_transaksi WHERE YEAR(tnggl)=".$year." GROUP BY MONTH(tnggl) order by MONTH(tnggl)";
$result= mysqli_query($conn, $sql);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

echo json_encode($data);
?>