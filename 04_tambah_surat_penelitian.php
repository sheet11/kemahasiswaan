<?php 	
	include"01_nav.php";
?>
<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">
			<form method="post" action="" enctype="multipart/form-data">	
				<table style="width:100%" class="table table-basic">
					<tr>
						<td class="info" colspan="3"><b>Tambah Data Surat Penelitian</b></td> 
					</tr>

					<tr>
						<td width="25%">Nama Mahasiswa</td>
						<td width="1%">:</td>
						<td><input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa" required="yes" class="form-control" value="<?=$u['nama_lengkap'];?>"> </td>
					<tr>

					<tr>
						<td>NIM Mahasiswa</td> 
						<td>:</td>
						<td><input type="text" placeholder="NIM Mahasiswa huruf P dibuat huruf kapital contoh P0" name="nim_mahasiswa" required="yes" class="form-control" value="<?=$u['username'];?>"></td>
					</tr>

					<tr>
						<td>No Handphone</td> 
						<td>:</td>
						<td><input type="text" placeholder="No Handphone" name="no_hp" required="yes" class="form-control"></td>
					</tr>

					<tr>
						<td>Lama Penelitian</td> 
						<td>:</td>
						<td><input type="text" placeholder="Lama Penelitian" name="lama_penelitian" required="yes" class="form-control"></td>
					</tr>

					<tr>
						<td>Tempat Penelitian</td> 
						<td>:</td>
						<td><textarea placeholder="Tempat Penelitian" name="tempat_penelitian" class="form-control" required="yes"></textarea></td>
					</tr>

					<tr>
						<td>Judul</td> 
						<td>:</td>
						<td><textarea placeholder="Judul Awal Kata Huruf Besar " name="judul_kti" class="form-control" required="yes"></textarea></td>
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
                        <td>Tahun Akademik </td>
                        <td>:</td>
                        <td><select name='tahun_akademik' class='form-control' >";
                            <option value="">..: Silahkan Dipilih :..</option>
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
						<td>Tugas Akhir</td>
						<td>:</td>
                        <td><select name='tugas_akhir' class='form-control' >";
                           	<option value="">..: Silahkan Dipilih :..</option>
                            <?php include "../config/koneksi.php";
                            $query = mysqli_query($kon,"SELECT * FROM tb_tugas_akhir ");
                            while ($row = mysqli_fetch_array($query)) {
                             echo"
                            <option value='$row[tugas_akhir]'>$row[tugas_akhir]</option>
                            ";
                             }
                            ?>
                            echo"</select></td>
					</tr>

					<tr>
						<td>Tujuan Surat</td> 
						<td>:</td>
						<td><input type="text" placeholder="Ditujukan Kemana" name="tujuan" class="form-control" required="yes"></td>
					</tr>

					<tr>
						<td>Tembusan</td> 
						<td>:</td>
						<td><textarea placeholder="Tembusan" name="tembusan" class="form-control" required="yes"></textarea></td>
					</tr>
					<tr>
						<td colspan="2">:</td>	
						<td><input type="submit" name="submit" value="Simpan"  class="btn btn-primary">
							<input type="reset" name="submit" value="Hapus" class="btn btn-danger">
						</td>
					</tr>

				</table>
			</form>
		</div>
	</div>
</div>
		<?php
			if(isset($_POST['submit'])){
					$date = date("Y-m-d");										
					$query=mysqli_query($kon,"insert into tb_surat_penelitian(nama_mahasiswa, nim_mahasiswa, no_hp, lama_penelitian,tempat_penelitian, judul_kti, jurusan,  prodi, tugas_akhir, tujuan, tanggal_cetak,tahun_akademik, tembusan)
										values('$_POST[nama_mahasiswa]','$_POST[nim_mahasiswa]','$_POST[no_hp]','$_POST[lama_penelitian]','$_POST[tempat_penelitian]','$_POST[judul_kti]','$_POST[jurusan]','$_POST[prodi]','$_POST[tugas_akhir]','$_POST[tujuan]','$date','$_POST[tahun_akademik]','$_POST[tembusan]')");				
						if($query){
								echo"<script>alert('Data Berhasil di Simpan');window.location='04_daftar_surat_penelitian.php'</script>";
						}
					}					
		?>
	</body>
</html>
