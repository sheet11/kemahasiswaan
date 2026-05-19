<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksi.php";

// Validasi session
if (!isset($_SESSION['level']) || $_SESSION['level'] != 'wakil_direktur') {
    header('location:../index.php');
    exit;
}

include('../karyawan/fucnt_tgl.php');

$id    = isset($_GET['id_surat_keterangan_lulus']) ? (int)$_GET['id_surat_keterangan_lulus'] : 0;
$query = mysqli_query($kon, "SELECT * FROM tb_surat_keterangan_lulus WHERE id_surat_keterangan_lulus='$id'");
$a     = mysqli_fetch_array($query);

if (!$a) {
    echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>"; exit;
}

$tanggal1 = tgl_indo($a['tanggal_lahir']);
$tanggal2 = tgl_indo($a['tanggal_cetak']);
$tanggal3 = tgl_indo($a['tanggal_sk']);
$tanggal4 = tgl_indo($a['tanggal_wisudah']);
$sp       = $a['status_persetujuan'];
$return   = isset($_GET['return']) ? $_GET['return'] : '02_persetujuan_surat_keterangan_lulus.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Preview - Surat Keterangan Lulus</title>
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
            margin: 70px auto 30px auto;
            max-width: 800px;
            background: #fff;
            padding: 60px 70px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.2);
            min-height: 1000px;
        }
        .status-bar {
            margin: 70px auto 0 auto;
            max-width: 800px;
            padding: 10px 15px;
            border-radius: 4px 4px 0 0;
            font-size: 13px;
            font-weight: bold;
        }
        .status-menunggu  { background: #f39c12; color: #fff; }
        .status-disetujui { background: #00a65a; color: #fff; }
        .status-ditolak   { background: #dd4b39; color: #fff; }
        body { font-family: Arial; line-height:150%; font-size:11.0pt; }
        table { font-family: Arial; line-height:150%; font-size:11.0pt; }
        @media print {
            .toolbar, .status-bar { display: none !important; }
            .surat-wrapper { margin: 0; box-shadow: none; padding: 30px; }
            body { background: #fff; }
        }
    </style>
</head>
<body>

<!-- Toolbar Aksi -->
<div class="toolbar">
    <span class="title"><i class="fa fa-file-text-o"></i> Preview Surat Keterangan Lulus &mdash; <?php echo $a['nama_mahasiswa']; ?></span>

    <?php if ($sp == 'Menunggu'): ?>
        <a href="proses_persetujuan.php?aksi=setujui&jenis=ket_lulus&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           onclick="return confirm('Setujui surat ini?')"
           class="btn btn-success btn-sm">
            <i class="fa fa-check"></i> Setujui
        </a>
        <a href="proses_persetujuan.php?aksi=tolak&jenis=ket_lulus&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           class="btn btn-danger btn-sm">
            <i class="fa fa-times"></i> Tolak
        </a>
    <?php elseif ($sp == 'Disetujui'): ?>
        <span class="label label-success" style="font-size:13px;padding:6px 12px;">
            <i class="fa fa-check"></i> Sudah Disetujui
        </span>
        <a href="proses_persetujuan.php?aksi=tolak&jenis=ket_lulus&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           class="btn btn-warning btn-sm">
            <i class="fa fa-undo"></i> Batalkan
        </a>
    <?php elseif ($sp == 'Ditolak'): ?>
        <span class="label label-danger" style="font-size:13px;padding:6px 12px;">
            <i class="fa fa-times"></i> Ditolak
        </span>
        <a href="proses_persetujuan.php?aksi=setujui&jenis=ket_lulus&id=<?php echo $id; ?>&return=<?php echo urlencode($return); ?>"
           onclick="return confirm('Setujui surat ini?')"
           class="btn btn-success btn-sm">
            <i class="fa fa-check"></i> Setujui
        </a>
    <?php endif; ?>

    <a href="<?php echo $return; ?>" class="btn btn-default btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<!-- Status Bar -->
<div class="status-bar <?php echo 'status-' . strtolower($sp); ?>">
    <?php if ($sp == 'Menunggu'): ?>
        <i class="fa fa-clock-o"></i> Status: Menunggu Persetujuan
    <?php elseif ($sp == 'Disetujui'): ?>
        <i class="fa fa-check-circle"></i> Status: Disetujui &mdash; Tanggal: <?php echo $a['tanggal_persetujuan']; ?>
    <?php elseif ($sp == 'Ditolak'): ?>
        <i class="fa fa-times-circle"></i> Status: Ditolak
        <?php if (!empty($a['catatan_penolakan'])): ?>
         &mdash; Catatan: <?php echo $a['catatan_penolakan']; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- ISI SURAT -->
<div class="surat-wrapper">
    <table border="0" width="100%" cellpadding="0">
        <tr>
            <td colspan="3" align="center" style='font-size:18.0pt;'><b><u>SURAT KETERANGAN</u></b><br></td>
        </tr>
        <tr>
            <td colspan="3" align="center"><b>Nomor : PP.01.01/1/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('Y'); ?></b></td>
        </tr>
    </table>

    <table border="0" width="100%" cellpadding="3">
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td colspan="3">Yang bertandatangan dibawah ini :</td></tr>
        <tr><td>Nama</td><td width="2%">:</td><td>Eliana, SKM, M.PH</td></tr>
        <tr><td>NIP</td><td>:</td><td>196505091989032001</td></tr>
        <tr><td>Pangkat, Golongan/Ruang</td><td>:</td><td>Pembina/ IVa</td></tr>
        <tr><td>Jabatan</td><td>:</td><td>Direktur Poltekkes Kemenkes Bengkulu</td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td colspan="3">Dengan ini menerangkan bahwa</td></tr>
        <tr><td>Nama</td><td>:</td><td><?php echo $a['nama_mahasiswa']; ?></td></tr>
        <tr><td>NIM</td><td>:</td><td><?php echo $a['nim_mahasiswa']; ?></td></tr>
        <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td><?php echo $a['tempat_lahir']; ?>, <?php echo $tanggal1; ?></td></tr>
    </table>

    <table border="0" width="100%" cellpadding="5">
        <tr>
            <td colspan="3" style="text-align:justify;line-height:200%;">
                telah dinyatakan <b>LULUS</b> pada <b>Program Studi <?php echo $a['prodi']; ?> Jurusan <?php echo $a['jurusan']; ?> Poltekkes Kemenkes Bengkulu</b> dan telah mengikuti Wisuda pada tanggal <?php echo $tanggal4; ?> di Bengkulu, berdasarkan Surat Keputusan Direktur Poltekkes Kemenkes Bengkulu Nomor : PP.01.01/1/<?php echo $a['nomor_surat']; ?> Tanggal <?php echo $tanggal3; ?> tentang Penetapan Lulusan Diploma Tiga dan Sarjana Terapan di Politeknik Kesehatan Kementerian Kesehatan Bengkulu Tahun Akademik <?php echo $a['tahun_akademik']; ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:justify;line-height:200%;">
                Demikian Surat Keterangan ini dibuat dengan sesungguhnya agar dapat digunakan sebagaimana mestinya.
            </td>
        </tr>
        <tr>
            <td width="40%">&nbsp;</td><td>&nbsp;</td>
            <td style="padding-left:80px;">Bengkulu, <?php echo $tanggal2; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td style="padding-left:80px;">Direktur,</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td style="padding-left:80px;"><b><u>Linda, SST, M.Kes</u></b></td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td style="padding-left:80px;">NIP.196909011989032001</td>
        </tr>
    </table>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
