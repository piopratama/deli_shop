
<!DOCTYPE html>
<html>
<?php
session_start();

$title="Main Menu";

if(empty($_SESSION['username'])){
	header("location:index.php");
}
else
{
	if(!empty($_SESSION['level_user']))
	{
		if($_SESSION["level_user"]==1)
		{
			header("location:index.php");
		}
	}
}
?>
	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/mainMenuStyle.css">
	<body>
		
		<div class="container-fluid" style="width: 100%">
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
									<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Point</a>
								</div>
								<div class="collapse navbar-collapse navbar-ex1-collapse">						
									<ul class="nav navbar-nav navbar-right">
										<li><a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px;" href="logout.php?usernamed=<?php echo $_SESSION['username']?>">Logout</a></li>
										<li><a href=""><!-- <?php  echo $_SESSION['username'];  ?> --> </a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div class="container-fluid">
			<div class="row">
				<div class ="col-md-2"></div>
				<div class="col-md-4">
					<a href="directPay.php"><button type="button" class="btn btn-default" id="directpayMenu" style="height:200px; background-color:#85cdcc">Direct Pay</button></a>
				</div>	
				<div class="col-md-4">
					<a href="directPayTable.php"><button type="button" class="btn btn-default" id="directpayMenuTable" style="height:200px; background-color:#fdcd27">Direct Pay Table <span style="color:red;font-size:12px;">(new)</span></button></a>
				</div>
				<div class ="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<a href="unDirectPay.php"><button type="button" class="btn btn-default" id="undirectpayMenu" style="height:200px; background-color:#97e0b6">Undirect Pay</button></a>
				</div>
				<div class="col-md-4">
					<a href="unDirectPayTable.php"><button type="button" class="btn btn-default" id="undirectpayMenuTable"style="height:200px; background-color:#e06947">Undirect Pay Table <span style="color:red;font-size:12px;">(new)</span></button></a>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<a href="paymentUnDirect.php"><button type="button" class="btn btn-default" id="undirectpayMenu" style="height:200px; background-color:#aabfd0">Transaction</button></a>
				</div>
				<div class="col-md-4">
					<a href="dayReport.php"><button type="button" class="btn btn-default" id="undirectpayMenu" style="height:200px; background-color:#8fc23f">Day Report</button></a>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
		<?php include("./templates/footer.php"); ?>
	</body>
</html>