<?php
// memanggil file koneksi.php
include "config/koneksi.php";
// membuat variable dengan nilai dari form
$username = $_POST['username']; // variablenya = username, dan nilainya sesuai yang dimasukkan di input name="username" tadi
$password = ($_POST['password']); // variable password, dan nilainya sesuai yang dimasukkan di input name="password" tadi
// md5 ada sebuah fungsi PHP untuk engkripsi. misalnya admin jadi 21232f297a57a5a743894a0e4a801fc3. untuk lengkapnya, silahkan googling tentang md5

// proses untuk login

// menyesuaikan dengan data di database
$perintah = "select * from tb_user WHERE username = '$username' AND password = '$password'";
$hasil = mysqli_query($kon,$perintah);
$ada = mysqli_num_rows($hasil);
$row = mysqli_fetch_array($hasil);
if ($ada > 0) {
	if($row['level'] == "karyawan")
	{
		session_start(); // memulai fungsi session
		$_SESSION['username'] = $username;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:karyawan/index.php"); // jika berhasil login, maka masuk ke file home.php
	}
	elseif($row['level'] == "penilai")
	{
		session_start(); // memulai fungsi session
		$_SESSION['username'] = $username;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:penilai/index.php"); // jika berhasil login, maka masuk ke file home.php
	}
	elseif($row['level'] == "administrator")
	{
		session_start(); // memulai fungsi session
		$_SESSION['username'] = $username;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:administrator/index.php"); // jika berhasil login, maka masuk ke file home.php
	}
	else
	{
		session_start(); // memulai fungsi session
		$_SESSION['username'] = $username;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:atasan/index.php"); // jika berhasil login, maka masuk ke file home.php
	}
}
else
{
	$perintah = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
	$hasil = mysqli_query($kon,$perintah);
	$ada = mysqli_num_rows($hasil);
	$row = mysqli_fetch_array($hasil);
	if($ada > 0)
	{
		if($row['level'] == 'administrator')
		{
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
			$_SESSION['level'] = $row['level'];
			header("location:administrator/index.php"); // jika berhasil login, maka masuk ke file home.php
		}
		elseif($row['level'] == 'verifikator1')
		{
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
			$_SESSION['level'] = $row['level'];
			header("location:verifikator1/index.php"); // jika berhasil login, maka masuk ke file home.php
		}
		elseif($row['level'] == 'verifikator2')
		{
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
			$_SESSION['level'] = $row['level'];
			header("location:verifikator2/index.php"); // jika berhasil login, maka masuk ke file home.php
		}
		elseif($row['level'] == 'atasan')
		{
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
			$_SESSION['level'] = $row['level'];
			header("location:atasan/index.php"); // jika berhasil login, maka masuk ke file home.php
		}
		else
		{
			echo "Gagal Masuk";
		}	
	}
	else
	{
		echo "Gagal Masuk";
	}	
}
?>