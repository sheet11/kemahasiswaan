<?php
	session_start();
	include"../config/koneksi.php";
	
	if (!isset($_SESSION['level'])){
		header('location:../index.php');
	}
	elseif ($_SESSION['level'] != "karyawan"){
		header('location:../index.php');
	}
?>
