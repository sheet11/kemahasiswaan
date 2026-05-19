<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(0);

require_once "../config/koneksi.php";

$tabel   = $_GET['tabel']   ?? '';
$keyword = trim($_GET['keyword'] ?? '');

$allowed = [
    'masih_kuliah' => [
        'table' => 'tb_surat_keterangan_masih_kuliah',
        'pk'    => 'id_surat_keterangan_masih_kuliah',
        'kolom' => ['nim_mahasiswa','nama_mahasiswa','jurusan','tingkat','tahun_akademik','status','status_persetujuan','catatan_penolakan'],
    ],
    'penelitian' => [
        'table' => 'tb_surat_penelitian',
        'pk'    => 'id_surat_penelitian',
        'kolom' => ['nim_mahasiswa','nama_mahasiswa','jurusan','judul_kti','tempat_penelitian','tahun_akademik','status','status_persetujuan','catatan_penolakan'],
    ],
    'pra_penelitian' => [
        'table' => 'tb_surat_pra_penelitian',
        'pk'    => 'id_surat_pra_penelitian',
        'kolom' => ['nim_mahasiswa','nama_mahasiswa','prodi','judul_kti','tujuan','lokasi','keterangan','tahun_akademik','status','status_persetujuan','catatan_penolakan'],
    ],
];

if (!isset($allowed[$tabel])) {
    echo json_encode(['error' => 'Tabel tidak valid.']);
    exit;
}

$cfg       = $allowed[$tabel];
$tableName = $cfg['table'];
$pkName    = $cfg['pk'];
$safe_kw   = '%' . mysqli_real_escape_string($kon, $keyword) . '%';

// Cari di semua kolom sekaligus
$where_parts = [];
foreach ($cfg['kolom'] as $kol) {
    $where_parts[] = "`$kol` LIKE '$safe_kw'";
}
$where = implode(' OR ', $where_parts);

$sql = "SELECT * FROM `$tableName` WHERE $where ORDER BY `$pkName` DESC LIMIT 200";
$res = mysqli_query($kon, $sql);

if (!$res) {
    echo json_encode(['error' => 'Query gagal: ' . mysqli_error($kon)]);
    exit;
}

$rows = [];
while ($row = mysqli_fetch_assoc($res)) {
    $rows[] = $row;
}

echo json_encode(['data' => $rows, 'total' => count($rows)]);
exit;