<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
error_reporting(0);

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'karyawan') {
    http_response_code(403);
    echo json_encode(['error' => 'Akses ditolak.']);
    exit;
}

require_once "../config/koneksi.php";

$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$configs = [
    'keterangan_lulus' => [
        'table' => 'tb_surat_keterangan_lulus',
        'pk' => 'id_surat_keterangan_lulus',
        'filter_column' => 'status',
        'filters' => ['Belum Dicetak', 'Sudah Dicetak'],
        'search_columns' => ['nim_mahasiswa', 'nama_mahasiswa', 'jurusan', 'tempat_lahir', 'tanggal_lahir', 'tahun_akademik', 'status'],
        'order' => "FIELD(status, 'Belum Dicetak', 'Sudah Dicetak'), id_surat_keterangan_lulus DESC",
    ],
    'penelitian' => [
        'table' => 'tb_surat_penelitian',
        'pk' => 'id_surat_penelitian',
        'filter_column' => 'status_persetujuan',
        'filters' => ['Menunggu', 'Perlu_Revisi', 'Telah_Direvisi', 'Disetujui_Resepsionis', 'Disetujui'],
        'search_columns' => ['nim_mahasiswa', 'nama_mahasiswa', 'jurusan', 'judul_kti', 'tempat_penelitian', 'tahun_akademik', 'status', 'status_persetujuan', 'catatan_penolakan'],
        'order' => "FIELD(status_persetujuan, 'Telah_Direvisi','Menunggu','Perlu_Revisi','Disetujui_Resepsionis','Disetujui'), COALESCE(tanggal_pengajuan, '1970-01-01') DESC, id_surat_penelitian DESC",
    ],
    'pra_penelitian' => [
        'table' => 'tb_surat_pra_penelitian',
        'pk' => 'id_surat_pra_penelitian',
        'filter_column' => 'status_persetujuan',
        'filters' => ['Menunggu', 'Perlu_Revisi', 'Telah_Direvisi', 'Disetujui_Resepsionis', 'Disetujui'],
        'search_columns' => ['nim_mahasiswa', 'nama_mahasiswa', 'prodi', 'judul_kti', 'tujuan', 'lokasi', 'keterangan', 'tahun_akademik', 'status', 'status_persetujuan', 'catatan_penolakan'],
        'order' => "FIELD(status_persetujuan, 'Telah_Direvisi','Menunggu','Perlu_Revisi','Disetujui_Resepsionis','Disetujui'), id_surat_pra_penelitian DESC",
    ],
];

if (!isset($configs[$jenis])) {
    http_response_code(400);
    echo json_encode(['error' => 'Jenis surat tidak valid.']);
    exit;
}

$config = $configs[$jenis];
$filter = isset($_GET['filter']) ? trim($_GET['filter']) : 'semua';
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$offset = isset($_GET['offset']) ? max(0, (int)$_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? min(50, max(10, (int)$_GET['limit'])) : 50;
$whereParts = [];

if ($filter !== 'semua' && in_array($filter, $config['filters'], true)) {
    $safeFilter = mysqli_real_escape_string($kon, $filter);
    $whereParts[] = "`{$config['filter_column']}`='$safeFilter'";
}

if ($keyword !== '') {
    $safeKeyword = mysqli_real_escape_string($kon, $keyword);
    $searchParts = [];
    foreach ($config['search_columns'] as $column) {
        $searchParts[] = "`$column` LIKE '%$safeKeyword%'";
    }
    $whereParts[] = '(' . implode(' OR ', $searchParts) . ')';
}

$where = count($whereParts) ? 'WHERE ' . implode(' AND ', $whereParts) : '';
$countResult = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM `{$config['table']}` $where");
if (!$countResult) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal menghitung data surat.']);
    exit;
}
$total = (int)mysqli_fetch_assoc($countResult)['jumlah'];
$query = mysqli_query($kon, "SELECT * FROM `{$config['table']}` $where ORDER BY {$config['order']} LIMIT $offset,$limit");
if (!$query) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal memuat data surat.']);
    exit;
}

$rows = [];
while ($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
}

echo json_encode([
    'data' => $rows,
    'total' => $total,
    'offset' => $offset,
    'limit' => $limit,
    'has_more' => ($offset + count($rows)) < $total,
]);
