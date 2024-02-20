<?php 
	include"01_nav.php";
	include "../assets/js/date.php";
?>

<aside class="right-side">
    <section class="content-header">
        <div class="container-fluid" style="margin:10px;"> 
			<form method="post" action="" enctype="multipart/form-data">		
				<table style="width:100%;" class="table table-hover" >
					<tr>
						<td colspan="2"><label>Laporan Surat Penelitian</label></td>
					</tr>
					
					<tr>
						<td><input id="tgls" type="date" placeholder="dari" name="tanggal_masuk_awal" required="yes" class="form-control"></td>
						<td><input id="tglf" type="date" placeholder="sampai" name="tanggal_masuk_akhir" required="yes" class="form-control"></td>
					</tr>
					
					<tr>	
						<td colspan="2"><input type="submit" name="submit" value="Tampil" class="btn btn-primary"></td>
					</tr>
				</table>
			</form>			
	
			<?php
					require_once("../config/koneksi.php");
			
			if(isset($_POST['submit'])){
				
				$query = mysqli_query($kon, "SELECT * FROM tb_surat_penelitian WHERE tanggal_cetak BETWEEN '$_POST[tanggal_masuk_awal]' AND '$_POST[tanggal_masuk_akhir]' and status='Sudah Dicetak' ");
				
				if($query){
				echo"
				<p>&nbsp;</p>
					<table class='table table-hover'>
						<tr class='success'>
							<td>No</td><td>Nama Mahasiswa</td><td>Tanggal Surat</td>
						</tr>
				";
					$i = +1;
					while($a=mysqli_fetch_array($query)){
						echo"
							<tr>
								<td>$i</td><td>$a[nama_mahasiswa]</td><td>$a[tanggal_cetak]</td>
							</tr>
							";
					$i++;	
					}
				echo "</table>";	
				}
				
				else{		
					echo"data tidak ditemukan";
				}	
				
			}	
			?>
			</div>
		</div>
	</body>
</html>
