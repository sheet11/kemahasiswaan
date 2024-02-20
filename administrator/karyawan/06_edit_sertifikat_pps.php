<?php include"01_nav.php";?>
<?php error_reporting(0); ?>

<?php
	require_once("../config/koneksi.php");
	include "../assets/js/date.php";
	$query=mysql_query("select * from tb_sertifikat_pps where id_sertifikat='$_GET[id_sertifikat]'");
	$a=mysql_fetch_array($query);
	
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="06_prosesedit_sertifikat_pps.php" enctype="multipart/form-data">	
		<table width="100%" border="0" class="table table-hover">
			<input type="hidden" name="id_sertifikat" value="<?php echo "$a[id_sertifikat]"; ?>">
		<tr>
			<td align="left" colspan="2"><b><h4>Edit Sertifikat PPS</b></h4></td> 
		</tr>

		<tr>
			<td colspan="2">Nama Mahasiswa</td> 
		</tr>
		<tr>
			<td colspan="2"><input type="text" placeholder="Nama Lengkap" name="nama_lengkap" required="yes" class="form-control" value="<?php echo "$a[nama_lengkap]"; ?>"></td>
		</tr>

		<tr>	
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
				<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
		</tr>
		</table>
	</form>
	</div>
</div>
