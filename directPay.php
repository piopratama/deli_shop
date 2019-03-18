<?php
session_start();

$title="Direct Menu";

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
$sql = "SELECT * FROM tb_barang";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/directPayStyle.css">

	<body>	
		<form action="transactionProcess.php"  method="POST" accept-charset="utf-8">
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
									<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Point</a>
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
				<div class="row">
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
						<div id="directPay_div">			
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
				<div class="row" id="parent_item_container">
					<div class="col-md-4" style="position: relative;">
						<i class="glyphicon glyphicon-trash" style="position: absolute;right: 25px;top:20px;"></i>
						<div class="itemForm">
							<div class="form-group">
								<label for="">Item</label>
								
								<select class="form-control myItem" name="item[]">
									<option value="">-- Select Item --</option>
									<?php
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											if($row['stock']==0)
											{
									?>
												<option value="<?php echo $row['id'] ?>" disabled="disabled"><?php echo $row['item']."*(".$row['stock']." ".$row['unit'].")"; ?></option>
									<?php
											}
											else
											{
									?>
												<option value="<?php echo $row['id'] ?>"><?php echo $row['item']."*(".$row['stock']." ".$row['unit'].")"; ?></option>
									<?php
											}
										}
									}
									$conn->close();
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="">Quantity</label>
								<input type="text" step="0" min="0" class="form-control qtyItem" name="qty[]" placeholder="Quantity" onkeypress="return isNumberKey(event)">
							</div>
							<div class="form-group">
								<label for="" class="label_price">Price</label>
								<input type="text" class="form-control price" placeholder="Price" readonly="readonly">
							</div>
							<div class="form-group">
								<label for="" class="label_discount">Discount (%)</label>
								<input type="text" class="form-control discount" value="0" name="discount[]" placeholder="Discount" onkeypress="return isNumberKey(event)">
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
					<div class="col-md-4" style="visibility:hidden;">
						<div id="extraForm">
							<div class="form-group">
								<label for="">Discount</label>
								<input type="number" class="form-control" placeholder="0%" readonly="readonly">
							</div>
							<div class="form-group">
								<label for="">PPN</label>
								<input type="number" class="form-control" placeholder="0%" readonly="readonly">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						
						<div class="form-group">
							<label for="">Grand Total</label>
							<input type="text" class="form-control" id="grandTotal" placeholder="Grand Total" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="">Payment</label>
							<input type="text" class="form-control" name="payment" id="payment" placeholder="Payment" required="required">
						</div>
						<div class="form-group">
							<label for="">Change</label>
							<input type="text" class="form-control" id="change" placeholder="Change" readonly="readonly">
						</div>
						<div class="form-group">
							<label for=""></label>
							<input type="text" class="form-control" id="grand">
						</div>
						
						<button type="button"class="btn btn-success" id="printItem">Print</button>
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
		
		<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);
			$session_casier=(isset($_SESSION['nama']))?$_SESSION['nama']:'';
		?>
		<?php include('./templates/footer.php'); ?>
		<script>
			$(document).ready(function() {
				var message='<?php echo $session_value;?>';
				var casier_name='<?php echo $session_casier;?>';
				$("#printBtn").attr('disabled', 'disabled');
				$("#printItem").attr('disabled', 'disabled');
				var manyItem=1;

				if(message!="")
				{
					alert(message);
					/*$("#warning_modal_msg").html(message);
					$("#exampleModal2").modal('show');*/
				}

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

				/*$("#printBtn").click(function(event) {
					var grandTotalCheck=$("#grandTotal").val();
					if(grandTotalCheck!="" && grandTotalCheck!="0")
					{
						var printer = new Recta('4590384132', '1811');
						printer.open().then(function () {
							var x=[];
							printer.align('center')	
							.text('DELI POINT')
							.bold(true)
							.text(formatDate($("#date").val()))
							.text('Jalan Puncak Waringin')
							.text('Labuan Bajo - Flores')
							.text('+62 812 3605 8607')
							.text('delipointkomodo@gmail.com')
							.text('cashier : '+casier_name)
							.text('------------------------------');
							printer.align('left')
							.text()
							.bold(true);
							
							$(".qtyItem").each(function() {
								x.push({qty:$(this).val(),item:"",price:"", discount: "", total:""});
							});
							var i=0;
							$(".myItem").each(function() {
								x[i].item=$(this).find('option:selected').text();
								i=i+1;
							});
							i=0;
							$(".price").each(function() {
								x[i].price=$(this).val();
								i=i+1;
							});
							i=0;
							$(".discount").each(function() {
								if($(this).val()!="")
								{
									x[i].discount=$(this).val();
								}
								else
								{
									x[i].discount=0;
								}
								i=i+1;
							});
							i=0;
							$(".total").each(function() {
								x[i].total=$(this).val()-$(this).val()*x[i].discount/100.0;
								i=i+1;
							});
							i=0;
							printer.text("Item").bold(true);
							printer.text("Qty     Price(Rp)     Discount(%)     Total(Rp)")
							.bold(true);
							printer.text("");
							for(var j=0;j<x.length;j++)
							{
								printer.text(x[j].item);
								printer.text(x[j].qty+"       "+x[j].price+"     "+x[j].discount+"     "+x[j].total);
								printer.text("");
							}
							alert("hay");
							printer.bold(true);
							printer.text("------------------------------")
							printer.text("Grand Total : "+numberToRupiah(parseFloat($("#grandTotal").val()))).bold(true);
							printer.text("Payment     : "+numberToRupiah(parseFloat($("#payment").val()))).bold(true);
							printer.text("Change : "+numberToRupiah(parseFloat($("#change").val()))).bold(true)
							.cut()
							.print();
						});
					}
				});*/				

				$("#printItem").click(function(event) {
					var grandTotalCheck=$("#grandTotal").val();
					if(grandTotalCheck!="" && grandTotalCheck!="0")
					{
						//var printer = new Recta('4590384132', '1811');
						var printer = new Recta('3245260761', '1811');
						printer.open().then(function () {
							var x=[];
							printer.align('center')	
							.text('DELI POINT')
							.bold(true)
							.text(formatDate($("#date").val()))
							.text('Jalan Puncak Waringin')
							.text('Labuan Bajo - Flores')
							.text('+62 812 3605 8607')
							.text('delipointkomodo@gmail.com')
							.text('cashier : '+casier_name)
							.text('------------------------------');
							printer.align('left')
							.text()
							.bold(true);
							
							$(".qtyItem").each(function() {
								x.push({qty:$(this).val(),item:"",price:"",total:""});
							});
							var i=0;
							$(".myItem").each(function() {
								x[i].item=$(this).find('option:selected').text().substring(0,$(this).find('option:selected').text().indexOf('*'));
								i=i+1;
							});
							i=0;
							$(".price").each(function() {
								x[i].price=$(this).val();
								i=i+1;
							});
							i=0;
							$(".discount").each(function() {
								if($(this).val()!="")
								{
									x[i].discount=$(this).val();
								}
								else
								{
									x[i].discount=0;
								}
								i=i+1;
							});
							i=0;
							$(".total").each(function() {
								x[i].total=$(this).val();//-$(this).val()*x[i].discount/100.0;
								i=i+1;
							});
							i=0;
							
							
							for(var j=0;j<x.length;j++)
							{
								printer.text("Item : "+x[j].item);
								printer.text("Qty : "+x[j].qty);
								printer.text("Price(Rp) : "+x[j].price);
								printer.text("Dsc(%) : "+x[j].discount);    
								printer.text("Total(Rp) : "+Math.round(x[j].total));
								printer.text("");
							}
							
							printer.bold(true);
							printer.text("------------------------------");
							if($("#grandTotal").val()!="")
							{
								printer.text("Grand Total : "+numberToRupiah(Math.round(parseFloat($("#grandTotal").val())))).bold(true);
							}
							if($("#payment").val()!="")
							{
								printer.text("Payment     : "+numberToRupiah(parseFloat($("#payment").val()))).bold(true);
							}
							if($("#change").val()!="")
							{
								printer.text("Change : "+numberToRupiah(parseFloat($("#change").val()))).bold(true);
							}
							printer.cut()
							.print();
						});
					}
				});

				var html=$("#parent_item_container").html();
				$(".myItem").select2();
				$("#add_item_btn").click(function(event) {
					$("#parent_item_container").append(html);
					$(".myItem").select2();
					manyItem=manyItem+1;
				});
				$("#parent_item_container").on('click','.glyphicon-trash',function(event){
					$(this).parent().remove();
					var total=0;
					$('.total').each(function(i, obj) {
						if(isNaN($(this).val())==false && $(this).val()!="")
						{
							var discount=$(this).parent().prev().find('.discount').val();
							if(discount=="")
							{
								discount=0;
							}
							total=total+parseFloat($(this).val());
							$("#grandTotal").val(total);
							var payment=parseFloat($("#payment").val());
							if(isNaN(payment)==false)
							{
								var change=payment-total;
								$("#change").val(change);
							}
						}
					});
					if(manyItem>1)
					{
						manyItem=manyItem-1;
					}
				});

				$("#parent_item_container").on('change','.myItem',function(event) {
					var id=$(this).val();
					var qty=$(this).parent().next().find(".qtyItem");
					var price_field=$(this).parent().next().next().find(".price");
					var discount=$(this).parent().next().next().next().find(".discount");
					var label_price=$(this).parent().next().next().find(".label_price");
					qty.val(0);
					discount.val(0);
					$.ajax({
							url: 'checkItemPrice.php',
							type: 'post',
							data: {id_item:id},
							dataType: 'json',
							success: function (data) {
								//alert(data);
								//console.log(data);
								price_field.val(data[0].price);
								label_price.html("Price ("+data[0].unit+")");
							}
						});
				});
				$("#parent_item_container").on('keyup','.discount',function(event) {
					var qty=$(this).parent().prev().prev().find('.qtyItem').val();
					var price_field=$(this).parent().prev().find(".price");
					var total=qty*price_field.val();
					var discount=$(this).val();
					var price_total=$(this).parent().next().find('.total');
					var grand=$(this).parent().parent().parents().parents().next().children().next().next().children().next().next().next().find('#grand');
					var grand_total=$(this).parent().parent().parents().parents().next().children().next().next().children().find('#grandTotal');
					if(discount=="")
					{
						discount=0;
					}
					total=total-discount*total/100.0;

					price_total.val(Math.round(total/1000)*1000);
					var total=0;
					$('.total').each(function(i, obj) {
						if(isNaN($(this).val())==false && $(this).val()!="")
						{
							total=total+parseFloat($(this).val());
							//total=total+0.1*total;
							grand.val(total);
							var grandtotal=parseFloat(grand.val())+parseFloat(grand.val())*0;
							grand_total.val(grandtotal);
							var payment=parseFloat($("#payment").val());
							if(isNaN(payment)==false)
							{
								var change=payment-total;
								$("#change").val(change);
							}
							
							if($("#method").val().trim()=='transfer')
							{
								$("#change").val(0);
								$("#payment").val(total);
							}
						}
						if($("#change").val()==0 && $("#method").val().trim()!='transfer'){
							$("#printBtn").attr('disabled', 'disabled');
							$("#printItem").attr('disabled', 'disabled');
							//alert("payment must be equal or bigger than grand total");
						}
						else
						{
							$("#printBtn").removeAttr('disabled');
							$("#printItem").removeAttr('disabled');
						}
					});
				});
				$("#parent_item_container").on('keyup','.qtyItem',function(event) {
					var qty=$(this).val();
					var price_field=$(this).parent().next().find(".price");
					var total=qty*price_field.val();
					var discount=$(this).parent().next().next().find('.discount').val();
					var price_total=$(this).parent().next().next().next().find('.total');
					var grand=$(this).parent().parent().parents().parents().next().children().next().next().children().next().next().next().find('#grand');
					var grand_total=$(this).parent().parent().parents().parents().next().children().next().next().children().find('#grandTotal');
					if(discount=="")
					{
						discount=0;
					}
					total=total-discount*total/100.0;

					price_total.val(Math.round(total/1000)*1000);
					var total=0;
					$('.total').each(function(i, obj) {
						if(isNaN($(this).val())==false && $(this).val()!="")
						{
							total=total+parseFloat($(this).val());
							//total=total+0.1*total;
							grand.val(total);
							var grandtotal=parseFloat(grand.val())+parseFloat(grand.val())*0;
							grand_total.val(grandtotal);
							var payment=parseFloat($("#payment").val());
							if(isNaN(payment)==false)
							{
								var change=payment-total;
								$("#change").val(change);
							}

							if($("#method").val().trim()=='transfer')
							{
								$("#change").val(0);
								$("#payment").val(total);
							}
						}
						if($("#change").val()==0 && $("#method").val().trim()!='transfer'){
							$("#printBtn").attr('disabled', 'disabled');
							$("#printItem").attr('disabled', 'disabled');
							//alert("payment must be equal or bigger than grand total");
						}
						else
						{
							$("#printBtn").removeAttr('disabled');
							$("#printItem").removeAttr('disabled');
						}
					});
				});
				$("#method").change(function(){
					if($(this).val()=='transfer')
					{
						$("#payment").val($("#grandTotal").val());
						$("#printBtn").removeAttr('disabled');
						$("#printItem").removeAttr('disabled');
					}
					else
					{
						$("#printBtn").attr('disabled', 'disabled');
						$("#printItem").attr('disabled', 'disabled');
					}
				});
				$("#payment").keyup(function(event) {
					var grandTotal=parseFloat($("#grandTotal").val());
					var payment=parseFloat($(this).val());
						if(isNaN(payment)==false)
						{
							var change=payment-grandTotal;
							if(change>=0)
							{
								$("#printBtn").removeAttr('disabled');
								$("#printItem").removeAttr('disabled');
							}
							else
							{
								$("#printBtn").attr('disabled', 'disabled');
								$("#printItem").attr('disabled', 'disabled');
							}
							$("#change").val(change);
						}
						else
						{
							$("#change").val(0);
							$("#printBtn").attr('disabled', 'disabled');
							$("#printItem").attr('disabled', 'disabled');
						}
				});

				$(document).scannerDetection({
					timeBeforeScanTest: 200, // wait for the next character for upto 200ms
					startChar: [120], // Prefix character for the cabled scanner (OPL6845R)
					endChar: [13], // be sure the scan is complete if key 13 (enter) is detected
					avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
					//ignoreIfFocusOn: 'input',
					onComplete: function(barcode, qty){
						
					} // main callback function	
				});

				function getItemScanner()
				{
					$.ajax({
							url: 'getItemByBarcode.php',
							type: 'post',
							data: {barcode:123},
							dataType: 'json',
							success: function (data) {
								if(data!="")
								{
									var gotData=false;
									$('.myItem').each(function(i, obj) {
										if(isNaN($(this).val())==false && $(this).val()!="")
										{
											var id=$(this).val();
											if(id==data)
											{
												gotData=true;
												var currQty=$(this).parent().next().find(".qtyItem").val();
												if(currQty=="")
												{
													currQty=0;
												}
												currQty=parseFloat(currQty)+1;
												$(this).parent().next().find(".qtyItem").val(currQty);
												$(this).parent().next().find(".qtyItem").keyup();
												return false;
											}
										}
									});
									if(!gotData)
									{
										gotData=false;
										$('.myItem').each(function(i, obj) {
											if(isNaN($(this).val())==true || $(this).val()=="")
											{
												$(this).val(data).change();
												gotData=true;
												var currQty=$(this).parent().next().find(".qtyItem").val();
												if(currQty=="")
												{
													currQty=0;
												}
												currQty=parseFloat(currQty)+1;
												$(this).parent().next().find(".qtyItem").val(currQty);
												$(this).parent().next().find(".qtyItem").keyup();
												return false;
											}
										});

										if(!gotData)
										{
											$('.myItem').each(function(i, obj) {
												if(isNaN($(this).val())==true || $(this).val()=="")
												{
													$("#add_item_btn").click();
													$(this).val(data).change();
													var currQty=$(this).parent().next().find(".qtyItem").val();
													if(currQty=="")
													{
														currQty=0;
													}
													currQty=parseFloat(currQty)+1;
													$(this).parent().next().find(".qtyItem").val(currQty);
													$(this).parent().next().find(".qtyItem").keyup();
													return false;
												}
											});
										}
									}
								}
							}
						});
				}

				//setInterval(getItemScanner, 3000);
			});
		</script>
	</body>
</html>