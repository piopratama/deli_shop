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

include 'koneksi.php';
$id=$_POST['id'];
$date_insert=$_POST['date_insert'];
$kategori=$_POST['catagory'];
$description=$_POST['description'];

mysqli_query($conn, "UPDATE tb_kategori SET date_insert='$date_insert', kategori='$kategori', description='$description' WHERE id='$id';"); 
header("location:kategori.php");
?>