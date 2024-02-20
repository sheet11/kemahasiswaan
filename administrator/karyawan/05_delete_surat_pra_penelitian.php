<?php
	include "../config/koneksi.php";
	$nama_mahasiswa = $_GET['nama_mahasiswa'];	
	mysql_query("delete from tb_surat_pra_penelitian where id_surat_pra_penelitian ='$_GET[id_surat_pra_penelitian] '");
	echo"<script>alert('Data berhasil di hapus');window.location='05_daftar_surat_pra_penelitian.php?nama_mahasiswa=$nama_mahasiswa'</script>";
?>
