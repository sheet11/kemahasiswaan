<?php 	
	include"01_nav.php";
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
						<td colspan="3" class="success"><b>Data Mahasiswa</b></td> 
					</tr>

					<tr>
						<td width="15%">Nama Mahasiswa</td>
						<td width="2%">:</td>
						<td><input type="text" placeholder="Nama Mahasiswa " name="nama_mahasiswa" required="yes" class="form-control" ></td>
					</tr>
					
					<tr>
						<td>NIM Mahasiswa</td> 
						<td width="2%">:</td>
						<td colspan="2"><input type="text" placeholder="NIM Mahasiswa" name="nim_mahasiswa" required="yes"class="form-control" ></td> 
					</tr>

					<tr>
						<td>Keperluan</td> 
						<td width="2%">:</td>
						<td><select name="keperluan" type="select" class="form-control" required="yes">
								<option value="">.: Silahkan Dipilih :..</option>
				    			<option value="Slip Gaji/Tunjangan/Pensiun">Slip Gaji/Tunjangan/Pensiun</option>
								<option value="Pembuatan Askes/BPJS">Pembuatan Askes/BPJS</option>
			          		</select></td>
					</tr>

					<tr>
						<td>Tingkat</td>
						<td width="2%">:</td>
						<td><select name="tingkat" type="select" class="form-control" required="yes">
								<option value="">.: Silahkan Dipilih :..</option>
				    			<option value="I">I</option>
								<option value="II">II</option>
								<option value="III">III</option>
								<option value="III">III</option>
								<option value="IV">IV</option>
							</select></td>
					</tr>

					<tr>
						<td>Semester</td>
						<td width="2%">:</td>
						<td><select name="semester" type="select" class="form-control" required="yes">
								<option value="">.: Silahkan Dipilih :..</option>
				    			<option value="I">I</option>
								<option value="II">II</option>
								<option value="III">III</option>
								<option value="III">III</option>
								<option value="IV">IV</option>
								<option value="V">V</option>
								<option value="VI">VI</option>
								<option value="VII">VII</option>
								<option value="VIII">VIII</option>
							</select></td>
					</tr>

					<tr>
						<td>Tahun Akademik</td> 
						<td width="2%">:</td>
						<td><select name="tahun_akademik" type="select" class="form-control">
		    			<option value="">..: Silahkan Dipilih :..</option>
	                            <?php include "../config/koneksi.php";
	                            $query = mysql_query("SELECT * FROM tb_tahun_akademik ");
	                            while ($row = mysql_fetch_array($query)) {
	                             echo"
	                            <option value='$row[tahun_akademik]'>$row[tahun_akademik]</option>
	                            ";
	                             }
	                            ?>
	                            echo"</select></td>
					</tr>

					<tr>
						<td>Jurusan</td>
						<td width="2%">:</td>
						<td><select name="jurusan" type="select" class="form-control">
							<option value="">..: Silahkan Dipilih :..</option>
		                    <?php include "../config/koneksi.php";
		                    $query = mysql_query("SELECT * FROM tb_jurusan ");
		                    while ($row = mysql_fetch_array($query)) {
		                    echo" <option value='$row[nama_jurusan]'>$row[nama_jurusan]</option>";
		                             } ?>
		                    echo" </select></td>
					</tr>

					<tr>
						<td>Prodi</td>
						<td width="2%">:</td>
						<td><select name='prodi' class='form-control' >";
                            <option value="">..: Silahkan Dipilih :..</option>
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
						<td colspan="3" class="success"><b>Data Orang Tua/Wali</b></td> 
					</tr>

					<tr>
						<td>Nama Orang Tua</td> 
						<td width="2%">:</td>
						<td><input type="text" placeholder="Nama Mahasiswa " name="nama_orang_tua" required="yes" class="form-control"></td>
					</tr>
					
					<tr>
						<td>NIP</td>
						<td width="2%">:</td> 
						<td><input type="text" placeholder="NIP" name="nip" required="yes" class="form-control"></td> 
					</tr>

					<tr>
						<td>Pangkat, Golongan</td> 
						<td width="2%">:</td>
						<td><input type="text" placeholder="Contoh: Melamar Pekerjaan" required="yes" name="pangkat" class="form-control" ></td>
					</tr>

					<tr>
						<td>Instansi</td> 
						<td width="2%">:</td>
						<td><input type="text" placeholder="Contoh :" name="instansi" required="yes" class="form-control"></td>
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
	
				if(isset($_POST['submit']))
				{
					$date = date("Y-m-d");
														
				$query=mysql_query("insert into tb_surat_keterangan_masih_kuliah(nama_mahasiswa, nim_mahasiswa, keperluan, tingkat, semester, tahun_akademik, nama_orang_tua, nip, pekerjaan, pangkat, instansi, jurusan, prodi, tanggal_cetak)
									values('$_POST[nama_mahasiswa]','$_POST[nim_mahasiswa]','$_POST[keperluan]','$_POST[tingkat]','$_POST[semester]','$_POST[tahun_akademik]','$_POST[nama_orang_tua]','$_POST[nip]','$_POST[pekerjaan]','$_POST[pangkat]','$_POST[instansi]','$_POST[jurusan]','$_POST[prodi]','$date')");
					
										
					if($query)
					{
						echo"<script>alert('Data Berhasil di Simpan');window.location='03_daftar_surat_keterangan_masih_kuliah.php'</script>";
					}
				}					
		?>				
<?php } ?>	 	
	</body>
</html>
