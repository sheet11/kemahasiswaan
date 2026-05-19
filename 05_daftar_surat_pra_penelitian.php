<?php 
include "01_nav.php";
include "config/class_paging.php";
include "config/koneksi.php";
?>

<aside class="right-side">
<section class="content-header">
<div class="container-fluid" style="margin:10px;">

	<!-- POPUP STATUS -->

<div id="popupStatus" 
     style="
        display:none;
        position:fixed;
        z-index:9999;
        left:0;
        top:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);
     ">

    <div style="
        background:#fff;
        width:500px;
        max-width:90%;
        margin:8% auto;
        padding:20px;
        border-radius:10px;
        box-shadow:0 0 10px rgba(0,0,0,0.3);
    ">

        <h3 style="margin-top:0; color:#17a2b8;">
            Informasi Status Surat
        </h3>

        <hr>

        <div style="
            background:#f8d7da;
            padding:15px;
            border-radius:5px;
            margin-bottom:15px;
        ">

            <b>Belum Dicetak</b><br><br>

            Data surat masih terdapat kesalahan.<br>
            Silakan mengajukan surat ulang.

        </div>

        <div style="
            background:#fff3cd;
            padding:15px;
            border-radius:5px;
        ">

            <b>Sudah Dicetak</b><br><br>

            Surat sudah selesai dicetak dan dapat diambil di resepsionis.

        </div>

        <div style="text-align:right; margin-top:20px;">

            <button 
                onclick="tutupPopup()"
                style="
                    background:#17a2b8;
                    color:white;
                    border:none;
                    padding:10px 20px;
                    border-radius:5px;
                    cursor:pointer;
                "
            >
                Mengerti
            </button>

        </div>

    </div>

</div>   

<table style="width:100%;">
    <tr class="info">
        <td align="left" colspan="6">
            <b><h4>Daftar Surat Pra Penelitian</h4></b>
        </td>   
    </tr>

    <tr>
        <td width="20%">
            <a href="05_tambah_surat_pra_penelitian.php" class="btn btn-info">
                Tambah Surat
            </a> 
        </td> 

        <td width="20%">
            <label>Pencarian Berdasarkan</label>
        </td>               

        <form method="post" action="">
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

                        <button class="btn btn-default" type="submit" name="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>  
            </td>

            <td width="5%"></td>   
        </form>

        <td>
            <a href="05_daftar_surat_pra_penelitian.php" class="btn btn-info">
                ALL
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
    <th>Nama Mahasiswa</th>
    <th>NIM</th>
    <th>Prodi</th>
    <th>Judul</th>
    <th>Tujuan</th>
    <th>Status</th>
    <th width="5%">Aksi</th>
</tr>

<?php

$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);

$i = $posisi + 1;

/* =========================
   PENCARIAN
========================= */

if(isset($_POST['submit'])){

    $cariid = $_POST['cariid'];
    $cari   = $_POST['cari'];

    $query = mysqli_query(
        $kon,
        "SELECT * FROM tb_surat_pra_penelitian 
         WHERE $cariid LIKE '%$cari%'"
    );
}

/* =========================
   DETAIL ID
========================= */

elseif(!empty($_GET['id_surat_pra_penelitian'])){

    $id = $_GET['id_surat_pra_penelitian'];

    $query = mysqli_query(
        $kon,
        "SELECT * FROM tb_surat_pra_penelitian 
         WHERE id_surat_pra_penelitian='$id'"
    );
}

/* =========================
   SEMUA DATA
========================= */

else {

    $nim = $_SESSION['nim'];

    $query = mysqli_query(
        $kon,
        "SELECT * FROM tb_surat_pra_penelitian
         WHERE nim_mahasiswa='$nim'
         ORDER BY id_surat_pra_penelitian DESC
         LIMIT $posisi, $batas"
    );

}

/* =========================
   TAMPILKAN DATA
========================= */

while($a = mysqli_fetch_array($query)){

echo "
<tr>

    <td>$i</td>
    <td>{$a['nama_mahasiswa']}</td>
    <td>{$a['nim_mahasiswa']}</td>
    <td>{$a['prodi']}</td>
    <td>{$a['judul_kti']}</td>
    <td>{$a['tujuan']}</td>

    <td>
";

/* =========================
   STATUS
========================= */

$sp      = $a['status_persetujuan'];
$catatan = !empty($a['catatan_penolakan']) ? htmlspecialchars($a['catatan_penolakan']) : '';

if ($sp == 'Ditolak') {
    echo "
    <span class='label label-danger' style='font-size:12px;'>
        <i class='fa fa-times'></i> Ditolak
    </span>
    ";
    if ($catatan) {
        echo "
    <br><small style='color:#dd4b39;'>
        <i class='fa fa-comment-o'></i> <i>$catatan</i>
    </small>
        ";
    }
}
elseif($a['status'] == 'Belum Dicetak'){
    echo "
    <button type='button' class='btn btn-danger'>
        Belum Dicetak
    </button>
    ";
}
elseif($a['status'] == 'Sudah Dicetak'){
    echo "
    <button type='button' class='btn btn-warning'>
        Sudah Dicetak
    </button>
    ";
}

echo "
    </td>

    <td>

        <a href='05_edit_surat_pra_penelitian.php?id_surat_pra_penelitian={$a['id_surat_pra_penelitian']}' 
           class='btn btn-info'>

            <span class='glyphicon glyphicon-pencil'></span>

        </a>

    </td>

</tr>
";

$i++;

}

/* =========================
   PAGING
========================= */

$result = mysqli_query(
    $kon,
    "SELECT * FROM tb_surat_pra_penelitian where nim='$_SESSION[nim]'"
);

$jmldata = mysqli_num_rows($result);

$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);

$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

$linkHalaman = $p->navHalaman($halaman, $jmlhalaman);

echo "
</table>

<div class='paginationw'>
    $linkHalaman
</div>
";

?>

</div>
</section>
<script>

window.onload = function(){

    document.getElementById('popupStatus').style.display = 'block';

}

function tutupPopup(){

    document.getElementById('popupStatus').style.display = 'none';

}

</script>
</aside>