<?php
session_start();
include "../config/koneksi.php";

$id      = isset($_GET['id_surat_pra_penelitian']) ? $_GET['id_surat_pra_penelitian'] : '';
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 0;

mysqli_query($kon, "UPDATE tb_surat_pra_penelitian 
                    SET keterangan = 'Belum Dicetak Karena Nama, Judul dan Tujuan dibuat Huruf besar, seharusnya dibuat awal kata saja huruf besar' 
                    WHERE id_surat_pra_penelitian = '$id'");

if ($halaman == 0) {
    echo "<script>window.location='05_daftar_surat_pra_penelitian.php?id_surat_pra_penelitian=$id'</script>";
} else {
    echo "<script>window.location='05_daftar_surat_pra_penelitian.php?halaman=$halaman'</script>";
}
?>