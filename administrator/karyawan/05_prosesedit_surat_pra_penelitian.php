
<?php 
	error_reporting(0);
	include "session.php"; 
?>
<?php
if($_POST['halaman'] == 0)
{
	
		require_once("config/koneksi.php");
			// Untuk foto
		$nama_file = $_FILES['gambar']['name'];
		$ukuran_file = $_FILES['gambar']['size'];
		$tipe_file = $_FILES['gambar']['type'];
		$tmp_file = $_FILES['gambar']['tmp_name'];
		
		// Folder tempat menyimpan gambarnya
		$path = "assets/img/".$nama_file;
	
	if(empty($nama_file))
	{
		$qr = mysqli_query($kon, "update tb_surat_pra_penelitian set nama_mahasiswa = '$_POST[nama_mahasiswa]',
														nim_mahasiswa = '$_POST[nim_mahasiswa]',
														tujuan = '$_POST[tujuan]',
														judul_kti = '$_POST[judul_kti]',
														lokasi = '$_POST[lokasi]',
														prodi = '$_POST[prodi]',
														tahun_akademik = '$_POST[tahun_akademik]',
														tugas_akhir = '$_POST[tugas_akhir]'
													
																								
												  		where id_surat_pra_penelitian= '$_POST[id_surat_pra_penelitian]'");
		if($qr)
		{
			echo "<script>alert('Data berhasil diperbarui');window.location='05_daftar_surat_pra_penelitian.php?username=$_POST[username]'</script>";
		}
		else
		{
			echo "<script>alert('Mohon maaf, data gagal diperbarui.');window.location='05_daftar_surat_pra_penelitian.php?username=$_POST[username]'</script>";
		}
	}
	else
	{
		if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $tipe_file == "image/jpg")
		{
			if($ukuran_file <= 3000000)
			{
				if(move_uploaded_file($tmp_file, $path))
				{
					$qr = mysqli_query($kon, "update tb_surat_pra_penelitian set nama_mahasiswa = '$_POST[nama_mahasiswa]',
														nim_mahasiswa = '$_POST[nim_mahasiswa]',
														tujuan = '$_POST[tujuan]',
														judul_kti = '$_POST[judul_kti]',
														lokasi = '$_POST[lokasi]',
														prodi = '$_POST[prodi]',
														tahun_akademik = '$_POST[tahun_akademik]',
														tugas_akhir = '$_POST[tugas_akhir]'
																								
												  	where id_surat_pra_penelitian= '$_POST[id_surat_pra_penelitian]'");
					if($qr)
					{
						echo "<script>alert('Data berhasil diperbarui.');window.location='05_daftar_surat_pra_penelitian.php?username=$_POST[username]'</script>";
					}
					else
					{
						echo "<script>alert('Mohon maaf, data gagal diperbarui.');window.location='05_daftar_surat_pra_penelitian.php?username=$_POST[username]'</script>";
					}
				}
				else
				{
					echo "<script>alert('Mohon maaf, Gambar gagal diupload.');window.location='05_daftar_surat_pra_penelitian.php?username=$_POST[username]'</script>";
				}
			}
			else
			{
				echo "<script>alert('Mohon maaf, Gambar tidak boleh melebihi 1 Mb.');window.location='05_daftar_surat_pra_penelitian.php?username=$_POST[username]'</script>";
			}
		}
		else
		{
			echo "<script>alert('Mohon maaf, type gambar yang diperbolehkan .jpg , .jpeg , .png');window.location='05_daftar_surat_pra_penelitian.php?username=$_POST[username]'</script>";
		}
	}
}
else
{
	
		require_once("../config/koneksi.php");
			// Untuk foto
		$nama_file = $_FILES['gambar']['name'];
		$ukuran_file = $_FILES['gambar']['size'];
		$tipe_file = $_FILES['gambar']['type'];
		$tmp_file = $_FILES['gambar']['tmp_name'];
		
		// Folder tempat menyimpan gambarnya
		$path = "assets/img/".$nama_file;
	
	if(empty($nama_file))
	{
		$qr = mysqli_query($kon, "update tb_surat_pra_penelitian set nama_mahasiswa = '$_POST[nama_mahasiswa]',
														nim_mahasiswa = '$_POST[nim_mahasiswa]',
														tujuan = '$_POST[tujuan]',
														judul_kti = '$_POST[judul_kti]',
														lokasi = '$_POST[lokasi]',
														prodi = '$_POST[prodi]',
														tahun_akademik = '$_POST[tahun_akademik]',
														tugas_akhir = '$_POST[tugas_akhir]'
																								
												  		where id_surat_pra_penelitian= '$_POST[id_surat_pra_penelitian]'");
		if($qr)
		{
			echo "<script>alert('Data berhasil diperbarui');window.location='05_daftar_surat_pra_penelitian.php?halaman=$_POST[halaman]'</script>";
		}
		else
		{
			echo "<script>alert('Mohon maaf, data gagal diperbarui.');window.location='05_daftar_surat_pra_penelitian.php?halaman=$_POST[halaman]'</script>";
		}
	}
	else
	{
		if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $tipe_file == "image/jpg")
		{
			if($ukuran_file <= 3000000)
			{
				if(move_uploaded_file($tmp_file, $path))
				{
					$qr = mysqli_query($kon, "update tb_surat_pra_penelitian set nama_mahasiswa = '$_POST[nama_mahasiswa]',
														nim_mahasiswa = '$_POST[nim_mahasiswa]',
														tujuan = '$_POST[tujuan]',
														judul_kti = '$_POST[judul_kti]',
														lokasi = '$_POST[lokasi]',
														prodi = '$_POST[prodi]',
														tahun_akademik = '$_POST[tahun_akademik]',
														tugas_akhir = '$_POST[tugas_akhir]'												
												  	where id_surat_pra_penelitian= '$_POST[id_surat_pra_penelitian]'");
					if($qr)
					{
						echo "<script>alert('Data berhasil diperbarui.');window.location='05_daftar_surat_pra_penelitian.php?halaman=$_POST[halaman]'</script>";
					}
					else
					{
						echo "<script>alert('Mohon maaf, data gagal diperbarui.');window.location='05_daftar_surat_pra_penelitian.php?halaman=$_POST[halaman]'</script>";
					}
				}
				else
				{
					echo "<script>alert('Mohon maaf, Gambar gagal diupload.');window.location='05_daftar_surat_pra_penelitian.php?halaman=$_POST[halaman]'</script>";
				}
			}
			else
			{
				echo "<script>alert('Mohon maaf, Gambar tidak boleh melebihi 1 Mb.');window.location='05_daftar_surat_pra_penelitian.php?halaman=$_POST[halaman]'</script>";
			}
		}
		else
		{
			echo "<script>alert('Mohon maaf, type gambar yang diperbolehkan .jpg , .jpeg , .png');window.location='05_daftar_surat_pra_penelitian.php?halaman=$_POST[halaman]'</script>";
		}
	}
}
?>
