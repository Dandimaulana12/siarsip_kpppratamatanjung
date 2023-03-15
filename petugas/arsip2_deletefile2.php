<?php 
include '../koneksi.php';
$id = $_GET['id'];

function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row ;
    }
    return $rows;
}


$arsip = query("SELECT * from tb_npwp,arsip_npwp where arsipp_id='$id'")[0];
$readidnpwp = $arsip['id_npwp'];
$npwpfile = query("SELECT * from tb_npwp,arsip_npwp where arsipp_id='$id' and npwp_id='$readidnpwp'")[0];
$readnamafile = $npwpfile['file_arsip'];
$kode = $npwpfile['no_npwp'];
$delete = mysqli_query($koneksi, "DELETE from tb_npwp where npwp_id='$id'");

echo $cfile;
if ($delete) {
    $cfile = unlink("../arsip/$kode");
    header("location:arsip2.php");
}


?>