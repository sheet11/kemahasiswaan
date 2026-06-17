<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'karyawan') {
    header('location:../index.php'); exit;
}

$aksi       = isset($_GET['aksi'])   ? $_GET['aksi']    : '';
$jenis      = isset($_GET['jenis'])  ? $_GET['jenis']   : '';
$id         = isset($_GET['id'])     ? (int)$_GET['id'] : 0;
$return_url = isset($_GET['return']) ? $_GET['return']  : 'index.php';
$tanggal    = date('Y-m-d');

$mapping = [
    'ket_lulus'      => ['tabel' => 'tb_surat_keterangan_lulus',        'pk' => 'id_surat_keterangan_lulus'],
    'masih_kuliah'   => ['tabel' => 'tb_surat_keterangan_masih_kuliah', 'pk' => 'id_surat_keterangan_masih_kuliah'],
    'pra_penelitian' => ['tabel' => 'tb_surat_pra_penelitian',          'pk' => 'id_surat_pra_penelitian'],
    'penelitian'     => ['tabel' => 'tb_surat_penelitian',              'pk' => 'id_surat_penelitian'],
];

if (!array_key_exists($jenis, $mapping) || $id == 0) {
    echo "<script>alert('Parameter tidak valid!'); window.history.back();</script>"; exit;
}

$tabel = $mapping[$jenis]['tabel'];
$pk    = $mapping[$jenis]['pk'];

$cek = mysqli_fetch_array(mysqli_query($kon, "SELECT status_persetujuan FROM `$tabel` WHERE `$pk`=$id"));
if (!$cek) { echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>"; exit; }

if ($aksi == 'setujui') {
    // Wadir hanya bisa setujui jika sudah divalidasi karyawan
    if ($cek['status_persetujuan'] != 'Disetujui_Resepsionis') {
        echo "<script>alert('Surat ini belum divalidasi oleh Resepsionis.'); window.history.back();</script>"; exit;
    }
    mysqli_query($kon, "UPDATE `$tabel` SET 
        status_persetujuan  = 'Disetujui',
        catatan_penolakan   = '',
        tanggal_persetujuan = '$tanggal'
        WHERE `$pk` = $id");
    header("location: $return_url?pesan=disetujui"); exit;

} else {
    echo "<script>alert('Aksi tidak dikenal!'); window.history.back();</script>";
}
?>