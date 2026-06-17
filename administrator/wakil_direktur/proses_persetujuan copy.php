<?php
session_start();
include "../config/koneksi.php";

// Validasi session
if (!isset($_SESSION['level']) || $_SESSION['level'] != 'wakil_direktur') {
    header('location:../index.php');
    exit;
}

$aksi       = isset($_GET['aksi'])    ? $_GET['aksi']    : '';
$jenis      = isset($_GET['jenis'])   ? $_GET['jenis']   : '';
$id         = isset($_GET['id'])      ? (int)$_GET['id'] : 0;
$catatan    = isset($_POST['catatan']) ? mysqli_real_escape_string($kon, $_POST['catatan']) : '';
$tanggal    = date('Y-m-d');
$return_url = isset($_GET['return'])  ? $_GET['return']  : 'index.php';

// Mapping jenis surat ke tabel dan kolom PK
$mapping = [
    'ket_lulus'   => ['tabel' => 'tb_surat_keterangan_lulus',        'pk' => 'id_surat_keterangan_lulus'],
    'masih_kuliah'=> ['tabel' => 'tb_surat_keterangan_masih_kuliah', 'pk' => 'id_surat_keterangan_masih_kuliah'],
    'pra_penelitian'=> ['tabel' => 'tb_surat_pra_penelitian',        'pk' => 'id_surat_pra_penelitian'],
    'penelitian'  => ['tabel' => 'tb_surat_penelitian',              'pk' => 'id_surat_penelitian'],
];

if (!array_key_exists($jenis, $mapping) || $id == 0) {
    echo "<script>alert('Parameter tidak valid!'); window.history.back();</script>";
    exit;
}

$tabel = $mapping[$jenis]['tabel'];
$pk    = $mapping[$jenis]['pk'];

if ($aksi == 'setujui') {
    $sql = "UPDATE `$tabel` SET 
                `status_persetujuan` = 'Disetujui',
                `catatan_penolakan`  = '',
                `tanggal_persetujuan`= '$tanggal'
            WHERE `$pk` = $id";
    mysqli_query($kon, $sql);
    header("location: $return_url?pesan=disetujui");
    exit;

} elseif ($aksi == 'tolak') {
    // Tampilkan form catatan penolakan jika belum submit
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
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-remove-circle"></i> Konfirmasi Penolakan Surat</h4></div>
        <div class="panel-body">
            <form method="post" action="proses_persetujuan.php?aksi=tolak&jenis=<?php echo $jenis; ?>&id=<?php echo $id; ?>&return=<?php echo urlencode($return_url); ?>">
                <div class="form-group">
                    <label>Catatan / Alasan Penolakan <span class="text-danger">*</span></label>
                    <textarea name="catatan" class="form-control" rows="4" placeholder="Tuliskan alasan penolakan..." required></textarea>
                </div>
                <input type="hidden" name="submit_tolak" value="1">
                <button type="submit" class="btn btn-danger btn-block">
                    <i class="glyphicon glyphicon-remove"></i> Tolak Surat
                </button>
                <a href="<?php echo $return_url; ?>" class="btn btn-default btn-block">Batal</a>
            </form>
        </div>
    </div>
</div>
<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
</body>
</html>
<?php
        exit;
    }

    // Submit penolakan
    $sql = "UPDATE `$tabel` SET 
                `status_persetujuan` = 'Ditolak',
                `catatan_penolakan`  = '$catatan',
                `tanggal_persetujuan`= '$tanggal'
            WHERE `$pk` = $id";
    mysqli_query($kon, $sql);
    header("location: $return_url?pesan=ditolak");
    exit;

} else {
    echo "<script>alert('Aksi tidak dikenal!'); window.history.back();</script>";
}
?>
