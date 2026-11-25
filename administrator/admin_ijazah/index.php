<?php
include __DIR__ . '/01_nav.php';

$totalIjazah = 0;
$belumDicetak = 0;
$sudahDicetak = 0;

if ($kon) {
	$totalResult = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM tb_ijazah");
	$belumResult = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM tb_ijazah WHERE status='Belum Dicetak'");
	$sudahResult = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM tb_ijazah WHERE status='Sudah Dicetak'");

	if ($totalResult) {
		$totalIjazah = (int) mysqli_fetch_assoc($totalResult)['jumlah'];
	}
	if ($belumResult) {
		$belumDicetak = (int) mysqli_fetch_assoc($belumResult)['jumlah'];
	}
	if ($sudahResult) {
		$sudahDicetak = (int) mysqli_fetch_assoc($sudahResult)['jumlah'];
	}
}
?>
<aside class="right-side">
	<section class="content-header">
		<h1>Dashboard Admin Ijazah</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-4 col-xs-12">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $totalIjazah; ?></h3>
						<p>Total Ijazah</p>
					</div>
					<div class="icon"><i class="fa fa-files-o"></i></div>
					<a href="01_daftar_ijazah.php" class="small-box-footer">Lihat daftar <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-4 col-xs-12">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo $belumDicetak; ?></h3>
						<p>Belum Dicetak</p>
					</div>
					<div class="icon"><i class="fa fa-clock-o"></i></div>
					<a href="01_daftar_ijazah.php" class="small-box-footer">Lihat daftar <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-4 col-xs-12">
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $sudahDicetak; ?></h3>
						<p>Sudah Dicetak</p>
					</div>
					<div class="icon"><i class="fa fa-check"></i></div>
					<a href="01_daftar_ijazah.php" class="small-box-footer">Lihat daftar <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</section>
</aside>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/AdminLTE/app.js"></script>
</body>
</html>
