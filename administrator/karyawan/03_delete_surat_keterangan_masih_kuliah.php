<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_surat_keterangan_masih_kuliah where id_surat_keterangan_masih_kuliah ='$_GET[id_surat_keterangan_masih_kuliah]'");
	echo"<script>alert('Data berhasil di hapus');window.location='03_daftar_surat_keterangan_masih_kuliah.php'</script>";
?>
