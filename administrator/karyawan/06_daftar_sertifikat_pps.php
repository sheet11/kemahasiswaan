<?php include"01_nav.php";?>
<?php error_reporting(0); ?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">



<?php
// BACK OFFICE


// super user
if($_SESSION['level'] == "karyawan"){ ?>
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">	
    	<table style="width:100%;">
    		<tr class="info">
					<td align="left" colspan="6"><b><h4>Daftar Sertifikat PPS</b></h4></td>   
			</tr>
		  	
			<tr>
				<td><a href="06_tambah_sertifikat_pps.php" class="btn btn-primary">Tambah data + </a></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
	  
		<div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>	
		  				<tr class="info">
							<th width="2%">No.</th><th>NIM Mahasiswa</th><th>Nama Mahasiswa</th><th width="50">Aksi</th>
						</tr>
					</thead>
			<?php 
							
					$query=mysql_query("select * from tb_sertifikat_pps order by id_sertifikat desc ");
				
					$i = +1;		
				while($a=mysql_fetch_array($query)){

				echo"
				<tr>
					<td>$i</td>
					<td>$a[nim]</td>
					<td>$a[nama_lengkap]</td>
					<td>
						<a href='06_cetak_sertifikat_pps.php?id_sertifikat=$a[id_sertifikat]'>
							<span class='glyphicon glyphicon-print' aria-hidden='true'></span>
						</a>
						<a href='06_edit_sertifikat_pps.php?id_sertifikat=$a[id_sertifikat]'>
							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a> 
						<a href='06_delete_sertifikat_pps.php?id_sertifikat=$a[id_sertifikat]' onclick='return confirm(\"Anda yakin akan menghapus $a[nama_lengkap] ?\")'>
							<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
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
                $('#example1').dataTable();
            });
        </script>		
<?php
}




