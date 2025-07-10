
<?php

	include "../config/koneksi.php";	
	mysqli_query($kon, "update tb_surat_penelitian set status = 'Sudah Dicetak' where id_surat_penelitian ='$_GET[id_surat_penelitian]'");
?>


<?php
	include "session.php";
	include"../config/koneksi.php";
	include('bar128.php');
  	include("library.php");
  	include("fucnt_tgl.php");
	
	$query=mysqli_query($kon, "SELECT * from tb_surat_penelitian where id_surat_penelitian='$_GET[id_surat_penelitian]' ");
	$a=mysqli_fetch_array($query);
    $tanggal2 = tgl_indo($a['tanggal_cetak']);
?>

<style type="text/css">;
    body { font-family: Arial; line-height:200%; font-size:11.0pt;}
    p { font-family: Arial; line-height:200%; font-size:11.0pt;}
    div { font-family: Arial; line-height:200%; font-size:11.0pt;}
	table { font-family: Arial; line-height:200%; font-size:11.0pt;}
</style>

<table cellpadding="60">
	<tr>
		<td></td>
	</tr>
</table>

<body>
<!-- <p class="MsoBodyText"><span style="mso-ignore:vglayout;position:
relative;z-index:-1895824384"><span style="position:absolute;left:0px;
top:-215px;width:794px;height:227px"><img width="794" height="227" src="../assets/images/kop2024.png" v:shapes="Picture_x0020_14"></span></span><span lang="id" style="font-size:10.0pt;mso-bidi-font-size:12.0pt"><o:p></o:p></span></p> -->
		<tr>
	<table border="0" align="center" width="95%" cellpadding="0" style="text-align:justify; line-height:150%;">
		<tr>
			<td colspan="3" align="right"><?php echo "$tanggal2"; ?></td>
		</tr>

		<tr >
			<td  width="25%">Nomor	: </td><td width="2%">:</td><td>PP. 01.01/F.XXIII.1/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?php echo date('Y'); ?></td>
		</tr>

		<tr>
			<td>Perihal</td>
			<td>:</td>
			<td><b>Izin Penelitian</b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		<tr>
			<td>Yth,</td>
		</tr>

		<tr>
			<td colspan="3"><b><?php echo "$a[tujuan]"; ?></b></td>
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

	<table border="0" align="center" width="95%" cellpadding="0">
		<tr>
			<td valign="left" colspan="3" style="text-align:justify;">&nbsp; &nbsp; &nbsp;Sehubungan penyusunan tugas akhir mahasiswa dalam bentuk <?php echo "$a[tugas_akhir]"; ?> Progam Studi <?php echo "$a[prodi]"; ?>  Jurusan <?php echo "$a[jurusan]"; ?> Politeknik Kesehatan Kemenkes Bengkulu Tahun Akademik <?php echo "$a[tahun_akademik]"; ?>  , dengan ini kami mohon Bapak/Ibu dapat memberikan izin pengambilan data untuk penelitian kepada:</td>
		</tr>
	</table>

	<table border="0" align="center" width="95%" cellpadding="1">
		<tr>
			<td width="25%">Nama</td>
			<td width="1%">: </td> 
			<td><?php echo "$a[nama_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>NIM </td>
			<td>:</td>
			<td><?php echo "$a[nim_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td valign="top">Tempat Penelitian </td>
			<td valign="top">:</td>
			<td><?php echo "$a[tempat_penelitian]"; ?></td>
		</tr>

		<tr>
			<td>Waktu Penelitian </td>
			<td>:</td>
			<td><?php echo "$a[lama_penelitian]"; ?></td>
		</tr>

		<tr>
			<td valign="top">Judul </td>
			<td valign="top">:</td>
			<td style="text-align:justify;"><?php echo "$a[judul_kti]"; ?> </td>
		</tr>

		<tr>
			<td>No Handphone </td>
			<td>:</td>
			<td><?php echo "$a[no_hp]"; ?></td>
		</tr>

		<tr>
			<td colspan="3" style="text-align:justify;" >&nbsp; &nbsp; &nbsp;Demikianlah, atas perhatian dan kesediaan Bapak/Ibu diucapkan terimakasih.</td>
		</tr>
	</table>

	<table border="0" align="center" width="95%" cellpadding="0" style="text-align:justify;">
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; a.n. Direktur Poltekkes Kemenkes Bengkulu</td>
		</tr>

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Wakil Direktur I Bidang Akademik</td>
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
			<td>&nbsp; </td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Septiyanti, S.Kep, Ners, M.Pd</b></td>
		</tr>

	</table>

	<table border="0" align="center" width="95%" cellpadding="0">
	
	</table>
	<!-- <p class="MsoBodyText" style="margin-top:1.2pt;margin-right:0cm;margin-bottom:
0cm;margin-left:262.55pt;margin-bottom:.0001pt"><span style="mso-ignore:vglayout;position:
absolute;z-index:251661312;left:0px;margin-left:700px;margin-top:120px;
width:61px;height:61px"><img width="61" height="61" src="..//assets/images/blu.png" v:shapes="Picture_x0020_1"></span></span></p> -->
</body>

<script>
  window.print();
</script>