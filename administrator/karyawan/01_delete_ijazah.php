<?php
	include "../config/koneksi.php";	
	mysqli_query($kon, "delete from tb_ijazah where id_ijazah ='$_GET[id_ijazah]'");
	echo"<script>alert('Data berhasil di hapus');window.location='01_daftar_ijazah.php'</script>";
?>
