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
$barang = mysqli_query($conn, "SELECT invoice, nm_transaksi, Date(tnggl) as tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_barang WHERE id=id_item )AS item, qty, total_price, statuss, method FROM tb_transaksi;");
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

					<div class="col-md-12" id="mytable">
					<table id="example" class="table table-bordered" style="width: 100%;">
						
						<a href="administrator.php" style="margin-left: 5px; margin-bottom: 10px;" type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" ></a><br>
						<div style="border-bottom:1px solid #bcbaba; margin-bottom:10px; background-color:#b5b2ac; padding:0 0 0 10px">
							Start: <input style="margin:10px; " type="date" name="start" id="date_start">
							Until: <input style="margin:10px;" type="date" name="end" id="date_end">
							Status: <select style="margin:10px; width:150px;height:28px" id="status_paid">
								<option value="">--Select Status--</option>
								<option value="1">Paid</option>
								<option value="0">Unpaid</option>
							</select>
							Customer: <select style="margin:10px; width:150px;height:28px" id="customer">
							<?php while($pelanggan=mysqli_fetch_array($customer)){?>
								<option>--Select Customer--</option>
								
								<option value="<?php ?>"><?php echo $pelanggan[0]?></option>
							<?php }?>
							</select>
							<input type="submit" class="btn btn-success glyphicon glyphicon-print" style="margin:10px 0 10px 0" name="Submit" value="Print"></button>
							<input type="submit" class="btn btn-success glyphicon glyphicon-print" style="margin:10px 0 10px 10px; " name="Submit" value="Pajak"></i></button>
						</div>
						
						<h1> TABEL REPORT</h1>
						<thead>
							<tr>
								<th>ID</th>
								<th>Invoice</th>
								<th>Name</th>
								<th>Date</th>
								<th>ID user</th>
								<th>Item</th>
								<th>QTY</th>
								<th>Total Price</th>
								<th>Method</th>
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
								<td><?php echo $data["total_price"];?></td>
								<td><?php echo $data["method"] ;?></td>
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
					<div id="chart-div">
						<div class="form-group">
							<label for="year">Year:</label>
							<input type="text" class="form-control" id="year">
						</div>
						<button class="btn btn-primary" id="chartBtn">Submit</button>
						<h3 class="text-center" id="title-chart" style="display: none;">Profit Chart (in K Rupiah)</h3>
						<div class="ct-chart ct-perfect-fourth"></div>
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
				$('#year').datepicker({
					changeYear: true,
					showButtonPanel: true,
					dateFormat: 'yy',
					onClose: function(dateText, inst) { 
						var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
						$(this).datepicker('setDate', new Date(year, 1));
					}
				});
				$("#year").focus(function () {
					$(".ui-datepicker-month").hide();
					$(".ui-datepicker-calendar").hide();
				});
				
				$("#chartBtn").click(function(event){
					event.preventDefault();
					createGraph();
				});

				function createGraph()
				{
					$("#title-chart").show();
					
					$.ajax({
						url: "grafik.php",
						method: 'POST',
						data: {year : $("#year").val()},
						dataType: 'json',
						success: function(result){
							var labels = [];
							var series = [];

							for(var i in result) {
								labels.push(result[i].labels);
								series.push(parseFloat(result[i].series));
							}

							var data = {
							labels: labels,
								series: [
								series
							]};

							var options = {
								seriesBarDistance: 15,
								height: '400px'
							};

							var responsiveOptions = [
							['screen and (min-width: 641px) and (max-width: 1024px)', {
								seriesBarDistance: 10,
								axisX: {
								labelInterpolationFnc: function (value) {
									return value;
								}
								},
							}],
							['screen and (max-width: 640px)', {
								seriesBarDistance: 5,
								axisX: {
								labelInterpolationFnc: function (value) {
									return value[0];
								}
								}
							}]
							];

							new Chartist.Bar('.ct-chart', data, options, responsiveOptions);
						}
					});
				}


				var message='<?php echo $session_value;?>';
				if(message!="")
				{
					alert(message);
				}
				var oTable=$("#example").dataTable();
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

				$("#status_paid").change(function(){
					getCustomerStatus();
					getTableCustomerStatus();
				});

				$("#customer").change(function(){
					getTableCustomerStatus();
				});
				
				$("#date_start").change(function(){
					getCustomerStatus();
					getTableCustomerStatus();
				});

				$("#date_end").change(function(){
					getCustomerStatus();
					getTableCustomerStatus();
				});

				function getCustomerStatus()
				{
					var status=$("#status_paid").val();
					var startDate=$("#date_start").val();
					var stopDate=$("#date_end").val();
					
					if(status!="" && startDate!="" && stopDate!="")
					{
						$.ajax({
							url: 'getStatusCustomer.php',
							type: 'post',
							data: {status: status, dateStart: startDate, dateStop: stopDate},
							dataType: 'text',
							success: function (data) {
								$("#customer").html(data);
								//oTable.fnClearTable();
								
								/*for(var i=0;i<data.length;i++)
								{
									oTable.fnAddData( [
										data[i].no,
										data[i].invoice,
										data[i].nm_transaksi,
										data[i].tnggl,
										data[i].nama_pegawai,
										data[i].item,
										data[i].qty,
										data[i].total_price,
										data[i].status
									]);
								}*/
							}
						});
					}
				}

				function getTableCustomerStatus()
				{
					var status=$("#status_paid").val();
					var startDate=$("#date_start").val();
					var stopDate=$("#date_end").val();
					var customer=$("#customer").val();
					$.ajax({
						url: 'getTableStatusCustomer.php',
						type: 'post',
						data: {status: status, dateStart: startDate, dateStop: stopDate, customer: customer},
						dataType: 'json',
						success: function (data) {
							if(data!=[])
							{
								oTable.fnClearTable();
								for(var i=0;i<data.length;i++)
								{
									oTable.fnAddData( [
										data[i].no,
										data[i].invoice,
										data[i].nm_transaksi,
										data[i].tnggl,
										data[i].nama_pegawai,
										data[i].item,
										data[i].qty,
										data[i].total_price,
										data[i].method,
										data[i].status
									]);
								}
							}
						}
					});
				}
			});
		</script>
	</body>
</html>