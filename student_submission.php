<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function submissionFail($message, $status = 422)
{
    http_response_code($status);
    header('Content-Type: text/html; charset=utf-8');
    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    echo '<!doctype html><html lang="id"><meta charset="utf-8"><title>Pengajuan tidak dapat diproses</title>';
    echo '<body style="font-family:Arial,sans-serif;max-width:700px;margin:40px auto;padding:0 16px">';
    echo '<h2>Pengajuan tidak dapat diproses</h2><p>' . $safeMessage . '</p>';
    echo '<p><a href="javascript:history.back()">Kembali ke formulir</a></p></body></html>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php', true, 303);
    exit;
}
if (empty($_SESSION['nim'])) {
    header('Location: login.php', true, 303);
    exit;
}
$sessionToken = $_SESSION['csrf_token'] ?? '';
$postedToken = $_POST['csrf_token'] ?? '';
if (!is_string($sessionToken) || $sessionToken === '' || !is_string($postedToken) || !hash_equals($sessionToken, $postedToken)) {
    submissionFail('Sesi formulir tidak valid atau sudah kedaluwarsa. Muat ulang formulir lalu coba kembali.', 403);
}

require_once __DIR__ . '/config/koneksi.php';
mysqli_set_charset($kon, 'utf8mb4');

$userStmt = mysqli_prepare($kon, 'SELECT username, nama_lengkap FROM tb_user WHERE username = ? LIMIT 1');
if (!$userStmt) {
    submissionFail('Layanan pengajuan sedang tidak tersedia.', 500);
}
mysqli_stmt_bind_param($userStmt, 's', $_SESSION['nim']);
mysqli_stmt_execute($userStmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($userStmt));
mysqli_stmt_close($userStmt);
if (!$user) {
    submissionFail('Akun mahasiswa tidak ditemukan. Silakan masuk kembali.', 403);
}

function formValue($key, $required = true, $maxLength = 255)
{
    $value = $_POST[$key] ?? '';
    if (!is_string($value)) {
        submissionFail('Format data formulir tidak valid.');
    }
    $value = trim($value);
    $length = function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
    if ($required && $value === '') {
        submissionFail('Semua kolom wajib harus diisi.');
    }
    if ($length > $maxLength || preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', $value)) {
        submissionFail('Ada isian yang terlalu panjang atau mengandung karakter tidak valid.');
    }
    return $value;
}

function optionExists($connection, $table, $column, $value)
{
    $allowed = [
        'tb_jurusan' => ['nama_jurusan'],
        'tb_prodi' => ['program_studi'],
        'tb_tahun_akademik' => ['tahun_akademik'],
    ];
    if (!isset($allowed[$table]) || !in_array($column, $allowed[$table], true)) {
        return false;
    }
    $stmt = mysqli_prepare($connection, "SELECT 1 FROM `$table` WHERE `$column` = ? LIMIT 1");
    if (!$stmt) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, 's', $value);
    mysqli_stmt_execute($stmt);
    $exists = mysqli_stmt_get_result($stmt)->num_rows > 0;
    mysqli_stmt_close($stmt);
    return $exists;
}

function requireOption($connection, $table, $column, $key, $label)
{
    $value = formValue($key, true, 120);
    if (!optionExists($connection, $table, $column, $value)) {
        submissionFail('Pilihan ' . $label . ' tidak valid. Pilih kembali dari daftar.');
    }
    return $value;
}

$name = trim((string)$user['nama_lengkap']);
$nim = trim((string)$user['username']);
if (strlen($name) < 2 || strlen($name) > 150 || !preg_match('/\p{L}/u', $name)) {
    submissionFail('Nama pada profil akun tidak valid. Hubungi administrator untuk memperbaiki profil.');
}
if (!preg_match('/^[A-Za-z0-9][A-Za-z0-9.-]{4,29}$/', $nim)) {
    submissionFail('NIM pada profil akun tidak valid. Hubungi administrator untuk memperbaiki profil.');
}

$type = $_POST['submission_type'] ?? '';
$redirects = [
    'keterangan_lulus' => '02_daftar_surat_keterangan_lulus.php?pesan=berhasil',
    'masih_kuliah' => '03_daftar_surat_keterangan_masih_kuliah.php?pesan=berhasil',
    'penelitian' => '04_daftar_surat_penelitian.php?pesan=berhasil',
    'pra_penelitian' => '05_daftar_surat_pra_penelitian.php?pesan=berhasil',
];
if (!is_string($type) || !isset($redirects[$type])) {
    submissionFail('Jenis pengajuan tidak valid.', 400);
}

$today = date('Y-m-d');
$submittedAt = date('Y-m-d H:i:s');
$data = [
    'nama_mahasiswa' => $name,
    'nim_mahasiswa' => $nim,
    'nim_pengaju' => $nim,
    'tanggal_pengajuan' => $submittedAt,
];

switch ($type) {
    case 'keterangan_lulus':
        $table = 'tb_surat_keterangan_lulus';
        $keperluan = formValue('keperluan', true, 100);
        $allowedPurposes = ['Melamar Pekerjaan', 'Kenaikan Pangkat', 'Melanjutkan Pendidikan', 'Melanjutkan Pendidikan dan Melamar Pekerjaan'];
        if (!in_array($keperluan, $allowedPurposes, true)) submissionFail('Pilihan keperluan tidak valid.');
        $birthDate = formValue('tanggal_lahir', true, 10);
        $date = DateTime::createFromFormat('!Y-m-d', $birthDate);
        $dateErrors = DateTime::getLastErrors();
        if (!$date || ($dateErrors && ($dateErrors['warning_count'] || $dateErrors['error_count'])) || $date->format('Y-m-d') !== $birthDate || $birthDate > $today) {
            submissionFail('Tanggal lahir tidak valid.');
        }
        $data += [
            'keperluan' => $keperluan,
            'tempat_lahir' => formValue('tempat_lahir', true, 100),
            'tanggal_lahir' => $birthDate,
            'jurusan' => requireOption($kon, 'tb_jurusan', 'nama_jurusan', 'jurusan', 'jurusan'),
            'prodi' => requireOption($kon, 'tb_prodi', 'program_studi', 'prodi', 'program studi'),
            'tahun_akademik' => requireOption($kon, 'tb_tahun_akademik', 'tahun_akademik', 'tahun_akademik', 'tahun akademik'),
            'nomor_surat' => formValue('nomor_surat', false, 100),
            'tanggal_sk' => formValue('tanggal_sk', false, 50),
            'tanggal_wisudah' => formValue('tanggal_wisudah', false, 50),
            'tanggal_cetak' => $today,
        ];
        break;

    case 'masih_kuliah':
        $table = 'tb_surat_keterangan_masih_kuliah';
        $keperluan = formValue('keperluan', true, 100);
        if (!in_array($keperluan, ['Slip Gaji/Tunjangan/Pensiun', 'Pembuatan Askes/BPJS', 'Lainnya'], true)) submissionFail('Pilihan keperluan tidak valid.');
        $tingkat = formValue('tingkat', true, 5);
        $semester = formValue('semester', true, 5);
        if (!in_array($tingkat, ['I', 'II', 'III', 'IV'], true) || !in_array($semester, ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII'], true)) submissionFail('Tingkat atau semester tidak valid.');
        $data += [
            'keperluan' => $keperluan,
            'tingkat' => $tingkat,
            'semester' => $semester,
            'tahun_akademik' => requireOption($kon, 'tb_tahun_akademik', 'tahun_akademik', 'tahun_akademik', 'tahun akademik'),
            'nama_orang_tua' => formValue('nama_orang_tua', true, 150),
            'nip' => formValue('nip', true, 50),
            'pekerjaan' => formValue('pekerjaan', false, 100),
            'pangkat' => formValue('pangkat', true, 100),
            'instansi' => formValue('instansi', true, 150),
            'jurusan' => requireOption($kon, 'tb_jurusan', 'nama_jurusan', 'jurusan', 'jurusan'),
            'prodi' => requireOption($kon, 'tb_prodi', 'program_studi', 'prodi', 'program studi'),
            'tanggal_cetak' => $today,
        ];
        break;

    case 'penelitian':
        $table = 'tb_surat_penelitian';
        $phone = formValue('no_hp', true, 30);
        if (!preg_match('/^[0-9+(). -]{8,30}$/', $phone) || preg_match_all('/[0-9]/', $phone) < 8) submissionFail('Nomor HP tidak valid.');
        $tugasAkhir = formValue('tugas_akhir', true, 100);
        if (!in_array($tugasAkhir, ['Skripsi', 'Karya Tulis Ilmiah(KTI)'], true)) submissionFail('Pilihan tugas akhir tidak valid.');
        $data += [
            'no_hp' => $phone,
            'lama_penelitian' => formValue('lama_penelitian', true, 100),
            'tempat_penelitian' => formValue('tempat_penelitian', true, 1000),
            'judul_kti' => formValue('judul_kti', true, 1000),
            'jurusan' => requireOption($kon, 'tb_jurusan', 'nama_jurusan', 'jurusan', 'jurusan'),
            'prodi' => requireOption($kon, 'tb_prodi', 'program_studi', 'prodi', 'program studi'),
            'tugas_akhir' => $tugasAkhir,
            'tujuan' => formValue('tujuan', true, 255),
            'tanggal_cetak' => $today,
            'tahun_akademik' => requireOption($kon, 'tb_tahun_akademik', 'tahun_akademik', 'tahun_akademik', 'tahun akademik'),
            'tembusan' => formValue('tembusan', true, 1000),
        ];
        break;

    case 'pra_penelitian':
        $table = 'tb_surat_pra_penelitian';
        $phone = formValue('no_hp', true, 30);
        if (!preg_match('/^[0-9+(). -]{8,30}$/', $phone) || preg_match_all('/[0-9]/', $phone) < 8) submissionFail('Nomor HP tidak valid.');
        $tugasAkhir = formValue('tugas_akhir', true, 100);
        if (!in_array($tugasAkhir, ['Karya Tulis Ilmiah (KTI)', 'Laporan Tugas Akhir (LTA)', 'Skripsi'], true)) submissionFail('Pilihan tugas akhir tidak valid.');
        $data += [
            'no_hp' => $phone,
            'judul_kti' => formValue('judul_kti', true, 1000),
            'lokasi' => formValue('lokasi', true, 1000),
            'jurusan' => requireOption($kon, 'tb_jurusan', 'nama_jurusan', 'jurusan', 'jurusan'),
            'prodi' => requireOption($kon, 'tb_prodi', 'program_studi', 'prodi', 'program studi'),
            'tugas_akhir' => $tugasAkhir,
            'tujuan' => formValue('tujuan', true, 255),
            'tahun_akademik' => requireOption($kon, 'tb_tahun_akademik', 'tahun_akademik', 'tahun_akademik', 'tahun akademik'),
            'tanggal_cetak' => $today,
            'keterangan' => '',
        ];
        break;
}

$columns = array_keys($data);
$quotedColumns = '`' . implode('`, `', $columns) . '`';
$placeholders = implode(', ', array_fill(0, count($data), '?'));
$insert = mysqli_prepare($kon, "INSERT INTO `$table` ($quotedColumns) VALUES ($placeholders)");
if (!$insert) {
    error_log('Student submission prepare failed for ' . $table . ': ' . mysqli_error($kon));
    submissionFail('Pengajuan gagal disimpan. Silakan coba kembali atau hubungi administrator.', 500);
}
$values = array_values($data);
$bindArgs = [str_repeat('s', count($values))];
foreach ($values as $index => &$value) {
    $bindArgs[] = &$value;
}
unset($value);
call_user_func_array([$insert, 'bind_param'], $bindArgs);
$saved = mysqli_stmt_execute($insert);
mysqli_stmt_close($insert);
if (!$saved) {
    error_log('Student submission insert failed for ' . $table . ': ' . mysqli_error($kon));
    submissionFail('Pengajuan gagal disimpan. Silakan coba kembali atau hubungi administrator.', 500);
}

header('Location: ' . $redirects[$type], true, 303);
exit;
