<?php 
	error_reporting(0); 
    include "session.php"; 
?>

<?php
		require_once("../config/koneksi.php");
		
		$query=mysql_query("update tb_surat_penelitian set status = 'Sudah Dicetak' where id_surat_penelitian = '$_GET[id_surat_penelitian]'");
														
	if($query) { 
			echo "<script>window.location='04_daftar_surat_penelitian.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Verifikasi');window.location='04_daftar_surat_penelitian.php'</script>";
	}
?>