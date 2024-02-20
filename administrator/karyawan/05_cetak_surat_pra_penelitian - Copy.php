<?php
	include "session.php";
?>

<?php

	include "../config/koneksi.php";	
	mysql_query("update tb_surat_pra_penelitian set status = 'Sudah Dicetak' where id_surat_pra_penelitian ='$_GET[id_surat_pra_penelitian]'");
?>


<?php
	include"../config/koneksi.php";
	include('bar128.php');
  	include("library.php");
  	include("fucnt_tgl.php");
	
	$query=mysql_query("select * from tb_surat_pra_penelitian where id_surat_pra_penelitian='$_GET[id_surat_pra_penelitian]' ");
	$a=mysql_fetch_array($query);
    $tanggal2 = tgl_indo($a['tanggal_cetak']);

?>
<table cellpadding="60"><tr><td></td></tr></table>
<body>


<table border="0" align="center" width="90%" cellpadding="0">

		<tr>
			<td colspan="3" align="right"><?php echo "$tanggal2"; ?></td>
		</tr>

		<tr>
			<td  width="25%">Nomor	: </td><td width="2%">:</td><td>DM. 01.04/..…….../2/2020</td>
		</tr>

		<tr>
			<td>Lampiran</td>
			<td>:</td>
			<td>-</td>
		</tr>

		<tr>
			<td>Hal</td>
			<td>:</td>
			<td><b>Izin Pra Penelitian</b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>


		<tr>
			<td>Yang Terhormat,</td>
		</tr>

		<tr>
			<td colspan="3" style="text-transform:capitalize;text-align:justify;"><b><?php echo "$a[tujuan]"; ?></b></td>
		</tr>

		<tr>
			<td>di_ </td>
		</tr>

		<tr>
			<td>&nbsp; &nbsp; <b>Bengkulu</b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		</table>

		<table border="0" align="center" width="90%" cellpadding="0">

		<tr>
			<td valign="left" colspan="3" style="text-align:justify;line-height:200%">Sehubungan dengan penyusunan tugas akhir mahasiswa dalam bentuk <?php echo "$a[tugas_akhir]"; ?> bagi Mahasiswa Prodi <?php echo "$a[prodi]"; ?>  Poltekkes Kemenkes Bengkulu Tahun Akademik <?php echo "$a[tahun_akademik]"; ?>, maka dengan ini kami mohon kiranya Bapak/Ibu dapat memberikan rekomendasi izin pengambilan data, untuk <?php echo "$a[tugas_akhir]"; ?> dimaksud. Nama mahasiswa tersebut adalah :</td>
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
			<td valign="top">Judul </td>
			<td valign="top">:</td>
			<td style="text-transform:capitalize;text-align:justify;line-height:200%"><?php echo "$a[judul_kti]"; ?> </td>
		</tr>

		<tr>
			<td valign="top">Lokasi</td>
			<td valign="top">:</td>
			<td valign="top" style="text-transform:capitalize;text-align:justify;line-height:200%"><?php echo "$a[lokasi]"; ?> </td>
		</tr>

		<tr>
			<td colspan="3" style="text-align:justify;line-height:150%" >Demikianlah, atas perhatian dan bantuan Bapak/Ibu diucapkan terimakasih.</td>
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
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	Wakil Direktur Bidang Akademik,</td>
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
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b><u>Eliana, SKM, M.PH</u></b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;NIP.196505091989032001</td>
		</tr>
	</table>


<!--
	<table border="0" align="center" width="90%" cellpadding="0">
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	Plh Pudir I,</td>
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
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b><u>BETTY ANDIYARTI, S.Kom, MPH</u></b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;NIP.198001162005012002</td>
		</tr>
	</table>
-->

</body>

<script>
  window.print();
</script>