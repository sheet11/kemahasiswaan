
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

<table cellpadding="60">
	<tr>
		<td></td>
	</tr>
</table>

<body>
	<table border="0" align="center" width="95%" cellpadding="0" style="text-align:justify;line-height:100%">
		<tr>
			<td colspan="3" align="right"><?php echo "$tanggal2"; ?></td>
		</tr>

		<tr >
			<td  width="25%">Nomor	: </td><td width="2%">:</td><td>DM. 01.04/..…….../2/2023</td>
		</tr>

		<tr>
			<td>Lampiran</td>
			<td>:</td>
			<td>-</td>
		</tr>

		<tr>
			<td>Hal</td>
			<td>:</td>
			<td><b>Izin Penelitian</b></td>
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
			<td colspan="3"><b><?php echo "$a[tujuan]"; ?></b></td>
		</tr>

		<tr>
			<td>di_ </td>
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
			<td valign="left" colspan="3" style="text-align:justify;line-height:150%">Sehubungan dengan penyusunan tugas akhir mahasiswa dalam bentuk <?php echo "$a[tugas_akhir]"; ?> bagi Mahasiswa Prodi <?php echo "$a[prodi]"; ?>  Jurusan <?php echo "$a[jurusan]"; ?> Poltekkes Kemenkes Bengkulu Tahun Akademik <?php echo "$a[tahun_akademik]"; ?>  , maka bersama ini kami mohon Bapak/Ibu dapat memberikan izin pengambilan data untuk penelitian kepada:</td>
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
			<td>Jurusan </td>
			<td>:</td>
			<td><?php echo "$a[jurusan]"; ?></td>
		</tr>

		<tr>
			<td>Program Studi</td>
			<td>:</td>
			<td><?php echo "$a[prodi]"; ?></td>
		</tr>

		<tr>
			<td>No Handphone </td>
			<td>:</td>
			<td><?php echo "$a[no_hp]"; ?></td>
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
			<td style="text-align:justify;line-height:150%"><?php echo "$a[judul_kti]"; ?> </td>
		</tr>

		<tr>
			<td colspan="3" style="text-align:justify;line-height:150%" >Demikianlah, atas perhatian dan bantuan Bapak/Ibu diucapkan terimakasih.</td>
		</tr>
	</table>

	<table border="0" align="center" width="95%" cellpadding="0" style="text-align:justify;line-height:100%">
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; an. Direktur Poltekkes Kemenkes Bengkulu</td>
		</tr>

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Wakil Direktur Bidang Akademik</td>
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
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Ns.Agung Riyadi, S.Kep, M.Kes</b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;NIP.196810071988031005</td>
		</tr>

	</table>

	<table border="0" align="center" width="95%" cellpadding="0">
		<tr>
			<td style="font-size:12"> <b>Tembusan disampaikan kepada:</b> </td>
		</tr>
		<tr>
			<td style="font-size:12"><?php echo "$a[tembusan]"; ?> </td>
		</tr>

	</table>
	
</body>

<script>
  window.print();
</script>