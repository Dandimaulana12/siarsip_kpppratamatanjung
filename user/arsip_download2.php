<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$waktu = date('Y-m-d H:i:s'); 
$user = $_SESSION['id'];
$arsip = $_GET['id'];

function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row ;
	}
	return $rows;
}
$data = query("select * from arsip_npwp where arsipp_id=$arsip")[0];
$readidnpwp = $data['id_npwp'];
$data2 = query("select * from tb_npwp where npwp_id=$readidnpwp")[0];
$readnonpwp = $data2['no_npwp'];
mysqli_query($koneksi, "insert into riwayat values (NULL,'$waktu','$user','$arsip')")or die(mysqli_error($koneksi));

$data = mysqli_query($koneksi,"select * from arsip_npwp where arsipp_id='$arsip'");
$d = mysqli_fetch_assoc($data);
$pp = header("location:../arsip/$readnonpwp/".$d['file_arsip']);

