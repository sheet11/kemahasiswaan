<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_sertifikat_pps where id_sertifikat ='$_GET[id_sertifikat]'");
	echo"<script>alert('Data berhasil di hapus');window.location='06_daftar_sertifikat_pps.php'</script>";
?>
