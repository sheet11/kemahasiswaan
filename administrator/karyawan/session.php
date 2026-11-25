<?php
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}

	if (!isset($_SESSION['level']) || $_SESSION['level'] !== "karyawan") {
		header('Location: ../index.php', true, 303);
		exit;
	}

	require_once "../config/koneksi.php";
?>
