<?php
include "../config/koneksi.php";
error_reporting(0);

$id = (int) ($_GET['id_user'] ?? 0);

if ($id) {
    mysqli_query($kon, "DELETE FROM tb_user WHERE id_user=$id");
}

echo "<script>window.location.href='user_edit.php?pesan=hapus';</script>";
exit;