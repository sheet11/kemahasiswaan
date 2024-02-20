<?php 	
	include"01_nav.php";
?>

<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:30px;">
			<form method="post" action="" enctype="multipart/form-data">	
				<table style="width:100%" class="table table-basic">
					<tr>
					<td class="info" colspan="3"><b>Tambah Data Surat Pra Penelitian</b></td> 
					</tr>

					<tr>
						<td width="25%">Nama Mahasiswa</td>
						<td width="1%">:</td>
						<td><input type="text" placeholder="Nama Mahasiswa awal kata dibuat huruf besar" name="nama_mahasiswa" required="yes" class="form-control" value="<?=$u['nama_lengkap'];?>"> </td>
					<tr>

					<tr>
						<td>NIM Mahasiswa</td> 
						<td>:</td>
						<td><input type="text" placeholder="NIM Mahasiswa contoh P0" name="nim_mahasiswa" required="yes"  class="form-control" value="<?=$u['username'];?>"></td>
					</tr>

					<tr>
						<td>No Handphone</td> 
						<td>:</td>
						<td><input type="text" placeholder="No HP" name="no_hp" required="yes"  class="form-control"></td>
					</tr>

					<tr>
						<td>Judul</td> 
						<td>:</td>
						<td><textarea placeholder="Judul " name="judul_kti" required="yes" class="form-control"> </textarea></td>
					</tr>

					<tr>
						<td>Lokasi</td> 
						<td>:</td>
						<td><textarea placeholder="Lokasi Pra Penelitian" name="lokasi" required="yes" class="form-control"> </textarea></td>
					</tr>

					<tr>
						<td>Jurusan</td>
						<td width="2%">:</td>
						<td><select name="jurusan" type="select" class="form-control">
							<option value="">..: Silahkan Dipilih :..</option>
		                    <?php include "../config/koneksi.php";
		                    $query = mysqli_query($kon,"SELECT * FROM tb_jurusan ");
		                    while ($row = mysqli_fetch_array($query)) {
		                    echo" <option value='$row[nama_jurusan]'>$row[nama_jurusan]</option>";
		                             } ?>
		                    echo" </select></td>
					</tr>

					<tr>
						<td>Prodi</td>
						<td>:</td>
						<td><select name='prodi' class='form-control' >";
                            <option value="">..: Silahkan Dipilih :..</option>
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
						<td>Tugas Akhir</td>
						<td>:</td>
						<td><select name="tugas_akhir" type="select" class="form-control" required="yes" >
			    			<option value="">-- Silahkan Dipilih --</option>
							<option value="Karya Tulis Ilmiah (KTI)">Karya Tulis Ilmiah (KTI)</option>
							<option value="Skripsi">Skripsi</option>
			          		</select></td>
					</tr>

					<tr>
						<td>Tahun Akademik</td> 
						<td>:</td>
						<td><select name="tahun_akademik" type="select" class="form-control">
							<option value="">-- Silahkan Dipilih --</option>
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
						<td>Tujuan</td> 
						<td>:</td>
						<td><input type="text" placeholder="Tempat Tujuan" name="tujuan" class="form-control" required="yes" ></td>
					</tr>

					<tr>
						<td colspan="2">&nbsp;</td>	
						<td><input type="submit" name="submit" value="Simpan"  class="btn btn-primary">
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
					$date = date("Y-m-d");								
				$query=mysqli_query($kon,"insert into tb_surat_pra_penelitian(nama_mahasiswa, nim_mahasiswa,no_hp, judul_kti, lokasi, jurusan, prodi, tugas_akhir, tujuan, tahun_akademik, tanggal_cetak)
									values('$_POST[nama_mahasiswa]','$_POST[nim_mahasiswa]','$_POST[no_hp]','$_POST[judul_kti]','$_POST[lokasi]','$_POST[jurusan]','$_POST[prodi]','$_POST[tugas_akhir]','$_POST[tujuan]','$_POST[tahun_akademik]','$date')");				
					if($query)
						{
							echo"<script>alert('Data Berhasil di Simpan');window.location='05_daftar_surat_pra_penelitian.php'</script>";
						}
				}					
		?> 	
	</body>
</html>
