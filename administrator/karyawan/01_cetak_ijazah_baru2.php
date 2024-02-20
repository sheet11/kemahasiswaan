<?php
	include "session.php";
?>

<?php
    include "../config/koneksi.php";  
    mysql_query("update tb_ijazah set status = 'Sudah Dicetak' where id_ijazah ='$_GET[id_ijazah]'");
?>


<?php
	include"../config/koneksi.php";
	include('bar128.php');
  include("library.php");
  include("fucnt_tgl.php");
	
	$query=mysql_query("select * from tb_ijazah where id_ijazah='$_GET[id_ijazah]'");
	$a=mysql_fetch_array($query);

?>
<html>
<head>

    <title></title>
    <script src="js/jquery-1.11.0.js"></script>
  

</head>
	<body>
  <table border="0" width="100%">
    <tr>
      <td>&nbsp;</td>
      <td align="right"><b>Nomor Ijazah Nasional: <?php echo "$a[no_seri_ijazah]"; ?></b></td>
    </tr>
  </table>


<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><br><br>



<table border="0"  cellpadding="7" width="100%" >
	<tr>
      	<td width="30%" colspan ="2" style='font-size:14.0pt;line-height:14px;'>Diberikan Kepada </td>
        <td colspan="2"></td> 
	</tr>

    <tr>
      	<td width="5%">&nbsp;</td>
      	<td width="30%" ><b>Nama</b></td>
      	<td width="2%"><b>:</b></td>
      	<td style='font-size:16.0pt;line-height:16px;'><b><?php echo "$a[nama_lengkap]"; ?></b></td>
    </tr>
<tr>
      <td>&nbsp;</td>
      <td><b>Tempat, Tanggal Lahir</b></td>
      <td><b>:</b></td>
      <td><b><?php echo "$a[tempatdantgl_lahir]"; ?></b></td>
    </tr>

    <tr>
    	<td>&nbsp;</td>
      	<td><b>Nomor Induk Mahasiswa</b></td>
      	<td><b>:</b></td>
      	<td><b><?php echo "$a[nim]"; ?></b></td>
      </td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><b>NIK</b></td>
      <td><b>:</b></td>
      <td><b><?php echo "$a[nik]"; ?></b></td>
    </tr>
<tr>
      <td colspan="4">Telah dinyatakan <b>LULUS</b> pada Program Pendidikan <b><?php echo "$a[program_pendidikan]"; ?></b> <?php echo "$a[tanggal_wisudah]"; ?> dan berhak menyandang gelar  <b><?php echo "$a[gelar]"; ?> </b>dengan segala hak dan kewajibannya. </td>
         </tr>

</table>



<table border="0" width="100%" style='line-height:13px;'>

  <tr>
        <td  width="240">&nbsp;</td>
        <td><b>&nbsp;</b></td>
        <td width="220">&nbsp;</td>
        <td><b>Bengkulu,&nbsp;&nbsp;<?php echo "$a[tanggal_cetak]"; ?> </b></td>
    </tr>

     <tr>
        <td  width="240">&nbsp;</td>
        <td><b>&nbsp;</b></td>
        <td width="220">&nbsp;</td>
        <td><b>&nbsp; </b></td>
    </tr>
	<tr>
        <td  width="240">&nbsp;</td>
        <td><b>Direktur</b></td>
        <td width="220">&nbsp;</td>
        <td><b>Ketua Jurusan <?php echo "$a[jurusan]"; ?> </b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
     <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="240">&nbsp;</td>
        <td><b><u>Darwis, S.Kp., M.Kes</u></b></td>
        <td width="220">&nbsp;</td>
        <td><b><u><?php echo "$a[pudir]"; ?></u></b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><b>NIP. 196301031983121002</b></td>
        <td>&nbsp;</td>
        <td><b><?php echo "$a[nip_pudir]"; ?></b></td>
    </tr>
</table>



  </table>

</body>
</html>
<script>
  window.print();
</script>