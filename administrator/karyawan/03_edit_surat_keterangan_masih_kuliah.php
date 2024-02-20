<?php 
	include"01_nav.php";
 ?>

<?php
	
	$query=mysqli_query($kon, "SELECT * from tb_surat_keterangan_masih_kuliah where id_surat_keterangan_masih_kuliah='$_GET[id_surat_keterangan_masih_kuliah]'");
	$a=mysqli_fetch_array($query);	
?>
	
<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">
		<form method="post" action="03_prosesedit_surat_keterangan_masih_kuliah.php" enctype="multipart/form-data">	
			<table width="100%" border="0" class="table table-hover">
				<input type="hidden" name="id_surat_keterangan_masih_kuliah" value="<?php echo "$a[id_surat_keterangan_masih_kuliah]"; ?>">
				<input type="hidden" name="halaman" value="<?php if(!empty($_GET['halaman'])){ echo "$_GET[halaman]";}else{ echo "0";} ?>">
				<tr>
					<td colspan="3"><h2>Edit Surat Keterangan Masih Kuliah</h2></td> 
				</tr>
				<tr>
					<td colspan="3" ><b>&nbsp;</b></td> 
				</tr>

				<tr>
					<td colspan="3" class="success"><b>Data Mahasiswa</b></td> 
				</tr>

				<tr>
					<td width="15%">Nama Mahasiswa</td>
					<td width="2%">:</td> 
					<td><input type="text" placeholder="Nama Mahasiswa " name="nama_mahasiswa" required="yes" class="form-control" value="<?php echo "$a[nama_mahasiswa]"; ?>"></td>
				</tr>
				
				<tr>
					<td>NIM Mahasiswa</td> 
					<td>:</td> 
					<td colspan="2"><input type="text" placeholder="NIM Mahasiswa" name="nim_mahasiswa" class="form-control" value="<?php echo "$a[nim_mahasiswa]"; ?>" required="yes"></td> 
				</tr>
				<tr>
						<td>Keperluan</td> 
						<td width="2%">:</td>
						<td><select name="keperluan" type="select" class="form-control" required="yes">
								<option value="<?php echo "$a[keperluan]"; ?>"> <?php echo "$a[keperluan]"; ?></option>
				    			<option value="Slip Gaji/Tunjangan/Pensiun">Slip Gaji/Tunjangan/Pensiun</option>
								<option value="Pembuatan Askes/BPJS">Pembuatan Askes/BPJS</option>
								<option value="Lainnya">Lainnya</option>
			          		</select></td>
					</tr>

					<tr>
						<td>Tingkat</td>
						<td width="2%">:</td>
						<td><select name="tingkat" type="select" class="form-control" required="yes">
								<option value="<?php echo "$a[tingkat]"; ?>"> <?php echo "$a[tingkat]"; ?></option>
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
								<option value="<?php echo "$a[semester]"; ?>"> <?php echo "$a[semester]"; ?></option>
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
						<td><select name="tahun_akademik" type="select" class="form-control" required="yes">
								<option value="<?php echo "$a[tahun_akademik]"; ?>"> <?php echo "$a[tahun_akademik]"; ?></option>
								
								<option value="2017/2018">2021/2022</option>
								<option value="2017/2018">2020/2021</option>
								<option value="2017/2018">2019/2020</option>
								<option value="2017/2018">2018/2019</option>
								<option value="2017/2018">2017/2018</option>
								<option value="2016/2017">2016/2017</option>
								<option value="2015/2016">2015/2016</option>
								<option value="2014/2015">2014/2015</option>
								<option value="2013/2014">2013/2014</option>
							</select></td>
					</tr>

				<tr>
					<td>Jurusan</td>
					<td>:</td> 
					<td><select name="jurusan" type="select" class="form-control">
						<option value="<?php echo $a['jurusan']; ?>"><?php echo $a['jurusan']; ?></option>
	                    <?php include "../config/koneksi.php";
	                    $query = mysqli_query($kon, "SELECT * FROM tb_jurusan ");
	                    while ($row = mysqli_fetch_array($query)) {
	                    echo" <option value='$row[nama_jurusan]'>$row[nama_jurusan]</option>";
	                             } ?>
	                    echo" </select></td>
				</tr>

				<tr>
					<td>Prodi</td>
					<td>:</td> 
					<td><select name='prodi' class='form-control' >";
                            <option value="<?php echo $a['prodi']; ?>"><?php echo $a['prodi']; ?></option>
                            <?php include "../config/koneksi.php";
                            $query = mysqli_query($kon, "SELECT * FROM tb_prodi ");
                            while ($row = mysqli_fetch_array($query)) {
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
					<td>:</td> 
					<td><input type="text" placeholder="Nama Mahasiswa " name="nama_orang_tua" required="yes" class="form-control" value="<?php echo "$a[nama_orang_tua]"; ?>"></td>
				</tr>
				
				<tr>
					<td>NIP</td> 
					<td>:</td> 
					<td><input type="text" placeholder="NIP" name="nip" class="form-control" value="<?php echo "$a[nip]"; ?>" required="yes"></td> 
				</tr>

				<tr>
					<td>Pangkat, Golongan</td> 
					<td>:</td> 
					<td><input type="text" placeholder="Contoh: Melamar Pekerjaan" name="pangkat" class="form-control" value="<?php echo "$a[pangkat]"; ?>" required="yes"></td>
				</tr>

				<tr>
					<td>Instansi</td> 
					<td>:</td> 
					<td><input type="text" placeholder="Contoh :" name="instansi" value="<?php echo "$a[instansi]"; ?>" class="form-control"></td>
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
