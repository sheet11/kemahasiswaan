<?php
include __DIR__ . '/session.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<title>Admin Ijazah - Poltekkes Kemenkes Bengkulu</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/ionicons.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
</head>
<body class="skin-black">
	<header class="header">
		<a href="index.php" class="logo">Kemahasiswaan</a>
		<nav class="navbar navbar-static-top" role="navigation">
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Buka navigasi</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span><?php echo htmlspecialchars($_SESSION['nama_lengkap'] ?? 'Admin Ijazah'); ?></span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>

	<div class="wrapper row-offcanvas row-offcanvas-left">
		<aside class="left-side sidebar-offcanvas">
			<section class="sidebar">
				<div class="user-panel">
					<div class="image">
						<img src="../assets/img/logo.polkeslu.png" class="img-circle" alt="Poltekkes">
					</div>
					<div class="info">
						<p><?php echo htmlspecialchars($_SESSION['nama_lengkap'] ?? 'Admin Ijazah'); ?></p>
					</div>
				</div>

				<ul class="sidebar-menu">
					<li>
						<a href="index.php">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li>
						<a href="01_daftar_ijazah.php">
							<i class="fa fa-list"></i>
							<span>Daftar Ijazah</span>
						</a>
					</li>
					<li>
						<a href="01_tambah_ijazah.php">
							<i class="fa fa-plus"></i>
							<span>Tambah Ijazah</span>
						</a>
					</li>
					<li>
						<a href="import/index.php">
							<i class="fa fa-upload"></i>
							<span>Import Ijazah</span>
						</a>
					</li>
					<li>
						<a href="logout.php">
							<i class="fa fa-sign-out"></i>
							<span>Log Out</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/AdminLTE/app.js"></script>
