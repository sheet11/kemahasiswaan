
<?php
if($_GET['halaman'] == 0)
{
	include "../config/koneksi.php";	
	mysql_query("update tb_surat_keterangan_masih_kuliah set status = 'Sudah Dicetak' where id_surat_keterangan_masih_kuliah ='$_GET[id_surat_keterangan_masih_kuliah]'");
	echo"<script>window.location='03_daftar_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah=$_GET[id_surat_keterangan_masih_kuliah]'</script>";
}
else
{
	include "../config/koneksi.php";	
	mysql_query("update tb_surat_keterangan_masih_kuliah set status = 'Sudah Dicetak' where id_surat_keterangan_masih_kuliah ='$_GET[id_surat_keterangan_masih_kuliah]'");
	echo"<script>window.location='03_daftar_surat_keterangan_masih_kuliah.php?halaman=$_GET[halaman]'</script>";
}
?>
