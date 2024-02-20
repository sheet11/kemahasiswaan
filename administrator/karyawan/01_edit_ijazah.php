<?php include"01_nav.php";?>
<?php error_reporting(0); ?>

<?php
	require_once("../config/koneksi.php");
	include "../assets/js/date.php";
	$query=mysqli_query($kon, "select * from tb_ijazah where id_ijazah='$_GET[id_ijazah]'");
	$a=mysqli_fetch_array($query);
	
?>
	
<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">	
		<form method="post" action="01_prosesedit_ijazah.php" enctype="multipart/form-data">	
		<table width="100%" border="0" class="table table-bordered">
			<input type="hidden" name="id_ijazah" value="<?php echo "$a[id_ijazah]"; ?>">
		<tr>
			<td colspan="3" class="info"><b>Edit Ijazah</b></td> 
		</tr>

		<tr>
			<td width="25%">Nama Lengkap</td> 
			<td width="2%">:</td>
			<td><input type="text" placeholder="Nama Lengkap" name="nama_lengkap" class="form-control" value="<?php echo "$a[nama_lengkap]"; ?>"></td> 
		</tr>

		<tr>
			<td>NIM</td> 
			<td>:</td>
			<td><input type="text" placeholder="NIM" name="nim" class="form-control" value="<?php echo "$a[nim]"; ?>"></td> 
		</tr>

		<tr>
			<td>Tempat/Tanggal Lahir</td>
			<td>:</td>
			<td><input type="text" placeholder="Tempat dan Tgl Lahir" name="tempatdantgl_lahir" class="form-control" value="<?php echo "$a[tempatdantgl_lahir]"; ?>"></td>
		</tr>

		<tr>
			<td>NIK</td>
			<td>:</td> 
			<td><input type="text" name="nik" class="form-control" value="<?php echo "$a[nik]"; ?>"></td> 
		</tr>

		<tr>
			<td>No Seri Ijazah</td>
			<td>:</td> 
			<td><input type="text" placeholder="No Seri Ijazah" name="no_seri_ijazah" class="form-control" value="<?php echo "$a[no_seri_ijazah]"; ?>"></td> 
		</tr>

		<tr>
			<td>Jurusan</td> 
			<td>:</td>
			<td><input type="text" placeholder="Jurusan" name="jurusan" class="form-control" value="<?php echo "$a[jurusan]"; ?>"></td> 
		</tr>

		<tr>
			<td>Program Pendidikan</td> 
			<td>:</td>
			<td><input type="text" placeholder="Program Pendidikan" name="program_pendidikan" class="form-control" value="<?php echo "$a[program_pendidikan]"; ?>"></td> 
		</tr>

		<tr>
			<td>Tanggal Yudisium</td> 
			<td>:</td>
			<td><input type="text" placeholder="Dalam Teks" name="tanggal_wisudah" class="form-control" value="<?php echo "$a[tanggal_wisudah]"; ?>"></td> 
		</tr>

		<tr>
			<td>Gelar</td> 
			<td>:</td>
			<td><input type="text" placeholder="Gelar" name="gelar" class="form-control" value="<?php echo "$a[gelar]"; ?>"></td> 
		</tr>

		<tr>
			<td>Tempat Cetak</td> 
			<td>:</td>
			<td><input type="text" placeholder="Tempat Cetak" name="tempat_cetak" class="form-control" value="<?php echo "$a[tempat_cetak]"; ?>"></td>
		</tr>

		<tr>
			<td>Tanggal Cetak</td>
			<td>:</td>
			<td><input type="text" placeholder="Tanggal Cetak" name="tanggal_cetak" class="form-control" value="<?php echo "$a[tanggal_cetak]"; ?>"></td>
		</tr>

		<tr>
			<td>Nama Kajur</td>
			<td>:</td>
			<td><input type="text" placeholder="Nama Pudir" name="pudir" class="form-control" value="<?php echo "$a[pudir]"; ?>"></td>
		</tr>

		<tr>
			<td>NIP Kajur</td>
			<td>:</td>
			<td><input type="text" placeholder="NIP Pudir" name="nip_pudir" class="form-control" value="<?php echo "$a[nip_pudir]"; ?>"></td>
		</tr>

		<tr>
			<td>Nama Direktur</td> 
			<td>:</td>
			<td><input type="text" placeholder="Nama Direktur" name="direktur" class="form-control" value="<?php echo "$a[direktur]"; ?>"></td>
		</tr>

		<tr>
			<td>NIP Direktur</td>
			<td>:</td>
			<td><input type="text" placeholder="NIP Direktur" name="nip_direktur" class="form-control" value="<?php echo "$a[nip_direktur]"; ?>"></td>
		</tr>

		<tr>
			<td>No Registrasi</td>
			<td>:</td>
			<td><input type="text" placeholder="No Registrasi" name="no_akreditasi_prodi" class="form-control" value="<?php echo "$a[no_akreditasi_prodi]"; ?>"></td>				
		</tr>

		<tr>
			<td colspan="2">&nbsp;</td>
			
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
				<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
		</tr>
		</table>
	</form>
	</div>
</div>
