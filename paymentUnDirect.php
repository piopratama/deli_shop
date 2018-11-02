<?php
session_start();

$title="Payment Undirect";

if(empty($_SESSION['username'])){
	header("location:index.php");
}
require 'koneksi.php';
$sql = "SELECT id, nm_transaksi, invoice FROM tb_transaksi where statuss='0' group by invoice;";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/paymentUnDirectStyle.css">
	<body>
		<form method="POST" action="finishTransaction.php" target="_blank">
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
								<div class="collapse navbar-collapse navbar-ex1-collapse">						
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
		<div class="container-fluid">
			<div class="row">
			<div class="col-md-4">
					<div class="col-md-4">
						<a class="btn btn-danger glyphicon glyphicon-arrow-left" href="mainMenu.php" ></a>	
					</div>
				</div>
				<div class="col-md-12">
				<h1 class="text-center">TRANSACTION PAGE</h1>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Date</label>
						<input type="date" class="form-control" id="curr_date" value="<?php echo date('Y-m-d'); ?>" placeholder="" readonly="readonly">
					</div>
					<div class="form-group">
						<select class="form-control" id="invoice" name="invoice" required="required">
							<option value="">-- Select Name --</option>
							<?php
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
							?>
							<option value="<?php echo $row['invoice'] ?>"><?php echo $row['nm_transaksi']; ?></option>
							<?php
								}
							}
							$conn->close();
							?>
						</select>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-12" id="mytable">
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-8"></div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Grand Total</label>
						<input type="text" class="form-control" id="grandTotal" placeholder="Grand Total" readonly="readonly">
					</div>
					<div class="form-group">
						<label for="">Deposit</label>
						<input type="text" class="form-control" id="deposit" placeholder="Deposit" readonly="readonly" required="required">
					</div>
					<div class="form-group">
						<label for="">Remianing Payment</label>
						<input type="text" class="form-control" id="remainingPay" placeholder="Remaining Payment" readonly="readonly">
						<button type="submit" class="btn btn-primary" id="printBtn" style="margin-top: 20px;">Submit</button>

					</div>
				</div>
			</div>
		</div>
		</form>
		<?php include("./templates/footer.php"); ?>
		<script>
			$(document).ready(function() {
				var invoice='';
				
				$("#invoice").change(function(event) {
					invoice=$(this).val();
					var grand_total=$("#grandTotal");
					var deposit_pay=$("#deposit");
					var remainingPay=$("#remainingPay");
					$.ajax({
						url: 'getDataTransaction.php',
						type: 'post',
						data: {invoice:invoice},
						success: function (data) {
							//console.log(data);
							//var element=$(data);
							$("#mytable").html(data);
							$('#example').dataTable();
							//element.dataTable();
						}
					});
					$.ajax({
							url: 'getGrandTotal.php',
							type: 'post',
							data: {invoice:invoice},
							success: function (data) {
								grand_total.val(data);
								//$("#grandTotal").val(data);
								$.ajax({
										url: 'getDeposit.php',
										type: 'post',
										data: {invoice:invoice},
										success: function (data) {
											deposit_pay.val(data);
											//$("#deposit").val(data);
											var remaining=parseFloat(grand_total.val())-parseFloat(deposit_pay.val());
											remainingPay.val(remaining);
										}
								});
							}
						});
				});

				$("#printBtn").click(function(event) {

					$.ajax({
						url: 'getDataTable.php',
						type: 'post',
						data: {invoice:invoice},
						dataType: 'json',
						success: function (data) {
							var printer = new Recta('3245260761', '1811');
							printer.open().then(function () {
						        printer.align('center')	
						        .text('DELI SHOP')
						        .bold(true)
						        .text(invoice)
						        .text($("#curr_date").val())
						        .text('------------------------------');
						        printer.align('left')
								.text("")
						        .bold(true);
						        
						        for(var j=0;j<data.length;j++)
						        {
						        	printer.text("Item : "+data[j].item);
						        	printer.text("Date : "+data[j].date);
						        	printer.text("Qty     Price(Rp)     Total(Rp)");
						        	printer.text(data[j].qty+"       "+data[j].price+"     "+data[j].total);
						        	printer.text("");
						        }
								printer.text("------------------------------")
						        printer.text("Grand Total : "+$("#grandTotal").val()).bold(true);
						        printer.text("Deposit : "+$("#deposit").val()).bold(true)
						        .cut()
						        .print();
						    });
						}
					});
					/*var printer = new Recta('3245260761', '1811');
					printer.open().then(function () {
						var x=[];
				        printer.align('center')	
				        .text('DELI SHOP')
				        .bold(true)
				        .text($(".date").val())	
				        .text("Invoice : ")
				        printer.text($("#invoice").val())
				        .text('------------------------------');
				        printer.align('left')
						.text()
				        .bold(true);
				        
				        $(".qty").each(function() {
				        	x.push({qty:$(this).val(),item:"",price:"",total:""});
				        });
				        var i=0;
				        $(".item").each(function() {
				        	x[i].item=$(this).find('option:selected').text();
				        	i=i+1;
				        });
				        i=0;
				        $(".price").each(function() {
				        	x[i].price=$(this).val();
				        	i=i+1;
				        });
				        i=0;
				        $(".total").each(function() {
				        	x[i].total=$(this).val();
				        	i=i+1;
				        });
				        i=0;
				        printer.text("Item").bold(true);
				        printer.text("Qty     Price(Rp)     Total(Rp)")
				        .bold(true);
				        printer.text("");
				        for(var j=0;j<x.length;j++)
				        {
				        	printer.text(x[j].item);
				        	printer.text(x[j].qty+"       "+x[j].price+"     "+x[j].total);
				        	printer.text("");
				        }
				        
				        printer.bold(true);
				        printer.text("------------------------------")
				        printer.text("Grand Total : "+$("#grandTotal").val()).bold(true);
				        printer.text("Deposit : "+$("#deposit").val()).bold(true)
				        .cut()
				        .print();
				    });*/
				});

			});
		</script>
	</body>
</html>