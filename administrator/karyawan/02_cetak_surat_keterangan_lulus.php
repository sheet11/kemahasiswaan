<?php
	include "session.php";
?>


<?php

	include "../config/koneksi.php";	
	mysqli_query($kon,"update tb_surat_keterangan_lulus set status = 'Sudah Dicetak' where id_surat_keterangan_lulus ='$_GET[id_surat_keterangan_lulus]'");
?>


<?php
	include"../config/koneksi.php";
	include('bar128.php');
  	include("library.php");
  	include("fucnt_tgl.php");
	
	$query=mysqli_query($kon, "SELECT * from tb_surat_keterangan_lulus where id_surat_keterangan_lulus='$_GET[id_surat_keterangan_lulus]'");
	$a=mysqli_fetch_array($query);
    $tanggal1 = tgl_indo($a['tanggal_lahir']);
    $tanggal2 = tgl_indo($a['tanggal_cetak']);
	$tanggal3 = tgl_indo($a['tanggal_sk']);
	$tanggal4 = tgl_indo($a['tanggal_wisudah']);

?>

<style type="text/css">;
    body { font-family: Arial; line-height:150%; font-size:11.0pt;}
    p { font-family: Arial; line-height:150%; font-size:11.0pt;}
    div { font-family: Arial; line-height:150%; font-size:11.0pt;}
	table { font-family: Arial; line-height:150%; font-size:11.0pt;}
</style>
	<table cellpadding="50">
		<tr><td></td></tr>
	</table>

	<table border="0" width="100%" cellpadding="0">
	<!-- <p class="MsoBodyText"><span style="mso-ignore:vglayout;position:relative;z-index:-1895824384"><span style="position:absolute;left:0px;
top:-190px;width:794px;height:227px"><img width="794" height="227" src="../assets/images/kop2024.png" v:shapes="Picture_x0020_14"></span></span><span lang="id" style="font-size:10.0pt;mso-bidi-font-size:12.0pt"><o:p></o:p></span></p> -->
		<tr>
			<td colspan="3" align="center" style='font-size:18.0pt;'><b><u>SURAT KETERANGAN</u></b><br></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><b>Nomor : PP.01.01/1/     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;        <?php echo date('Y'); ?></b></td>
		</tr>
	</table>


	<table border="0" width="100%" cellpadding="3">
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		<tr>
			<td colspan="3">Yang bertandatangan dibawah ini :</td>
		</tr>
		
		<tr>
			<td>Nama</td><td width="2%">:</td><td>	Eliana, SKM, M.PH</td>
		</tr>

		<tr>
			<td>NIP	</td><td>:</td><td>196505091989032001</td>
		</tr>

		<tr>
			<td>Pangkat, Golongan/Ruang</td><td>:</td><td> Pembina/ IVa</td>
		</tr>

		<tr>
			<td>Jabatan	</td><td>:</td><td> Direktur Poltekkes Kemenkes Bengkulu</td>
		</tr>


		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		<tr>
			<td colspan="3">Dengan ini menerangkan bahwa </td>
		</tr>

		<tr>
			<td>Nama 	</td><td>: </td> <td><?php echo "$a[nama_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>NIM </td><td>	:</td><td>	<?php echo "$a[nim_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>Tempat, Tanggal Lahir 	</td><td>:	</td><td><?php echo "$a[tempat_lahir]"; ?>, <?php echo "$tanggal1"; ?></td>
		</tr>
	</table>
<br>
	<table border="0" width="100%" cellpadding="5">
		<tr>
			<td colspan="3" style="text-align:justify;line-height:200%;"  >telah dinyatakan <b>LULUS</b> pada <b>Program Studi <?php echo "$a[prodi]"; ?> Jurusan <?php echo "$a[jurusan]"; ?> Poltekkes Kemenkes Bengkulu</b> dan telah mengikuti Wisuda pada tanggal <?php echo "$tanggal4"; ?> di Bengkulu, berdasarkan Surat Keputusan Direktur Poltekkes Kemenkes Bengkulu Nomor : PP.01.01/1/<?php echo "$a[nomor_surat]"; ?> Tanggal <?php echo "$tanggal3"; ?> tentang Penetapan Lulusan Diploma Tiga dan Sarjana Terapan di Politeknik Kesehatan Kementerian Kesehatan Bengkulu Tahun Akademik <?php echo "$a[tahun_akademik]"; ?></td>
		</tr>


		<tr>
			<td colspan="3" style="text-align:justify;line-height:200%;" >Demikian Surat Keterangan ini dibuat dengan sesungguhnya agar dapat digunakan sebagaimana mestinya.</td>
		</tr>

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Bengkulu, <?php echo "$tanggal2"; ?></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Direktur,</td>
		</tr>
			<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>	

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b><u>Linda, SST, M.Kes</u></b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;NIP.196909011989032001</td>
		</tr>
		<!-- <p class="MsoBodyText" style="margin-top:1.2pt;margin-right:0cm;margin-bottom:0cm;margin-left:262.55pt;margin-bottom:.0001pt"><span style="mso-ignore:vglayout;position:
absolute;z-index:251661312;left:0px;margin-left:700px;margin-top:500px;
width:61px;height:61px"><img width="61" height="61" src="..//assets/images/blu.png" v:shapes="Picture_x0020_1"></span></span></p> -->
	</table>
</body>

<script>
  window.print();
</script>