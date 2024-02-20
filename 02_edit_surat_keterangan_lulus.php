<?php 
	include"01_nav.php";    
?>

<?php
	$query=mysql_query("select * from tb_surat_keterangan_lulus where id_surat_keterangan_lulus='$_GET[id_surat_keterangan_lulus]'");
	$a=mysql_fetch_array($query);	
?>
	
<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">
			<form method="post" action="02_prosesedit_surat_keterangan_lulus.php" enctype="multipart/form-data">	
				<table width="100%" border="0" class="table table-hover">
					<input type="hidden" name="id_surat_keterangan_lulus" value="<?php echo "$a[id_surat_keterangan_lulus]"; ?>">
					<input type="hidden" name="halaman" value="<?php if(!empty($_GET['halaman'])){ echo "$_GET[halaman]";}else{ echo "0";} ?>">				
					<tr>
						<td class="info" colspan="3"><b>Edit Surat Keterangan Lulus</b></td> 
					</tr>

					<tr>
						<td>Nama Mahasiswa</td>
					</tr>
					<tr> 
						<td><input type="text" placeholder="Nama Mahasiswa " name="nama_mahasiswa" required="yes" class="form-control" value="<?php echo "$a[nama_mahasiswa]"; ?>"></td>
					</tr>
					
					<tr>
						<td>NIM Mahasiswa</td>
					</tr>
					<tr> 
						<td><input type="text" placeholder="NIM Mahasiswa" name="nim_mahasiswa" class="form-control" value="<?php echo "$a[nim_mahasiswa]"; ?>"></td> 
					</tr>


					<tr>
						<td>Prodi</td>
					</tr>
					<tr>
						<td><select name='prodi' class='form-control' >";
                            <option value="<?php echo $a['prodi']; ?>"><?php echo $a['prodi']; ?></option>
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
						<td><b>Keperluan</b></td> 
					</tr>
					</tr>
						<td><select name="keperluan" type="select" class="form-control">
					    			<option value="<?php echo "$a[keperluan]"; ?>"> <?php echo "$a[keperluan]"; ?></option>
									<option value="Melamar Pekerjaan">Melamar Pekerjaan</option>
									<option value="Kenaikan Pangkat">Kenaikan Pangkat</option>
									<option value="Melanjutkan Pendidikan">Melanjutkan Pendidikan</option>
									<option value="Melanjutkan Pendidikan dan Melamar Pekerjaan">Melanjutkan Pendidikan dan Melamar Pekerjaan</option>
					          		</select></td>
					</tr>

					<tr>
						<td>Tempat Lahir</td> 
					</tr>	
					<tr>
						<td><input type="text" placeholder="Tempat Lahir" name="tempat_lahir" class="form-control" value="<?php echo "$a[tempat_lahir]"; ?>"></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
					</tr>
					<tr>
						
						<td><input type="text" id="tgls" placeholder="Format  : Tahun-Bulan-Tanggal" name="tanggal_lahir" class="form-control" value="<?php echo "$a[tanggal_lahir]"; ?>"></td>
					</tr>

					<tr>
						<td>Jurusan</td>
					</tr>
					<tr>
						<td><select name="jurusan" type="select" class="form-control">
				    		<option value="<?php echo "$a[jurusan]"; ?>"> <?php echo "$a[jurusan]"; ?></option>
							<option value="Teknologik Laboratorium Medis">Teknologik Laboratorium Medis</option>
								<option value="Sanitasi">Sanitasi</option>
							<option value="Kebidanan">Kebidanan</option>
							<option value="Gizi">Gizi</option>
							<option value="Keperawatan">Keperawatan</option>
				          	</select></td>
					</tr>

					<tr>
						<td>Prodi</td>
					</tr>
					<tr>
						<td><select name="prodi" type="select" class="form-control">
							<option value="<?php echo $a['prodi']; ?>"><?php echo $a['prodi']; ?></option>
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
                        <td>Tahun Akademik </td>
                    </tr>
                    <tr>
                        <td><select name='tahun_akademik' class='form-control' >";
                            <option value="<?php echo $a['tahun_akademik']; ?>"><?php echo $a['tahun_akademik']; ?></option>
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
						<td><b>Nomor Surat</b></td> 
					</tr>
					</tr>
						<td><input type="text" placeholder="Nomor Surat" name="nomor_surat" class="form-control" value="<?php echo "$a[nomor_surat]"; ?>"></td>
					</tr>
					
					<tr>
						<td><b>Tanggal SK</b></td> 
					</tr>
					</tr>
						<td><input type="text" name="tanggal_sk" class="form-control" value="<?php echo "$a[tanggal_sk]"; ?>"></td>
					</tr>

					<tr>
						<td><b>Tanggal Wisudah</b></td> 
					</tr>
					</tr>
						<td><input type="text" placeholder="Tanggal Wisudah" name="tanggal_wisudah" class="form-control" value="<?php echo "$a[tanggal_wisudah]"; ?>"></td>
					</tr>

					<tr>
						<td><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
							<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
					</tr>
				</table>
			</form>
		</div>
	</section>
</aside>
