<?php
session_start();
$title="Report";

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
include_once 'koneksi.php';

$barang = mysqli_query($conn, "SELECT tb_transaksi.invoice, nm_transaksi, Date(tnggl) as tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_barang WHERE id=id_item ) AS item, qty, discount, total_price, statuss FROM tb_transaksi WHERE DATE(tnggl)=CURDATE() and statuss=1");

$kategori= mysqli_query($conn, "SELECT TK.nm_kategori, SUM(TT.total_price) AS income FROM tb_transaksi TT INNER JOIN tb_barang TB ON TT.id_item=TB.id INNER JOIN tb_kategori TK ON TB.kategori=TK.id WHERE DATE(tnggl)=CURDATE() AND TT.statuss=1 GROUP BY TK.nm_kategori;");

$depositArr= mysqli_query($conn, "SELECT SUM(deposit) AS deposit FROM tb_deposit WHERE invoice IN (SELECT invoice FROM tb_transaksi WHERE tb_transaksi.statuss=0 AND date(tnggl)=CURDATE()) AND `date`=CURDATE();");

$method= mysqli_query($conn, "SELECT method,SUM(payment+deposit) AS payment FROM tb_deposit WHERE `date`=CURDATE() GROUP BY method;");

$deposit=0;
$total_no_deposit=0;
foreach ($depositArr as $depo){
	$deposit=$deposit+$depo["deposit"];
}



$user = mysqli_query($conn, "SELECT * FROM tb_employee");
?>
<!DOCTYPE html>
<html>


	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/stockStyle.css">
		
	<link rel="stylesheet" href="./assets/jquery-ui.css">
	<style>
	.ct-label {
		font-size: 12px;
	}

	#chart-div {
		margin-top: 50px;
	}
	</style>

	<body>
		
		<form action="finishReport.php" method="POST" accept-charset="utf-8">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 header">
						<nav class="navbar navbar-default" role="navigation">
							<div class="container-fluid">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Shop</a>
								</div>
						
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse navbar-ex1-collapse">
									<!-- <ul class="nav navbar-nav">
										<li class="active"><a href="#">Link</a></li>
										<li><a href="#">Link</a></li>
									</ul> -->
									
									<ul class="nav navbar-nav navbar-right">
										<li><a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px;" href="logout.php">Logout</a></li>
										<li><a href=""><!-- <?php  echo $_SESSION['username'];  ?> --> </a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row">

					<div class="col-md-12" id="mytable">
					<a href="mainMenu.php" style="margin-left: 5px; margin-bottom: 10px;" type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" ></a><br>
					<h1> TABEL REPORT</h1>
					<table id="example" class="table table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th>ID</th>
								<th>Invoice</th>
								<th>Name</th>
								<th>Date</th>
								<th>Employee</th>
								<th>Item</th>
								<th>QTY</th>
								<th>DSC</th>
								<th>Total Price</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no=1;
							foreach ($barang as $data) {?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data["invoice"];?></td>
								<td><?php echo ($data["nm_transaksi"]=="" ? "Direct Pay": $data["nm_transaksi"]);?></td>
								<td><?php echo $data["tnggl"];?></td>
								<td><?php echo $data["nama_pegawai"];?></td>
								<td><?php echo $data["item"];?></td>
								<td><?php echo $data["qty"];?></td>
								<td><?php echo $data["discount"];?></td>
								<td><?php echo $data["total_price"];?></td>
								<td><?php if($data["statuss"]==0)
								{
									echo("not paid");
								}
								else{
									echo("paid");
								}
								?></td>
							</tr>
							<?php $no++; }?>							
						</tbody>
					</table>
					<h1> TABEL REPORT CATEGORY</h1>
					<table id="example2" class="table table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th>Category</th>
								<th>Income</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no=1;
							foreach ($kategori as $i) {?>
							<tr>
								<td><?php echo $i["nm_kategori"];?></td>
								<td><?php echo $i["income"];?></td>
								<?php $total_no_deposit=$total_no_deposit+$i["income"]; ?>
							</tr>
							<?php $no++; }?>							
						</tbody>
					</table>
					<h1> TABEL REPORT METHOD</h1>
					<table id="example3" class="table table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th>Method</th>
								<th>Income</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no=1;
							foreach ($method as $j) {?>
							<tr>
								<td><?php echo $j["method"];?></td>
								<td><?php echo $j["payment"];?></td>
							</tr>
							<?php $no++; }?>							
						</tbody>
					</table>
					<h3>
						Total Category : <?php echo "Rp.".rupiah($total_no_deposit)." <i>(*category doesn't include deposit)</i>"; ?><br>
						Total Deposit  : <?php echo "Rp.".rupiah($deposit); ?><br>
						Total Income   : <?php echo "Rp.".rupiah($total_no_deposit+$deposit); ?>
					</h3>
					<a href="export_excel.php" style="margin-left: 95%; margin-bottom: 10px; widht:100px;" type="button" class="btn btn-success" >Print</a><br>
				</div>
				<div class="row">
				<div class="col-md-8"></div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Category (Category doesn't include deposit)</label>
						<input type="text" class="form-control" readonly="readonly" value="<?php echo "Rp.".rupiah($total_no_deposit); ?>">
					</div>
					<div class="form-group">
						<label for="">Deposit</label>
						<input type="text" class="form-control" readonly="readonly" value="<?php echo "Rp.".rupiah($deposit); ?>">
					</div>
					<div class="form-group">
						<label for="">Total Income</label>
						<input type="text" class="form-control" readonly="readonly" value="<?php echo "Rp.".rupiah($total_no_deposit+$deposit); ?>">
					</div>
				</div>
			</div>
		</form>
		<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);
		?>

		<?php include("./templates/footer.php"); ?>
		<script src="./assets/jquery-ui.js"></script>
		<script>
			$(document).ready(function() {
				var oTable=$("#example").dataTable();
				var oTable=$("#example2").dataTable();
				var oTable=$("#example3").dataTable();
			});
		</script>
	</body>
</html>