<?php
include __DIR__ . '/01_nav.php';

$countResult = mysqli_query($kon, 'SELECT COUNT(*) AS jumlah FROM tb_ijazah');
$belumResult = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM tb_ijazah WHERE status='Belum Dicetak'");
$sudahResult = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM tb_ijazah WHERE status='Sudah Dicetak'");

$jumlah = $countResult ? (int) mysqli_fetch_assoc($countResult)['jumlah'] : 0;
$belum = $belumResult ? (int) mysqli_fetch_assoc($belumResult)['jumlah'] : 0;
$sudah = $sudahResult ? (int) mysqli_fetch_assoc($sudahResult)['jumlah'] : 0;
?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">
<style>
	#tabel-ijazah th:last-child,
	#tabel-ijazah td:last-child {
		width: 180px;
		text-align: center;
		white-space: nowrap;
	}

	#tabel-ijazah .aksi-buttons {
		display: inline-flex;
		align-items: center;
		gap: 4px;
	}

	#tabel-ijazah .aksi-buttons .btn {
		width: 32px;
		height: 32px;
		padding: 6px 0;
		border-radius: 4px;
	}

	#tabel-ijazah .aksi-buttons .btn i {
		font-size: 14px;
	}
</style>

<aside class="right-side">
	<section class="content-header">
		<h1>Daftar Ijazah</h1>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="box box-primary">
				<div class="box-header">
					<a href="01_tambah_ijazah.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah data</a>
					<a href="import/index.php" class="btn btn-primary"><i class="fa fa-upload"></i> Import data</a>
					<span class="btn btn-info">Jumlah: <?php echo $jumlah; ?></span>
					<span class="btn btn-success">Belum dicetak: <?php echo $belum; ?></span>
					<span class="btn btn-danger">Sudah dicetak: <?php echo $sudah; ?></span>
				</div>
				<div class="box-body">
					<div class="form-group" style="max-width:260px">
						<label for="filter-status">Filter status</label>
						<select id="filter-status" class="form-control">
							<option value="">Semua status</option>
							<option value="Belum Dicetak">Belum Dicetak</option>
							<option value="Sudah Dicetak">Sudah Dicetak</option>
						</select>
					</div>
					<div class="table-responsive">
						<table id="tabel-ijazah" class="table table-bordered table-striped" style="width:100%">
							<thead>
								<tr class="info">
									<th>No.</th>
									<th>Nama Lengkap</th>
									<th>NIM</th>
									<th>Tempat/Tgl Lahir</th>
									<th>Jurusan</th>
									<th>Status</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</aside>
</div>

<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap.js"></script>
<script>
$(function () {
	var tabel = $('#tabel-ijazah').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: 'ajax_load_ijazah.php',
			type: 'GET',
			data: function (data) {
				data.filter_status = $('#filter-status').val();
			}
		},
		pageLength: 25,
		lengthMenu: [[25, 50, 100], [25, 50, 100]],
		order: [[0, 'desc']],
		stateSave: true,
		columns: [
			{orderable: true},
			{orderable: true},
			{orderable: true},
			{orderable: true},
			{orderable: true},
			{orderable: true},
			{orderable: false, searchable: false}
		],
		language: {
			processing: 'Memuat data...',
			search: 'Cari:',
			lengthMenu: 'Tampilkan _MENU_ data',
			info: 'Menampilkan _START_-_END_ dari _TOTAL_ data',
			infoEmpty: 'Tidak ada data',
			zeroRecords: 'Data tidak ditemukan',
			paginate: {
				first: 'Pertama',
				last: 'Terakhir',
				next: 'Selanjutnya',
				previous: 'Sebelumnya'
			}
		}
	});

	$('#filter-status').on('change', function () {
		tabel.ajax.reload(null, false);
	});
});
</script>
</body>
</html>

