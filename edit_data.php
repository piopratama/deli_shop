<!doctype html>
<html>
<?php
session_start();

$title="Update Stock";

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
$id=$_GET['id'];

$data = mysqli_query($conn, "SELECT id, price, item, stock, unit, description FROM tb_barang WHERE id='$id'");
$sql = "SELECT * FROM tb_kategori";
$result = $conn->query($sql);
?>
	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/directPayStyle.css">

	<body>
		
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 header">
						<nav class="navbar navbar-default" role="navigation">
							<div class="container-fluid">
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
										<li><a ype="button" class="btn btn-danger" style="margin: 10px; padding: 10px;" href="logout.php">Logout</a></li>
										<!-- <li><a href=""><?php  echo $_SESSION['username'];  ?> </a></li> -->
										
										<!-- <li class="">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="#">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li><a href="#">Something else here</a></li>
												<li><a href="#">Separated link</a></li>
											</ul>
										</li> -->
									</ul>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row">

					
					<div class="col-md-4 sidebar">
						<a type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" " href="stock.php"></a>
					</div>
					
					<div class="col-md-8 articles">
						<div class="row">
							<div class="col-md-12" style="margin: 10px 0px">
								<?php while($d=mysqli_fetch_array($data)) {?>
								<form action="updateStock.php" method="POST" role="form" id="directPay_div">
									<table>
										<tr>
											<td>
											<div class="form-group">
										      <label>category :</label>
										      <select class="form-control myItem2" name="category" style="width: 200%;">
													<option value="">-- Select Category --</option>
													<?php
														if ($result->num_rows > 0) {
														// output data of each row
														while($row = $result->fetch_assoc()) {
														?>
													<option value="<?php echo $row['id']?>"><?php echo $row['kategori'];?></option>
													<?php
														}
													}
														$conn->close();
													?>
												</select>
										</div>
										</td>
										</tr>
										<tr>												
											<td>	<div class="form-group">
										      <label for="usr">Name :</label>
										      <input type="hidden" name="id" value="<?php echo $d['id']?>">
										      <input type="text" style="width: 200%;" class="form-control" name="name" id="usr" value="<?php echo $d['item'];?>">
										    </div></td>
										</tr>
										<tr>
											
											<td>	<div class="form-group">
										      <label for="usr">Price :</label>
										      <input type="text" style="width: 200%;" class="form-control" name="price" id="usr" value="<?php echo $d['price'];?>">
										    </div></td>
										</tr>
										<tr>
											
											<td>	<div class="form-group">
										      <label for="usr">Stock :</label>
										      <input type="text" style="width: 200%;" class="form-control" name="stock" id="usr" value="<?php echo $d['stock'];?>">
										    </div></td>
										</tr>
										<tr>
											
											<td>	<div class="form-group">
										      <label for="usr">Unit</label>
										      <input type="text" style="width: 200%;" class="form-control" name="unit" id="usr" value="<?php echo $d['unit'];?>">
										    </div></td>
										</tr>
										<tr>
											
											<td><label for="usr">Description</label>
												<textarea name="description" style="width: 200%;" class="form-control" value="<?php echo $d['description']?>"></textarea></td>
										</tr>
										<tr>
											<td><button type="submit" class="btn btn-success" id="add_item_btn" style="margin-top: 10px;" name=Submit>Update</button></td>
											
										</tr>
										
									</table>
								</form>
								<?php }?>
								
							</div>
						</div>
					

					</div>
				</div>
			</div>
			<?php include("./templates/footer.php"); ?>
			<script>
				$(document).ready(function() {
					$(".myItem2").select2();
				});
			</script>
	</body>
</html>
