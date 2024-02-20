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
				<td class="info" colspan="3"><b>Tambah Data Surat Pra Penelitian</b></td> 
				</tr>

				<tr>
					<td width="25%">Nama Mahasiswa</td>
					<td width="1%">:</td>
					<td><input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa" required="yes" class="form-control"> </td>
				<tr>

				<tr>
					<td>NIM Mahasiswa</td> 
					<td>:</td>
					<td><input type="text" placeholder="NIM Mahasiswa contoh P0" name="nim_mahasiswa" class="form-control"></td>
				</tr>

				<tr>
					<td>Judul KTI</td> 
					<td>:</td>
					<td><input type="text" placeholder="Judul KTI Awal Kata Huruf Besar Semua" name="judul_kti" class="form-control"></td>
				</tr>

				<tr>
					<td>Prodi</td>
					<td>:</td>
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
					<td>Tugas Akhir</td>
					<td>:</td>
					<td><select name="tugas_akhir" type="select" class="form-control">
		    			<option value="">-- Silahkan Dipilih --</option>
						<option value="Karya Tulis Ilmiah (KTI)">Karya Tulis Ilmiah (KTI)</option>
						<option value="Skripsi">Skripsi</option>
		          		</select></td>
				</tr>

				<tr>
						<td><b>Tahun Akademik</b></td> 
						<td>:</td>
						<td><select name="tahun_akademik" type="select" class="form-control">
		    			<option value="">-- Silahkan Dipilih --</option>
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
					<td><input type="text" placeholder="Ditujukan Kemana" name="tujuan" class="form-control"></td>
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
		<?php
			include"../config/koneksi.php";
	
				if(isset($_POST['submit']))
					{
														
				$query=mysql_query("insert into tb_surat_pra_penelitian(nama_mahasiswa, nim_mahasiswa, judul_kti,  prodi, tugas_akhir, tujuan, tahun_akademik, tanggal_cetak)
									values('$_POST[nama_mahasiswa]','$_POST[nim_mahasiswa]','$_POST[judul_kti]','$_POST[prodi]','$_POST[tugas_akhir]','$_POST[tujuan]','$_POST[tahun_akademik]','$date')");
					
										
					if($query)
					{
						echo"<script>alert('Data Berhasil di Simpan');window.location='05_daftar_surat_pra_penelitian.php'</script>";
					}
				}					
		?>


				
<?php } ?>	 	
	</body>
</html>
