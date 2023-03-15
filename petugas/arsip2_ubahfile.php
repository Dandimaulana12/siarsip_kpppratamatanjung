<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

// $waktu = date('Y-m-d H:i:s'); 
// $petugas = $_SESSION['id'];
$id  = $_GET['id2'];

$rand = rand();

// $filename = $_FILES['files']['name'];
var_dump($_FILES);
// function query($query){
//     global $koneksi;
//     $result = mysqli_query($koneksi,$query);
//     $rows = [];
//     while ($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row ;
//     }
//     return $rows;
// }


// $arsip = query("SELECT * from tb_npwp,arsip_npwp where arsipp_id='$id'")[0];
// $readidnpwp = $arsip['id_npwp'];

// if($filename == $id){

// 	mysqli_query($koneksi, "update arsip_npwp set id_npwp='$readidnpwp' where arsipp_id='$id'")or die(mysqli_error($koneksi));
// 	header("location:arsip2.php");

// }else{

// 	$jenis = pathinfo($filename, PATHINFO_EXTENSION);

// 	if($jenis == "php") {
// 		header("location:arsip2.php?alert=gagal");
// 	}else{

// 		// hapus file lama
// 		$lama = mysqli_query($koneksi,"select * from arsip_npwp where arsipp_id='$id'");
// 		$l = mysqli_fetch_assoc($lama);
// 		$nama_file_lama = $l['file_arsip'];
// 		unlink("../arsip/".$nama_file_lama);

// 		// upload file baru
// 		move_uploaded_file($_FILES['file']['tmp_name'], '../arsip/'.$rand.'_'.$filename);
// 		$nama_file = $rand.'_'.$filename;
// 		mysqli_query($koneksi, "update arsip_npwp set jenis_arsip='$jenis',file_arsip='$nama_file' where arsipp_id='$id'")or die(mysqli_error($koneksi));
// 		header("location:arsip2.php?alert=sukses");
// 	}
// }

