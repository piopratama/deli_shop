<?php
session_start();

$title="Undirect Menu";

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
require 'koneksi.php';
$sql = "SELECT invoice, nm_transaksi FROM tb_transaksi where statuss='0' group by invoice;";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="css/directPayStyle.css">
	<body>
		<form action="transactionUnDirect.php" method="POST" accept-charset="utf-8">
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
			<div class="container">
				<div class="row" id="parent_invoice">
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select class="form-control"  id="invoice" name="invoice" theme="google">
								<option value="">-- Select Nama --</option>
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
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" class="form-control" id="name" placeholder="name" name="name">
						</div>
						<div class="form-group">
							<label for="">Date</label>
							<input type="date" class="form-control" id="date" value="<?php echo date('Y-m-d'); ?>" placeholder="" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="">Method</label>
							<select class="form-control" name="method" id="method">
								<option value="cash">Cash</option>
								<option value="transfer">Transfer</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						
						<a class="btn btn-danger glyphicon glyphicon-arrow-left" href="mainMenu.php"></a>
						<a class="btn btn-primary glyphicon glyphicon-plus" id="add_item_btn"></a>
					</div>
					<div class="col-md-4">
						
					</div>
				</div>
				<?php
					require 'koneksi.php';
					$sql="SELECT * FROM tb_barang;";
					$result2 = $conn->query($sql);
				?>
				<div class="row" id="parent_item_container">
					<div class="col-md-4" style="position: relative;">
						<i class="glyphicon glyphicon-trash" style="position: absolute;right: 25px;top:20px;"></i>
						<div class="itemForm">
							<div class="form-group">
								<label for="">Item</label>
								<select class="form-control item" name="item[]" theme="google" data-search="true">
									<option value="">-- Select Item --</option>
									<?php
									if ($result2->num_rows > 0) {
										// output data of each row
										while($row2 = $result2->fetch_assoc()) {
									?>
									<option value="<?php echo $row2['id'] ?>"><?php echo $row2['item']."(".$row2['stock']." ".$row2['unit'].")"; ?></option>
									<?php
										}
									}
									$conn->close();
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="">Quantity</label>
								<input type="number" step="any" min="1" class="form-control qtyItem" name="qty[]" placeholder="Quantity">
							</div>
							<div class="form-group">
								<label for="" class="label_price">Price</label>
								<input type="text" class="form-control price" placeholder="Price" readonly="readonly">
							</div>
							<div class="form-group">
								<label for="">Total</label>
								<input type="text" class="form-control total" placeholder="Total" readonly="readonly">
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="parent_price_total">
					<div class="col-md-4">
					</div>
					<!--<div class="col-md-4">
						<div id="extraForm">
							<div class="form-group">
								<label for="">Discount</label>
								<input type="number" class="form-control discount" placeholder="%" readonly="readonly">
							</div>
							<div class="form-group">
								<label for="">PPN</label>
								<input type="number" class="form-control ppn" placeholder="10%" readonly="readonly">
							</div>
						</div>
					</div>-->
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Grand Total</label>
							<input type="text" class="form-control" id="grandTotal" placeholder="Grand Total" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="" id="deposit_label">Deposit</label>
							<input type="text" class="form-control" name="deposit" id="deposit" placeholder="Deposit" required="required" value="0">
						</div>
						<div class="form-group">
							<label for=""></label>
							<input type="text" class="form-control" id="grand">
						</div>
						<button type="button" class="btn btn-success" id="printItem">Print</button>
						<button type="submit"class="btn btn-primary" id="printBtn">End Transaction</button>
					</div>
				</div>
			</div>
		</form>
		
		<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel2">Warning</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p id="warning_modal_msg"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
        </div>
		<hr>
		<h3 id="history-title" class="text-center">History</h3>
		<hr>
		<div id="history"></div>
		<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);
		?>
		<?php include('./templates/footer.php'); ?>
		<script>
			$(document).ready(function() {
				var message='<?php echo $session_value;?>';
				var invoice='<?php if(isset($_SESSION['invoice'])){ echo $_SESSION['invoice']; } ?>';
				
				if(message!="")
				{
					$("#warning_modal_msg").html(message);
					$("#exampleModal2").modal('show');
				}

				$("#history-title").hide();

				$('#invoice').select2();

				var html=$("#parent_item_container").html();
				$('.item').select2();
				$("#add_item_btn").click(function(event) {
					$("#parent_item_container").append(html);
					$('.item').select2();
				});

				function numberToRupiah(bilangan)
				{
					var	number_string = bilangan.toString(),
						sisa 	= number_string.length % 3,
						rupiah 	= number_string.substr(0, sisa),
						ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
							
					if (ribuan) {
						separator = sisa ? '.' : '';
						rupiah += separator + ribuan.join('.');
					}

					return rupiah;
				}
				
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
				
				$("#invoice").change(function(event) {
					var invoice=$(this).val();
					var name=$("#invoice :selected").text();
					
					if(invoice==null || invoice=="")
					{
						$("#name").attr('readonly', false);
					}
					else
					{
					$.ajax({
							url: 'checkInvoiceDeposit.php',
							type: 'post',
							data: {invoice:invoice},
							success: function (data) {
								$("#deposit_label").html("deposit ("+data+")");
							}
						});

					
					$.ajax({
							url: 'checkInvoice.php',
							type: 'post',
							data: {invoice:invoice},
							success: function (data) {
								$("#name").val(name);
								$("#name").attr('readonly', true);
								//$("#parent_item_container").html(data);
								$("#history").html(data);
								var grand=$(this).parent().parent().parents().parents().next().children().next().next().children().next().next().find('#grand');
								var grand_total=$(this).parent().parent().parents().parents().next().children().next().next().children().find('#grandTotal');
								var total=0;
								$("#history-title").show();
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
							}
						});
					}
				});

				$("#printBtn").click(function(event) {
					var grandTotalCheck=$("#grandTotal").val();
					if(grandTotalCheck!="" && grandTotalCheck!="0")
					{
						var printer = new Recta('3245260761', '1811');
						printer.open().then(function () {
							var x=[];
							printer.align('center')	
							.text('DELI SHOP')
							.bold(true)
							.text($("#date").val())	
							.text("Invoice : ")
							printer.text(invoice)
							.text('------------------------------');
							printer.align('left')
							.text()
							.bold(true);
							
							$(".qtyItem").each(function() {
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
							printer.text("Grand Total : "+numberToRupiah(parseFloat($("#grandTotal").val()))).bold(true);
							printer.text("Deposit : "+numberToRupiah(parseFloat($("#deposit").val()))).bold(true)
							.cut()
							.print();
						});
					}
				});

				$("#printItem").click(function(event) {
					var grandTotalCheck=$("#grandTotal").val();
					if(grandTotalCheck!="" && grandTotalCheck!="0")
					{
						var printer = new Recta('3245260761', '1811');
						printer.open().then(function () {
							var x=[];
							printer.align('center')	
							.text('DELI SHOP')
							.bold(true)
							.text($("#date").val())	
							.text("Invoice : ")
							printer.text(invoice)
							.text('------------------------------');
							printer.align('left')
							.text()
							.bold(true);
							
							$(".qtyItem").each(function() {
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
							.cut()
							.print();
						});
					}
				});

				$("#parent_item_container").on('change','.item',function(event) {
					var id=$(this).val();
					var price_field=$(this).parent().next().next().find(".price");
					var label_price=$(this).parent().next().next().find(".label_price");
					$.ajax({
							url: 'checkItemPrice.php',
							type: 'post',
							data: {id_item:id},
							dataType: 'json',
							success: function (data) {
								//price_field.val(data);
								price_field.val(data[0].price);
								label_price.html("Price ("+data[0].unit+")");
							}
						});
				});
				
				$("#parent_item_container").on('keyup','.qtyItem',function(event) {
					var qty=$(this).val();
					var price_field=$(this).parent().next().find(".price");
					var total=qty*price_field.val();
					var price_total=$(this).parent().next().next().find('.total');
					var grand=$(this).parent().parent().parents().parents().next().children().next().next().children().next().next().find('#grand');
					var grand_total=$(this).parent().parent().parents().parents().next().children().next().next().children().find('#grandTotal');
					price_total.val(total);
					var total=0;
					$('.total').each(function(i, obj) {
						if(isNaN($(this).val())==false && $(this).val()!="")
						{
							total=total+parseFloat($(this).val());
							//$("#grandTotal").val(total);
							grand.val(total);
							var grandtotal=parseFloat(grand.val())+parseFloat(grand.val())*0;
							grand_total.val(grandtotal);
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

				//+gusde - ajax print PDF
				$("#printItem").click(function(event) {
					var nama=$("#name").val();
					$.ajax({
							url: 'transactionListControl.php',
							type: 'post',
							data: {nama:nama},
							dataType: 'json',
							success: function (relust) {
								//price_field.val(data);
								alert(result);
							}
						});
				});
			});
		</script>
	</body>
</html>