<?php
session_start();
if(empty($_SESSION['username'])){
	header("location:index.php");
}
include_once 'koneksi.php';
$barang = mysqli_query($conn, "SELECT id, item, price, stock, unit, description FROM tb_barang;");
$stock_kurang = mysqli_query($conn, "SELECT id, item, stock, unit, description FROM tb_barang where stock<='5';");
$user = mysqli_query($conn, "SELECT * FROM tb_employee");
?>
<!DOCTYPE html>
<html>


	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<link rel="stylesheet" href="./assets/bootstrap3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./assets/jquery.dataTables.min.css">
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
			<script>
			 function kurang(){
			 document.getElementByClassName("stock").style.backgroundColor="red";
			 }
			</script>
			<div class="container">
				<div class="row">
				<div class="col-md-12 ">
				<a type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" href="administrator.php" style="margin:0 5px 10px 0;"></a>
						<h1>STOCK KURANG</h1>
						<table id="example2" class="table table-bordered" style="width: 100%;">
		
							
							
							<thead>
								<tr>
									
									<th>Item</th>
									
									<th>Stock</th>
									<th>Unit</th>
									<th>Description</th>
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no=1;
								foreach ($stock_kurang as $kurang) {?>
								<tr>
									<td><?php echo $kurang['item']?></td>
									<td><?php echo $kurang['stock']?></td>
									<td><?php echo $kurang['unit']?></td>
									<td><?php echo $kurang['description']?></td>
									
									
									
									<td>
										
										<a type="button" class="btn btn-success" href="edit_data.php?id=<?php echo $kurang['id'];?>">Update</a>
									</td>
								</tr>
								<?php $no++; }?>						
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
					
						<table id="example" class="table table-bordered" style="width: 100%;">
							<h1>TABEL STOCK</h1>
							
							
							<a type="button" class="btn btn-primary glyphicon glyphicon-plus" href="add_data.php" style="margin: 0 0 10px 0" ></a>
							<thead>
								<tr>
									<th>ID</th>
									<th>Item</th>
									<th>Price</th>
									<th>Stock</th>
									<th>Unit</th>
									<th>Description</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no=1;
								foreach ($barang as $data) {?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $data["item"];?></td>
									<td><?php echo $data["price"];?></td>
									<td id="stock"><?php echo $data["stock"];?><?php if($data["stock"]<=5){?>
										
										<?php }elseif($data["stock"]>10 && $data["stock"]<=30){?>
												
									<?php }?>
									</td>
									<td><?php echo $data["unit"];?></td>
									<td><?php echo $data["description"];?></td>
									<td><?php if($data["stock"]<=5){
										echo "Stock Kurang";
									}elseif($data["stock"]<=25){
										echo "Stock mulai berkurang";
									}else{
										echo "Stock aman";
									}?></td>
									<td>
										<a type="button" class="btn btn-danger" href="delete_data.php?id=<?php echo $data['id']?>">Delete</a>
										<a type="button" class="btn btn-success" href="edit_data.php?id=<?php echo $data['id'];?>">Update</a>
									</td>
								</tr>
								<?php $no++; }?>						
							</tbody>
						</table>
					</div>
				</div>
			</div>		
		</form>

		<script src="./assets/jquery.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="./assets/bootstrap3.3.7/js/bootstrap.min.js"></script>
		<script src="./assets/jquery.dataTables.min.js"></script>
		
		<script>
		
			$(document).ready(function() {
				$("#example").DataTable();
				$("#example2").DataTable();
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