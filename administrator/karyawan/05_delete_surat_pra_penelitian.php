<?php
include "../config/koneksi.php";

$id   = (int)($_GET['id_surat_pra_penelitian'] ?? 0);
$nama = mysqli_real_escape_string($kon, $_GET['nama_mahasiswa'] ?? '');

if ($id > 0) {
    mysqli_query($kon, "DELETE FROM tb_surat_pra_penelitian WHERE id_surat_pra_penelitian = $id");
}

echo "<script>alert('Data berhasil dihapus'); window.location='05_daftar_surat_pra_penelitian.php?nama_mahasiswa=$nama'</script>";
?>