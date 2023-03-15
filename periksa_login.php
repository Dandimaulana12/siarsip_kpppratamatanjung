<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = md5($_POST['password']);
$akses = $_POST['akses'];

function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row ;
	}
	return $rows;
}
$datapw = query("select * from petugas where petugas_username='$username'")[0];
$readpw =  $datapw['petugas_password'];

if($akses == "admin"){

	$login = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password2'");
	$cek = mysqli_num_rows($login);

	if($cek > 0){
		session_start();
		$data = mysqli_fetch_assoc($login);
		$_SESSION['id'] = $data['admin_id'];
		$_SESSION['nama'] = $data['admin_nama'];
		$_SESSION['username'] = $data['admin_username'];
		$_SESSION['status'] = "admin_login";
		
		header("location:admin/");
	}else{
		header("location:login.php?alert=gagal");
	}

}else{

	$login = mysqli_query($koneksi, "SELECT * FROM petugas WHERE petugas_username='$username'");
	$cek = mysqli_num_rows($login);

	if($cek > 0){
	if (password_verify($password, $readpw)) {
		session_start();
		$data = mysqli_fetch_assoc($login);
		$_SESSION['id'] = $data['petugas_id'];
		$_SESSION['nama'] = $data['petugas_nama'];
		$_SESSION['username'] = $data['petugas_username'];
		$_SESSION['status'] = "petugas_login";
		header("location:petugas/");
	}else{
		header("location:login.php?alert=gagal");
	}	
	}else{
		header("location:login.php?alert=gagal");
	}

}


