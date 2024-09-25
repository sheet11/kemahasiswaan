<?php
    include "session.php";
?>

<?php
    include "../config/koneksi.php";  
    mysqli_query($kon, "update tb_ijazah set status = 'Sudah Dicetak' where id_ijazah ='$_GET[id_ijazah]'");
?>


<?php
    include "../config/koneksi.php";
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

<table border="0"  cellpadding="0.1" align="center" style="margin-right: 180px;">
  <tr>
    <td align="center" colspan="3" style='font-size:20.0pt;line-height:14px;'><b>Politeknik Kesehatan Kementerian Kesehatan Bengkulu</b></td>
  </tr>
  <tr><td></td></tr>
  <tr><td></td></tr>
    <tr>
        <td align="center" colspan="3">SK Akreditasi Perguruan Tinggi: 794/SK/BAN-PT/Ak.PPJ/PT/X/2020</td>
    </tr>

    <tr>
        <td align="center" colspan="3">SK Akreditasi Program Studi: <?php echo "$a[no_akreditasi_prodi]"; ?></td>
    </tr>

</table>
<br>
<table border="0" align="center" cellpadding="7" style="margin-right: 150px;">
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


</table>
<br><br>
<table border="0" align="center" style='line-height:13px; margin-right: 110px;'>

  <tr>
        <td><b>&nbsp;</b></td>
        <td width="170">&nbsp;</td>
        <td align="center"><b>Bengkulu,&nbsp;&nbsp;<?php echo "$a[tanggal_cetak]"; ?> </b></td>
    </tr>

    <tr>
        <td align="center"><b>Direktur</b></td>
        <td>&nbsp;</td>
        <td align="center"><b>Ketua Jurusan</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
     <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
     <tr>
        <td align="center" width="220"><?php echo "$a[direktur]"; ?></td>
        <td width="260">&nbsp;</td>
        <td width="240" align="center"><?php echo "$a[pudir]"; ?></td>
    </tr>
    <tr>
        <td align="center" ><?php echo "$a[nip_direktur]"; ?></td>
        <td align="center">&nbsp;NIK: <?php echo "$a[nik]"; ?></td>
        <td align="center"><?php echo "$a[nip_pudir]"; ?></td>
    </tr>
</table>

</table>

</body>
</html>
<script>
  window.print();
</script>