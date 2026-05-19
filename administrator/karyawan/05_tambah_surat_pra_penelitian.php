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
	$judul_kti      = mysqli_real_escape_string($kon, $_POST['judul_kti']);
	$prodi          = mysqli_real_escape_string($kon, $_POST['prodi']);
	$tugas_akhir    = mysqli_real_escape_string($kon, $_POST['tugas_akhir']);
	$tujuan         = mysqli_real_escape_string($kon, $_POST['tujuan']);
	$tahun_akademik = mysqli_real_escape_string($kon, $_POST['tahun_akademik']);
	$date           = date("Y-m-d");

	$query = mysqli_query($kon, "INSERT INTO tb_surat_pra_penelitian 
		(nama_mahasiswa, nim_mahasiswa, judul_kti, prodi, tugas_akhir, tujuan, tahun_akademik, tanggal_cetak)
		VALUES 
		('$nama_mahasiswa','$nim_mahasiswa','$judul_kti','$prodi','$tugas_akhir','$tujuan','$tahun_akademik','$date')");

	if ($query) {
		echo "<script>alert('Data Berhasil di Simpan'); window.location='05_daftar_surat_pra_penelitian.php';</script>";
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
						<td class="info" colspan="3"><b>Tambah Data Surat Pra Penelitian</b></td> 
					</tr>

					<tr>
						<td width="25%">Nama Mahasiswa</td>
						<td width="1%">:</td>
						<td><input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa" required class="form-control"></td>
					</tr>

					<tr>
						<td>NIM Mahasiswa</td> 
						<td>:</td>
						<td><input type="text" placeholder="NIM Mahasiswa contoh P0" name="nim_mahasiswa" required class="form-control"></td>
					</tr>

					<tr>
						<td>Judul KTI</td> 
						<td>:</td>
						<td><input type="text" placeholder="Judul KTI Awal Kata Huruf Besar Semua" name="judul_kti" required class="form-control"></td>
					</tr>

					<tr>
						<td>Prodi</td>
						<td>:</td>
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
						<td>Tugas Akhir</td>
						<td>:</td>
						<td>
							<select name="tugas_akhir" class="form-control" required>
								<option value="">-- Silahkan Dipilih --</option>
								<option value="Karya Tulis Ilmiah (KTI)">Karya Tulis Ilmiah (KTI)</option>
								<option value="Skripsi">Skripsi</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Tahun Akademik</td> 
						<td>:</td>
						<td>
							<select name="tahun_akademik" class="form-control" required>
								<option value="">-- Silahkan Dipilih --</option>
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
						<td>Tujuan</td> 
						<td>:</td>
						<td><input type="text" placeholder="Ditujukan Kemana" name="tujuan" required class="form-control"></td>
					</tr>

					<tr>
						<td colspan="2"></td>	
						<td>
							<input type="submit" name="submit" value="Simpan" class="btn btn-primary">
							<div style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">

								<button 
									type="button"
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