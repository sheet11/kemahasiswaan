<?php 	
	include "01_nav.php";
	include "../assets/js/date.php";
	include "../config/koneksi.php";
	error_reporting(0);
?>

<?php if ($_SESSION['level'] == "karyawan"): ?>

<?php
if (isset($_POST['submit'])) {
	$nama_mahasiswa = mysqli_real_escape_string($kon, $_POST['nama_mahasiswa']);
	$nim_mahasiswa  = mysqli_real_escape_string($kon, $_POST['nim_mahasiswa']);
	$keperluan      = mysqli_real_escape_string($kon, $_POST['keperluan']);
	$tingkat        = mysqli_real_escape_string($kon, $_POST['tingkat']);
	$semester       = mysqli_real_escape_string($kon, $_POST['semester']);
	$tahun_akademik = mysqli_real_escape_string($kon, $_POST['tahun_akademik']);
	$nama_orang_tua = mysqli_real_escape_string($kon, $_POST['nama_orang_tua']);
	$nip            = mysqli_real_escape_string($kon, $_POST['nip']);
	$pangkat        = mysqli_real_escape_string($kon, $_POST['pangkat']);
	$instansi       = mysqli_real_escape_string($kon, $_POST['instansi']);
	$jurusan        = mysqli_real_escape_string($kon, $_POST['jurusan']);
	$prodi          = mysqli_real_escape_string($kon, $_POST['prodi']);
	$date           = date("Y-m-d");

	$query = mysqli_query($kon, "INSERT INTO tb_surat_keterangan_masih_kuliah 
		(nama_mahasiswa, nim_mahasiswa, keperluan, tingkat, semester, tahun_akademik, nama_orang_tua, nip, pangkat, instansi, jurusan, prodi, tanggal_cetak)
		VALUES 
		('$nama_mahasiswa','$nim_mahasiswa','$keperluan','$tingkat','$semester','$tahun_akademik','$nama_orang_tua','$nip','$pangkat','$instansi','$jurusan','$prodi','$date')");

	if ($query) {
		echo "<script>alert('Data Berhasil di Simpan'); window.location='03_daftar_surat_keterangan_masih_kuliah.php';</script>";
	} else {
		echo "<script>alert('Gagal menyimpan: " . mysqli_error($kon) . "');</script>";
	}
}
?>

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
						<td><input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa" required class="form-control"></td>
					</tr>
					
					<tr>
						<td>NIM Mahasiswa</td> 
						<td width="2%">:</td>
						<td><input type="text" placeholder="NIM Mahasiswa" name="nim_mahasiswa" required class="form-control"></td> 
					</tr>

					<tr>
						<td>Keperluan</td> 
						<td width="2%">:</td>
						<td>
							<select name="keperluan" class="form-control" required>
								<option value="">.: Silahkan Dipilih :..</option>
								<option value="Slip Gaji/Tunjangan/Pensiun">Slip Gaji/Tunjangan/Pensiun</option>
								<option value="Pembuatan Askes/BPJS">Pembuatan Askes/BPJS</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Tingkat</td>
						<td width="2%">:</td>
						<td>
							<select name="tingkat" class="form-control" required>
								<option value="">.: Silahkan Dipilih :..</option>
								<option value="I">I</option>
								<option value="II">II</option>
								<option value="III">III</option>
								<option value="IV">IV</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Semester</td>
						<td width="2%">:</td>
						<td>
							<select name="semester" class="form-control" required>
								<option value="">.: Silahkan Dipilih :..</option>
								<option value="I">I</option>
								<option value="II">II</option>
								<option value="III">III</option>
								<option value="IV">IV</option>
								<option value="V">V</option>
								<option value="VI">VI</option>
								<option value="VII">VII</option>
								<option value="VIII">VIII</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Tahun Akademik</td> 
						<td width="2%">:</td>
						<td>
							<select name="tahun_akademik" class="form-control" required>
								<option value="">..: Silahkan Dipilih :..</option>
								<?php
								$q_tahun = mysqli_query($kon, "SELECT * FROM tb_tahun_akademik");
								while ($row = mysqli_fetch_array($q_tahun)) {
									echo "<option value='{$row['tahun_akademik']}'>{$row['tahun_akademik']}</option>";
								}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td>Jurusan</td>
						<td width="2%">:</td>
						<td>
							<select name="jurusan" class="form-control" required>
								<option value="">..: Silahkan Dipilih :..</option>
								<?php
								$q_jurusan = mysqli_query($kon, "SELECT * FROM tb_jurusan");
								while ($row = mysqli_fetch_array($q_jurusan)) {
									echo "<option value='{$row['nama_jurusan']}'>{$row['nama_jurusan']}</option>";
								}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td>Prodi</td>
						<td width="2%">:</td>
						<td>
							<select name="prodi" class="form-control" required>
								<option value="">..: Silahkan Dipilih :..</option>
								<?php
								$q_prodi = mysqli_query($kon, "SELECT * FROM tb_prodi");
								while ($row = mysqli_fetch_array($q_prodi)) {
									echo "<option value='{$row['program_studi']}'>{$row['program_studi']}</option>";
								}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td colspan="3" class="success"><b>Data Orang Tua/Wali</b></td> 
					</tr>

					<tr>
						<td>Nama Orang Tua</td> 
						<td width="2%">:</td>
						<td><input type="text" placeholder="Nama Orang Tua" name="nama_orang_tua" required class="form-control"></td>
					</tr>
					
					<tr>
						<td>NIP</td>
						<td width="2%">:</td> 
						<td><input type="text" placeholder="NIP" name="nip" required class="form-control"></td> 
					</tr>

					<tr>
						<td>Pangkat, Golongan</td> 
						<td width="2%">:</td>
						<td><input type="text" placeholder="Contoh: IV/a" name="pangkat" required class="form-control"></td>
					</tr>

					<tr>
						<td>Instansi</td> 
						<td width="2%">:</td>
						<td><input type="text" placeholder="Nama Instansi" name="instansi" required class="form-control"></td>
					</tr>

					<tr>	
						<td colspan="3">
							<input type="submit" name="submit" value="Simpan" class="btn btn-primary">
							<div style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">

								<button 
									onclick="history.back()" 
									class="btn btn-light border"
								>
									Kembali
								</button>

							</div>
						</td>
					</tr>

				</table>
			</form>
        </div>
    </section>
</aside>

<?php endif; ?>