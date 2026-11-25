<?php
include __DIR__ . '/session.php';

header('Content-Type: application/json');

$draw = isset($_GET['draw']) ? (int) $_GET['draw'] : 1;
$start = isset($_GET['start']) ? max(0, (int) $_GET['start']) : 0;
$length = isset($_GET['length']) ? (int) $_GET['length'] : 25;
$length = $length === -1 ? 25 : max(1, min(100, $length));

$search = isset($_GET['search']['value']) ? trim((string) $_GET['search']['value']) : '';
$filter = isset($_GET['filter_status']) ? trim((string) $_GET['filter_status']) : '';

$where = [];
if ($search !== '') {
	$searchValue = mysqli_real_escape_string($kon, $search);
	$where[] = "(nama_lengkap LIKE '%{$searchValue}%'
		OR nim LIKE '%{$searchValue}%'
		OR tempatdantgl_lahir LIKE '%{$searchValue}%'
		OR jurusan LIKE '%{$searchValue}%'
		OR status LIKE '%{$searchValue}%'
		OR no_seri_ijazah LIKE '%{$searchValue}%')";
}
if ($filter !== '' && in_array($filter, ['Belum Dicetak', 'Sudah Dicetak'], true)) {
	$where[] = "status = '" . mysqli_real_escape_string($kon, $filter) . "'";
}

$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$countAll = mysqli_query($kon, 'SELECT COUNT(*) AS jumlah FROM tb_ijazah');
$recordsTotal = $countAll ? (int) mysqli_fetch_assoc($countAll)['jumlah'] : 0;

$countFiltered = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM tb_ijazah {$whereSql}");
$recordsFiltered = $countFiltered ? (int) mysqli_fetch_assoc($countFiltered)['jumlah'] : 0;

$columns = [
	0 => 'id_ijazah',
	1 => 'nama_lengkap',
	2 => 'nim',
	3 => 'tempatdantgl_lahir',
	4 => 'jurusan',
	5 => 'status',
];
$orderColumn = isset($_GET['order'][0]['column']) ? (int) $_GET['order'][0]['column'] : 0;
$orderDirection = isset($_GET['order'][0]['dir']) && strtolower($_GET['order'][0]['dir']) === 'asc' ? 'ASC' : 'DESC';
$orderBy = isset($columns[$orderColumn]) ? $columns[$orderColumn] : 'id_ijazah';

$querySql = "SELECT id_ijazah, nama_lengkap, nim, tempatdantgl_lahir, jurusan, status
	FROM tb_ijazah
	{$whereSql}
	ORDER BY {$orderBy} {$orderDirection}
	LIMIT {$start}, {$length}";
$result = mysqli_query($kon, $querySql);

$data = [];
$rowNumber = $start + 1;
while ($result && ($row = mysqli_fetch_assoc($result))) {
	$id = (int) $row['id_ijazah'];
	$nama = htmlspecialchars($row['nama_lengkap'], ENT_QUOTES, 'UTF-8');
	$actions =
		'<div class="aksi-buttons" role="group" aria-label="Aksi untuk ' . $nama . '">' .
		'<a href="01_cetak_ijazah.php?id_ijazah=' . $id . '" class="btn btn-success btn-xs" title="Cetak ijazah" aria-label="Cetak ijazah ' . $nama . '"><i class="fa fa-print" aria-hidden="true"></i></a>' .
		'<a href="01_cetak_ulang_ijazah.php?id_ijazah=' . $id . '" class="btn btn-info btn-xs" title="Cetak ulang" aria-label="Cetak ulang ijazah ' . $nama . '"><i class="fa fa-repeat" aria-hidden="true"></i></a>' .
		'<a href="01_edit_ijazah.php?id_ijazah=' . $id . '" class="btn btn-warning btn-xs" title="Edit data" aria-label="Edit data ' . $nama . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>' .
		'<a href="01_delete_ijazah.php?id_ijazah=' . $id . '" class="btn btn-danger btn-xs" title="Hapus data" aria-label="Hapus data ' . $nama . '" onclick="return confirm(\'Anda yakin akan menghapus ' . $nama . '?\')"><i class="fa fa-trash" aria-hidden="true"></i></a>' .
		'</div>';

	$data[] = [
		$rowNumber++,
		htmlspecialchars($row['nama_lengkap'], ENT_QUOTES, 'UTF-8'),
		htmlspecialchars($row['nim'], ENT_QUOTES, 'UTF-8'),
		htmlspecialchars($row['tempatdantgl_lahir'], ENT_QUOTES, 'UTF-8'),
		htmlspecialchars($row['jurusan'], ENT_QUOTES, 'UTF-8'),
		htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'),
		$actions,
	];
}

echo json_encode([
	'draw' => $draw,
	'recordsTotal' => $recordsTotal,
	'recordsFiltered' => $recordsFiltered,
	'data' => $data,
], JSON_UNESCAPED_UNICODE);
