<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Data Arsip</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Arsip</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="panel panel">
    <?php 
    $id = $_GET['id']; 
    if (!is_numeric($id)){
        echo "Yah.. Di Patch...<br>
     Gak Jadi Ngehack + Mirror Deh,, Muehehehe...
     <br>
     Program BugBounty :<br>
     /security<br>
     
     (Kalo Kamu Menemukan Bug/Celah Yang Dapat Berdampak Buruk Bagi System Kami,, Silahkan DiLaporkan Kepada Tim-IT Kami Ya.. Karena Kami Selalu Mengadakan Program BugBounty Hehehe :D )<br>
     
     Terimakasih Sebelumnya Yaa...
     <br>
     # ITsecurity - BL4CK.4TX ";
        exit;
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
    $arsipid = query("SELECT * from tb_npwp where npwp_id='$id'")[0];
    $data = mysqli_query($koneksi, "SELECT * from tb_npwp where npwp_id='$id'");
    while($d = mysqli_fetch_array($data)){
    ?>
        <div class="panel-heading">
            <h3 class="panel-title">Data Arsip <br>Kode : <?php echo $d['no_npwp']; ?><br> Nama : <?php echo $d['nama']; ?></h3>
        </div>
    <?php 
    }
    ?>
        <div class="panel-body">


            <div class="pull-right">            
                        <a href="arsip2.php" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <br>
            <br>
            <br>

            <center>
                <?php 
                if(isset($_GET['alert'])){
                    if($_GET['alert'] == "gagal"){
                        ?>
                        <div class="alert alert-danger">File arsip gagal diupload. krena demi keamanan file .php tidak diperbolehkan.</div>
                        <?php
                    }else{
                        ?>
                        <div class="alert alert-success">Arsip berhasil tersimpan.</div>
                        <?php
                    }
                }
                ?>
            </center>
            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Waktu Upload</th>
                        <th>Nama file</th>  
                        <th class="text-center" width="20%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    $no = 1;   
                    $saya = $_GET['id'];
                    if (!is_numeric($id)){
                        echo "Yah.. Di Patch...<br>
                     Gak Jadi Ngehack + Mirror Deh,, Muehehehe...
                     <br>
                     Program BugBounty :<br>
                     /security<br>
                     
                     (Kalo Kamu Menemukan Bug/Celah Yang Dapat Berdampak Buruk Bagi System Kami,, Silahkan DiLaporkan Kepada Tim-IT Kami Ya.. Karena Kami Selalu Mengadakan Program BugBounty Hehehe :D )<br>
                     
                     Terimakasih Sebelumnya Yaa...
                     <br>
                     # ITsecurity - BL4CK.4TX ";
                        exit;
                     }   
                    $arsip2 = $arsipid['npwp_id'];    
                    $data2 = mysqli_query($koneksi, "SELECT * from arsip_npwp,tb_npwp where id_npwp='$saya' and id_npwp=npwp_id");
                    while($d = mysqli_fetch_array($data2)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo date('H:i:s  d-m-Y',strtotime($d['arsipp_waktu_upload'])) ?></td>
                            <td>
                                 <?php echo $d['file_arsip'] ?><br>

                            </td> 
                            <td class="text-center">
                            
                                <div class="modal fade" id="exampleModal_<?php echo $d['arsipp_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">PERINGATAN!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini? <br>file dan semua yang berhubungan akan dihapus secara permanen.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                <a href="arsip2_deletefile.php?id=<?php echo $d['arsipp_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp; Ya, hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="btn-group">
                                    <!-- <a target="_blank" class="btn btn-default" href="../arsip/<?php echo $d['arsip_file']; ?>"><i class="fa fa-download"></i></a> -->
                                    <a target="_blank" class="btn btn-default" href="arsip_download2.php?id=<?php echo $d['arsipp_id']; ?>"><i class="fa fa-download"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                </tbody>
            </table>


        </div>

    </div>
</div>


<?php include 'footer.php'; ?>