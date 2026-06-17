<?php
/**
 * proses_karyawan.php  –  folder: karyawan/
 *
 * Aksi review surat oleh karyawan dari halaman preview.
 *
 * Alur status_persetujuan:
 *   Mahasiswa ajukan  → 'Menunggu'
 *   Karyawan setujui  → 'Disetujui_Resepsionis'  (masuk antrian wadir)
 *   Karyawan tolak    → 'Perlu_Revisi'            (kembali ke mahasiswa)
 *   Mahasiswa revisi  → 'Telah_Direvisi'          (kembali ke karyawan)
 *   Wadir setujui     → 'Disetujui'              (tombol cetak muncul)
 */

session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'karyawan') {
    header('location:../index.php'); exit;
}

$aksi       = isset($_GET['aksi'])   ? $_GET['aksi']    : '';
$jenis      = isset($_GET['jenis'])  ? $_GET['jenis']   : '';
$id         = isset($_GET['id'])     ? (int)$_GET['id'] : 0;
$return_url = isset($_GET['return']) ? $_GET['return']  : 'index.php';

$mapping = [
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
if (!$cek) {
    echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>"; exit;
}

// ── SETUJUI → teruskan ke wadir ──────────────────────────────────────────────
if ($aksi == 'setujui') {
    mysqli_query($kon, "UPDATE `$tabel` SET
        status_persetujuan = 'Disetujui_Resepsionis',
        catatan_penolakan  = NULL,
        is_revisi          = 0
        WHERE `$pk` = $id");
    header("location: $return_url?pesan=disetujui");
    exit;
}

// ── TOLAK → kembalikan ke mahasiswa dengan status Perlu_Revisi ───────────────
if ($aksi == 'tolak') {

    if (!isset($_POST['submit_tolak'])):
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tolak Surat</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body { padding: 40px; background: #f4f4f4; }
        .panel { border-radius: 6px; }
    </style>
</head>
<body>
<div class="container" style="max-width:520px; margin-top:20px;">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h4><i class="fa fa-edit"></i> Kembalikan ke Mahasiswa untuk Direvisi</h4>
        </div>
        <div class="panel-body">
            <p class="text-muted">
                Berikan catatan yang jelas agar mahasiswa tahu apa yang perlu diperbaiki.
                Surat akan berstatus <strong>"Perlu Revisi"</strong> di akun mahasiswa.
            </p>
            <form method="post"
                  action="proses_karyawan.php?aksi=tolak&jenis=<?php echo htmlspecialchars($jenis); ?>&id=<?php echo $id; ?>&return=<?php echo urlencode($return_url); ?>">
                <div class="form-group">
                    <label>Catatan Revisi <span class="text-danger">*</span></label>
                    <textarea name="catatan" class="form-control" rows="5"
                              placeholder="Contoh: Nama orang tua belum diisi dengan benar, mohon diperbaiki."
                              required></textarea>
                </div>
                <input type="hidden" name="submit_tolak" value="1">
                <button type="submit" class="btn btn-warning btn-block">
                    <i class="fa fa-undo"></i> Kembalikan ke Mahasiswa
                </button>
                <a href="<?php echo htmlspecialchars($return_url); ?>"
                   class="btn btn-default btn-block" style="margin-top:6px;">
                    <i class="fa fa-arrow-left"></i> Batal
                </a>
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
<?php
        exit;
    endif;

    // Simpan catatan dan ubah status ke Perlu_Revisi
    $catatan = mysqli_real_escape_string($kon, $_POST['catatan']);
    $result  = mysqli_query($kon, "UPDATE `$tabel` SET
        status_persetujuan = 'Perlu_Revisi',
        catatan_penolakan  = '$catatan',
        is_revisi          = 1
        WHERE `$pk` = $id");

    if (!$result) {
        echo "<script>alert('Query gagal: " . mysqli_error($kon) . "'); window.history.back();</script>";
        exit;
    }

    header("location: $return_url?pesan=perlu_revisi");
    exit;
}

echo "<script>alert('Aksi tidak dikenal!'); window.history.back();</script>";
?>