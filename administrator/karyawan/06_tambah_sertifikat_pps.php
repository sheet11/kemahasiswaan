<?php 	include"01_nav.php";
		include"../assets/js/date.php";
?>
<?php


if($_SESSION['level'] == "karyawan"){ ?>
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="" enctype="multipart/form-data">	
		<table style="width:100%" class="table table-basic">
			<tr>
			<td colspan="2"><b><h4>Tambah Data + </b></h4></td> 
			</tr>

			<tr>
				<td colspan="2"><b>Nama Mahasiswa</b></td> 
			</tr>
			<tr>
				<td colspan="2"><input type="text" placeholder="Nama Mahasiswa" name="nama_lengkap" required="yes" class="form-control"> </td>
			<tr>

			<tr>	
				<td colspan="4">
					<input type="submit" name="submit" value="SIMPAN"  class="btn btn-primary">
					<input type="reset" name="submit" value="Hapus" class="btn btn-danger">
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>
		<?php
			include"../config/koneksi.php";
	
				if(isset($_POST['submit'])){
														
				$query=mysql_query("insert into tb_sertifikat_pps(nama_lengkap)
									values('$_POST[nama_lengkap]')");
					
										
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='06_daftar_sertifikat_pps.php'</script>";
					}
				}					
		?>


				
<?php } ?>	 	
	</body>
</html>
