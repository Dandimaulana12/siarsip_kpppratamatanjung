<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$waktu = date('Y-m-d H:i:s'); 
$petugas = $_SESSION['id'];
$no_arsip = $_POST['no_arsip'];
$rand = rand();

$filename = $_FILES['file']['name'];
$ukuranfile = $_FILES['file']['size'];
$error = $_FILES['file']['error'];
$tmpname = $_FILES['file']['tmp_name'];
$jenis = pathinfo($filename, PATHINFO_EXTENSION);



if ($error === 4) {
	echo "<script>alert('masukan gambar terlebih dahulu')</script>";
	return false;
}
$ekstensifileval = ['pdf'];
$ekstensifile = explode('.', $filename);
$ekstensifile = strtolower(end($ekstensifile));


if (!in_array($ekstensifile, $ekstensifileval)){
	echo "<script> 
			 alert('file yang anda bukan gambar!');
		   document.location.href='arsip2_tambah.php';
			</script>";
			return false;
}
if ($ukuranfile > 25000000) {
echo "<script> 
		 alert('file terlalu besar');
		 document.location.href='arsip2_tambah.php';
		</script>";
		return false;
}

function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row ;
	}
	return $rows;
}
$data = query("select * from tb_npwp where npwp_id=$no_arsip")[0];

if($jenis == "php") {
	header("location:arsip2.php?alert=gagal");
}else{
	move_uploaded_file($_FILES['file']['tmp_name'], '../arsip/'.$data['no_npwp'].'/'.$rand.'_'.$filename);
	$nama_file = $rand.'_'.$filename;
	mysqli_query($koneksi, "insert into arsip_npwp values (NULL,'$waktu','$petugas','$no_arsip','$jenis','$nama_file')")or die(mysqli_error($koneksi));
	header("location:arsip2.php?alert=sukses");
}
