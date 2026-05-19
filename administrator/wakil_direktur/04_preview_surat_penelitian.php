<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'wakil_direktur') {
    header('location:../index.php'); exit;
}

include('../karyawan/fucnt_tgl.php');

$id    = isset($_GET['id_surat_penelitian']) ? (int)$_GET['id_surat_penelitian'] : 0;
$query = mysqli_query($kon, "SELECT * FROM tb_surat_penelitian WHERE id_surat_penelitian='$id'");
$a     = mysqli_fetch_array($query);

if (!$a) { echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>"; exit; }

$tanggal2 = tgl_indo($a['tanggal_cetak']);
$sp       = $a['status_persetujuan'];
$return   = isset($_GET['return']) ? $_GET['return'] : '04_persetujuan_surat_penelitian.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Preview - Surat Penelitian</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body { background: #e8e8e8; font-family: Arial; }
        .toolbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 999;
            background: #2c3e50; padding: 10px 20px;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }
        .toolbar .title { color: #fff; font-size: 14px; font-weight: bold; flex: 1; }
        .surat-wrapper {
            margin: 70px auto 30px auto; max-width: 800px;
            background: #fff; padding: 60px 70px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.2); min-height: 1000px;
        }
        .status-bar {
            margin: 70px auto 0 auto; max-width: 800px;
            padding: 10px 15px; border-radius: 4px 4px 0 0;
            font-size: 13px; font-weight: bold;
        }
        .status-menunggu  { background: #f39c12; color: #fff; }
        .status-disetujui { background: #00a65a; color: #fff; }
        .status-ditolak   { background: #dd4b39; color: #fff; }
        table { font-family: Arial; line-height:200%; font-size:11.0pt; }
        @media print {
            .toolbar, .status-bar { display: none !important; }
            .surat-wrapper { margin: 0; box-shadow: none; padding: 30px; }
            body { background: #fff; }
        }
    </style>
</head>
<body>

<div class="toolbar">
    <span class="title"><i class="fa fa-file-text-o"></i> Preview Surat Penelitian &mdash; <?php echo $a['nama_mahasiswa']; ?></span>
    <?php if ($sp == 'Menunggu'): ?>
        <a href="proses_persetujuan.php?aksi=setujui&jenis=penelitian&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           onclick="return confirm('Setujui surat ini?')" class="btn btn-success btn-sm">
            <i class="fa fa-check"></i> Setujui</a>
        <a href="proses_persetujuan.php?aksi=tolak&jenis=penelitian&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</a>
    <?php elseif ($sp == 'Disetujui'): ?>
        <span class="label label-success" style="font-size:13px;padding:6px 12px;"><i class="fa fa-check"></i> Sudah Disetujui</span>
        <a href="proses_persetujuan.php?aksi=tolak&jenis=penelitian&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           class="btn btn-warning btn-sm"><i class="fa fa-undo"></i> Batalkan</a>
    <?php elseif ($sp == 'Ditolak'): ?>
        <span class="label label-danger" style="font-size:13px;padding:6px 12px;"><i class="fa fa-times"></i> Ditolak</span>
        <a href="proses_persetujuan.php?aksi=setujui&jenis=penelitian&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           onclick="return confirm('Setujui surat ini?')" class="btn btn-success btn-sm">
            <i class="fa fa-check"></i> Setujui</a>
    <?php endif; ?>
    <a href="<?php echo $return; ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>

<div class="status-bar <?php echo 'status-' . strtolower($sp); ?>">
    <?php if ($sp == 'Menunggu'): ?>
        <i class="fa fa-clock-o"></i> Status: Menunggu Persetujuan
    <?php elseif ($sp == 'Disetujui'): ?>
        <i class="fa fa-check-circle"></i> Status: Disetujui &mdash; Tanggal: <?php echo $a['tanggal_persetujuan']; ?>
    <?php elseif ($sp == 'Ditolak'): ?>
        <i class="fa fa-times-circle"></i> Status: Ditolak
        <?php if (!empty($a['catatan_penolakan'])): ?> &mdash; Catatan: <?php echo $a['catatan_penolakan']; ?><?php endif; ?>
    <?php endif; ?>
</div>

<!-- ISI SURAT -->
<div class="surat-wrapper">
    <table border="0" align="center" width="95%" cellpadding="0" style="text-align:justify; line-height:150%;">
        <tr><td colspan="3" align="right"><?php echo $tanggal2; ?></td></tr>
        <tr>
            <td width="25%">Nomor</td><td width="2%">:</td>
            <td>PP. 01.01/F.XXIII.1/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?php echo date('Y'); ?></td>
        </tr>
        <tr><td>Perihal</td><td>:</td><td><b>Izin Penelitian</b></td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td>Yth,</td></tr>
        <tr><td colspan="3"><b><?php echo $a['tujuan']; ?></b></td></tr>
        <tr><td>di</td></tr>
        <tr><td>&nbsp;&nbsp;<b>Tempat</b></td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
    </table>

    <table border="0" align="center" width="95%" cellpadding="0">
        <tr>
            <td colspan="3" style="text-align:justify;">
                &nbsp;&nbsp;&nbsp;Sehubungan penyusunan tugas akhir mahasiswa dalam bentuk <?php echo $a['tugas_akhir']; ?> Progam Studi <?php echo $a['prodi']; ?> Jurusan <?php echo $a['jurusan']; ?> Politeknik Kesehatan Kemenkes Bengkulu Tahun Akademik <?php echo $a['tahun_akademik']; ?>, dengan ini kami mohon Bapak/Ibu dapat memberikan izin pengambilan data untuk penelitian kepada:
            </td>
        </tr>
    </table>

    <table border="0" align="center" width="95%" cellpadding="1">
        <tr><td width="25%">Nama</td><td width="2%">:</td><td><?php echo $a['nama_mahasiswa']; ?></td></tr>
        <tr><td>NIM</td><td>:</td><td><?php echo $a['nim_mahasiswa']; ?></td></tr>
        <tr><td valign="top">Tempat Penelitian</td><td valign="top">:</td><td><?php echo $a['tempat_penelitian']; ?></td></tr>
        <tr><td>Waktu Penelitian</td><td>:</td><td><?php echo $a['lama_penelitian']; ?></td></tr>
        <tr><td valign="top">Judul</td><td valign="top">:</td><td style="text-align:justify;"><?php echo $a['judul_kti']; ?></td></tr>
        <tr><td>No Handphone</td><td>:</td><td><?php echo $a['no_hp']; ?></td></tr>
        <tr>
            <td colspan="3" style="text-align:justify;">
                &nbsp;&nbsp;&nbsp;Demikianlah, atas perhatian dan kesediaan Bapak/Ibu diucapkan terimakasih.
            </td>
        </tr>
    </table>

    <table border="0" align="center" width="95%" cellpadding="0">
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr>
            <td width="40%">&nbsp;</td><td>&nbsp;</td>
            <td style="padding-left:30px;">a.n. Direktur Poltekkes Kemenkes Bengkulu</td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td style="padding-left:30px;">Wakil Direktur I Bidang Akademik</td>
        </tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td style="padding-left:30px;"><b><u>Septiyanti, S.Kep, Ners, M.Pd</u></b></td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td style="padding-left:30px;">NIP. 197409161997032001</td>
        </tr>
    </table>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
