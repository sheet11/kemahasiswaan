<?php
	include "session.php";
?>


<?php

	include "../config/koneksi.php";	
	mysqli_query($kon, "update tb_surat_keterangan_masih_kuliah set status = 'Sudah Dicetak' where id_surat_keterangan_masih_kuliah ='$_GET[id_surat_keterangan_masih_kuliah]'");
?>


<?php
	include"../config/koneksi.php";
	include('bar128.php');
  	include("library.php");
 	include("fucnt_tgl.php");
	
	$query=mysqli_query($kon, "SELECT * from tb_surat_keterangan_masih_kuliah where id_surat_keterangan_masih_kuliah='$_GET[id_surat_keterangan_masih_kuliah]'");
	$a=mysqli_fetch_array($query);
    $tanggal2 = tgl_indo($a['tanggal_cetak']);

?>

<style type="text/css">;
    body { font-family: Arial; line-height:150%; font-size:11.0pt;}
    p { font-family: Arial; line-height:150%; font-size:11.0pt;}
    div { font-family: Arial; line-height:150%; font-size:11.0pt;}
	table { font-family: Arial; line-height:150%; font-size:11.0pt;}
</style>

<table cellpadding="70"><tr><td></td></tr></table>

<table border="0" width="100%" cellpadding="0" >
<!-- <p class="MsoBodyText"><span style="mso-ignore:vglayout;position:
relative;z-index:-1895824384"><span style="position:absolute;left:0px;
top:-215px;width:794px;height:227px"><img width="794" height="227" src="../assets/images/kop2024.png" v:shapes="Picture_x0020_14"></span></span><span lang="id" style="font-size:10.0pt;mso-bidi-font-size:12.0pt"><o:p></o:p></span></p> -->

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

</table>

	<table border="0" width="100%" cellpadding="0">
		<tr>
			<td colspan="3" align="center" style='font-size:14.0pt;'><b>SURAT PERNYATAAN MASIH KULIAH</b><br></td>
		</tr>
		<tr>
			<td colspan="3" align="center">NOMOR : KH.06.01/F.XXXI.1/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/<?php echo date('Y'); ?> </td>
		</tr>
	</table>


<table border="0" width="100%" cellpadding="0" style="text-align:justify;line-height:150%" >

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		<tr>
			<td colspan="3">Yang bertandatangan dibawah ini :</td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Nama</td><td width="2%">:</td><td>Ns.Agung Riyadi, S.Kep., M.Kes</td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;NIP	</td><td>:</td><td>196810071988031005</td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Pangkat, Golongan/Ruang</td><td>:</td><td>Pembina/IV A</td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Jabatan	</td><td>:</td><td>Wakil Direktur Bidang Akademik</td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		<tr>
			<td colspan="3">Dengan ini menyatakan bahwa : </td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Nama</td><td>: </td> <td><?php echo "$a[nama_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;NIM</td><td>	:</td><td>	<?php echo "$a[nim_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Perguruan Tinggi</td><td>:</td><td>Poltekkes Kemenkes Bengkulu</td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Tingkat/Semester</td><td>:</td><td><?php echo "$a[tingkat]"; ?> / <?php echo "$a[semester]"; ?> </td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Tahun Akademik</td><td>:</td><td><?php echo "$a[tahun_akademik]"; ?></td>
		</tr>
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>
		<tr>
			<td colspan="3">Dan bahwa orang tua/wali anak tersebut :</td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Nama</td><td>: </td> <td><?php echo "$a[nama_orang_tua]"; ?></td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;NIP/NRP</td><td>	:</td><td>	<?php echo "$a[nip]"; ?></td>
		</tr>

		<tr>
			<td>&emsp;&emsp;&emsp;Pangkat, Golongan/ruang</td><td>:	</td><td><?php echo "$a[pangkat]"; ?></td>
		</tr>

		<tr>
			<td valign="top" >&emsp;&emsp;&emsp;Instansi</td><td valign="top">:	</td><td valign="top"><?php echo "$a[instansi]"; ?></td>
		</tr>
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>
		
		</table>

		<table border="0" width="100%" >
		<tr>
			<td colspan="3" style="text-align:justify;">Adalah benar mahasiswa Program Studi <?php echo "$a[prodi]"; ?>  Jurusan <?php echo "$a[jurusan]"; ?> Poltekkes Kemenkes Bengkulu</td>
		</tr>

		<tr>
			<td colspan="3" style="text-align:justify;" >Demikian Surat Keterangan ini dibuat dengan sesungguhnya agar dapat digunakan sebagaimana mestinya.</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Bengkulu, <?php echo "$tanggal2"; ?></td>
		</tr>

		<!-- <tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; a.n. Direktur Poltekkes Kemenkes Bengkulu</td>
		</tr> -->

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Wakil Direktur I Bidang Akademik,</td>
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
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Ns.Agung Riyadi, S.Kep.,M.Kes</b></td>
		</tr>

		<!-- <p class="MsoBodyText" style="margin-top:1.2pt;margin-right:0cm;margin-bottom:0cm;margin-left:262.55pt;margin-bottom:.0001pt"><span style="mso-ignore:vglayout;position:
absolute;z-index:251661312;left:0px;margin-left:700px;margin-top:370px;
width:61px;height:61px"><img width="61" height="61" src="..//assets/images/blu.png" v:shapes="Picture_x0020_1"></span></span></p>
</table> -->
</body>

<script>
  window.print();
</script>