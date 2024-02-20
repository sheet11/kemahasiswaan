<?php 	include"01_nav.php";
		include"../assets/js/date.php";
?>
<?php


if($_SESSION['level'] == "karyawan"){ ?>
<aside class="right-side">
    <section class="content-header">
        <div class="container-fluid" style="margin:10px;"> 
		<form method="post" action="" enctype="multipart/form-data">	
		<table style="width:100%" class="table table-basic">
			<tr>
			<td colspan="2"><b><h4>Tambah Data Surat Keterangan Lulus</b></h4></td> 
			</tr>

			<tr>
				<td colspan="2"><b>Nama Mahasiswa</b></td> 
			</tr>
			<tr>
				<td colspan="2"><input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa" required="yes" class="form-control"> </td>
			<tr>

			<tr>
				<td colspan="2"><b>NIM Mahasiswa</b></td> 
			</tr>
			</tr>
				<td colspan="2"><input type="text" placeholder="Contoh : P05120213069" name="nim_mahasiswa" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="2"><b>Keperluan</b></td> 
			</tr>
			<tr>
				<td colspan="2"><select name="keperluan" type="select" class="form-control">
	    			<option value="">-- Silahkan Dipilih --</option>
					<option value="Melamar Pekerjaan">Melamar Pekerjaan</option>
					<option value="Kenaikan Pangkat">Kenaikan Pangkat</option>
					<option value="Melanjutkan Pendidikan">Melanjutkan Pendidikan</option>
					<option value="Melanjutkan Pendidikan dan Melamar Pekerjaan">Melanjutkan Pendidikan dan Melamar Pekerjaan</option>
	          		</select></td>
			</tr>

			<tr>
				<td ><b>Tempat </b></td><td><b>Tanggal Lahir</b></td> 
			</tr>
			<tr>
				<td><input type="text" placeholder="Tempat Lahir " name="tempat_lahir" class="form-control"></td>
				<td><input type="text" id="tgls" placeholder="Format  : Tahun-Bulan-Tanggal" name="tanggal_lahir" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="2">Jurusan</td>
			</tr>
			<tr>
				<td colspan="2"><select name="jurusan" type="select" class="form-control">
					<option value="">-- Silahkan Dipilih --</option>
                    <?php include "../config/koneksi.php";
                    $query = mysql_query("SELECT * FROM tb_jurusan ");
                    while ($row = mysql_fetch_array($query)) {
                    echo" <option value='$row[nama_jurusan]'>$row[nama_jurusan]</option>";
                             } ?>
                    echo" </select></td>
			</tr>

			<tr>
				<td colspan="2">Prodi</td>
			</tr>
			<tr>
				<td colspan="2"><select name='prodi' class='form-control' >";
                            <option value="">-- Silahkan Dipilih --</option>
                            <?php include "../config/koneksi.php";
                            $query = mysql_query("SELECT * FROM tb_prodi ");
                            while ($row = mysql_fetch_array($query)) {
                             echo"
                            <option value='$row[program_studi]'>$row[program_studi]</option>
                            ";
                             }
                            ?>
                            echo"</select></td>
			</tr>

			<tr>
				<td colspan="2"><b>Tanggal SK</b></td> 
			</tr>
			</tr>
				<td colspan="2"><input type="text" id="tglf" placeholder="Tanggal SK" name="tanggal_sk" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="2"><b>Tanggal Wisudah</b></td> 
			</tr>
			</tr>
				<td colspan="2"><input type="text" id="tgld" placeholder="Tanggal Wisudah" name="tanggal_wisudah" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="2"><b>Tanggal Cetak</b></td> 
			</tr>
			<tr>
				<td colspan="2"><input type="text" id="tglg" placeholder="Format  : Tahun-Bulan-Tanggal" name="tanggal_cetak" class="form-control"></td>
			</tr>


			<tr>	
				<td colspan="4">
					<input type="submit" name="submit" value="Simpan"  class="btn btn-primary">
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
														
				$query=mysql_query("insert into tb_surat_keterangan_lulus(nama_mahasiswa, nim_mahasiswa, keperluan, tempat_lahir, tanggal_lahir, jurusan,  prodi, tahun_akademik, tanggal_wisudah, tanggal_sk, tanggal_cetak)
									values('$_POST[nama_mahasiswa]','$_POST[nim_mahasiswa]','$_POST[keperluan]','$_POST[tempat_lahir]','$_POST[tanggal_lahir]','$_POST[jurusan]','$_POST[prodi]','$_POST[tahun_akademik]','$_POST[tanggal_wisudah]','$_POST[tanggal_sk]','$_POST[tanggal_cetak]')");
					
										
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='02_daftar_surat_keterangan_lulus.php'</script>";
					}
				}					
		?>


				
<?php } ?>	 	
	</body>
</html>
