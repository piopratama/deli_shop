<?php
session_start();
if(empty($_SESSION['username'])){
	header("location:index.php");
}

$id=$_POST["id_delete"];

include 'koneksi.php';

$conn->autocommit(FALSE);
$conn->query("START TRANSACTION");

//BEFORE DELETE
$transaction = mysqli_query($conn, "SELECT tt.invoice, tt.id_item, tt.qty, tt.statuss
FROM tb_transaksi tt INNER JOIN tb_barang tb ON tt.id_item=tb.id
INNER JOIN tb_employee te ON tt.id_employee=te.id where tt.id=".$id.";");

$sql="DELETE FROM tb_transaksi WHERE id = $id";

$valid=true;
$directPay=0;
$invoice='';
$status=0;

if ($conn->query($sql) === TRUE) {
    foreach ($transaction as $data)
    {
        $sql2 = "UPDATE tb_barang SET stock = stock + ".$data["qty"]." where id =".$data["id_item"]."";
        if ($conn->query($sql2) === FALSE)
        {
            $_SESSION['message']="Delete Failed".$conn->error;
            $valid=false;
            break;
        }
        $status=$status+$data["statuss"];
        $invoice=$data["invoice"];
    }

    if($valid)
    {
        //AFTER DELETE
        $transaction2 = mysqli_query($conn, "SELECT tt.invoice, tt.id_item, tt.qty, tt.total_price
        FROM tb_transaksi tt INNER JOIN tb_barang tb ON tt.id_item=tb.id
        INNER JOIN tb_employee te ON tt.id_employee=te.id where tt.invoice='".$invoice."';");

        if(mysqli_num_rows($transaction2)>0)
        {
            foreach ($transaction2 as $data2)
            {
                $directPay=$directPay+$data2["total_price"];
            }

            if($status==1)
            {
                $sql3 = "UPDATE tb_deposit SET payment = ".$directPay." where invoice ='".$invoice."';";
                if ($conn->query($sql3) === FALSE)
                {
                    $_SESSION['message']="Delete Failed".$conn->error;
                    $valid=false;
                }
            }
        }
        else
        {
            $sql4 = "DELETE FROM tb_deposit where invoice ='".$invoice."';";
            if ($conn->query($sql4) === FALSE)
            {
                $_SESSION['message']="Delete Failed".$conn->error;
                $valid=false;
            }
        }
    }

} else {
    $valid=false;
    $_SESSION['message']="Delete Failed".$conn->error;
}

if($valid)
{
    $_SESSION['message']="Delete Successfully";
    $conn->commit();
}
else
{
    $conn->rollback();
}
$conn->close();
header("location:superAdmin.php");
?>