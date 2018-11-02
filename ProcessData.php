<?php

function select(){
	require 'koneksi.php';
	$data="SELECT * FROM tb_barang";
	$result=$conn->query($data);
}
?>