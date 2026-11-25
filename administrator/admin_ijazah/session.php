<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin_ijazah') {
	header('Location: ../index.php', true, 303);
	exit;
}

require_once __DIR__ . '/../config/koneksi.php';
