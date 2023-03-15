<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row ;
	}
	return $rows;
}
$datapw = query("select * from user where user_username='$username'")[0];
$readpw =  $datapw['user_password'];
$login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='$username'");
$cek = mysqli_num_rows($login);


if($cek > 0){
	 
	if (password_verify($password, $readpw)) {
	session_start();
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['user_id'];
	$_SESSION['nama'] = $data['user_nama'];
	$_SESSION['username'] = $data['user_username'];
	$_SESSION['status'] = "user_login";

	header("location:user/");
	}else{
		header("location:user_login.php?alert=gagal");
	}		
}else{
	header("location:user_login.php?alert=gagal");
}

