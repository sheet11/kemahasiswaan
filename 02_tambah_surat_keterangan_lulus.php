<?php 	include"01_nav.php";
		include"../assets/js/date.php";
?>

<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">
			<form method="post" action="" enctype="multipart/form-data">	
				<table style="width:100%" class="table table-basic">
					<tr>
					<td class="info"><b>Tambah Data Surat Keterangan Lulus</b></td> 
					</tr>

					<tr>
						<td><b>Nama Mahasiswa</b></td> 
					</tr>
					<tr>
						<td><input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa" required="yes" class="form-control" value="<?=$u['nama_lengkap'];?>" disabled> </td>
					<tr>

					<tr>
						<td><b>NIM Mahasiswa</b></td> 
					</tr>
					</tr>
						<td><input type="text" placeholder="Contoh : P05120213069" name="nim_mahasiswa" class="form-control" value="<?=$u['username'];?>" disabled></td>
					</tr>

					<tr>
						<td><b>Keperluan</b></td> 
					</tr>
					<tr>
						<td><select name="keperluan" type="select" class="form-control">
			    			<option value="">-- Silahkan Dipilih --</option>
							<option value="Melamar Pekerjaan">Melamar Pekerjaan</option>
							<option value="Kenaikan Pangkat">Kenaikan Pangkat</option>
							<option value="Melanjutkan Pendidikan">Melanjutkan Pendidikan</option>
							<option value="Melanjutkan Pendidikan dan Melamar Pekerjaan">Melanjutkan Pendidikan dan Melamar Pekerjaan</option>
			          		</select></td>
					</tr>

					<tr>
						<td ><b>Tempat </b></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Tempat Lahir " name="tempat_lahir" class="form-control"></td>
					</tr>
					<tr>
						<td><b>Tanggal Lahir (Tahun-Bulan-Tanggal)</b></td> 
					</tr>
					<tr>
						<td><input type="text" value="0000-00-00" name="tanggal_lahir" class="form-control"></td>
					</tr>

					<tr>
						<td>Jurusan</td>
					</tr>
					<tr>
						<td><select name='jurusan' class='form-control' >";
                            <option value="<?php echo $a['jurusan']; ?>"><?php echo $a['jurusan']; ?></option>
                            <?php 
                            $query = mysqli_query($kon,"SELECT * FROM tb_jurusan ");
                            while ($row = mysqli_fetch_array($query)) {
                             echo"
                            <option value='$row[nama_jurusan]'>$row[nama_jurusan]</option>
                            ";
                             }
                            ?>
                            echo"</select></td>
					</tr>

					<tr>
						<td>Prodi</td>
					</tr>
					<tr>
						<td><select name='prodi' class='form-control' >";
                            <option value="<?php echo $a['prodi']; ?>"><?php echo $a['prodi']; ?></option>
                            <?php include "../config/koneksi.php";
                            $query = mysqli_query($kon,"SELECT * FROM tb_prodi ");
                            while ($row = mysqli_fetch_array($query)) {
                             echo"
                            <option value='$row[program_studi]'>$row[program_studi]</option>
                            ";
                             }
                            ?>
                            echo"</select></td>
					</tr>

					<tr>
                        <td>Tahun Akademik </td>
                    </tr>
                    <tr>
                        <td><select name='tahun_akademik' class='form-control' >";
                            <option value="<?php echo $a['tahun_akademik']; ?>"><?php echo $a['tahun_akademik']; ?></option>
                            <?php include "../config/koneksi.php";
                            $query = mysqli_query($kon,"SELECT * FROM tb_tahun_akademik ");
                            while ($row = mysqli_fetch_array($query)) {
                             echo"
                            <option value='$row[tahun_akademik]'>$row[tahun_akademik]</option>
                            ";
                             }
                            ?>
                            echo"</select></td>
                    </tr>

                    <tr>
						<td><b>Nomor Surat</b></td> 
					</tr>
					</tr>
						<td><input type="text" placeholder="Nomor Surat" name="nomor_surat" class="form-control" value="2433/2018"></td>
					</tr>
					
					<tr>
						<td><b>Tanggal SK</b></td> 
					</tr>
					</tr>
						<td><input type="text" value="2018-08-13"  placeholder="Tanggal SK" name="tanggal_sk" class="form-control"></td>
					</tr>

                    <tr>
						<td><b>Tanggal Wisudah</b></td> 
					</tr>
					</tr>
						<td><input type="text" value="2018-08-13" placeholder="Tanggal Wisudah" name="tanggal_wisudah" class="form-control" ></td>
					</tr>

					<tr>	
						<td>
							<input type="submit" name="submit" value="Simpan"  class="btn btn-primary">
							<input type="reset" name="submit" value="Hapus" class="btn btn-danger">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
		<?php
			include"../config/koneksi.php";
	
				if(isset($_POST['submit'])){
					$date = date("Y-m-d");
														
				$query=mysqli_query($kon,"insert into tb_surat_keterangan_lulus(nama_mahasiswa, nim_mahasiswa, keperluan, tempat_lahir, tanggal_lahir, jurusan,  prodi, tahun_akademik, nomor_surat, tanggal_sk, tanggal_wisudah, tanggal_cetak)
									values('$_POST[nama_mahasiswa]','$_POST[nim_mahasiswa]','$_POST[keperluan]','$_POST[tempat_lahir]','$_POST[tanggal_lahir]','$_POST[jurusan]','$_POST[prodi]','$_POST[tahun_akademik]','$_POST[nomor_surat]','$_POST[tanggal_sk]','$_POST[tanggal_wisudah]', '$date')");
					
										
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='02_daftar_surat_keterangan_lulus.php'</script>";
					}
				}					
		?>

 	
	</body>
</html>
