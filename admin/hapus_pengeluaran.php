<?php 
include 'config.php';
$id=$_GET['id'];
mysqli_query($koneksi,"DELETE from pengeluaran where id ='$id'");
header("location:pengeluaran.php");

 ?>