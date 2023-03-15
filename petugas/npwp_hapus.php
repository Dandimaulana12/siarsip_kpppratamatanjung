<?php 
include '../koneksi.php';
$id = $_GET['id'];


mysqli_query($koneksi, "delete from tb_npwp where npwp_id='$id'");
header("location:npwp.php");
