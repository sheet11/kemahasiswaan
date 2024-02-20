<?php 
	include"01_nav.php";
	include"config/class_paging.php";
?>
<aside class="right-side">
    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">	
    		<table style="width:100%;">
	    		<tr class="info">
            		<td align="left" colspan="6"><b><h4>Daftar Surat Penelitian</b></h4></td>   
	        	</tr>

	            <tr><td width="20%">
		                     <a href="04_tambah_surat_penelitian.php" class="btn btn-info">Tambah Surat</a> 
		                </td> 

	                <td width="20%"><label>Pencarian Berdasarkan</label></td>               
	                    <form method="post" action="" enctype="multipart/form-data">                    
	                        <td width="25%">
	                            <select name="cariid" class="form-control">
	                                <option value="nim_mahasiswa">NIM</option>
	                                <option value="nama_mahasiswa">Nama Mahasiswa</option>
	                            </select>
	                        </td>
	                        <td width="5%"></td>
	                        <td>
	                            <div class="form-group input-group" style="margin-top:15px;">
	                            <span class="input-group-btn">
	                                <input type="text" name="cari" placeholder="Cari" class="form-control">
	                                <button class="btn btn-default" type="submit" name="submit"><i class="fa fa-search"></i></button>
	                            </span>
	                            </div>  
	                        </td>
	                        <td width="5%">
	                        </td>   
	                    </form>
	                
		                <td>
		                    <a href="04_daftar_surat_penelitian.php" class="btn btn-info">ALL</a>
		                </td>                   
	            </tr>
	            <tr>
	                <td>&nbsp;</td>
	            </tr>
	        </table>

        <table style="width:100%;" class="table table-bordered">    
            <tr class="info">
                <th>No.</th><th>Nama Mahasiswa</th><th>NIM</th><th>Prodi</th><th>Judul</th><th>Tujuan</th><th>Status</th><th width="5%">Aksi</th>
            </tr>
            <?php 
            	include "config/koneksi.php";
                if(isset($_POST['submit'])){
                    $cariid = $_POST['cariid'];
                    $cari = $_POST['cari'];
                    $query=mysql_query("select * from tb_surat_penelitian where $cariid = '$cari' or $cariid = '0' "); 
                    $i = $posisi+1;      
                while($a=mysql_fetch_array($query)){
            echo"
                <tr>
                    <td>$i</td>
					<td>$a[nama_mahasiswa]</td>
					<td>$a[nim_mahasiswa]</td>
					<td>$a[prodi]</td>
					<td>$a[judul_kti]</td>
					<td>$a[tujuan]</td>      
                    <td>";
										
										if($a['status'] == 'Belum Dicetak')
											{
											echo "<button type='button' class='btn btn-danger'>Belum Dicetak</button>
						            			 ";
											}
										elseif($a['status'] == 'Sudah Dicetak')
						          			{
								            echo "<button type='button' class='btn btn-warning'>Sudah Dicetak</button>
								            ";
								          	}
								        if($a['status'] == 'Sudah Selesai')
											{
											echo "<button type='button' class='btn btn-success'>Sudah Selesai</button>
						            			 ";
											}
										elseif($a['status'] == 'Sudah Diambil')
						          			{
								            echo "<button type='button' class='btn btn-info'>Sudah Diambil</button>
								            ";
								          	}
										echo"</td>";

											echo"<td>
                        <a href='04_edit_surat_penelitian.php?id_surat_penelitian=$a[id_surat_penelitian]' class='btn btn-info'>
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a> 

                    </td>
                </tr>";
                $i++;
            }
                }
                elseif(!empty($_GET['id_surat_penelitian'])){
                    $query=mysql_query("select * from tb_surat_penelitian where id_surat_penelitian='$_GET[id_surat_penelitian]'"); 
                    $i = $posisi+1;      
                while($a=mysql_fetch_array($query)){
            echo"
                <tr>    
                    <td>$i</td>
					<td>$a[nama_mahasiswa]</td>
					<td>$a[nim_mahasiswa]</td>
					<td>$a[prodi]</td>
					<td>$a[judul_kti]</td>
					<td>$a[tujuan]</td>      
                    <td>";
										
										if($a['status'] == 'Belum Dicetak')
											{
											echo "<button type='button' class='btn btn-danger'>Belum Dicetak</button>
						            			 ";
											}
										elseif($a['status'] == 'Sudah Dicetak')
						          			{
								            echo "<button type='button' class='btn btn-warning'>Sudah Dicetak</button>
								            ";
								          	}
								        if($a['status'] == 'Sudah Selesai')
											{
											echo "<button type='button' class='btn btn-success'>Sudah Selesai</button>
						            			 ";
											}
										elseif($a['status'] == 'Sudah Diambil')
						          			{
								            echo "<button type='button' class='btn btn-info'>Sudah Diambil</button>
								            ";
								          	}
										echo"</td>";

											echo"<td>   
                        <a href='04_edit_surat_penelitian.php?id_surat_penelitian=$a[id_surat_penelitian]' class='btn btn-info'>
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a>  
                    </td>
                </tr>";
                $i++;
                }
                }

                else{
                    $p      = new Paging;
                    $batas  = 10;
                    $posisi = $p->cariPosisi($batas);               
                    $query=mysql_query("select * from tb_surat_penelitian order by id_surat_penelitian desc LIMIT $posisi,$batas");
                
                    $i = $posisi+1;     
                while($a=mysql_fetch_array($query)){

                echo"
                <tr>
                    <td>$i</td>
					<td>$a[nama_mahasiswa]</td>
					<td>$a[nim_mahasiswa]</td>
					<td>$a[prodi]</td>
					<td>$a[judul_kti]</td>
					<td>$a[tujuan]</td>      
                    <td>";
										
										if($a['status'] == 'Belum Dicetak')
											{
											echo "<button type='button' class='btn btn-danger'>Belum Dicetak</button>
						            			 ";
											}
										elseif($a['status'] == 'Sudah Dicetak')
						          			{
								            echo "<button type='button' class='btn btn-warning'>Sudah Dicetak</button>
								            ";
								          	}
								        if($a['status'] == 'Sudah Selesai')
											{
											echo "<button type='button' class='btn btn-success'>Sudah Selesai</button>
						            			 ";
											}
										elseif($a['status'] == 'Sudah Diambil')
						          			{
								            echo "<button type='button' class='btn btn-info'>Sudah Diambil</button>
								            ";
								          	}
										echo"</td>";

											echo"<td>
                        <a href='04_edit_surat_penelitian.php?id_surat_penelitian=$a[id_surat_penelitian]&halaman=$_GET[halaman]' class='btn btn-info'>
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a> 
                    </td>
                </tr>";
                $i++;
            }
            

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM tb_surat_penelitian "));
      
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

echo "</table><div class=\"paginationw\">$linkHalaman</div>";
}
            ?>




