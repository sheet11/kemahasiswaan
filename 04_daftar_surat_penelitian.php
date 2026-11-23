<?php 
include "01_nav.php";
include "config/class_paging.php";
include "config/koneksi.php";

$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);
$nim    = $_SESSION['nim'];
?>

<style>
    /* ===== Responsive styling tambahan (tidak mengubah logika PHP) ===== */
    .header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 12px;
    }

    .header-bar h4 {
        margin: 0;
        font-weight: 700;
    }

    .table-responsive-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-responsive-wrap table {
        margin-bottom: 0;
    }

    .table-responsive-wrap th,
    .table-responsive-wrap td {
        white-space: nowrap;
        vertical-align: middle !important;
    }

    .table-responsive-wrap td.col-nama,
    .table-responsive-wrap td.col-judul,
    .table-responsive-wrap td.col-tujuan {
        white-space: normal;
        min-width: 140px;
    }

    .table-responsive-wrap td.col-status {
        white-space: normal;
        min-width: 190px;
    }

    .status-note {
        display: block;
        margin-top: 4px;
    }

    .btn-aksi {
        white-space: nowrap;
    }

    .paginationw {
        margin-top: 15px;
        text-align: center;
    }

    .paginationw ul.pagination {
        margin: 0;
        flex-wrap: wrap;
    }

    /* ===== Tampilan khusus HP ===== */
    @media (max-width: 767px) {
        .header-bar h4 {
            font-size: 16px;
        }

        .table-responsive-wrap th,
        .table-responsive-wrap td {
            font-size: 12px;
            padding: 6px 8px;
        }

        .btn-aksi {
            font-size: 11px;
            padding: 5px 8px;
        }

        .label {
            font-size: 10px;
        }
    }
</style>

<aside class="right-side">
<section class="content-header">
<div class="container-fluid" style="margin:10px;">

    <div class="header-bar">
        <h4>Surat Izin Penelitian</h4>
        <a href="04_tambah_surat_penelitian.php" class="btn btn-info">
            <i class="fa fa-plus"></i> Tambah Surat
        </a>
    </div>

    <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'revisi_terkirim'): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-check"></i> <strong>Berhasil!</strong> Surat telah diperbarui dan dikirim ulang ke resepsionis untuk direview.
        </div>
    <?php endif; ?>

    <div class="table-responsive-wrap">
        <table class="table table-bordered">
            <thead>
                <tr class="info">
                    <th>No.</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Judul</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th width="8%">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $query = mysqli_query($kon,
                "SELECT * FROM tb_surat_penelitian
                 WHERE nim_mahasiswa='$nim'
                 ORDER BY id_surat_penelitian DESC
                 LIMIT $posisi, $batas"
            );

            $i = $posisi + 1;

            while ($a = mysqli_fetch_array($query)):
                $sp      = $a['status_persetujuan'];
                $st      = $a['status'];
                $catatan = !empty($a['catatan_penolakan']) ? htmlspecialchars($a['catatan_penolakan']) : '';
                $id      = $a['id_surat_penelitian'];
                $hal     = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td class="col-nama"><?php echo htmlspecialchars($a['nama_mahasiswa']); ?></td>
                <td><?php echo htmlspecialchars($a['nim_mahasiswa']); ?></td>
                <td><?php echo htmlspecialchars($a['prodi']); ?></td>
                <td class="col-judul"><?php echo htmlspecialchars($a['judul_kti']); ?></td>
                <td class="col-tujuan"><?php echo htmlspecialchars($a['tujuan']); ?></td>

                <!-- Kolom Status -->
                <td class="col-status">
                <?php if ($sp == 'Perlu_Revisi'): ?>
                    <span class="label label-warning" style="font-size:12px;">
                        <i class="fa fa-edit"></i> Perlu Revisi
                    </span>
                    <?php if ($catatan): ?>
                    <small class="status-note" style="color:#d68910;">
                        <i class="fa fa-comment-o"></i>
                        <i><?php echo $catatan; ?></i>
                    </small>
                    <?php endif; ?>

                <?php elseif ($sp == 'Telah_Direvisi'): ?>
                    <span class="label label-info" style="font-size:12px;">
                        <i class="fa fa-refresh"></i> Telah Direvisi
                    </span>
                    <small class="status-note text-muted">Menunggu review resepsionis</small>

                <?php elseif ($sp == 'Disetujui_Resepsionis'): ?>
                    <span class="label label-info" style="font-size:12px;">
                        <i class="fa fa-arrow-up"></i> Sedang Diproses Wadir
                    </span>

                <?php elseif ($sp == 'Disetujui'): ?>
                    <span class="label label-success" style="font-size:12px;">
                        <i class="fa fa-check-circle"></i> Disetujui
                    </span>
                    <?php if ($st == 'Sudah Dicetak'): ?>
                    <small class="status-note text-success">
                        <i class="fa fa-print"></i> Sudah Dicetak — silakan ambil di resepsionis
                    </small>
                    <?php else: ?>
                    <small class="status-note text-muted">Menunggu dicetak oleh resepsionis</small>
                    <?php endif; ?>

                <?php elseif ($sp == 'Ditolak_Wadir'): ?>
                    <span class="label label-danger" style="font-size:12px;">
                        <i class="fa fa-times-circle"></i> Ditolak Wadir
                    </span>
                    <?php if ($catatan): ?>
                    <small class="status-note" style="color:#dd4b39;">
                        <i class="fa fa-comment-o"></i>
                        <i><?php echo $catatan; ?></i>
                    </small>
                    <?php endif; ?>
                    <small class="status-note text-danger">Silakan ajukan surat baru.</small>

                <?php else: // Menunggu ?>
                    <span class="label label-default" style="font-size:12px;">
                        <i class="fa fa-clock-o"></i> Menunggu Review
                    </span>
                <?php endif; ?>
                </td>

                <!-- Kolom Aksi -->
                <td>
                <?php if ($sp == 'Menunggu' || $sp == 'Perlu_Revisi' || $sp == 'Telah_Direvisi'): ?>
                    <a href="04_edit_surat_penelitian.php?id_surat_penelitian=<?php echo $id; ?>&halaman=<?php echo $hal; ?>"
                       class="btn btn-info btn-xs btn-aksi" title="Edit Surat">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                <?php elseif ($sp == 'Disetujui' && $st == 'Sudah Dicetak'): ?>
                    <span class="text-success" style="font-size:11px;">
                        <i class="fa fa-check-circle"></i> Selesai
                    </span>

                <?php else: ?>
                    <span class="text-muted" style="font-size:11px;">-</span>
                <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php
    $jmldata     = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM tb_surat_penelitian WHERE nim_mahasiswa='$nim'"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman(isset($_GET['halaman']) ? $_GET['halaman'] : 1, $jmlhalaman);
    echo "<div class='paginationw'>$linkHalaman</div>";
    ?>

</div>
</section>
</aside>