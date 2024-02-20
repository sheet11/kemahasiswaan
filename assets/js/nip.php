<?php
$conn = new mysqli("localhost","root","root","perizinan");
$id_prov = $_GET['id'];
	
		$sql_kota = $conn->query("SELECT * FROM form_pejabat WHERE nama_pejabat='$id_prov'");
		$r = $sql_kota->fetch_assoc() ;
	?>

<input class="form-control" name="nip" type="text" value="<?php echo"$r[nip_pejabat]"; ?>"/>