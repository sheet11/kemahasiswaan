<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'wakil_direktur') {
    header('location:../index.php'); exit;
}

$aksi       = isset($_GET['aksi'])   ? $_GET['aksi']    : '';
$jenis      = isset($_GET['jenis'])  ? $_GET['jenis']   : '';
$id         = isset($_GET['id'])     ? (int)$_GET['id'] : 0;
$catatan    = isset($_POST['catatan']) ? mysqli_real_escape_string($kon, $_POST['catatan']) : '';
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

$cek = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM `$tabel` WHERE `$pk`=$id"));
if (!$cek) { echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>"; exit; }

// ── Setujui ───────────────────────────────────────────────────────────────────
if ($aksi == 'setujui') {
    // Wadir hanya bisa setujui jika sudah divalidasi karyawan
    if ($cek['status_persetujuan'] != 'Disetujui_Resepsionis') {
        echo "<script>alert('Surat ini belum divalidasi oleh Karyawan.'); window.history.back();</script>"; exit;
    }
    mysqli_query($kon, "UPDATE `$tabel` SET 
        status_persetujuan  = 'Disetujui',
        catatan_penolakan   = '',
        tanggal_persetujuan = '$tanggal'
        WHERE `$pk` = $id");
    header("location: $return_url?pesan=disetujui"); exit;

// ── Tolak ─────────────────────────────────────────────────────────────────────
} elseif ($aksi == 'tolak') {
    // Tampilkan form catatan jika belum submit
    if (!isset($_POST['submit_tolak'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tolak Surat</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>body{padding:30px;}</style>
</head>
<body>
<div class="container" style="max-width:500px;">
    <div class="panel panel-danger">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-remove-circle"></i> Tolak Surat — Wadir</h4></div>
        <div class="panel-body">
            <p class="text-muted">Surat yang ditolak wadir akan dikembalikan ke mahasiswa dengan keterangan untuk mengajukan surat baru.</p>
            <form method="post" action="proses_persetujuan.php?aksi=tolak&jenis=<?php echo $jenis; ?>&id=<?php echo $id; ?>&return=<?php echo urlencode($return_url); ?>">
                <div class="form-group">
                    <label>Catatan / Alasan Penolakan <span class="text-danger">*</span></label>
                    <textarea name="catatan" class="form-control" rows="4" placeholder="Tuliskan alasan penolakan..." required></textarea>
                </div>
                <input type="hidden" name="submit_tolak" value="1">
                <button type="submit" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-remove"></i> Tolak Surat</button>
                <a href="<?php echo $return_url; ?>" class="btn btn-default btn-block">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
        exit;
    }

    // Proses penolakan — status kembali ke mahasiswa dengan keterangan ajukan surat baru
    $pesan_tolak = $catatan ? $catatan : 'Surat ditolak oleh Wadir. Silahkan ajukan surat baru.';
    mysqli_query($kon, "UPDATE `$tabel` SET 
        status_persetujuan  = 'Ditolak_Wadir',
        catatan_penolakan   = '$pesan_tolak',
        tanggal_persetujuan = '$tanggal'
        WHERE `$pk` = $id");
    header("location: $return_url?pesan=ditolak"); exit;

} else {
    echo "<script>alert('Aksi tidak dikenal!'); window.history.back();</script>";
}
?>