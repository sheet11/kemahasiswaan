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

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';
$allowedFilters = [
    'semua' => '',
    'Menunggu' => 'Menunggu',
    'Perlu_Revisi' => 'Perlu_Revisi',
    'Telah_Direvisi' => 'Telah_Direvisi',
    'Disetujui_Resepsionis' => 'Disetujui_Resepsionis',
    'Disetujui' => 'Disetujui',
];
if (!isset($allowedFilters[$filter])) {
    $filter = 'semua';
}

$offset = isset($_GET['offset']) ? max(0, (int)$_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 30;
$limit = min(50, max(10, $limit));
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$safeKeyword = mysqli_real_escape_string($kon, $keyword);
$whereParts = [];

if ($allowedFilters[$filter] !== '') {
    $safeFilter = mysqli_real_escape_string($kon, $allowedFilters[$filter]);
    $whereParts[] = "status_persetujuan='$safeFilter'";
}
if ($safeKeyword !== '') {
    $like = "'%$safeKeyword%'";
    $whereParts[] = "(nama_mahasiswa LIKE $like OR nim_mahasiswa LIKE $like OR jurusan LIKE $like OR tingkat LIKE $like OR tahun_akademik LIKE $like OR status_persetujuan LIKE $like OR catatan_penolakan LIKE $like)";
}
$where = count($whereParts) ? 'WHERE ' . implode(' AND ', $whereParts) : '';
$order = "ORDER BY FIELD(status_persetujuan, 'Telah_Direvisi','Menunggu','Perlu_Revisi','Disetujui_Resepsionis','Disetujui'), COALESCE(tanggal_pengajuan, '1970-01-01') DESC, id_surat_keterangan_masih_kuliah DESC";

$countQuery = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM tb_surat_keterangan_masih_kuliah $where");
if (!$countQuery) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal menghitung data.']);
    exit;
}
$total = (int)mysqli_fetch_assoc($countQuery)['jumlah'];
$query = mysqli_query($kon, "SELECT * FROM tb_surat_keterangan_masih_kuliah $where $order LIMIT $offset,$limit");
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
exit;
?>
