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

<table cellpadding="70"><tr><td></td></tr></table>

<table border="0" width="100%" cellpadding="0" >
	<tr>
		<td width="10%" valign="top" >Lampiran</td>
		<td valign="top"> : </td>
		<td style="text-align:justify;"> Surat Edaran Menteri Keuangan dan Kepala Badan Administrasi Kepegawaian Negara</td>
	</tr>

	<tr>
		<td>Nomor</td>
		<td>: </td>
		<td> SE-1-38/DJA/1.7/80 (NO. SE/11780)</td>
	</tr>
	<tr>
		<td>Nomor</td>
		<td>: </td>
		<td> 19/SE/1980<br/></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td>: </td>
		<td> 7 Juli 1980</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

</table>

	<table border="0" width="100%" cellpadding="0">
		<tr>
			<td colspan="3" align="center" style='font-size:14.0pt;'><b><u>SURAT PERNYATAAN MASIH KULIAH</u></b><br></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><b>Nomor : DM.01.04/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/2/2023 </b></td>
		</tr>
	</table>


<table border="0" width="100%" cellpadding="0" style="text-align:justify;line-height:100%" >

		<tr>
			<td width="40%">&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>

		<tr>
			<td colspan="3">Yang bertandatangan dibawah ini :</td>
		</tr>

		<tr>
			<td>Nama</td><td width="2%">:</td><td>Ns.Agung Riyadi, S.Kep, M.Kes</td>
		</tr>

		<tr>
			<td>NIP	</td><td>:</td><td>196810071988031005</td>
		</tr>

		<tr>
			<td>Pangkat, Golongan/Ruang</td><td>:</td><td>Pembina/IV A</td>
		</tr>

		<tr>
			<td>Jabatan	</td><td>:</td><td>Wakil Direktur Bidang Akademik</td>
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
			<td>Nama</td><td>: </td> <td><?php echo "$a[nama_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>NIM</td><td>	:</td><td>	<?php echo "$a[nim_mahasiswa]"; ?></td>
		</tr>

		<tr>
			<td>Perguruan Tinggi</td><td>:</td><td>Poltekkes Kemenkes Bengkulu</td>
		</tr>

		<tr>
			<td>Tingkat/Semester</td><td>:</td><td><?php echo "$a[tingkat]"; ?> / <?php echo "$a[semester]"; ?> </td>
		</tr>

		<tr>
			<td>Tahun Akademik</td><td>:</td><td><?php echo "$a[tahun_akademik]"; ?></td>
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
			<td>Nama</td><td>: </td> <td><?php echo "$a[nama_orang_tua]"; ?></td>
		</tr>

		<tr>
			<td>NIP/NRP</td><td>	:</td><td>	<?php echo "$a[nip]"; ?></td>
		</tr>

		<tr>
			<td>Pangkat, Golongan/ruang</td><td>:	</td><td><?php echo "$a[pangkat]"; ?></td>
		</tr>

		<tr>
			<td valign="top" >Instansi</td><td valign="top">:	</td><td valign="top"><?php echo "$a[instansi]"; ?></td>
		</tr>
		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
		</tr>
		
		</table>

		<table border="0" width="100%" >
		<tr>
			<td colspan="3" style="text-align:justify;line-height:100%">Adalah benar mahasiswa Program Studi <?php echo "$a[prodi]"; ?>  Jurusan <?php echo "$a[jurusan]"; ?> Poltekkes Kemenkes Bengkulu</td>
		</tr>

		<tr>
			<td colspan="3" style="text-align:justify;line-height:100%" >Demikian Surat Keterangan ini dibuat dengan sesungguhnya agar dapat digunakan sebagaimana mestinya.</td>
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

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;an. Direktur Poltekkes Kemenkes Bengkulu</td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Wakil Direktur Bidang Akademik,</td>
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
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Ns.Agung Riyadi, S.Kep, M.Kes</b></td>
		</tr>

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;NIP.196810071988031005</td>
		</tr>

</table>
</body>

<script>
  window.print();
</script>