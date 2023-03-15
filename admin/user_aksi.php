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
			   document.location.href='user_tambah.php';
  		      </script>";
  		      return false;
}
if ($ukuranfile > 10000000) {
	echo "<script> 
			 alert('file terlalu besar');
			 document.location.href='user_tambah.php';
			</script>";
			return false;
}

move_uploaded_file($tmpname, '../gambar/user/'.$namafile);
$tambah = mysqli_query($koneksi, "insert into user values (NULL,'$nama','$username','$password1','$namafile')");
if ($tambah) {
    header("location:user.php");
}
