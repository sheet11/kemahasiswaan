<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		
		
		$query=mysql_query("update tb_sertifikat_pps set nama_lengkap = '$_POST[nama_lengkap]'
												  where id_sertifikat= '$_POST[id_sertifikat]'");					
				if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='06_daftar_sertifikat_pps.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='06_daftar_sertifikat_pps.php'</script>";
	}
?>	
