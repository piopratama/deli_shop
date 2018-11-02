<?php
session_start();
if(empty($_SESSION['username'])){
	header("location:index.php");
}
include_once 'koneksi.php';
$barang = mysqli_query($conn, "SELECT * FROM tb_barang;");
$user = mysqli_query($conn, "SELECT id, nama, address, sallary, tlp, username, password FROM tb_employee");
?>
<!DOCTYPE html>
<html>


	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="css/stockStyle.css">
	</head>
	<body>
		
		<form action="transactionUnDirect.php" method="POST" accept-charset="utf-8">
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
									<!-- <ul class="nav navbar-nav">
										<li class="active"><a href="#">Link</a></li>
										<li><a href="#">Link</a></li>
									</ul> -->
									
									<ul class="nav navbar-nav navbar-right">
										<li><a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px; color: white" href="logout.php">Logout</a></li>
										<li><a href=""><!-- <?php  echo $_SESSION['username'];  ?> --> </a></li>
										
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
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row">
					

					<div class="col-md-12 articles">
						<div class="row">
						
						
							<table id="example" class="table table-bordered" style="width: 100%">
								<h1>USER</h1>
							
							<a type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" href="administrator.php" style="margin:0 5px 10px 0"></a>
							<a type="button" class="btn btn-primary glyphicon glyphicon-plus" href="add_user.php" style="margin: 0 0 10px 0"></a>
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Address</th>
										<th>Sallary</th>
										<th>tlpn</th>
										<th>Username</th>
										<th>Password</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$no=1;
										foreach($user as $data) {?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $data["nama"];?></td>
										<td><?php echo $data["address"];?></td>
										<td><?php echo $data["sallary"];?></td>
										<td><?php echo $data["tlp"];?></td>
										<td><?php echo $data["username"];?></td>
										<td><?php echo $data["password"];?></td>
										<td><a type="button" class="btn btn-danger" href="delete_user.php?id=<?php echo $data['id']?>">Delete</a>
											<a type="button" class="btn btn-success" href="edit_user.php?id=<?php echo $data['id']?>">Update</a>
										</td>
									</tr>
									<?php $no++;}?>
									
								</tbody>
							</table>
						</div>
					</div>
			</div>
		</form>

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

		<script>
			$(document).ready(function() {
				$("#example").DataTable();
				var html=$("#parent_item_container").html();
				$("#add_item_btn").click(function(event) {
					$("#parent_item_container").append(html);
				});
				$("#parent_item_container").on('click','.glyphicon-trash',function(event){
					$(this).parent().remove();
					$('.total').each(function(i, obj) {
						if(isNaN($(this).val())==false && $(this).val()!="")
						{
							total=total+parseFloat($(this).val());
							total=total+0.1*total;
							$("#grandTotal").val(total);
							var payment=parseFloat($("#deposit").val());
							if(isNaN(payment)==false)
							{
								var change=payment-total;
								$("#change").val(change);
							}
						}
					});
				});
				$("#parent_item_container").on('change','.myItem',function(event) {
					var id=$(this).val();
					var price_field=$(this).parent().next().next().find(".price");
					$.ajax({
							url: 'checkItemPrice.php',
							type: 'post',
							data: {id_item:id},
							success: function (data) {
								//alert(data);
								price_field.val(data);
							}
						});
				});
				$("#parent_item_container").on('keyup','.qtyItem',function(event) {
					var qty=$(this).val();
					var price_field=$(this).parent().next().find(".price");
					var total=qty*price_field.val();
					var price_total=$(this).parent().next().next().find('.total');
					price_total.val(total);
					var total=0;
					$('.total').each(function(i, obj) {
						if(isNaN($(this).val())==false && $(this).val()!="")
						{
							total=total+parseFloat($(this).val());
							total=total+0.1*total;
							$("#grandTotal").val(total);
							var payment=parseFloat($("#deposit").val());
							/*if(isNaN(payment)==false)
							{
								var change=payment-total;
								$("#change").val(change);
							}*/
						}
					});
				});
				$("#payment").keyup(function(event) {
					var grandTotal=parseFloat($("#grandTotal").val());
					var deposit=parseFloat($(this).val());
					/*if(isNaN(payment)==false)
					{
						var change=payment-grandTotal;
						$("#change").val(change);
					}
					else
					{
						$("#change").val("");
					}*/
				});
			});
		</script>
	</body>
</html>