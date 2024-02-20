<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>
    <script src="js/jquery-1.11.0.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<?php
			
			require_once("../config/koneksi.php");
			
			if(isset($_POST['submit'])){
				
				$query = mysql_query("SELECT * FROM tb_surat_masuk WHERE tanggal_masuk BETWEEN '$_POST[tanggal_masuk]' AND '$_POST[tanggal_masuk]'");
				
				if($query){
				echo"
				<p>&nbsp;</p>
					<table style='width:100%;' class='table table-hover'>
						<tr>
							<td>No Surat</td><td>Judul Surat</td><td>Tanggal Surat</td><td>tanggal_masuk</td><td>Lokasi Arsip</td><td>Nama Pengirim</td>
						</tr>
				";
					
					while($a=mysql_fetch_array($query)){
						echo"
							<tr>
								<td>$a[no_surat]</td><td>$a[judul_surat]</td><td>$a[tanggal_surat]</td><td>$a[tanggal_masuk]</td><td>$a[lokasi_arsip]</td><td> $a[nama_pengirim]</td>
							</tr>
							";	
					}
				echo "</table>";	
				}
				
				else{		
					echo"data tidak ditemukan";
				}	
				
			}	
			?>

			