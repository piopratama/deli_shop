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

$sql2 = "SELECT * FROM tb_api";
$api = $conn->query($sql2);

$sql = "SELECT invoice, nm_transaksi FROM tb_transaksi where statuss='0' group by invoice;";
$historyInvoice = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/directPayStyle.css">

	<body>	
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
								<a class="navbar-brand" style="font-size: 40px;" href="#">Barong</a>
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
			<div class="row" id="parent_item_container">
				<div class="col-md-3" style="background:orange;padding-top:10px;padding-bottom:10px;">
					<a class="btn btn-danger glyphicon glyphicon-arrow-left" href="mainMenu.php"></a>
					<hr>
					<div style="margin-top:10px;">
						<div class="form-group">
							<label for="">Date</label>
							<input type="date" class="form-control" id="date" value="<?php echo date('Y-m-d'); ?>" placeholder="" readonly="readonly">
						</div>
						<hr>
                        <div class="form-group">
                            <label for="">Pilih Nama</label>
                            <select class="form-control"  id="invoice" name="invoice" theme="google">
								<option value="">-- Select Nama --</option>
								<?php
								if ($historyInvoice->num_rows > 0) {
									// output data of each row
									while($row = $historyInvoice->fetch_assoc()) {
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
							<label for="">Nama Baru</label>
							<input type="text" class="form-control" id="name" placeholder="name" name="name">
						</div>
                        <div style="text-align:center;">
							<button type="button" id="historyBtn" class="btn btn-primary pull-right" style="width:150px;">History</button>
						</div>
                        <div class="clear" style="clear:both;"></div>
                        <hr>
						<div class="form-group">
							<label for="">Item</label>
							
							<select class="form-control myItem" name="item[]" id="myItem">
								<option value="">-- Pilih Item --</option>
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
							<label for="">Jumlah</label>
							<input type="text" step="0" min="0" id="myQty" class="form-control qtyItem" name="qty[]" placeholder="Quantity" onkeypress="return isNumberKey(event)">
						</div>
						<div class="form-group">
							<label for="" class="label_discount">Discount (%)</label>
							<input type="text" class="form-control discount" id="myDiscount" value="0" name="discount[]" placeholder="Discount" onkeypress="return isNumberKey(event)">
						</div>
						<div style="text-align:center;">
							<button type="button" id="addItem" class="btn btn-primary pull-right" style="width:150px;">Add</button>
						</div>
						<div class="clear" style="clear:both;"></div>
					</div>
					<hr>
					<div>
						<div class="form-group">
							<label for="" id="grand_total_label">Total Bayar</label>
							<input type="text" class="form-control" id="grandTotal" placeholder="Grand Total" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="">Metode Pembayaran</label>
							<select class="form-control" name="method" id="method">
								<option value="cash">Cash</option>
								<option value="transfer">Transfer</option>
							</select>
						</div>
						<div class="form-group">
                            <label for="">Deposit</label>
							<input type="text" class="form-control" name="payment" id="payment" placeholder="Deposit" required="required">
						</div>
						
						<div style="text-align:center;">
							<button type="button"class="btn btn-success" id="printBtn" style="width:150px;">Print</button>
							<button type="submit"class="btn btn-primary" id="endTransactionBtn" style="width:150px;">End Transaction</button>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-9">
					<div style="height: 950px !important;overflow: scroll;">
						<table class="table table-bordered">
							<thead>
								<tr>
								<th scope="col">#</th>
								<th scope="col">Item</th>
								<th scope="col">Jum</th>
								<th scope="col">Unit</th>
								<th scope="col">Harga</th>
								<th scope="col">Discount (%)</th>
								<th scope="col">Total</th>
								<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody id="table_body">
								<!--<tr>
									<td>1</td>
									<td>Daging Sapi</td>
									<td>2</td>
									<td>kg</td>
									<td>50000</td>
									<td>0%</td>
									<td>100000</td>
									<td>
										<i class="glyphicon glyphicon-trash"></i>
										<i class="glyphicon glyphicon-pencil"></i>
									</td>
								</tr>-->
								<tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row" id="parent_price_total">
				<div class="col-md-4">
				</div>
				<!--<div class="col-md-4" style="visibility:hidden;">
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
				</div>-->
				<div class="col-md-4">
					
					

				</div>
			</div>
		</div>

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

        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel2">History</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="historyModalBody">
					
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
			$apiPrinter="";
			$portPrinter="";
			$namePrinter="";
			$address="";
			$address2="";
			$phone="";
			$email="";
			foreach($api as $val)
			{
				$apiPrinter = $val["api"];
				$portPrinter = $val["port"];
				$namePrinter = $val["name"];
				$address=$val["address"];
				$address2=$val["address2"];
				$phone=$val["phone"];
				$email=$val["email"];
			}
			
		?>
		<?php include('./templates/footer.php'); ?>
		<script>
			$(document).ready(function() {
				var message='<?php echo $session_value;?>';
				var casier_name='<?php echo $session_casier;?>';
				var api = '<?php echo $apiPrinter;?>';
				var port = '<?php echo $portPrinter;?>';
				var namePrinter = '<?php echo $namePrinter;?>';
				var address = '<?php echo $address;?>';
				var address2 = '<?php echo $address2;?>';
				var phone = '<?php echo $phone;?>';
				var email = '<?php echo $email;?>';
                var manyItem=1;
                var deposit=0;

				$("#printBtn").attr('disabled', 'disabled');
                $("#endTransactionBtn").attr('disabled', 'disabled');
                $('#invoice').select2();
                $("#myItem").select2();

				if(message!="")
				{
					alert(message);
					/*$("#warning_modal_msg").html(message);
					$("#exampleModal2").modal('show');*/
				}
				var myDataTable=[];
				var myDataTableTemp=[];

				function getGrandTotal()
				{
					var grand_total=0;
					for(var i=0;i<myDataTable.length;i++)
					{
						grand_total=grand_total+(myDataTable[i].price*myDataTable[i].qty-myDataTable[i].price*myDataTable[i].qty*myDataTable[i].discount/100.0);
					}

					if($("#method").val().trim()=='transfer')
					{
						$("#payment").val(grand_total);
						$("#printBtn").removeAttr('disabled');
						$("#endTransactionBtn").removeAttr('disabled');
                    }
                    else if(grand_total>0)
					{
						$("#printBtn").removeAttr('disabled');
						$("#endTransactionBtn").removeAttr('disabled');
                    }
                    else
                    {
                        $("#printBtn").attr('disabled', 'disabled');
						$("#endTransactionBtn").attr('disabled', 'disabled');
                    }
					return grand_total;
                }
                
                function getDespositHistory()
                {
                    var invoice=$("#invoice").val();
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
                                deposit=data;
                            }
                        });
                    }
                }

                function getInvoiceHistory()
                {
                    var invoice=$("#invoice").val();
					var name=$("#invoice :selected").text();
					if(invoice==null || invoice=="")
					{
						$("#name").attr('readonly', false);
                    }
                    else
                    {
                        $.ajax({
                            url: 'checkInvoice.php',
                            type: 'post',
                            data: {invoice:invoice, deposit: deposit},
                            success: function (data) {
                                $("#historyModalBody").html(data);
                                $("#exampleModal3").modal("show");
                            }
                        });
                    }
                }

				function getItemDetailById(id, qty, discount)
				{
					var result=[];
					$.ajax({
						url: 'checkItemPrice.php',
						type: 'post',
						data: {id_item:id, qty: qty, discount: discount},
						dataType: 'json',
						async: false,
						success: function (data) {
							result=data;
						}
					});
					return result;
				}

				function saveTransaction()
				{
					var item=[];
					var qty=[];
					var payment=$("#payment").val();
                    var method=$("#method").val();
                    var invoice=$("#invoice").val();
                    var name=$("#name").val();
					var discount=[];

					for(var i=0;i<myDataTable.length;i++)
					{
						item.push(myDataTable[i].id_item);
						qty.push(myDataTable[i].qty);
						discount.push(myDataTable[i].discount);
					}
					
					$.ajax({
						url: 'transactionUnDirect.php',
						type: 'post',
						data: {invoice:invoice, name:name,item:item, qty:qty, deposit:payment, method: method, discount: discount,mode:1},
						dataType: 'json',
						async: false,
						success: function (data) {
							location.reload();
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
					});
				}

				function createHTMLTransactionTable()
				{
					var html="";
					for(var i=0;i<myDataTable.length;i++)
					{
						html=html+"<tr>";
						html=html+"<td>"+(i+1)+"</td>";
						html=html+"<td>"+myDataTable[i].item+"</td>";
						html=html+"<td>"+myDataTable[i].qty+"</td>";
						html=html+"<td>"+myDataTable[i].unit+"</td>";
						html=html+"<td>"+myDataTable[i].price+"</td>";
						html=html+"<td>"+myDataTable[i].discount+"</td>";
						html=html+"<td>"+myDataTable[i].total_price+"</td>";
						html=html+"<td id='"+i+"'><button class='btn btn-primary myItemEdit'><i class='glyphicon glyphicon-pencil'></i></button> <button class='btn btn-danger myItemDelete'><i class='glyphicon glyphicon-trash'></i></button></td>";
						html=html+"</tr>";
					}
					$("#table_body").html(html);
					var grand_total=getGrandTotal();
					$("#grandTotal").val(grand_total);
					var payment=$("#payment").val();
				}

				$("#addItem").click(function(){
					var id=$("#myItem").val();
					var qty=$("#myQty").val();
					var discount=$("#myDiscount").val();
					if(id!=null && id!="")
					{
						var data=getItemDetailById(id, qty, discount);
						var dataExist=false;
						if(data!=null)
						{
							for(var i=0;i<myDataTable.length;i++)
							{
								if(data[0].id_item==myDataTable[i].id_item)
								{
									myDataTable[i].qty=parseFloat(myDataTable[i].qty)+parseFloat(qty);
									myDataTable[i].total_price=parseFloat(myDataTable[i].price)*parseFloat(myDataTable[i].qty)-parseFloat(myDataTable[i].price)*parseFloat(myDataTable[i].qty)*parseFloat(myDataTable[i].discount)/100.0;
									dataExist=true;
									break;
								}
							}
							if(!dataExist)
							{
								myDataTable.push(data[0]);
								myDataTableTemp=myDataTable;
							}
							createHTMLTransactionTable();
						}
					}
					$("#addItem").text("Add");
				});
				
				$("#table_body").on("click",".myItemDelete", function(){
					var id=$(this).parent().attr("id");
					myDataTable.splice(id, 1);
					createHTMLTransactionTable();
				});

				$("#table_body").on("click",".myItemEdit",function(){
					var id_temp=$(this).parent().attr('id');

					$("#addItem").text("Update");
					$("#myItem").val(myDataTableTemp[id_temp].id_item);
					$("#myItem").change();
					$("#myQty").val(myDataTableTemp[id_temp].qty);

					var id_temp=$(this).parent().attr("id");
					myDataTable.splice(id_temp, 1);
                    createHTMLTransactionTable();
				});

				$("#method").change(function(){
					var grand_total=getGrandTotal();
					$("#grandTotal").val(grand_total);
				});

				$("#printBtn").click(function(event) {
					var mydate = formatDate(new Date($("#date").val()));
					//console.log(mydate);
					var grandTotalCheck=$("#grandTotal").val();
					if(grandTotalCheck!="" && grandTotalCheck!="0")
					{
						var printer = new Recta(api.toString(), port.toString());
						//var printer = new Recta('4590384132', '1811');

						printer.open().then(function () {
							var x=[];
							printer.align('center')	
							.text(namePrinter)
							.bold(true)
							.text(mydate)
							.text(address)
							.text(address2)
							.text(phone)
							.text(email)
							.text('cashier : '+casier_name)
							.text('------------------------------');
							printer.align('left')
							.text()
							.bold(true);							
							
							for(var j=0;j<myDataTable.length;j++)
							{
								printer.text("Item : "+myDataTable[j].item);
								printer.text("Qty : "+myDataTable[j].qty+" "+myDataTable[j].unit);
								printer.text("Price(Rp) : "+myDataTable[j].price);
								printer.text("Dsc(%) : "+myDataTable[j].discount);    
								printer.text("Total(Rp) : "+Math.round(myDataTable[j].total_price));
								printer.text("");
							}
							
							printer.bold(true);
							printer.text("------------------------------");
							if($("#grandTotal").val()!="")
							{
								printer.text("Grand Total : "+numberToRupiah(parseFloat($("#grandTotal").val()))).bold(true);
							}
							if($("#deposit").val()!="")
							{
								printer.text("Deposit : "+numberToRupiah(parseFloat($("#deposit").val()))).bold(true);
							}
							printer.cut()
							.print();
						});
					}
				});

				$("#endTransactionBtn").click(function(){
					saveTransaction();
				});

				$(document).scannerDetection({
					timeBeforeScanTest: 200, // wait for the next character for upto 200ms
					startChar: [120], // Prefix character for the cabled scanner (OPL6845R)
					endChar: [13], // be sure the scan is complete if key 13 (enter) is detected
					avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
					//ignoreIfFocusOn: 'input',
					onComplete: function(barcode, qty){
						getItemScanner(barcode);
					} // main callback function	
				});

				function getItemScanner(barcode)
				{
					$.ajax({
						url: 'getItemByBarcode.php',
						type: 'post',
						data: {barcode:barcode},
						dataType: 'json',
						success: function (data) {
							if(data!="")
							{
								var gotData=false;
								$("#myItem").val(data);
								$("#myItem").change();
								$("#myQty").val(1);
								$("#addItem").click();
							}
						}
					});
                }
                
                $("#historyBtn").click(function(){
                    getInvoiceHistory();
                });

                $("#invoice").change(function(){
                    var name=$("#invoice :selected").text();
                    getDespositHistory();
                    if($(this).val()!="")
                    {
                        $("#name").attr('readonly',true);
                        $("#name").val(name);
                    }
                    else
                    {
                        $("#name").attr('readonly',false);
                        $("#name").val("");
                    }
                });
			});
		</script>
	</body>
</html>