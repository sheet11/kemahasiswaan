<?php
	include "session.php";
?>

<?php

	include "../config/koneksi.php";	
	mysqli_query($kon, "update tb_surat_pra_penelitian set status = 'Sudah Dicetak' where id_surat_pra_penelitian ='$_GET[id_surat_pra_penelitian]'");
?>

<style type="text/css">;
    body { font-family: Arial; line-height:200%; font-size:11.0pt;}
    p { font-family: Arial; line-height:200%; font-size:11.0pt;}
    div { font-family: Arial; line-height:200%; font-size:11.0pt;}
	table { font-family: Arial; line-height:200%; font-size:11.0pt;}
</style>

<?php
	include"../config/koneksi.php";
	include('bar128.php');
  	include("library.php");
  	include("fucnt_tgl.php");
	
	$query=mysqli_query($kon, "SELECT * from tb_surat_pra_penelitian where id_surat_pra_penelitian='$_GET[id_surat_pra_penelitian]' ");
	$a=mysqli_fetch_array($query);
    $tanggal2 = tgl_indo($a['tanggal_cetak']);

?>
<table cellpadding="80"><tr><td></td></tr></table>
<body>


<table border="0" align="center" width="90%" cellpadding="0" style="line-height:150%;">
<!-- <p class="MsoBodyText"><span style="mso-ignore:vglayout;position:
relative;z-index:-1895824384"><span style="position:absolute;left:0px;
top:-227px;width:794px;height:227px"><img width="794" height="227" src="../assets/images/kop2024.png" v:shapes="Picture_x0020_14"></span></span><span lang="id" style="font-size:10.0pt;mso-bidi-font-size:12.0pt"><o:p></o:p></span></p> -->
		<tr>
			<td colspan="3" align="right"><?php echo "$tanggal2"; ?></td>
		</tr>

		<tr>
			<td  width="25%">Nomor	: </td><td width="2%">:</td><td>PP.06.02/F.XXIII.1/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?php echo date('Y'); ?></td>
		</tr>

		<tr>
			<td>Perihal</td>
			<td>:</td>
			<td><b>Izin Pra Penelitian</b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>


		<tr>
			<td>Yth.</td>
		</tr>

		<tr>
			<td colspan="3" style="text-transform:capitalize;text-align:justify;"><b><?php echo "$a[tujuan]"; ?></b></td>
		</tr>

		<tr>
			<td>di </td>
		</tr>

		<tr>
			<td>&nbsp; &nbsp; <b>Tempat</b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		</table>

		<table border="0" align="center" width="90%" cellpadding="0">

		<tr>
			<td valign="left" colspan="3" style="text-align:justify;line-height:200%">&nbsp; &nbsp; &nbsp;Sehubungan penyusunan tugas akhir dalam bentuk <?php echo "$a[tugas_akhir]"; ?> Mahasiswa Progam Studi <?php echo "$a[prodi]"; ?> Jurusan <?php echo "$a[jurusan]"; ?>  Politeknik Kesehatan Kemenkes Bengkulu Tahun Akademik <?php echo "$a[tahun_akademik]"; ?>, dengan ini mohon Bapak/Ibu dapat memberikan izin pengambilan data, Pra Penelitian pada mahasiswa dibawah ini :</td>
		</tr>
		</table>

		<table border="0" align="center" width="90%" cellpadding="0">

		<tr>
			<td width="25%">&emsp;&emsp;&emsp;Nama Mahasiswa</td>
			<td width="1%">: </td> 
			<td style="text-transform:capitalize;text-align:justify;"><?php echo "$a[nama_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Nim </td>
			<td>:</td>
			<td style="text-transform:uppercase;text-align:justify;"><?php echo "$a[nim_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td valign="top">&emsp;&emsp;&emsp;Tempat</td>
			<td valign="top">:</td>
			<td valign="top" style="text-transform:capitalize;text-align:justify;line-height:200%"><?php echo "$a[lokasi]"; ?> </td>
		</tr>

		<tr>
			<td valign="top">&emsp;&emsp;&emsp;Judul </td>
			<td valign="top">:</td>
			<td style="text-transform:capitalize;text-align:justify;line-height:200%"><?php echo "$a[judul_kti]"; ?> </td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;No Handphone </td>
			<td>:</td>
			<td style="text-transform:uppercase;text-align:justify;"><?php echo "$a[no_hp]"; ?></td>
		</tr>

		<tr>
			<td colspan="3" style="text-align:justify;line-height:150%" >&nbsp; &nbsp; &nbsp;Demikianlah, atas perhatian dan kerjasamanya kami mengucapkan terimakasih.</td>
		</tr>

		</table>

	<table border="0" align="center" width="90%" cellpadding="0">
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp;</td>
		</tr>

		<!-- <tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;a.n. Direktur Poltekkes Kemenkes Bengkulu</td>
		</tr> -->

		 <tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	Wakil Direktur I Bidang Akademik</td>
		</tr>



		<tr>
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
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Septiyanti, S.Kep, Ners, M.Pd</b></td>
		</tr>

		<!-- <p class="MsoBodyText" style="margin-top:1.2pt;margin-right:0cm;margin-bottom:
0cm;margin-left:262.55pt;margin-bottom:.0001pt"><span style="mso-ignore:vglayout;position:
absolute;z-index:251661312;left:0px;margin-left:720px;margin-top:320px;
width:61px;height:61px"><img width="61" height="61" src="..//assets/images/blu.png" v:shapes="Picture_x0020_1"></span></span></p> -->
	</table>


</body>

<script>
  window.print();
</script>