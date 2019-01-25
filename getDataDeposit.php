<?php
	session_start();
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
	
    $status=$_POST['status'];
    $startDate=$_POST['dateStart'];
    $stopDate=$_POST['dateStop'];
    //$nm_transaksi=$_POST['customer'];
    require 'koneksi.php';
    //echo json_encode($startDate." ".$stopDate." ".$status);
    if($startDate!="" && $stopDate!="")
    {
        $sql = "SELECT SUM(deposit) AS deposit FROM tb_deposit WHERE invoice 
        IN (SELECT invoice FROM tb_transaksi WHERE tb_transaksi.statuss=0 
        AND DATE(tnggl)>='".$startDate."' AND DATE(tnggl)<='".$stopDate."')";
    }
    else if($startDate=="" && $stopDate!="")
    {
        $sql = "SELECT SUM(deposit) AS deposit FROM tb_deposit WHERE invoice IN (SELECT invoice FROM tb_transaksi WHERE tb_transaksi.statuss=0 AND DATE(tnggl)<='".$stopDate."');";
    }
    else if($startDate!="" && $stopDate=="")
    {
        $sql = "SELECT SUM(deposit) AS deposit FROM tb_deposit WHERE invoice IN (SELECT invoice FROM tb_transaksi WHERE tb_transaksi.statuss=0 AND date(tnggl)>='".$startDate."');";
    }
    else 
    {
        $sql = "SELECT SUM(deposit) AS deposit FROM tb_deposit WHERE invoice IN (SELECT invoice FROM tb_transaksi WHERE tb_transaksi.statuss=0);";
    }
    //echo json_encode($sql);
    
   $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //$html="<option value=''>-- Select Customer --</option>";
        while($row = $result->fetch_assoc()){
            echo $row["deposit"];
        }
    }
    
?>