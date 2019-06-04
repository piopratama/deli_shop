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

$sql="SELECT T1.id, T1.invoice, T1.nm_transaksi as nama, DATE(T1.tnggl) as tnggl, SUM(TD.deposit) AS deposit, SUM(TD.payment) AS payment, T1.total_price, (T1.total_price-SUM(TD.deposit)-SUM(TD.payment)) as dept FROM 
(SELECT id, nm_transaksi, invoice, tnggl, tnggl2, statuss, SUM(total_price) as total_price FROM tb_transaksi GROUP BY invoice) AS T1 INNER JOIN tb_deposit TD ON 
T1.invoice = TD.invoice";
$startDate="";
$endDate="";
$status="";
$where="";
if(isset($_POST['submit']))
{
	if($_POST['submit']=="submit")
	{
		$startDate=$_POST['startDate'];
		$endDate=$_POST['endDate'];
		$status=$_POST['status'];

		$where="Where";
		if($startDate!="")
		{
			$where=$where." DATE(TD.date)>='".$startDate."'";
		}

		if($endDate!="")
		{
			if($where=="Where")
			{
				$where=$where." DATE(TD.date)<='".$endDate."'";
			}
			else
			{
				$where=$where." and DATE(TD.date)<='".$endDate."'";
			}
		}

		if($status!="")
		{
			if($where=="Where")
			{
				$where=$where." T1.statuss='".$status."'";
			}
			else
			{
				$where=$where." and T1.statuss='".$status."'";
			}
		}
	}
}

if($where=="Where")
{
	$where="";
}

$sql=$sql." ".$where." GROUP BY T1.invoice order by T1.tnggl desc";
$sql=trim($sql);
$transactionData = $conn->query($sql);
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
				<a class="btn btn-danger glyphicon glyphicon-arrow-left" href="administrator.php"></a>
				<a class="btn btn-danger" href="administrator.php">Transaction Report</a>
				<a class="btn btn-danger" href="administrator.php">Category Report</a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<h2>Transaction Report</h2>
				<form class="form-inline" method="POST" action="">
					<div class="form-group">
						<label for="">Start Date : </label>
						<input type="date" name="startDate" id="startDate" class="form-control" placeholder="Start Date" 
							value="<?php echo ($startDate!="" ? $startDate:""); ?>">
					</div>
					<div class="form-group">
						<label for="">End Date : </label>
						<input type="date" name="endDate" id="endDate" class="form-control" placeholder="End Date" 
							value="<?php echo ($endDate!="" ? $endDate:""); ?>">
					</div>
					<div class="form-group">
						<label for="">Status : </label>
						<select class="form-control" name="status" id="status">
							<option value="" <?php echo $status=="" ? "selected":""; ?>>-- Select Status --</option>
							<option value="1" <?php echo $status=="1" ? "selected":""; ?>>Finished</option>
							<option value="0" <?php echo $status=="0" ? "selected":""; ?>>UnFinished</option>
						</select>
					</div>
					<button type="submit" name="submit" class="btn btn-submit" value="submit">Submit</button>
					<button type="submit" name="submit" class="btn btn-submit" value="print">Print</button>
				</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<table id="transactionTable" class="display">
					<thead>
						<tr>
							<th>No</th>
							<th>Created Date</th>
							<th>Payment Date</th>
							<th>Invoice</th>
							<th>Name</th>
							<th>Total Deposit</th>
							<th>Total Paid</th>
							<th>Total</th>
							<th>Total Dept</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=1;
						while($row = $transactionData->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo explode(" ",$row["invoice"])[0]; ?></td>
							<td><?php echo ($row["payment"] == 0 ?  "-": $row["tnggl"]); ?></td>
							<td><?php echo $row["invoice"]; ?></td>
							<td><?php echo ($row["nama"] == "" ?  "Direct Pay": $row["nama"]); ?></td>
							<td><?php echo rupiah(Round($row["deposit"]/1000)*1000); ?></td>
							<td><?php echo rupiah(Round($row["payment"]/1000)*1000); ?></td>
							<td><?php echo rupiah(Round($row["total_price"]/1000)*1000); ?></td>
							<td><?php echo rupiah(Round($row["dept"]/1000)*1000); ?></td>
							<td><?php echo ($row["payment"] == 0 ?  "Progress": "Finished"); ?></td>
							<td>
								<button type="button" class="btn btn-primary">History</button>
							</td>
						</tr>
						<?php
						$i=$i+1;
						$totalTransaction=$totalTransaction+$row["payment"]+$row["deposit"];
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
				<label>Total Income</label>
				<input type="text" name="totalTransaction" id="totalTransaction" value="<?php echo "Rp.".rupiah(ROUND($totalTransaction/1000)*1000); ?>" readonly="readonly" class="form-control">
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