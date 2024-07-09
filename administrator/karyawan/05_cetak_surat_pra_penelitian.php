<?php
	include "session.php";
?>

<?php

	include "../config/koneksi.php";	
	mysqli_query($kon, "update tb_surat_pra_penelitian set status = 'Sudah Dicetak' where id_surat_pra_penelitian ='$_GET[id_surat_pra_penelitian]'");
?>


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


<table border="0" align="center" width="90%" cellpadding="0">
<p class="MsoBodyText"><!--[if gte vml 1]><v:shapetype id="_x0000_t75"
 coordsize="21600,21600" o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe"
 filled="f" stroked="f">
 <v:stroke joinstyle="miter"/>
 <v:formulas>
  <v:f eqn="if lineDrawn pixelLineWidth 0"/>
  <v:f eqn="sum @0 1 0"/>
  <v:f eqn="sum 0 0 @1"/>
  <v:f eqn="prod @2 1 2"/>
  <v:f eqn="prod @3 21600 pixelWidth"/>
  <v:f eqn="prod @3 21600 pixelHeight"/>
  <v:f eqn="sum @0 0 1"/>
  <v:f eqn="prod @6 1 2"/>
  <v:f eqn="prod @7 21600 pixelWidth"/>
  <v:f eqn="sum @8 21600 0"/>
  <v:f eqn="prod @7 21600 pixelHeight"/>
  <v:f eqn="sum @10 21600 0"/>
 </v:formulas>
 <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
 <o:lock v:ext="edit" aspectratio="t"/>
</v:shapetype><v:shape id="Picture_x0020_14" o:spid="_x0000_s1026" type="#_x0000_t75"
 style='position:absolute;margin-left:-.25pt;margin-top:-77.3pt;width:595.3pt;
 height:170.15pt;z-index:-251657216;visibility:visible;mso-wrap-style:square;
 mso-width-percent:0;mso-height-percent:0;mso-wrap-distance-left:9pt;
 mso-wrap-distance-top:0;mso-wrap-distance-right:9pt;
 mso-wrap-distance-bottom:0;mso-position-horizontal:absolute;
 mso-position-horizontal-relative:page;mso-position-vertical:absolute;
 mso-position-vertical-relative:text;mso-width-percent:0;mso-height-percent:0;
 mso-width-relative:page;mso-height-relative:page'>
 <v:imagedata src="file:///C:/Users/labkom/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png"
  o:title=""/>
 <w:wrap anchorx="page"/>
</v:shape><![endif]--><!--[if !vml]--><span style="mso-ignore:vglayout;position:
relative;z-index:-1895824384"><span style="position:absolute;left:0px;
top:-227px;width:794px;height:227px"><img width="794" height="227" src="../assets/images/kop2024.png" v:shapes="Picture_x0020_14"></span></span><!--[endif]--><span lang="id" style="font-size:10.0pt;mso-bidi-font-size:12.0pt"><o:p></o:p></span></p>
		<tr>
			<td colspan="3" align="right"><?php echo "$tanggal2"; ?></td>
		</tr>

		<tr>
			<td  width="25%">Nomor	: </td><td width="2%">:</td><td>PP. 01.01/FXXXI.1/.…….../2024</td>
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
			<td>Yth,</td>
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
			<td valign="left" colspan="3" style="text-align:justify;line-height:200%">&nbsp; &nbsp; &nbsp;Sehubungan penyusunan tugas akhir mahasiswa dalam bentuk <?php echo "$a[tugas_akhir]"; ?> bagi Mahasiswa Progam Studi <?php echo "$a[prodi]"; ?> Jurusan <?php echo "$a[jurusan]"; ?>  Politeknik Kesehatan Kemenkes Bengkulu Tahun Akademik <?php echo "$a[tahun_akademik]"; ?>, dengan ini mohon kiranya Bapak/Ibu dapat memberikan rekomendasi izin pengambilan data, untuk Pra Penelitian pada mahasiswa dibawah ini :</td>
		</tr>
		</table>

		<table border="0" align="center" width="90%" cellpadding="0">

		<tr>
			<td width="25%">Nama</td>
			<td width="1%">: </td> 
			<td style="text-transform:capitalize;text-align:justify;"><?php echo "$a[nama_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>NIM </td>
			<td>:</td>
			<td style="text-transform:uppercase;text-align:justify;"><?php echo "$a[nim_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td valign="top">Lokasi</td>
			<td valign="top">:</td>
			<td valign="top" style="text-transform:capitalize;text-align:justify;line-height:200%"><?php echo "$a[lokasi]"; ?> </td>
		</tr>

		<tr>
			<td valign="top">Judul </td>
			<td valign="top">:</td>
			<td style="text-transform:capitalize;text-align:justify;line-height:200%"><?php echo "$a[judul_kti]"; ?> </td>
		</tr>

		<tr>
			<td>No Handphone </td>
			<td>:</td>
			<td style="text-transform:uppercase;text-align:justify;"><?php echo "$a[no_hp]"; ?></td>
		</tr>

		<tr>
			<td colspan="3" style="text-align:justify;line-height:150%" >&nbsp; &nbsp; &nbsp;Demikianlah, atas perhatian dan kesediaan Bapak/Ibu diucapkan terimakasih.</td>
		</tr>

		</table>

	<table border="0" align="center" width="90%" cellpadding="0">
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; an. Direktur Poltekkes Kemenkes Bengkulu</td>
		</tr>

		 <tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	Wakil Direktur Bidang Akademik</td>
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
			<td>&nbsp; </td>
		</tr>
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Agung Riyadi, S.Kep.Ns.M.Kes</b></td>
		</tr>

		<p class="MsoBodyText" style="margin-top:1.2pt;margin-right:0cm;margin-bottom:
0cm;margin-left:262.55pt;margin-bottom:.0001pt"><!--[if gte vml 1]><v:shape
 id="Picture_x0020_1" o:spid="_x0000_s1026" type="#_x0000_t75" style='position:absolute;
 left:0;text-align:left;margin-left:-16.5pt;margin-top:87pt;width:45.6pt;
 height:45.4pt;z-index:251661312;visibility:visible;mso-wrap-style:square;
 mso-width-percent:0;mso-height-percent:0;mso-wrap-distance-left:9pt;
 mso-wrap-distance-top:0;mso-wrap-distance-right:9pt;
 mso-wrap-distance-bottom:0;mso-position-horizontal:absolute;
 mso-position-horizontal-relative:right-margin-area;mso-position-vertical:absolute;
 mso-position-vertical-relative:text;mso-width-percent:0;mso-height-percent:0;
 mso-width-relative:margin;mso-height-relative:margin'>
 <v:imagedata src="file:///C:/Users/labkom/AppData/Local/Temp/msohtmlclip1/01/clip_image003.png"
  o:title=""/>
 <w:wrap anchorx="margin"/>
</v:shape><![endif]--><!--[if !vml]--><span style="mso-ignore:vglayout;position:
absolute;z-index:251661312;left:0px;margin-left:720px;margin-top:390px;
width:61px;height:61px"><img width="61" height="61" src="..//assets/images/blu.png" v:shapes="Picture_x0020_1"></span><!--[endif]--></span></p>
	</table>


</body>

<script>
  window.print();
</script>