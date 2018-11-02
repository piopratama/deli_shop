<!doctype html>
<html>
<?php
session_start();
if(empty($_SESSION['username'])){
	header("location:index.php");
}?>
<?php 
include 'koneksi.php';
$id=$_GET['id'];
$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE id='$id';");

?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/directPayStyle.css">
	</head>

	<body>
		
			<div class="container-fluid" style="margin-right: -15px; margin-left: -15px;">

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
					
									<ul class="nav navbar-nav navbar-right">
										<li><a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px; color: white" href="logout.php">Logout</a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">

					
					<div class="col-md-4 sidebar">
						<a type="button" href="kategori.php" class="btn btn-danger glyphicon glyphicon-arrow-left"></a>
					</div>
					
					<div class="col-md-8 articles">
						<div class="row">
							<div class="col-md-12" style="margin: 10px 0px">
								<?php while($d=mysqli_fetch_array($kategori)){?>
								<form action="update_kategori.php" method="POST" role="form" id="directPay_div">
									<table>
											<tr>
												<td>	<div class="form-group">
											      <label for="usr">Date Insert :</label>
											      <input type="hidden" class="form-control" name="id" value="<?php echo $d['id'];?>">
											      <input type="date" style="padding-bottom: 30px" class="form-control" name="date_insert" value="<?php echo $d['date_insert'];?>">
											    </div></td>
											</tr>
											<tr>
												
												<td>	<div class="form-group">
											      <label for="usr">Catagory :</label>
											      <input type="text" style="width: 200%; margin-bottom: 5px;" class="form-control" name="catagory" id="usr" value="<?php echo$d['nm_kategori'];?>">
											    </div></td>
											</tr>
											<tr>
												
												<td>	<div class="form-group">
											      <label for="usr">Description :</label>
											      <input type="text" style="width: 200%; margin-bottom: 5px;" class="form-control" name="description" id="usr" value="<?php echo $d['description'];?>">
											    </div></td>
											</tr>

											<tr>
												<td><button type="submit" class="btn btn-success" id="add_item_btn" name=Submit>Submit</button></td>
												
											</tr>
										
									</table>
								</form>

								<?php }?>
							</div>
						</div>
					

					</div>
				</div>
			</div>
	</body>
</html>
