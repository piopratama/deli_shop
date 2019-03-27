
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
		if($_SESSION["level_user"]==0)
		{
			header("location:index.php");
		}
	}
}

	include "koneksi.php";
	$user = mysqli_query($conn, "SELECT nama FROM tb_employee where online_status=1");
?>
	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/mainMenuStyle.css">

	<body>
		
		<div class="container-fluid">
				<div class="row">
						<nav class="navbar navbar-default" role="navigation" >
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
				<div class="col-md-2" >
					<div style="height:200px; position: absolute;">
						<table>
						<p>User Online</p>
							<?php $no=0; 
							foreach( $user as $a ){
							?> 
							<tr style="border-bottom:1px solid black">
								<td style="width :100px; font-style:bold"><?php echo $a['nama'];?></td>
								<td style="color:green">Online</td>
							</tr>
							<?php  $no++; }?>
						</table>
					</div>
				</div>
				<div class="col-md-4">
					<a href="stock.php"><button type="button" class="btn btn-default" id="directpayMenu" style="height:170px; background-color:#85cdcc; border:none;">Stock</button></a>
				</div>
				<div class="col-md-4">
					<a href="user.php"><button type="button" class="btn btn-default" id="undirectpayMenu" style="height:170px; background-color:#fdcd27; border:none;">User</button></a>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<a href="expenses.php"><button type="button" class="btn btn-default buttonMenu" style="height:170px; background-color:#97e0b6; border:none;">Expenses</button></a>
				</div>
				<div class="col-md-4">
					<a href="report.php"><button type="button" class="btn btn-default buttonMenu" style="height:170px; background-color:#e06947">Report</button></a>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<a href="kategori.php"><button type="button" class="btn btn-default buttonMenu" style="height:170px; background-color:#aabfd0; border:none;">Category</button></a>
				</div>
				<div class="col-md-4">
					<a href="supplier.php"><button type="button" class="btn btn-default buttonMenu" style="height:170px; background-color:#8fc23f">Supplier</button></a>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<a href="api.php"><button type="button" class="btn btn-default" id="undirectpayMenu" style="height:170px; background-color:#fff79c">Printer Setting</button></a>
				</div>
				<div class="col-md-4">
					<a href=""><button type="button" class="btn btn-default" id="undirectpayMenu" style="height:170px; background-color:#cbbca9">Income Graph</button></a>
				</div>
				<div class="col-md-2"></div>
			</div>
			<!--<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="expired.php"><button type="button" class="btn btn-default buttonMenu">Add Expired</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>-->
		</div>
		<?php include('./templates/footer.php'); ?>
	</body>
</html>