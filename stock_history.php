<!DOCTYPE html>
<html>
<?php
session_start();

$title="Stock History";

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
$myItem="";
if(isset($_POST['itemFilter']))
{
    if($_POST['itemFilter']=="0")
    {
        $history = mysqli_query($conn, "SELECT TS.date, TB.item, TS.stock_awal, TS.qty, TS.stock_akhir, TS.status, TS.username, TB.unit from tb_stock TS inner join tb_barang TB on TS.item=TB.id order by TS.date asc");
    }
    else
    {
        $myItem=$_POST['itemFilter'];
        $history = mysqli_query($conn, "SELECT TS.date, TB.item, TS.stock_awal, TS.qty, TS.stock_akhir, TS.status, TS.username, TB.unit from tb_stock TS inner join tb_barang TB on TS.item=TB.id where TB.id=".$myItem." order by TS.date asc");
    }
}
else
{
    $history = mysqli_query($conn, "SELECT TS.date, TB.item, TS.stock_awal, TS.qty, TS.stock_akhir, TS.status, TS.username, TB.unit from tb_stock TS inner join tb_barang TB on TS.item=TB.id order by TS.date asc");
}

$barang = mysqli_query($conn, "SELECT * from tb_barang");

?>
    <?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/stockStyle.css">
	<body>
        <div class="container-fluid" style="">
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
                    
                            <!-- Collect the nav links, forms, and other content for toggling -->
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
                <div class="col-md-12" id="mytable">
                <a href="administrator.php" style="margin:0 5px 10px 0" type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" ></a>
                    <form action="" method="POSt" style="margin-bottom:20px;">
                        <div class="form-group">
                          <label for="">Select Item</label>
                          <select name="itemFilter" id="itemFilter" class="form-control" style="width:300px;">
                            <option value="0">-- Select All --</option>
                            <?php
                                while($row = $barang->fetch_assoc())
                                {
                                    if($myItem==$row['id'])
                                    {
                            ?>
                                        <option value="<?php echo $row['id'] ?>" selected="selected"><?php echo $row['item']; ?></option>
                            <?php
                                    }
                                    else
                                    {
                            ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['item']; ?></option>
                            <?php
                                    }
                                }
                            ?>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                <table id="example" class="table table-bordered" style="width: 100%;">
                    <h1>STOCK HISTORY</h1>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Item</th>
                            <th>Employee</th>
                            <th>Stock Awal</th>
                            <th>Qty</th>
                            <th>Stock Akhir</th>
                            <th>Unit</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no=1;
                        foreach ($history as $data) {?>
                        <tr>
                            <td><?php echo $data["date"];?></td>
                            <td><?php echo $data["item"];?></td>
                            <td><?php echo $data["username"];?></td>
                            <td><?php echo $data["stock_awal"];?></td>
                            <td><?php echo $data["qty"];?></td>
                            <td><?php echo $data["stock_akhir"];?></td>
                            <td><?php echo $data["unit"];?></td>
                            <td>
                            <?php 
                            if($data["status"]==0)
                            {
                                echo("Transaksi Direct");
                            }
                            else if($data["status"]==1)
                            {
                                echo("Insert Data");
                            }
                            else if($data["status"]==2)
                            {
                                echo("Update Data");
                            }
                            else
                            {
                                echo("Transaction Undirect");
                            }
                            ?></td>
                        </tr>
                        <?php 
                        $no++; 
                        }
                        ?>							
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="insertSupplier.php" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Supplier</label>
                                <input type="text" name="supplier" class="form-control" placeholder="Supplier" require="required">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Address" require="required">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone" require="required">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </div>
                </form>
            </div>
        </div>
                                    
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="deleteSupplier.php" method="POST">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Delete Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_delete" id="id_delete" class="form-control" placeholder="id" require="required">
                        </div>
                        <p>Are you sure want to delete this data ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>

		<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);
		?>

		<?php include("./templates/footer.php"); ?>

		<script>
			$(document).ready(function() {
				var message='<?php echo $session_value;?>';
				if(message!="")
				{
					alert(message);
				}
				$("#example").DataTable();

                $("#example").on('click','.deleteCategory', function(){
					$("#id_delete").val($(this).attr('id'));
                    $("#exampleModal2").modal('show');
				});

                $("#itemFilter").select2();
			});
		</script>
	</body>
</html>