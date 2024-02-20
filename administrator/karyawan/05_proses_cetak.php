
<?php
if($_GET['halaman'] == 0)
{
	include "../config/koneksi.php";	
	mysql_query("update tb_surat_pra_penelitian set status = 'Sudah Dicetak' where id_surat_pra_penelitian ='$_GET[id_surat_pra_penelitian]'");
	echo"<script>window.location='05_daftar_surat_pra_penelitian.php?id_surat_pra_penelitian=$_GET[id_surat_pra_penelitian]'</script>";
}
else
{
	include "../config/koneksi.php";	
	mysql_query("update tb_surat_pra_penelitian set status = 'Sudah Dicetak' where id_surat_pra_penelitian ='$_GET[id_surat_pra_penelitian]'");
	echo"<script>window.location='05_daftar_surat_pra_penelitian.php?halaman=$_GET[halaman]'</script>";
}
?>
