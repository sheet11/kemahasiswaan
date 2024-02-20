	<?php 
				$query2=mysql_query("select * from form_izin_iujp where id_pemohon='$_GET[id_pemohon]'");
				while($vT=mysql_fetch_array($query2)){		
				
						$buah[] = "$vT[t1]"; 
						$buah[] = "$vT[t2]"; 
						$buah[] = "$vT[t3]"; 
						$buah[] = "$vT[t4]"; 
						$buah[] = "$vT[t5]"; 
						$buah[] = "$vT[t6]"; 
						$buah[] = "$vT[t7]"; 
						$buah[] = "$vT[t8]"; 
						
						//echo $buah[1]; 
						//Hasilnya Rambutan 
						echo "<p>"; 
						for($i=0;$i<count($buah);$i++)
						{ 
								$connection = mysql_connect("localhost","root","") or die(mysql_error());
								mysql_select_db("perizinan") or die(mysql_error());
								$query=mysql_query("select * from tembusan");							
							echo"
							<select name=t1 class=form-control >
							<option value=$buah[$i]>$buah[$i]</option>";
								while($a=mysql_fetch_array($query)){
								$id = $a['id_tembusan'];
								$nama = $a['nama_tembusan'];
								echo"
								<option value=$id>$nama</option>";
								}
							echo"</select>";
							
						//echo "buah #$i: ".$buah[$i]."<br>";
						} 
				}
			
			?>