<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

// $waktu = date('Y-m-d H:i:s'); 
// $petugas = $_SESSION['id'];
$id  = $_POST['id'];
$id2  = $_POST['id2'];

$rand = rand();

$filename = $_FILES['file']['name'];

function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row ;
    }
    return $rows;
}

if($filename == ""){

	mysqli_query($koneksi, "update arsip_npwp set id_npwp='$id' where arsipp_id='$id2'")or die(mysqli_error($koneksi));
	header("location:arsip2_edit2.php?id=$id");

}else{

	$jenis = pathinfo($filename, PATHINFO_EXTENSION);

	if($jenis == "php") {
		header("location:arsip2_edit2.php?id=$id&&alert=gagal");
	}else{

		// hapus file lama
        
        $arsip = query("SELECT * from tb_npwp,arsip_npwp where arsipp_id='$id2'")[0];
        $readidnpwp = $arsip['id_npwp'];
        $npwpfile = query("SELECT * from tb_npwp,arsip_npwp where arsipp_id='$id2' and npwp_id='$readidnpwp'")[0];
        $readnamafile = $npwpfile['file_arsip'];
        $kode = $npwpfile['no_npwp'];
		$cfile = unlink("../arsip/$kode/".$readnamafile);
		// upload file baru
		move_uploaded_file($_FILES['file']['tmp_name'], '../arsip/'.$kode.'/'.$rand.'_'.$filename);
		$nama_file = $rand.'_'.$filename;
		mysqli_query($koneksi, "update arsip_npwp set id_npwp='$id', jenis_arsip='$jenis', file_arsip='$nama_file' where arsipp_id='$id2'")or die(mysqli_error($koneksi));
		header("location:arsip2_edit2.php?id=$id&&alert=sukses");
	}
}

