<?php
include "../config/koneksi.php";

$id   = (int)($_GET['id_surat_penelitian'] ?? 0);
$nama = mysqli_real_escape_string($kon, $_GET['nama_mahasiswa'] ?? '');

if ($id > 0) {
    mysqli_query($kon, "DELETE FROM tb_surat_penelitian WHERE id_surat_penelitian = $id");
}

echo "<script>alert('Data berhasil dihapus'); window.location='04_daftar_surat_penelitian.php?nama_mahasiswa=$nama'</script>";
?>