<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'wakil_direktur') {
    header('location:../index.php');
    exit;
}

$map = [
    'ket_lulus' => ['tabel' => 'tb_surat_keterangan_lulus', 'pk' => 'id_surat_keterangan_lulus', 'status' => 'Menunggu', 'halaman' => '02_persetujuan_surat_keterangan_lulus.php'],
    'masih_kuliah' => ['tabel' => 'tb_surat_keterangan_masih_kuliah', 'pk' => 'id_surat_keterangan_masih_kuliah', 'status' => 'Disetujui_Resepsionis', 'halaman' => '03_persetujuan_surat_keterangan_masih_kuliah.php'],
    'penelitian' => ['tabel' => 'tb_surat_penelitian', 'pk' => 'id_surat_penelitian', 'status' => 'Disetujui_Resepsionis', 'halaman' => '04_persetujuan_surat_penelitian.php'],
    'pra_penelitian' => ['tabel' => 'tb_surat_pra_penelitian', 'pk' => 'id_surat_pra_penelitian', 'status' => 'Disetujui_Resepsionis', 'halaman' => '05_persetujuan_surat_pra_penelitian.php'],
];
$jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($map[$jenis])) {
    header('location:index.php');
    exit;
}
$item = $map[$jenis];
$token = isset($_POST['csrf_token']) && is_string($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
if (empty($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
    header('location:' . $item['halaman'] . '?pesan=gagal');
    exit;
}
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id < 1) {
    header('location:' . $item['halaman'] . '?pesan=gagal');
    exit;
}

$tabel = $item['tabel'];
$pk = $item['pk'];
$status = mysqli_real_escape_string($kon, $item['status']);
$tanggal = date('Y-m-d');
$sql = "UPDATE `$tabel`
        SET status_persetujuan='Disetujui', catatan_penolakan='', tanggal_persetujuan='$tanggal'
        WHERE `$pk`=$id AND status_persetujuan='$status'";
if (!mysqli_query($kon, $sql)) {
    header('location:' . $item['halaman'] . '?pesan=gagal');
    exit;
}
if (mysqli_affected_rows($kon) !== 1) {
    header('location:' . $item['halaman'] . '?pesan=tidak_dapat_disetujui');
    exit;
}
header('location:' . $item['halaman'] . '?pesan=disetujui');
exit;
?>
