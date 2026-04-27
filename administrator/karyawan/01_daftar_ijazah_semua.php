<?php include"01_nav.php";?>
<?php error_reporting(0); ?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">



<?php
// BACK OFFICE


// super user
if($_SESSION['level'] == "karyawan"){ ?>
<aside class="right-side">
	<section class="content-header">
		<div class="container-fluid" style="margin:10px;">	
		<table style="width:100%;">
			<tr class="info">
					<td align="left" colspan="6"><b><h4>Daftar Ijazah</b></h4></td>   
			</tr>
			
			<tr>
				<td>
					<a href="01_tambah_ijazah.php" class="btn btn-primary">Tambah data + </a>
					<a href="../../import" class="btn btn-primary">Import data + </a>
					<a class="btn btn-info" > <i class="fa fa-cloud fa-sm"></i> | Jumlah : <?php
																	require_once("../config/koneksi.php");
																	$query = mysqli_query ($kon, "SELECT * from tb_ijazah");
																	$jumlah = mysqli_num_rows ($query); ?>
																	<?php echo $jumlah; ?> </a>
					<a class="btn btn-success" > <i class="fa fa-spinner fa-sm"></i> | Belum Di Proses : <?php
																	require_once("../config/koneksi.php");
																	$query = mysqli_query ($kon, "SELECT * from tb_ijazah where status='Belum Dicetak' ");
																	$jumlah = mysqli_num_rows ($query); ?>
																	<?php echo $jumlah; ?> </a>

					<a class="btn btn-danger" > <i class="fa fa-spinner fa-sm"></i> | Sudah Di Proses : <?php
																	require_once("../config/koneksi.php");
																	$query = mysqli_query ($kon, "SELECT * from tb_ijazah where status='Sudah Dicetak' ");
																	$jumlah = mysqli_num_rows ($query); ?>
																	<?php echo $jumlah; ?> </a>
					
					<!-- Filter Jurusan -->
					<form method="GET" style="display:inline;">
						<select name="filter_jurusan" onchange="this.form.submit()" class="btn btn-default">
							<option value="">-- Filter Jurusan --</option>
							<?php
								$jurusan_query = mysqli_query($kon, "SELECT DISTINCT jurusan FROM tb_ijazah");
								while ($row = mysqli_fetch_assoc($jurusan_query)) {
									$selected = ($_GET['filter_jurusan'] == $row['jurusan']) ? 'selected' : '';
									echo "<option value='{$row['jurusan']}' $selected>{$row['jurusan']}</option>";
								}
							?>
						</select>
					</form>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		
		<br>
		<div class="box-body table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>	
						<tr class="info">
							<th>No.</th><th>Nama Lengkap</th><th width="15%">NIM</th><th>Tempat/Tgl Lahir</th><th>Jurusan</th><th>Status</th><th width="12%">Aksi</th>
						</tr>
					</thead>
			<?php 
					$filter_jurusan = isset($_GET['filter_jurusan']) ? $_GET['filter_jurusan'] : '';
					$query_str = "SELECT * from tb_ijazah";
					if (!empty($filter_jurusan)) {
						$query_str .= " WHERE jurusan = '$filter_jurusan'";
					}
					$query_str .= " order by id_ijazah desc";
					$query = mysqli_query($kon, $query_str);
				
					$i = 1;		
				while($a=mysqli_fetch_array($query)){

				echo"
				<tr>
					<td>$i</td>
					<td>$a[nama_lengkap]</td>
					<td>$a[nim]</td>
					<td>$a[tempatdantgl_lahir]</td>
					<td>$a[jurusan]</td>
					<td>$a[status]</td>
					<td>
						
						<a href='01_cetak_ijazah.php?id_ijazah=$a[id_ijazah]'class=' glyphicon glyphicon-print btn btn-success'> </a>
							
			

						
						<a href='01_edit_ijazah.php?id_ijazah=$a[id_ijazah]' class='glyphicon glyphicon-pencil btn btn-warning'> </a>
						
	
						
						<a href='01_delete_ijazah.php?id_ijazah=$a[id_ijazah]' class='glyphicon glyphicon-remove btn btn-danger'  onclick='return confirm(\"Anda yakin akan menghapus $a[nama_lengkap] ?\")'> </a>
							
						</a>
					</td>
				</tr>";
				$i++;
			}
			
?>
		
	 
	</div>
</div>	
		<script src="../assets/js/jquery-1.11.1.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/dataTables.bootstrap.js"></script>	
		<script type="text/javascript">
			$(function() {
				$('#example1').dataTable({
					stateSave: true
				});
			});
		</script>		
<?php
}
