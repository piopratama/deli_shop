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
    $nm_transaksi=$_POST['customer'];
	require 'koneksi.php';
    $sql = "SELECT invoice, nm_transaksi, tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_barang WHERE id=id_item )AS item, qty, total_price, statuss, method FROM tb_transaksi WHERE statuss=".$status." and nm_transaksi<>'' and Date(tnggl)>='".$startDate."' and Date(tnggl)<='".$stopDate."' and nm_transaksi='".$nm_transaksi."';";
    //$sql = "SELECT invoice, nm_transaksi FROM tb_transaksi WHERE statuss=".$status." and nm_transaksi<>'' and Date(tnggl)>='".$startDate."' and Date(tnggl)<='".$stopDate."' and nm_transaksi='".$nm_transaksi."';";

    $result = $conn->query($sql);

    $data=array();
    if ($result->num_rows > 0) {
        $i=0;

        $html="<option value=''>-- Select Customer --</option>";
        while($row = $result->fetch_assoc()){
            $data[$i]["no"]=($i+1);
            $data[$i]["invoice"]=$row["invoice"];
            $data[$i]["nm_transaksi"]=$row["nm_transaksi"];
            $data[$i]["tnggl"]=$row["tnggl"];
            $data[$i]["nama_pegawai"]=$row["nama_pegawai"];
            $data[$i]["item"]=$row["item"];
            $data[$i]["qty"]=$row["qty"];
            $data[$i]["total_price"]=$row["total_price"];
            $data[$i]["method"]=$row["method"];
            if($row["statuss"]==1)
            {
                $data[$i]["status"]="paid";
            }
            else if($row["statuss"]==0){
                $data[$i]["status"]="not paid";
            }
        }
        echo json_encode($data);
    }
    else
    {
        echo json_encode($data);
    }

?>