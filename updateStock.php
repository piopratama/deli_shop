<?php 
session_start();
date_default_timezone_set('Asia/Singapore');
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

include 'koneksi.php';
$id=$_POST['id'];
$category=$_POST['category'];
$name=addslashes($_POST['name']);
$price=$_POST['price'];
$stock=$_POST['stock'];
$unit=$_POST['unit'];
$supplier=$_POST['supplier'];
$purchase=$_POST['purchase_price'];
$barcode=$_POST['barcode'];
$date=date('Y-m-d H:i:s');

$check=FALSE;

$conn->autocommit(FALSE);
$conn->query("START TRANSACTION");
$result=mysqli_query($conn, "UPDATE tb_barang SET item='$name', price='$price', stock='$stock', unit='$unit', supplier='$supplier', barcode='$barcode', kategori='$category', `date`='$date', pur_price='$purchase' WHERE id='$id'");
$sql3 = "INSERT INTO tb_stock values('".$data[$i]["tnggl"]."', ".$id.", ".$stock.", 0, ".$stock.", 1)";
if ($conn->query($sql3) === TRUE) {
    $check=TRUE;
} else {
    echo "Error: " . $sql2s . "<br>" . $conn->error;
}
if(!$result || !$check)
{
    $_SESSION["message"]="Transaksi gagal, silahkan ulangi transaksi";
    $conn->rollback();
}
else
{
    $conn->commit();
}

header("location:stock.php");
?>