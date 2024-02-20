<?php 	include"01_nav.php";
		include"../assets/js/date.php";
?>

<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">	
		<form method="post" action="" enctype="multipart/form-data">	
		<table style="width:100%" class="table table-bordered">
			<tr>
			<td colspan="2"><b><h4>Tambah Data Ijazah</b></h4></td> 
			</tr>
				
			<tr>
				<td colspan="2"><input type="text" placeholder="Nama Lengkap" name="nama_lengkap" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="2"><input type="text" placeholder="NIM" name="nim" class="form-control"></td>				
			</tr>

			<tr>
				<td colspan="2"><input type="text" placeholder="Tempat dan Tanggal Lahir " name="tempatdantgl_lahir" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="2"><input type="text" placeholder="NIK" name="nik" class="form-control"></td>
			</tr>

			</tr>
				<td colspan="2"><input type="text" placeholder="No Seri ijazah" name="no_seri_ijazah" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="2"><input type="text" placeholder="Jurusan" name="jurusan" class="form-control" ></td> 
			</tr>

			<tr>
				<td colspan="2"><input type="text" placeholder="Program Pendidikan" name="program_pendidikan" class="form-control" ></td> 
			</tr>

			<tr>
				<td colspan="2"><input type="text" placeholder="Dalam Teks" name="tanggal_wisudah" class="form-control"></td> 
			</tr>

			<tr>
				<td colspan="2"><input type="text" placeholder="Gelar" name="gelar" class="form-control"></td> 
			</tr>

			<tr>
				<td><input type="text" placeholder="Tempat Cetak" name="tempat_cetak" class="form-control"></td>
				<td><input type="text" placeholder="Tanggal Cetak" id="tgld" name="tanggal_cetak" class="form-control"></td>
			</tr>

			<tr>
				<td><input type="text" placeholder="Nama Pudir" name="pudir" class="form-control"></td>
				<td><input type="text" placeholder="NIP Pudir" name="nip_pudir" class="form-control"></td>
			</tr>

			<tr>
				<td><input type="text" placeholder="Nama Direktur" name="direktur" class="form-control"></td>
				<td><input type="text" placeholder="NIP Direktur" name="nip_direktur" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="2"><input type="text" placeholder="No Registrasi" name="no_registrasi" class="form-control"></td>				
			</tr>

			<tr>
				<td>Gambar Ijazah</td>	
				<td colspan="3"><input type="file" name="gambar" class="form-control"></td>
			</tr>

			<tr>	
				<td colspan="4">
					<input type="submit" name="submit" value="SIMPAN"  class="btn btn-primary">
					<input type="reset" name="submit" value="Hapus" class="btn btn-danger">
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>
		<?php
			include"../config/koneksi.php";
	
				if(isset($_POST['submit'])){
					$nama_file = $_FILES['gambar']['name'];
					$ukuran_file = $_FILES['gambar']['size'];
					$tipe_file = $_FILES['gambar']['type'];
					$tmp_file = $_FILES['gambar']['tmp_name'];
					$tanggal = date('Y-m-d');
					
					$path = "../assets/img/".$nama_file;
					
					if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
						if($ukuran_file <= 1000000){
							if(move_uploaded_file($tmp_file, $path)){
								$query = mysql_query("insert into tb_ijazah(nama_lengkap, nim, 
																tempatdantgl_lahir, 
																nik,
																no_seri_ijazah, 
																jurusan, 
																program_pendidikan, 
																tanggal_wisudah, 
																gelar, 
																tempat_cetak, 
																tanggal_cetak, 
																pudir,
																nip_pudir, 
																direktur, 
																nip_direktur, 
																no_registrasi,
																gambar_ijazah)
									values('$_POST[nama_lengkap]',
																'$_POST[nim]',
																'$_POST[tempatdantgl_lahir]',
																'$_POST[nik]',
																'$_POST[no_seri_ijazah]',
																'$_POST[jurusan]',
																'$_POST[program_pendidikan]',
																'$_POST[tanggal_wisudah]',
																'$_POST[gelar]',
																'$_POST[tempat_cetak]',
																'$_POST[tanggal_cetak]',
																'$_POST[pudir]',
																'$_POST[nip_pudir]',
																'$_POST[direktur]',
																'$_POST[nip_direktur]',
																'$_POST[no_registrasi]',
																'".$nama_file."')");
								if($query){
									echo"<script>alert('Data Berhasil di Simpan');window.location='01_daftar_ijazah.php'</script>";
								}
								else{
									echo"<script>alert('Data Gagal di Simpan');window.location='01_daftar_ijazah.php'</script>";
								}
							}else{
								echo"<script>alert('Gambar Gagal di Simpan');window.location='01_daftar_ijazah.php'</script>";
							}
						}else{
							echo"<script>alert('Maaf Ukuran Gambar Tidak Boleh Melebihi 1MB');window.location='01_daftar_ijazah.php'</script>";
						}
					}else{
						echo"<script>alert('Maaf Type Gambar harus JPG , JPEG, PNG');window.location='01_daftar_ijazah.php'</script>";
					}
				}				
		?>
	</body>
</html>
