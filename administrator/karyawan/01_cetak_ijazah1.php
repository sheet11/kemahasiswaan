<?php
    include "session.php";
?>

<?php
    include "../config/koneksi.php";  
    mysqli_query($kon, "update tb_ijazah set status = 'Sudah Dicetak' where id_ijazah ='$_GET[id_ijazah]'");
?>


<?php
    include"../config/koneksi.php";
    include('bar128.php');
  include("library.php");
  include("fucnt_tgl.php");
    
    $query=mysqli_query($kon, "SELECT * from tb_ijazah where id_ijazah='$_GET[id_ijazah]'");
    $a=mysqli_fetch_array($query);

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


<p>&nbsp;</p><p>&nbsp;</p>

<h2 align="center">Politeknik Kesehatan Kementerian Kesehatan Bengkulu</h2>
<table border="0"  cellpadding="0.1" align="center">
    <tr>
        <td>SK Akreditasi Perguruan Tinggi</td>
        <td>:</td>
        <td>794/SK/BAN-PT/Ak.PPJ/PT/X/2020</td>
    </tr>

    <tr>
        <td>SK Akreditasi Program Studi</td>
        <td>:</td>
        <td><?php echo "$a[no_akreditasi_prodi]"; ?></td>
    </tr>

</table>

</br>
<table border="1" align="center" cellpadding="7" >
     <tr>
        <td align="center" colspan ="4" style='font-size:14.0pt;line-height:14px;'>Memberikan Ijazah kepada: </td>
       </tr>

    <tr>
        <td align="center" colspan="4" style='font-size:16.0pt;line-height:16px;'><b><?php echo "$a[nama_lengkap]"; ?></b></td>
    </tr>

    <tr>
        <td align="center" colspan="4" style='font-size:13.0pt;line-height:16px;'>NIM: <?php echo "$a[nim]"; ?></td>
      </td>
    </tr>
    <tr>
      <td></td>
    </tr>

    <tr>
      <td align="center" colspan="4" style='font-size:13.0pt;line-height:16px;'>Lahir di <?php echo "$a[tempatdantgl_lahir]"; ?></b></td>
    </tr>
    <tr>
      <td align="center" colspan="4" style='font-size:13.0pt;line-height:16px;'>karena telah menyelesaikan pendidikan dan dinyatakan lulus pada tanggal <?php echo "$a[tanggal_wisudah]"; ?> pada</td>
    </tr>

    <tr>
      <td align="center" colspan="4" style='font-size:16.0pt;line-height:16px;'><b>Program Studi Gizi Program Diploma Tiga</b></td>
    </tr>
    <tr>
      <td align="center" colspan="4" style='font-size:13.0pt;line-height:16px;'>dan kepadanya diberikan gelar</td>
    </tr>

    <tr>
      <td align="center" colspan="4" style='font-size:13.0pt;line-height:16px;'><b><?php echo "$a[gelar]"; ?></b></td>
    </tr>

    <tr>
      <td align="center" colspan="4" style='font-size:13.0pt;line-height:16px;'>beserta segala hak, wewenang dan kewajiban yang melekat pada gelar tersebut.</td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><b>Nomor Induk Kependudukan (NIK)</b></td>
      <td><b>:</b></td>
      <td><b><?php echo "$a[nik]"; ?></b></td>
    </tr>
<tr>
      <td colspan="4">Telah menyelesaikan pendidikan dan dinyatakan <b>LULUS</b> pada <b> Program Studi <?php echo "$a[jurusan]"; ?> Program <?php echo "$a[program_pendidikan]"; ?></b> tanggal <?php echo "$a[tanggal_wisudah]"; ?>  dan berhak menyandang gelar  <b><?php echo "$a[gelar]"; ?> </b>dengan segala hak dan kewajibannya. </td>
         </tr>

</table>



<table border="0" width="100%" style='line-height:13px;'>

  <tr>
        <td width="300">&nbsp;</td>
        <td><b>&nbsp;</b></td>
        <td width="170">&nbsp;</td>
        <td><b>Diterbitkan di Bengkulu,&nbsp;&nbsp;<?php echo "$a[tanggal_cetak]"; ?> </b></td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td><b>Direktur</b></td>
        <td>&nbsp;</td>
        <td><b>Ketua Jurusan  </b></td>
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
        <td><b><?php echo "$a[direktur]"; ?></b></td>
        <td width="220">&nbsp;</td>
        <td><b><?php echo "$a[pudir]"; ?></b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><b><?php echo "$a[nip_direktur]"; ?></b></td>
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