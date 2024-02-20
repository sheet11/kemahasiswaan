<?php
	include "session.php";
?>

<?php
	include"../config/koneksi.php";
	include('bar128.php');
  include("library.php");
  include("fucnt_tgl.php");
	
	$query=mysql_query("select * from tb_sertifikat_pps where id_sertifikat='$_GET[id_sertifikat]'");
	$a=mysql_fetch_array($query);


?>
<table cellpadding="115"><tr><td></td></tr></table>
<body>
	<table border="0" width="100%" cellpadding="0">

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td colspan="3" align="center" style='font-size:20.0pt;'><b><?php echo "$a[nama_lengkap]"; ?></b><br></td>
		</tr>

	</table>

</body>

<script>
  window.print();
</script>