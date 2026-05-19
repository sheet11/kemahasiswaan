<?php 
include "01_nav.php";
include "config/class_paging.php";
include "config/koneksi.php";

$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);

$nim = $_SESSION['nim'];
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

<table width="100%">

    <tr class="info">
        <td colspan="6">
            <b><h4>Daftar Surat Keterangan Lulus</h4></b>
        </td>   
    </tr>

    <tr>

        <td width="20%">
            <a href="02_tambah_surat_keterangan_lulus.php" class="btn btn-info">
                Tambah Surat
            </a> 
        </td> 
    <tr>
        <td>&nbsp;</td>
    </tr>

</table>

<table style="width:100%;" class="table table-bordered">    

<tr class="info">

    <th>No.</th>
    <th>Nama Mahasiswa</th>
    <th>NIM</th>
    <th>Jurusan</th>
    <th>Tempat</th>
    <th>Tgl Lahir</th>
    <th>Status</th>
    <th width="50">Aksi</th>

</tr>

<?php

/* =========================
   PENCARIAN
========================= */

if(isset($_POST['submit'])){

    $cariid = $_POST['cariid'];
    $cari   = $_POST['cari'];

    $query = mysqli_query(
        $kon,
        "SELECT * FROM tb_surat_keterangan_lulus
         WHERE nim_mahasiswa='$nim'
         AND $cariid LIKE '%$cari%'"
    );
}

/* =========================
   DETAIL BERDASARKAN ID
========================= */

elseif(!empty($_GET['id_surat_keterangan_lulus'])){

    $id = $_GET['id_surat_keterangan_lulus'];

    $query = mysqli_query(
        $kon,
        "SELECT * FROM tb_surat_keterangan_lulus
         WHERE id_surat_keterangan_lulus='$id'
         AND nim_mahasiswa='$nim'"
    );
}

/* =========================
   SEMUA DATA
========================= */

else{

    $query = mysqli_query(
        $kon,
        "SELECT * FROM tb_surat_keterangan_lulus
         WHERE nim_mahasiswa='$nim'
         ORDER BY id_surat_keterangan_lulus DESC
         LIMIT $posisi, $batas"
    );
}

/* =========================
   TAMPILKAN DATA
========================= */

$i = $posisi + 1;

while($a = mysqli_fetch_array($query)){

echo "

<tr>

    <td>$i</td>

    <td>{$a['nama_mahasiswa']}</td>

    <td>{$a['nim_mahasiswa']}</td>

    <td>{$a['jurusan']}</td>

    <td>{$a['tempat_lahir']}</td>

    <td>{$a['tanggal_lahir']}</td>

    <td>

";

/* =========================
   STATUS
========================= */

if($a['status'] == 'Belum Dicetak'){

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

elseif($a['status'] == 'Sudah Selesai'){

    echo "
    <button type='button' class='btn btn-success'>
        Sudah Selesai
    </button>
    ";
}

elseif($a['status'] == 'Sudah Diambil'){

    echo "
    <button type='button' class='btn btn-info'>
        Sudah Diambil
    </button>
    ";
}

echo "

    </td>

    <td>

        <a 
            href='02_edit_surat_keterangan_lulus.php?id_surat_keterangan_lulus={$a['id_surat_keterangan_lulus']}&halaman=" . (isset($_GET['halaman']) ? $_GET['halaman'] : 1) . "'
            class='btn btn-info'
        >

            <span class='glyphicon glyphicon-pencil'></span>

        </a>

    </td>

</tr>

";

$i++;

}

/* =========================
   PAGINATION
========================= */

$result = mysqli_query(
    $kon,
    "SELECT * FROM tb_surat_keterangan_lulus
     WHERE nim_mahasiswa='$nim'"
);

$jmldata = mysqli_num_rows($result);

$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);

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