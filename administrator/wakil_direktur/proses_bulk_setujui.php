<?php
session_start();
include "../config/koneksi.php";
error_reporting(0);

header('Content-Type: application/json');

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'wakil_direktur') {
    echo json_encode(['status' => 'error', 'pesan' => 'Akses ditolak.']);
    exit;
}

$ids_raw = isset($_POST['ids'])   ? $_POST['ids']   : '';
$jenis   = isset($_POST['jenis']) ? $_POST['jenis'] : '';

$tabel_map = [
    'masih_kuliah' => [
        'tabel'    => 'tb_surat_keterangan_masih_kuliah',
        'kolom_id' => 'id_surat_keterangan_masih_kuliah',
    ],
    'penelitian' => [
        'tabel'    => 'tb_surat_penelitian',
        'kolom_id' => 'id_surat_penelitian',
    ],
    'pra_penelitian' => [
        'tabel'    => 'tb_surat_pra_penelitian',
        'kolom_id' => 'id_surat_pra_penelitian',
    ],
];

if (!array_key_exists($jenis, $tabel_map)) {
    echo json_encode(['status' => 'error', 'pesan' => 'Jenis surat tidak valid.']);
    exit;
}

$ids = json_decode($ids_raw, true);
if (!is_array($ids) || count($ids) === 0) {
    echo json_encode(['status' => 'error', 'pesan' => 'Tidak ada surat yang dipilih.']);
    exit;
}

$ids_clean = array_filter(array_map('intval', $ids), function($v) { return $v > 0; });
if (count($ids_clean) === 0) {
    echo json_encode(['status' => 'error', 'pesan' => 'ID surat tidak valid.']);
    exit;
}

$tabel    = $tabel_map[$jenis]['tabel'];
$kolom_id = $tabel_map[$jenis]['kolom_id'];
$ids_str  = implode(',', $ids_clean);
$tgl_now  = date('Y-m-d H:i:s');

$sql = "UPDATE `$tabel`
        SET status_persetujuan  = 'Disetujui',
            tanggal_persetujuan = '$tgl_now'
        WHERE $kolom_id IN ($ids_str)
          AND status_persetujuan = 'Disetujui_Resepsionis'";

$result = mysqli_query($kon, $sql);

if ($result) {
    $jml = mysqli_affected_rows($kon);
    echo json_encode(['status' => 'ok', 'jml' => $jml, 'pesan' => $jml . ' surat berhasil disetujui.']);
} else {
    echo json_encode(['status' => 'error', 'pesan' => 'Query gagal: ' . mysqli_error($kon)]);
}
exit;