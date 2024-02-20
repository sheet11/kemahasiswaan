<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_surat_penelitian where id_surat_penelitian ='$_GET[id_surat_penelitian]'");
	echo"<script>alert('Data berhasil di hapus');window.location='04_daftar_surat_penelitian.php'</script>";
?>
