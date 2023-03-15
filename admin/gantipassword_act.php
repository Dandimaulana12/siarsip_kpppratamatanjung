<?php 
include '../koneksi.php';
session_start();
$id = $_SESSION['id'];
$password = $_POST['password'];

$password1 = password_hash($password,PASSWORD_DEFAULT);

mysqli_query($koneksi, "UPDATE admin SET admin_password='$password1' WHERE admin_id='$id'")or die(mysqli_errno());

header("location:gantipassword.php?alert=sukses");