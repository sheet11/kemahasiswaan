<?php 
include "01_nav.php";
include "config/koneksi.php";

$id = $_GET['id_surat_pra_penelitian'];

$query = mysqli_query(
    $kon,
    "SELECT * FROM tb_surat_pra_penelitian 
     WHERE id_surat_pra_penelitian='$id'"
);

$a = mysqli_fetch_array($query);
?>

<aside class="right-side">

<section class="content-header">

<div class="container-fluid" style="margin:10px;">

<form method="post" action="05_prosesedit_surat_pra_penelitian.php">

<table width="100%" border="0" class="table table-hover">

<input type="hidden" 
       name="id_surat_pra_penelitian" 
       value="<?php echo $a['id_surat_pra_penelitian']; ?>">

<tr>
    <td class="info" colspan="3">
        <b>Edit Surat Pra Penelitian</b>
    </td> 
</tr>

<tr>
    <td width="15%">Nama Mahasiswa</td> 
    <td width="2%">:</td>

    <td>
        <input 
            type="text"
            name="nama_mahasiswa"
            class="form-control"
            value="<?php echo $a['nama_mahasiswa']; ?>"
        >
    </td>
</tr>

<tr>
    <td>NIM Mahasiswa</td> 
    <td>:</td>

    <td>
        <input 
            type="text"
            name="nim_mahasiswa"
            class="form-control"
            value="<?php echo $a['nim_mahasiswa']; ?>"
        >
    </td> 
</tr>

<tr>
    <td>No Handphone</td> 
    <td>:</td>

    <td>
        <input 
            type="text"
            name="no_hp"
            class="form-control"
            value="<?php echo $a['no_hp']; ?>"
        >
    </td> 
</tr>

<tr>
    <td>Judul</td> 
    <td>:</td>

    <td>
        <textarea name="judul_kti" class="form-control"><?php echo $a['judul_kti']; ?></textarea>
    </td>
</tr>

<tr>
    <td>Lokasi</td> 
    <td>:</td>

    <td>
        <textarea name="lokasi" class="form-control"><?php echo $a['lokasi']; ?></textarea>
    </td>
</tr>

<tr>
    <td>Jurusan</td>
    <td>:</td>

    <td>

        <select name="jurusan" class="form-control">

            <option value="<?php echo $a['jurusan']; ?>">
                <?php echo $a['jurusan']; ?>
            </option>

            <?php

            $qJurusan = mysqli_query($kon, "SELECT * FROM tb_jurusan");

            while($row = mysqli_fetch_array($qJurusan)){

                echo "
                <option value='$row[nama_jurusan]'>
                    $row[nama_jurusan]
                </option>
                ";
            }

            ?>

        </select>

    </td>
</tr>

<tr>
    <td>Prodi</td>
    <td>:</td>

    <td>

        <select name="prodi" class="form-control">

            <option value="<?php echo $a['prodi']; ?>">
                <?php echo $a['prodi']; ?>
            </option>

            <?php

            $qProdi = mysqli_query($kon, "SELECT * FROM tb_prodi");

            while($row = mysqli_fetch_array($qProdi)){

                echo "
                <option value='$row[program_studi]'>
                    $row[program_studi]
                </option>
                ";
            }

            ?>

        </select>

    </td>
</tr>

<tr>
    <td>Tugas Akhir</td>
    <td>:</td>

    <td>

        <select name="tugas_akhir" class="form-control">

            <option value="<?php echo $a['tugas_akhir']; ?>">
                <?php echo $a['tugas_akhir']; ?>
            </option>

            <option value="Karya Tulis Ilmiah (KTI)">
                Karya Tulis Ilmiah (KTI)
            </option>

            <option value="Skripsi">
                Skripsi
            </option>

        </select>

    </td>
</tr>

<tr>
    <td>Tahun Akademik</td>
    <td>:</td>

    <td>

        <select name="tahun_akademik" class="form-control">

            <option value="<?php echo $a['tahun_akademik']; ?>">
                <?php echo $a['tahun_akademik']; ?>
            </option>

            <?php

            $qTahun = mysqli_query($kon, "SELECT * FROM tb_tahun_akademik");

            while($row = mysqli_fetch_array($qTahun)){

                echo "
                <option value='$row[tahun_akademik]'>
                    $row[tahun_akademik]
                </option>
                ";
            }

            ?>

        </select>

    </td>
</tr>

<tr>
    <td>Tujuan</td> 
    <td>:</td>

    <td>
        <input 
            type="text"
            name="tujuan"
            class="form-control"
            value="<?php echo $a['tujuan']; ?>"
        >
    </td>
</tr>

<tr>

    <td colspan="2">&nbsp;</td>

    <td>

        <input 
            type="submit"
            name="submit"
            value="Simpan"
            class="btn btn-success"
        >

        <input 
            type="reset"
            value="Hapus"
            class="btn btn-danger"
        >
        <div style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">
			<button 
			type="button"
			onclick="history.back()" 
			class="btn btn-light border">Kembali
            </button>
		</div>

    </td>

</tr>

</table>

</form>

</div>

</section>

</aside>