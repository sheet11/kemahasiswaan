<?php
include "01_nav.php";
?>

<aside class="right-side">
    <section class="content-header">
        <h1>Dashboard <small>Wakil Direktur / Kasubak ADAK</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <!-- Surat Keterangan Lulus -->
            <!-- <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php
                            require_once("../config/koneksi.php");
                            $q = mysqli_query($kon,"SELECT * FROM tb_surat_keterangan_lulus WHERE status_persetujuan='Menunggu'");
                            echo mysqli_num_rows($q);
                        ?></h3>
                        <p>Menunggu Persetujuan<br><small>Ket. Lulus</small></p>
                    </div>
                    <div class="icon"><i class="ion ion-clock"></i></div>
                    <a href="02_persetujuan_surat_keterangan_lulus.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> -->

            <!-- Surat Masih Kuliah -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php
                            $q = mysqli_query($kon,"SELECT * FROM tb_surat_keterangan_masih_kuliah WHERE status_persetujuan='Menunggu'");
                            echo mysqli_num_rows($q);
                        ?></h3>
                        <p>Menunggu Persetujuan<br><small>Masih Kuliah</small></p>
                    </div>
                    <div class="icon"><i class="ion ion-clock"></i></div>
                    <a href="03_persetujuan_surat_keterangan_masih_kuliah.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Surat Pra Penelitian -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php
                            $q = mysqli_query($kon,"SELECT * FROM tb_surat_pra_penelitian WHERE status_persetujuan='Menunggu'");
                            echo mysqli_num_rows($q);
                        ?></h3>
                        <p>Menunggu Persetujuan<br><small>Pra Penelitian</small></p>
                    </div>
                    <div class="icon"><i class="ion ion-clock"></i></div>
                    <a href="05_persetujuan_surat_pra_penelitian.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Surat Penelitian -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php
                            $q = mysqli_query($kon,"SELECT * FROM tb_surat_penelitian WHERE status_persetujuan='Menunggu'");
                            echo mysqli_num_rows($q);
                        ?></h3>
                        <p>Menunggu Persetujuan<br><small>Penelitian</small></p>
                    </div>
                    <div class="icon"><i class="ion ion-clock"></i></div>
                    <a href="04_persetujuan_surat_penelitian.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div><!-- /.row -->

        <!-- Rekapitulasi -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-bar-chart"></i> Rekapitulasi Persetujuan</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="info">
                                    <th>Jenis Surat</th>
                                    <th class="text-center"><span class="label label-warning">Menunggu</span></th>
                                    <th class="text-center"><span class="label label-success">Disetujui</span></th>
                                    <th class="text-center"><span class="label label-danger">Ditolak</span></th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $surat_list = [
                                    // ['label' => 'Surat Keterangan Lulus',        'tabel' => 'tb_surat_keterangan_lulus'],
                                    ['label' => 'Surat Keterangan Masih Kuliah', 'tabel' => 'tb_surat_keterangan_masih_kuliah'],
                                    ['label' => 'Surat Pra Penelitian',          'tabel' => 'tb_surat_pra_penelitian'],
                                    ['label' => 'Surat Penelitian',              'tabel' => 'tb_surat_penelitian'],
                                ];
                                foreach ($surat_list as $s) {
                                    $menunggu  = mysqli_num_rows(mysqli_query($kon,"SELECT * FROM {$s['tabel']} WHERE status_persetujuan='Menunggu'"));
                                    $disetujui = mysqli_num_rows(mysqli_query($kon,"SELECT * FROM {$s['tabel']} WHERE status_persetujuan='Disetujui'"));
                                    $ditolak   = mysqli_num_rows(mysqli_query($kon,"SELECT * FROM {$s['tabel']} WHERE status_persetujuan='Ditolak'"));
                                    $total     = $menunggu + $disetujui + $ditolak;
                                    echo "<tr>
                                        <td>{$s['label']}</td>
                                        <td class='text-center'><span class='badge' style='background:#f39c12'>$menunggu</span></td>
                                        <td class='text-center'><span class='badge' style='background:#00a65a'>$disetujui</span></td>
                                        <td class='text-center'><span class='badge' style='background:#dd4b39'>$ditolak</span></td>
                                        <td class='text-center'><strong>$total</strong></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</aside>
