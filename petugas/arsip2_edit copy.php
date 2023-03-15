<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Edit Arsip</h4>
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


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Edit Arsip</h3>
                </div>
                <div class="panel-body">

                    <div class="pull-right">            
                        <a href="arsip2.php" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>

                    <br>
                    <br>


                    <?php 
                    $id = $_GET['id'];              
                    $data = mysqli_query($koneksi, "SELECT * from tb_npwp where npwp_id='$id'");
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
                    while($d = mysqli_fetch_array($data)){
                        ?>
                        <form method="post" action="arsip2_update.php" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Kode Arsip</label>
                                  <input type="hidden" name="id" value="<?php echo $d['npwp_id']; ?>">
                                <input type="text" class="form-control" name="kode" required="required" value="<?php echo $d['no_npwp']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Nama Arsip</label>
                                <input type="text" class="form-control" name="nama" required="required" value="<?php echo $d['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label></label>
                                <input type="submit" class="btn btn-primary" value="Upload">
                            </div>
                            <?php 
                    }
                    ?>
                    <?php   
                    $no = 1;    
                    $arsip2 = $arsipid['npwp_id'];    
                    $data2 = mysqli_query($koneksi, "SELECT * from arsip_npwp where id_npwp='$arsip2'");
                    while($d = mysqli_fetch_array($data2)){
                        ?>
                        
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
                        <div class="modal fade" id="exampleModal2_<?php echo $d['arsipp_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">PERINGATAN!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini? <br>file dan semua yang berhubungan akan diganti secara permanen.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                <a href="arsip2_ubahfile.php?id2=<?php echo $d['arsipp_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp; Ya, hapus</a>
                                            </div>
                                        </div>
                                    </div>
                        </div>
         
                            <div class="form-group">
                            <br>
                            
                                <label>File</label>
                                
                                <input type="hidden" name="id2" value="<?php echo $d['arsipp_id']; ?>">
                                <input type="file" name="files">
                                <small><?php echo $d['file_arsip']; ?></small>
                                <br>
                                <small>Kosongkan jika tidak ingin mengubah file</small>
                            </div>
                            <div class="form-group">
                                <label></label>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2_<?php echo $d['arsipp_id']; ?>">
                                Ubah
                                    </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?php echo $d['arsipp_id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                            </div>
                                
                        </form>
                        <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>


<?php include 'footer.php'; ?>