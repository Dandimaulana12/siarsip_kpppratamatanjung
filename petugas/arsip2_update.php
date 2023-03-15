<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

// $waktu = date('Y-m-d H:i:s'); 
// $petugas = $_SESSION['id'];
$id  = $_POST['id'];
$id2  = $_POST['id2'];

$rand = rand();

var_dump($_FILES);
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row ;
    }
    return $rows;
}
$arsip = query("SELECT * from arsip_npwp where id_npwp='$id'")[0];
$readidnpwp = $arsip['id_npwp'];


if($filename == ""){
	mysqli_query($koneksi, "UPDATE arsip_npwp set id_npwp='$readidnpwp' where arsipp_id='$id'")or die(mysqli_error($koneksi));
	header("location:arsip2.php");
}else{

	$jenis = pathinfo($filename, PATHINFO_EXTENSION);

	if($jenis == "php") {
		header("location:arsip2.php?alert=gagal");
	}else{

		// hapus file lama
		$lama = mysqli_query($koneksi,"SELECT * from arsip_npwp where arsipp_id='$id2'");
		$l = mysqli_fetch_assoc($lama);
		$nama_file_lama = $l['arsip_file'];
		unlink("../arsip/".$nama_file_lama);

		// upload file baru
		move_uploaded_file($_FILES['file']['tmp_name'], '../arsip/'.$rand.'_'.$filename);
		$nama_file = $rand.'_'.$filename;
		mysqli_query($koneksi, "UPDATE arsip_npwp set id_npwp='$readidnpwp', jenis_arsip ='$jenis', file_arsip='$nama_file' where arsipp_id='$id2'")or die(mysqli_error($koneksi));
		header("location:arsip2.php?alert=sukses");
	}
}

