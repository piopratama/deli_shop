<?php
session_start();
if(isset($_POST["username"]) && isset($_POST["password"]))
{
	require 'koneksi.php';

	$usernamed=$_POST["username"];
	$password=$_POST["password"];
	// $level=$_POST["level"];

	$sql = mysqli_query($conn, "SELECT level FROM tb_employee where username='$usernamed';");
	$no=1;
	foreach($sql as $a){
		$b = $a['level'];
	}
	echo $b;

	  
	if($b=='1'){
		
		$sql = "SELECT id,username FROM tb_employee WHERE username = '$usernamed' AND `password`=MD5('".$password."');";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
	        $_SESSION["username"]=$usernamed;
	        $_SESSION["id_kasir"]=$row["id"];
			}
			$sql1 = mysqli_query($conn, "update tb_employee set online_status='1' where username='$usernamed'");
			header("location:administrator.php");
			}else{
			$_SESSION["message"]="Login Failed";
			header("location:index.php");
			}
	}
	elseif ($b=='0'){
		
		$sql = "SELECT id,username FROM tb_employee WHERE username = '$usernamed' AND `password`=MD5('".$password."');";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$_SESSION["username"]=$usernamed;
	        	$_SESSION["id_kasir"]=$row["id"];
			}
			$sql1 = mysqli_query($conn, "update tb_employee set online_status='1' where username='$usernamed'");
			header("location:mainMenu.php");
		}else{
			$_SESSION["message"]="Login Failed";
			header("location:index.php");
		}
	}
	
	$conn->close();

}
else
{
	$_SESSION["message"]="Login Failed";
	header("location:index.php");
}
?>