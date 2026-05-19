<?php 
	include"01_nav.php";
	error_reporting(0);
	include"../config/class_paging.php";
?>
<aside class="right-side">
	<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil'): ?>
    <div class="alert alert-success alert-dismissible" style="margin:15px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-check"></i> <strong>Berhasil!</strong> User baru telah ditambahkan.
    </div>
	<?php endif; ?>
	<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'edit'): ?>
    <div class="alert alert-info alert-dismissible" style="margin:15px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-check"></i> <strong>Berhasil!</strong> Data user telah diperbarui.
    </div>
	<?php endif; ?>
	<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'hapus'): ?>
    <div class="alert alert-warning alert-dismissible" style="margin:15px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-trash"></i> <strong>Berhasil!</strong> User telah dihapus.
    </div>
	<?php endif; ?>

    <section class="content-header">
    	<div class="container-fluid" style="margin:10px;">	
    		<table width="100%">
	    		<tr class="info">
            		<td colspan="6"><b><h4>Daftar User</b></h4></td>   
	        	</tr>
	            <tr>
	                <td width="20%"><label>Pencarian Berdasarkan</label></td>               
	                    <form method="post" action="" enctype="multipart/form-data">                    
	                        <td width="25%">
	                            <select name="cariid" class="form-control">
	                                <option value="username">Username</option>
	                                <option value="nama_lengkap">Nama</option>
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
		                    <a href="user_edit.php" class="btn btn-info">ALL</a>
		                </td>                   
	            </tr>
	            <tr>
	                <td colspan="6">
	                	<a href="tambah_user.php" class="btn btn-primary">Tambah data +</a>
						<a class="btn btn-info"><i class="fa fa-cloud fa-sm"></i> | Jumlah : <?php
		                    require_once("../config/koneksi.php");
		                    $query = mysqli_query($kon, "SELECT * FROM tb_user");
		                    echo mysqli_num_rows($query); ?>
		                </a>
	                </td>
	            </tr>
	            <tr>
	                <td>&nbsp;</td>
	            </tr>
	        </table>

        <table style="width:100%;" class="table table-bordered">    
            <tr class="info">
				<th>No.</th>
				<th>Username</th>
				<th>Nama</th>
				<th>Password</th>
				<th>Level</th>
				<th width="10%">Aksi</th>
			</tr>
            <?php 
            	include "../config/koneksi.php";
                $p      = new Paging;
                $batas  = 10;
                $posisi = $p->cariPosisi($batas);

                // Pencarian
                if (isset($_POST['submit']) && !empty($_POST['cari'])) {
                    $kolom = mysqli_real_escape_string($kon, $_POST['cariid']);
                    $cari  = mysqli_real_escape_string($kon, $_POST['cari']);
                    $query = mysqli_query($kon, "SELECT * FROM tb_user WHERE `$kolom` LIKE '%$cari%' ORDER BY id_user DESC LIMIT $posisi,$batas");
                } else {
                    $query = mysqli_query($kon, "SELECT * FROM tb_user ORDER BY id_user DESC LIMIT $posisi,$batas");
                }

                $i = $posisi + 1;     
                while ($a = mysqli_fetch_array($query)) {
                    echo "
                    <tr>
                        <td>$i</td>
                        <td>{$a['username']}</td>
                        <td>{$a['nama_lengkap']}</td>
                        <td>{$a['password']}</td>
                        <td><span class='label label-default'>{$a['level']}</span></td>
                        <td>
                            <a href='edit_user.php?id_user={$a['id_user']}&halaman={$_GET['halaman']}' class='btn btn-success btn-xs'>
                                <span class='glyphicon glyphicon-pencil'></span>
                            </a>
                            <a href='delete_user.php?id_user={$a['id_user']}&halaman={$_GET['halaman']}' onclick='return confirm(\"Hapus user {$a['nama_lengkap']}?\")' class='btn btn-danger btn-xs'>
                                <span class='glyphicon glyphicon-remove'></span>
                            </a>
                        </td>
                    </tr>";
                    $i++;
                }

                $jmldata    = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM tb_user"));
                $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
                $linkHalaman= $p->navHalaman($_GET['halaman'] ?? 1, $jmlhalaman);

                echo "</table><div class=\"paginationw\">$linkHalaman</div>";
            ?>