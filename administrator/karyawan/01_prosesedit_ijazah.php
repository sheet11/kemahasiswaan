<?php error_reporting(0); 
include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
			// Untuk foto
		$nama_file = $_FILES['gambar']['name'];
		$ukuran_file = $_FILES['gambar']['size'];
		$tipe_file = $_FILES['gambar']['type'];
		$tmp_file = $_FILES['gambar']['tmp_name'];
		$path = "../assets/img/".$nama_file;
		$path = "../assets/img/".$nama_file2;		
		// Folder tempat menyimpan gambarny
	
	if(empty($nama_file))
	{
		$qr = mysqli_query($kon, "update tb_ijazah set nama_lengkap = '$_POST[nama_lengkap]',
														nim = '$_POST[nim]',
														tempatdantgl_lahir = '$_POST[tempatdantgl_lahir]',
														nik = '$_POST[nik]',
														no_seri_ijazah = '$_POST[no_seri_ijazah]',
														jurusan = '$_POST[jurusan]',
														program_pendidikan = '$_POST[program_pendidikan]',
														tanggal_wisudah = '$_POST[tanggal_wisudah]',
														gelar = '$_POST[gelar]',
														tempat_cetak = '$_POST[tempat_cetak]',
														tanggal_cetak = '$_POST[tanggal_cetak]',
														pudir = '$_POST[pudir]',
														nip_pudir = '$_POST[nip_pudir]',
														direktur = '$_POST[direktur]',
														nip_direktur = '$_POST[nip_direktur]',
														no_akreditasi_prodi = '$_POST[no_akreditasi_prodi]'											
												  		where id_ijazah= '$_POST[id_ijazah]'");
		if($qr)
		{
			echo "<script>alert('Data berhasil diperbarui.');window.location='01_daftar_ijazah.php'</script>";
		}
		else
		{
			echo "<script>alert('Mohon maaf, data gagal diperbarui.');window.location='01_daftar_ijazah.php'</script>";
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
					$qr = mysqli_query($kon, "update tb_ijazah set nama_lengkap = '$_POST[nama_lengkap]',
														nim = '$_POST[nim]',
														tempatdantgl_lahir = '$_POST[tempatdantgl_lahir]',
														nik = '$_POST[nik]',
														no_seri_ijazah = '$_POST[no_seri_ijazah]',
														jurusan = '$_POST[jurusan]',
														program_pendidikan = '$_POST[program_pendidikan]',
														tanggal_wisudah = '$_POST[tanggal_wisudah]',
														gelar = '$_POST[gelar]',
														tempat_cetak = '$_POST[tempat_cetak]',
														tanggal_cetak = '$_POST[tanggal_cetak]',
														pudir = '$_POST[pudir]',
														nip_pudir = '$_POST[nip_pudir]',
														direktur = '$_POST[direktur]',
														nip_direktur = '$_POST[nip_direktur]',
														no_akreditasi_prodi = '$_POST[no_akreditasi_prodi]'															
														
												  		where id_ijazah= '$_POST[id_ijazah]'");
					if($qr)
					{
						echo "<script>alert('Data berhasil diperbarui.');window.location='01_daftar_ijazah.php'</script>";
					}
					else
					{
						echo "<script>alert('Mohon maaf, data gagal diperbarui.');window.location='01_daftar_ijazah.php'</script>";
					}
				}
				else
				{
					echo "<script>alert('Mohon maaf, Gambar gagal diupload.');window.location='01_daftar_ijazah.php'</script>";
				}
			}
			else
			{
				echo "<script>alert('Mohon maaf, Gambar tidak boleh melebihi 1 Mb.');window.location='01_daftar_ijazah.php'</script>";
			}
		}
		else
		{
			echo "<script>alert('Mohon maaf, type gambar yang diperbolehkan .jpg , .jpeg , .png');window.location='01_daftar_ijazah.php'</script>";
		}
	}
?>	
