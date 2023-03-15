<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

$password1 = password_hash($password,PASSWORD_DEFAULT);

	$namafile = $_FILES['foto']['name'];
	$ukuranfile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpname = $_FILES['foto']['tmp_name'];

	if ($error === 4) {
		echo "<script>alert('masukan gambar terlebih dahulu')</script>";
		return false;
	}
	$ekstensifileval = ['jpg','jpeg','png'];
	$ekstensifile = explode('.', $namafile);
	$ekstensifile = strtolower(end($ekstensifile));


	if (!in_array($ekstensifile, $ekstensifileval)){
		echo "<script> 
  			   alert('file yang anda bukan gambar!');
  		      </script>";
  		      return false;
}
move_uploaded_file($tmpname, '../gambar/petugas/'.$namafile);
$tambah = mysqli_query($koneksi, "insert into petugas values (NULL,'$nama','$username','$password1','$namafile')");
if ($tambah) {
    header("location:petugas.php");
}
