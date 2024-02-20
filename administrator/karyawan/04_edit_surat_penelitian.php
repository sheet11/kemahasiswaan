<?php 
	include"01_nav.php";    
?>

<?php
	$query=mysqli_query($kon, "SELECT * from tb_surat_penelitian where id_surat_penelitian='$_GET[id_surat_penelitian]'");
	$a=mysqli_fetch_array($query);	
?>
	
<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">
			<form method="post" action="04_prosesedit_surat_penelitian.php" enctype="multipart/form-data">	
				<table width="100%" border="0" class="table table-hover">
					<input type="hidden" name="id_surat_penelitian" value="<?php echo "$a[id_surat_penelitian]"; ?>">
					<input type="hidden" name="halaman" value="<?php if(!empty($_GET['halaman'])){ echo "$_GET[halaman]";}else{ echo "0";} ?>">				
					<tr>
						<td class="info"><b>Edit Surat Peneltian</b></td> 
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
						<td>No Handphone</td> 
					</tr>
					<tr>
						<td><input type="text" placeholder="No Handphone" name="no_hp" required="yes" class="form-control" value="<?php echo "$a[no_hp]"; ?>"></td>
					</tr>

					<tr>
						<td>Lama Penelitian</td> 
					</tr>
					<tr>
						<td><input type="text" placeholder="Lama Penelitian" name="lama_penelitian" required="yes" class="form-control" value="<?php echo "$a[lama_penelitian]"; ?>"></td>
					</tr>

					<tr>
						<td>Tempat Penelitian</td>
					</tr>
					<tr> 
						<td><textarea placeholder="Tempat Penelitian" name="tempat_penelitian" class="form-control" required="yes" ><?php echo "$a[tempat_penelitian]"; ?></textarea></td>
					</tr>

					<tr>
						<td>Judul KTI</td>
					</tr>
					<tr> 
						<td><textarea placeholder="Judul KTI" name="judul_kti" class="form-control" ><?php echo "$a[judul_kti]"; ?></textarea></td>
					</tr>

					<tr>
						<td>Jurusan</td>
					</tr>
					<tr>
						<td><select name='jurusan' class='form-control' >";
                            <option value="<?php echo $a['jurusan']; ?>"><?php echo $a['jurusan']; ?></option>
                            <?php include "../config/koneksi.php";
                            $query = mysqli_query($kon, "SELECT * FROM tb_jurusan ");
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
                        <td>Tahun Akademik </td>
                    </tr>
                    <tr>
                        <td><select name='tahun_akademik' class='form-control' >";
                            <option value="<?php echo $a['tahun_akademik']; ?>"><?php echo $a['tahun_akademik']; ?></option>
                            <?php include "../config/koneksi.php";
                            $query = mysqli_query($kon, "SELECT * FROM tb_tahun_akademik ");
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
					</tr>
					<tr>
                        <td><select name='tugas_akhir' class='form-control' >";
                            <option value="<?php echo $a['tugas_akhir']; ?>"><?php echo $a['tugas_akhir']; ?></option>
                            <?php include "../config/koneksi.php";
                            $query = mysqli_query($kon, "SELECT * FROM tb_tugas_akhir ");
                            while ($row = mysqli_fetch_array($query)) {
                             echo"
                            <option value='$row[tugas_akhir]'>$row[tugas_akhir]</option>
                            ";
                             }
                            ?>
                            echo"</select></td>
					</tr>

					<tr>
						<td>Tujuan</td> 
					</tr>
					<tr>
						<td><input type="text" placeholder="Ditujukan Kemana" name="tujuan" class="form-control" value="<?php echo "$a[tujuan]"; ?>"></td>
					</tr>

					<tr>
						<td>Tanggal Cetak</td> 
					</tr>
					<tr>
						<td><input type="text" id="tgld" placeholder="Format  : Tahun-Bulan-Tanggal" name="tanggal_cetak" class="form-control" value="<?php echo "$a[tanggal_cetak]"; ?>"></td>
					</tr>

					<tr>
						<td>Tembusan</td> 
					</tr>
					<tr>
						<td><textarea placeholder="Tembusan" name="tembusan" class="form-control"> <?php echo "$a[tembusan]"; ?></textarea></td>
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
