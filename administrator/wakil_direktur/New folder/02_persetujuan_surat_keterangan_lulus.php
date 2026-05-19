<?php
include "01_nav.php";
include "../config/koneksi.php";
include "../config/class_paging.php";
error_reporting(0);
?>

<aside class="right-side">
    <section class="content-header">
        <h1>Persetujuan <small>Surat Keterangan Lulus</small></h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Surat Keterangan Lulus</li>
        </ol>
    </section>

    <section class="content">

        <?php if (isset($_GET['pesan'])): ?>
            <?php if ($_GET['pesan'] == 'disetujui'): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-check"></i> <strong>Berhasil!</strong> Surat telah <strong>disetujui</strong>. Resepsionis sudah dapat mencetak surat ini.
                </div>
            <?php elseif ($_GET['pesan'] == 'ditolak'): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-times"></i> <strong>Surat ditolak.</strong> Catatan penolakan telah disimpan.
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Filter Tab -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li <?php echo (!isset($_GET['filter']) || $_GET['filter']=='semua') ? 'class="active"' : ''; ?>>
                    <a href="02_persetujuan_surat_keterangan_lulus.php?filter=semua">Semua</a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Menunggu') ? 'class="active"' : ''; ?>>
                    <a href="02_persetujuan_surat_keterangan_lulus.php?filter=Menunggu">
                        <span class="label label-warning">Menunggu</span>
                    </a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Disetujui') ? 'class="active"' : ''; ?>>
                    <a href="02_persetujuan_surat_keterangan_lulus.php?filter=Disetujui">
                        <span class="label label-success">Disetujui</span>
                    </a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Ditolak') ? 'class="active"' : ''; ?>>
                    <a href="02_persetujuan_surat_keterangan_lulus.php?filter=Ditolak">
                        <span class="label label-danger">Ditolak</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">

                <?php
                $filter = isset($_GET['filter']) && $_GET['filter'] != 'semua' ? $_GET['filter'] : '';
                $where  = $filter ? "WHERE status_persetujuan='$filter'" : '';

                $p      = new Paging;
                $batas  = 15;
                $posisi = $p->cariPosisi($batas);
                $query  = mysqli_query($kon, "SELECT * FROM tb_surat_keterangan_lulus $where ORDER BY id_surat_keterangan_lulus DESC LIMIT $posisi,$batas");
                $i = $posisi + 1;
                ?>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="info">
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Keperluan</th>
                            <th class="text-center">Status Persetujuan</th>
                            <th width="16%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($a = mysqli_fetch_array($query)):
                        $sp = $a['status_persetujuan'];
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $a['nama_mahasiswa']; ?></td>
                            <td><?php echo $a['nim_mahasiswa']; ?></td>
                            <td><?php echo $a['jurusan']; ?></td>
                            <td><?php echo $a['keperluan']; ?></td>
                            <td class="text-center">
                                <?php if ($sp == 'Menunggu'): ?>
                                    <span class="label label-warning"><i class="fa fa-clock-o"></i> Menunggu</span>
                                <?php elseif ($sp == 'Disetujui'): ?>
                                    <span class="label label-success"><i class="fa fa-check"></i> Disetujui</span>
                                <?php elseif ($sp == 'Ditolak'): ?>
                                    <span class="label label-danger"><i class="fa fa-times"></i> Ditolak</span>
                                    <?php if (!empty($a['catatan_penolakan'])): ?>
                                        <br><small class="text-danger"><?php echo $a['catatan_penolakan']; ?></small>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($sp == 'Menunggu'): ?>
                                    <a href="proses_persetujuan.php?aksi=setujui&jenis=ket_lulus&id=<?php echo $a['id_surat_keterangan_lulus']; ?>&return=02_persetujuan_surat_keterangan_lulus.php"
                                       onclick="return confirm('Setujui surat <?php echo addslashes($a['nama_mahasiswa']); ?>?')"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-check"></i> Setujui
                                    </a>
                                    <a href="proses_persetujuan.php?aksi=tolak&jenis=ket_lulus&id=<?php echo $a['id_surat_keterangan_lulus']; ?>&return=02_persetujuan_surat_keterangan_lulus.php"
                                       class="btn btn-danger btn-xs">
                                        <i class="fa fa-times"></i> Tolak
                                    </a>
                                <?php elseif ($sp == 'Disetujui'): ?>
                                    <a href="proses_persetujuan.php?aksi=tolak&jenis=ket_lulus&id=<?php echo $a['id_surat_keterangan_lulus']; ?>&return=02_persetujuan_surat_keterangan_lulus.php"
                                       class="btn btn-warning btn-xs">
                                        <i class="fa fa-undo"></i> Batalkan
                                    </a>
                                <?php elseif ($sp == 'Ditolak'): ?>
                                    <a href="proses_persetujuan.php?aksi=setujui&jenis=ket_lulus&id=<?php echo $a['id_surat_keterangan_lulus']; ?>&return=02_persetujuan_surat_keterangan_lulus.php"
                                       onclick="return confirm('Setujui surat ini?')"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-check"></i> Setujui
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>

                <?php
                $jmldata     = mysqli_num_rows(mysqli_query($kon,"SELECT * FROM tb_surat_keterangan_lulus $where"));
                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                $linkHalaman = $p->navHalaman($_GET['halaman'] ?? 1, $jmlhalaman);
                echo "<div class='paginationw'>$linkHalaman</div>";
                ?>

            </div>
        </div>

    </section>
</aside>
