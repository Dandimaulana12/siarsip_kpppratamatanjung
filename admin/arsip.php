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



    <div class="panel">

        <div class="panel-heading">
            <h3 class="panel-title">Data arsip</h3>
        </div>
        <div class="panel-body">

            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Waktu Upload</th>
                        <th>Arsip</th>
                        <th>Folder</th>
                        <th class="text-center" width="20%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                   $no = 1;
                   function query($query){
                    global $koneksi;
                    $result = mysqli_query($koneksi,$query);
                    $rows = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $rows[] = $row ;
                    }
                    return $rows;
                    }
                    $arsip2 = query("SELECT DISTINCT id_npwp FROM arsip_npwp")[0];
                    echo $arsip2['id_npwp'];
                    $arsip = mysqli_query($koneksi,"SELECT * FROM tb_npwp");
                   while ($p = mysqli_fetch_array($arsip)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo date('H:i:s  d-m-Y',strtotime($p['npwp_waktu_upload'])) ?></td>
                            <td>

                                <b>KODE</b> : <?php echo $p['no_npwp'] ?><br>
                                <b>Nama</b> : <?php echo $p['nama'] ?><br>

                            </td>
                            <td><a href="../arsip/<?php echo $p['no_npwp'] ?>">arsip/<?php echo $p['no_npwp'] ?></a></td>
                         
                            <td class="text-center">
                                <div class="btn-group">     
                                    <a target="" href="arsip_preview2.php?id=<?php echo $p['npwp_id']; ?>" class="btn btn-default">Lihat</a>
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