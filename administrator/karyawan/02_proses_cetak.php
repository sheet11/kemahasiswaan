
<?php
if($_GET['halaman'] == 0)
{
	include "../config/koneksi.php";	
	mysql_query("update tb_surat_keterangan_lulus set status = 'Sudah Dicetak' where id_surat_keterangan_lulus ='$_GET[id_surat_keterangan_lulus]'");
	echo"<script>window.location='02_daftar_surat_keterangan_lulus.php?id_surat_keterangan_lulus=$_GET[id_surat_keterangan_lulus]'</script>";
}
else
{
	include "../config/koneksi.php";	
	mysql_query("update tb_surat_keterangan_lulus set status = 'Sudah Dicetak' where id_surat_keterangan_lulus='$_GET[id_surat_keterangan_lulus]'");
	echo"<script>window.location='02_daftar_surat_keterangan_lulus.php?halaman=$_GET[halaman]'</script>";
}
?>
