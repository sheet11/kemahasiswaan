<?php

include "../config/koneksi.php";

$id = $_GET['id_surat_keterangan_masih_kuliah'];

mysqli_query(
    $kon,
    "DELETE FROM tb_surat_keterangan_masih_kuliah 
    WHERE id_surat_keterangan_masih_kuliah='$id'"
);

echo "
<script>
    alert('Data berhasil di hapus');
    window.location='03_daftar_surat_keterangan_masih_kuliah.php';
</script>
";

?>
