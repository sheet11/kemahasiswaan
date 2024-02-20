<?php 
	include"01_nav.php";    
?>

<?php
	$query=mysql_query("select * from tb_surat_pra_penelitian where id_surat_pra_penelitian='$_GET[id_surat_pra_penelitian]'");
	$a=mysql_fetch_array($query);	
?>
	
<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">
			<form method="post" action="05_prosesedit_surat_pra_penelitian.php" enctype="multipart/form-data">	
				<table width="100%" border="0" class="table table-hover">
					<input type="hidden" name="id_surat_pra_penelitian" value="<?php echo "$a[id_surat_pra_penelitian]"; ?>">
					<input type="hidden" name="halaman" value="<?php if(!empty($_GET['halaman'])){ echo "$_GET[halaman]";}else{ echo "0";} ?>">				
					<tr>
						<td class="info" colspan="3"><b>Edit Surat Pra Peneltian</b></td> 
					</tr>

					<tr>
						<td width="15%">Nama Mahasiswa</td> 
						<td width="2%">:</td>
						<td><input type="text" placeholder="Nama Mahasiswa " name="nama_mahasiswa" required="yes" class="form-control" value="<?php echo "$a[nama_mahasiswa]"; ?>"></td>
					</tr>
					
					<tr>
						<td>NIM Mahasiswa</td> 
						<td>:</td>
						<td><input type="text" placeholder="NIM Mahasiswa" name="nim_mahasiswa" class="form-control" value="<?php echo "$a[nim_mahasiswa]"; ?>"></td> 
					</tr>

					<tr>
						<td>No Handphone</td> 
						<td>:</td>
						<td><input type="text" placeholder="No Handphone" name="no_hp" class="form-control" value="<?php echo "$a[no_hp]"; ?>"></td> 
					</tr>

					<tr>
						<td>Judul</td> 
						<td>:</td>
						<td><textarea placeholder="Judul KTI" name="judul_kti" class="form-control"><?php echo "$a[judul_kti]"; ?></textarea></td>
					</tr>

					<tr>
						<td>Lokasi</td> 
						<td>:</td>
						<td><textarea placeholder="Lokasi Pra Penelitian" name="lokasi" class="form-control"><?php echo "$a[lokasi]"; ?></textarea></td>
					</tr>

					<tr>
						<td>Jurusan</td>
						<td>:</td>
						<td><select name='jurusan' class='form-control' >";
                            <option value="<?php echo $a['jurusan']; ?>"><?php echo $a['jurusan']; ?></option>
                            <?php include "../config/koneksi.php";
                            $query = mysql_query("SELECT * FROM tb_jurusan ");
                            while ($row = mysql_fetch_array($query)) {
                             echo"
                            <option value='$row[nama_jurusan]'>$row[nama_jurusan]</option>
                            ";
                             }
                            ?>
                            echo"</select></td>
					</tr>

					<tr>
						<td>Prodi</td>
						<td>:</td>
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
						<td>Tugas Akhir</td>
						<td>:</td>
						<td><select name="tugas_akhir" type="select" class="form-control">
							<option value="<?php echo "$a[tugas_akhir]"; ?>"> <?php echo "$a[tugas_akhir]"; ?></option>
			    			<option value="">-- Silahkan Dipilih --</option>
							<option value="Karya Tulis Ilmiah (KTI)">Karya Tulis Ilmiah (KTI)</option>
							<option value="Skripsi">Skripsi</option>
			          		</select></td>
					</tr>

					<tr>
                        <td>Tahun Akademik </td>
                        <td>:</td>
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
						<td>Tujuan</td> 
						<td>:</td>
						<td><input type="text" placeholder="Ditujukan Kemana" name="tujuan" class="form-control" value="<?php echo "$a[tujuan]"; ?>"></td>
					</tr>

					<tr><td colspan="2">&nbsp;</td> 	
						<td><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
							<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
					</tr>
				</table>
			</form>
		</div>
	</section>
</aside>
