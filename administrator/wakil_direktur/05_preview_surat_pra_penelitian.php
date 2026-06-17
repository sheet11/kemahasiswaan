<?php
session_start();
include "../config/koneksi.php";
include('../karyawan/fucnt_tgl.php');
error_reporting(0);

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'wakil_direktur') {
    header('location:../index.php'); exit;
}

$id = isset($_GET['id_surat_pra_penelitian']) ? (int)$_GET['id_surat_pra_penelitian'] : 0;
$a  = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM tb_surat_pra_penelitian WHERE id_surat_pra_penelitian='$id'"));
if (!$a) { echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>"; exit; }

$sp       = $a['status_persetujuan'];
$return   = isset($_GET['return']) ? $_GET['return'] : '05_persetujuan_surat_pra_penelitian.php';
$tanggal2 = tgl_indo($a['tanggal_cetak']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Preview - Surat Pra Penelitian</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body { background:#e8e8e8; font-family:Arial; }
        .toolbar {
            position:fixed; top:0; left:0; right:0; z-index:999;
            background:#2c3e50; padding:10px 20px;
            display:flex; align-items:center; gap:10px;
            box-shadow:0 2px 6px rgba(0,0,0,0.3);
        }
        .toolbar .title { color:#fff; font-size:14px; font-weight:bold; flex:1; }
        .status-bar {
            margin:70px auto 0 auto; max-width:800px;
            padding:10px 15px; font-size:13px; font-weight:bold;
        }
        .s-menunggu  { background:#00c0ef; color:#fff; }
        .s-disetujui { background:#00a65a; color:#fff; }
        .s-ditolak   { background:#dd4b39; color:#fff; }
        .surat-wrapper {
            margin:0 auto 30px auto; max-width:800px;
            background:#fff; padding:60px 70px;
            box-shadow:0 2px 15px rgba(0,0,0,0.2); min-height:1000px;
        }
        table { font-family:Arial; line-height:200%; font-size:11.0pt; }
        @media print {
            .toolbar,.status-bar { display:none !important; }
            .surat-wrapper { margin:0; box-shadow:none; padding:30px; }
            body { background:#fff; }
        }
    </style>
</head>
<body>

<div class="toolbar">
    <span class="title">
        <i class="fa fa-file-text-o"></i> Preview Surat Pra Penelitian &mdash; <?php echo $a['nama_mahasiswa']; ?>
    </span>

    <?php if ($sp == 'Disetujui_Resepsionis'): ?>
        <a href="proses_persetujuan.php?aksi=setujui&jenis=pra_penelitian&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           onclick="return confirm('Setujui surat ini?')" class="btn btn-success btn-sm">
            <i class="fa fa-check"></i> Setujui
        </a>
        <a href="proses_persetujuan.php?aksi=tolak&jenis=pra_penelitian&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           class="btn btn-danger btn-sm">
            <i class="fa fa-times"></i> Tolak
        </a>
    <?php elseif ($sp == 'Disetujui'): ?>
        <span class="label label-success" style="font-size:13px;padding:6px 12px;">
            <i class="fa fa-check-circle"></i> Sudah Disetujui
        </span>
    <?php elseif ($sp == 'Ditolak_Wadir'): ?>
        <span class="label label-danger" style="font-size:13px;padding:6px 12px;">
            <i class="fa fa-times-circle"></i> Sudah Ditolak
        </span>
    <?php endif; ?>

    <a href="<?php echo htmlspecialchars($return); ?>" class="btn btn-default btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<?php
$status_map = [
    'Disetujui_Resepsionis' => ['s-menunggu',  '<i class="fa fa-clock-o"></i> Status: Menunggu Persetujuan Wadir — Sudah divalidasi oleh Resepsionis'],
    'Disetujui'             => ['s-disetujui', '<i class="fa fa-check-circle"></i> Status: Disetujui — Tanggal: ' . $a['tanggal_persetujuan']],
    'Ditolak_Wadir'         => ['s-ditolak',   '<i class="fa fa-times-circle"></i> Status: Ditolak Wadir' . (!empty($a['catatan_penolakan']) ? ' — Catatan: ' . htmlspecialchars($a['catatan_penolakan']) : '')],
];
$sl = isset($status_map[$sp]) ? $status_map[$sp] : ['s-menunggu', $sp];
?>
<div class="status-bar <?php echo $sl[0]; ?>">
    <?php echo $sl[1]; ?>
</div>

<!-- ISI SURAT -->
<div class="surat-wrapper">
    <table border="0" align="center" width="90%" cellpadding="0" style="line-height:150%;">
        <tr><td colspan="3" align="right"><?php echo $tanggal2; ?></td></tr>
        <tr>
            <td width="25%">Nomor</td><td width="2%">:</td>
            <td>PP.06.02/F.XXIII.1/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?php echo date('Y'); ?></td>
        </tr>
        <tr><td>Perihal</td><td>:</td><td><b>Izin Pra Penelitian</b></td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td>Yth.</td></tr>
        <tr><td colspan="3" style="text-transform:capitalize;text-align:justify;"><b><?php echo $a['tujuan']; ?></b></td></tr>
        <tr><td>di</td></tr>
        <tr><td>&nbsp;&nbsp;<b>Tempat</b></td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
    </table>

    <table border="0" align="center" width="90%" cellpadding="0">
        <tr>
            <td colspan="3" style="text-align:justify;line-height:200%">
                &nbsp;&nbsp;&nbsp;Sehubungan penyusunan tugas akhir dalam bentuk <?php echo $a['tugas_akhir']; ?> Mahasiswa Progam Studi <?php echo $a['prodi']; ?> Jurusan <?php echo $a['jurusan']; ?> Politeknik Kesehatan Kemenkes Bengkulu Tahun Akademik <?php echo $a['tahun_akademik']; ?>, dengan ini mohon Bapak/Ibu dapat memberikan izin pengambilan data, Pra Penelitian pada mahasiswa dibawah ini :
            </td>
        </tr>
    </table>

    <table border="0" align="center" width="90%" cellpadding="0">
        <tr><td width="30%">&emsp;&emsp;&emsp;Nama Mahasiswa</td><td width="2%">:</td><td style="text-transform:capitalize;"><?php echo $a['nama_mahasiswa']; ?></td></tr>
        <tr><td>&emsp;&emsp;&emsp;NIM</td><td>:</td><td style="text-transform:uppercase;"><?php echo $a['nim_mahasiswa']; ?></td></tr>
        <tr><td valign="top">&emsp;&emsp;&emsp;Tempat</td><td valign="top">:</td><td style="text-transform:capitalize;text-align:justify;"><?php echo $a['lokasi']; ?></td></tr>
        <tr><td valign="top">&emsp;&emsp;&emsp;Judul</td><td valign="top">:</td><td style="text-transform:capitalize;text-align:justify;"><?php echo $a['judul_kti']; ?></td></tr>
        <tr><td>&emsp;&emsp;&emsp;No Handphone</td><td>:</td><td><?php echo $a['no_hp']; ?></td></tr>
        <tr>
            <td colspan="3" style="text-align:justify;line-height:150%">
                &nbsp;&nbsp;&nbsp;Demikianlah, atas perhatian dan kerjasamanya kami mengucapkan terimakasih.
            </td>
        </tr>
    </table>

    <table border="0" align="center" width="90%" cellpadding="0">
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr>
            <td width="40%">&nbsp;</td><td>&nbsp;</td>
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