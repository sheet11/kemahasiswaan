<?php
	include "session.php";
?>


<?php

	include "../config/koneksi.php";	
	mysql_query("update tb_surat_keterangan_lulus set status = 'Sudah Dicetak' where id_surat_keterangan_lulus ='$_GET[id_surat_keterangan_lulus]'");
?>


<?php
	include"../config/koneksi.php";
	include('bar128.php');
  	include("library.php");
  	include("fucnt_tgl.php");
	
	$query=mysql_query("select * from tb_surat_keterangan_lulus where id_surat_keterangan_lulus='$_GET[id_surat_keterangan_lulus]'");
	$a=mysql_fetch_array($query);
    $tanggal1 = tgl_indo($a['tanggal_lahir']);
    $tanggal2 = tgl_indo($a['tanggal_cetak']);
		 $tanggal3 = tgl_indo($a['tanggal_sk']);
		  $tanggal4 = tgl_indo($a['tanggal_wisudah']);

?>
	<table cellpadding="50">
		<tr><td></td></tr>
	</table>

	<table border="0" width="100%" cellpadding="0">
		<tr>
			<td colspan="3" align="center" style='font-size:20.0pt;'><b><u>SURAT KETERANGAN</u></b><br></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><b>Nomor : PP.01.01/1/     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;        2020</b></td>
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

		<!--

		<tr>
			<td>Nama</td><td width="2%">:</td><td>Eliana, SKM, M.PH</td>
		</tr>

		<tr>
			<td>NIP	</td><td>:</td><td>196505091989032001</td>
		</tr>

		<tr>
			<td>Pangkat, Golongan/Ruang</td><td>:</td><td>Penata Tk. I/ IV A</td>
		</tr>

		<tr>
			<td>Jabatan	</td><td>:</td><td>Pembantu Direktur Bidang Akademik.</td>
		</tr>

		-->

		
		<tr>
			<td>Nama	</td><td width="2%">:</td><td>	Darwis, S.Kp., M.Kes.</td>
		</tr>

		<tr>
			<td>NIP	</td><td>	:</td><td> 196301031983121002</td>
		</tr>

		<tr>
			<td>Pangkat, Golongan/Ruang</td><td>	:</td><td> Pembina/ IVa</td>
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

	<table border="0" width="100%" cellpadding="5">
		<tr>
			<td colspan="3" style="text-align:justify;line-height:150%"  >telah dinyatakan <b>LULUS</b> pada <b>Program Studi <?php echo "$a[prodi]"; ?> Jurusan <?php echo "$a[jurusan]"; ?> Poltekkes Kemenkes Bengkulu</b> dan telah mengikuti Wisuda pada tanggal <?php echo "$tanggal4"; ?> di Bengkulu, berdasarkan Surat Keputusan Direktur Poltekkes Kemenkes Bengkulu Nomor : PP.01.01/1/<?php echo "$a[nomor_surat]"; ?> Tanggal <?php echo "$tanggal3"; ?> tentang Penetapan Lulusan DIII/DIV di Politeknik Kesehatan Kementerian Kesehatan Bengkulu Tahun Akademik <?php echo "$a[tahun_akademik]"; ?></td>
		</tr>


		<tr>
			<td colspan="3" style="text-align:justify;line-height:150%" >Demikian Surat Keterangan ini dibuat dengan sesungguhnya agar dapat digunakan sebagaimana mestinya.</td>
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

		<!--

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

		-->

		<tr>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b><u>Darwis , S.Kp., M.Kes</u></b><br>
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;NIP.196301031983121002</td>
		</tr>

		
	</table>
</body>

<script>
  window.print();
</script>