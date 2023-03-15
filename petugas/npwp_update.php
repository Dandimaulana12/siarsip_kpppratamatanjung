<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

// $waktu = date('Y-m-d H:i:s'); 
// $petugas = $_SESSION['id'];
$id  = $_POST['id'];
$kode  = $_POST['kode'];
$nama  = $_POST['nama'];

function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row ;
	}
	return $rows;
}
$data = query("select * from tb_npwp where npwp_id=$id")[0];

$readdata = $data['no_npwp'];
	$data = mysqli_query($koneksi, "update tb_npwp set no_npwp='$kode', nama='$nama' where npwp_id='$id'")or die(mysqli_error($koneksi));
    if($data){
        $cfile = rename("../arsip/$readdata", "../arsip/$kode");
        echo "<script> 
        alert('data berhasil diubah');
        document.location.href='npwp.php';
         </script>";
} else{
    echo "data gagal ditambahkan";
  }


