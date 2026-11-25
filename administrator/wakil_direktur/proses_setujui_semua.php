<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'wakil_direktur') {
    header('location:../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location:index.php');
    exit;
}

// Status awal yang memang menunggu persetujuan Wadir pada tiap jenis surat.
$surat = [
    'ket_lulus' => ['tabel' => 'tb_surat_keterangan_lulus', 'status' => 'Menunggu', 'halaman' => '02_persetujuan_surat_keterangan_lulus.php'],
    'masih_kuliah' => ['tabel' => 'tb_surat_keterangan_masih_kuliah', 'status' => 'Disetujui_Resepsionis', 'halaman' => '03_persetujuan_surat_keterangan_masih_kuliah.php'],
    'pra_penelitian' => ['tabel' => 'tb_surat_pra_penelitian', 'status' => 'Disetujui_Resepsionis', 'halaman' => '05_persetujuan_surat_pra_penelitian.php'],
    'penelitian' => ['tabel' => 'tb_surat_penelitian', 'status' => 'Disetujui_Resepsionis', 'halaman' => '04_persetujuan_surat_penelitian.php'],
];

$jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';
if (!isset($surat[$jenis])) {
    header('location:index.php?pesan=gagal');
    exit;
}

$item = $surat[$jenis];
$tabel = $item['tabel'];
$halaman = $item['halaman'];
$token = isset($_POST['csrf_token']) && is_string($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
if (empty($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
    header('location:' . $halaman . '?pesan=bulk_gagal');
    exit;
}
$tanggal = date('Y-m-d');
$status = mysqli_real_escape_string($kon, $item['status']);
$sql = "UPDATE `$tabel`
        SET status_persetujuan = 'Disetujui',
            catatan_penolakan = '',
            tanggal_persetujuan = '$tanggal'
        WHERE status_persetujuan = '$status'";

if (!mysqli_query($kon, $sql)) {
    header('location:' . $halaman . '?pesan=bulk_gagal');
    exit;
}

$jumlah = mysqli_affected_rows($kon);
header('location:' . $halaman . '?pesan=bulk_disetujui&jumlah=' . $jumlah);
exit;
?>
