<?php
session_start();
$title="Detail Report Customer";

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
$invoice = $_GET['invoice'];
$sql="SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_barang.id=tb_transaksi.id_item INNER JOIN tb_employee ON tb_employee.id=tb_transaksi.id_employee WHERE invoice='".$invoice."' order by tnggl2 asc;";
$sql2 = "SELECT sum(deposit) as deposit, sum(payment) as payment FROM tb_deposit WHERE invoice='".$invoice."'";

$sql=trim($sql);
$transactionData = $conn->query($sql);
$transactionData2 = $conn->query($sql2);
$totalTransaction=0;
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

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 header">
				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse"
								data-target=".navbar-ex1-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Point</a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav navbar-right">
								<li><a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px;"
										href="logout.php">Logout</a></li>
								<li><a href="">
										<!-- <?php  echo $_SESSION['username'];  ?> --> </a></li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div>
				</nav>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-danger" href="report.php">Transaction Report</a>
				<a class="btn btn-danger" href="category_report.php">Category Report</a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<h2>Transaction Report</h2>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<table id="transactionTable" class="display">
					<thead>
						<tr>
							<th>No</th>
							<th>Date</th>
							<th>Invoice</th>
							<th>Customet</th>
							<th>Employee</th>
							<th>Item</th>
							<th>Qty</th>
							<th>Discount(%)</th>
							<th>Price</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=1;
						while($row = $transactionData->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row["tnggl2"]; ?></td>
							<td><?php echo $row["invoice"]; ?></td>
							<td><?php echo ($row["nm_transaksi"] == "" ?  "Direct Pay": $row["nm_transaksi"]); ?></td>
							<td><?php echo $row["nama"]; ?></td>
							<td><?php echo $row["item"]; ?></td>
							<td><?php echo $row["qty"]; ?></td>
							<td><?php echo $row["discount"]; ?></td>
							<td><?php echo $row["price"]; ?></td>
							<td><?php echo round($row["total_price"]/1000)*1000; ?></td>
						</tr>
						<?php
						$i=$i+1;
						$totalTransaction=$totalTransaction+$row["total_price"];
						} 
						?>
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<label>Total</label>
				<input type="text" name="total" id="total" value="<?php echo "Rp.".rupiah(ROUND($totalTransaction/1000)*1000); ?>" readonly="readonly" class="form-control"><br>
				<?php while($row2 = $transactionData2->fetch_assoc()) { ?>
				<label>Deposit</label>
				<input type="text" name="deposit" id="deposit" value="<?php echo "Rp.".rupiah($row2["deposit"]); ?>" readonly="readonly" class="form-control"><br>
				<label>Debt</label>
				<input type="text" name="debt" id="debt" value="<?php echo "Rp.".rupiah((ROUND($totalTransaction/1000)*1000)-$row2["deposit"]); ?>" readonly="readonly" class="form-control"><br>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);
		?>

	<?php include("./templates/footer.php"); ?>
	<script src="./assets/jquery-ui.js"></script>
	<script>
		$(document).ready(function () {
			$("#transactionTable").DataTable({
				"pageLength": 10
			});
		});
	</script>
</body>

</html>