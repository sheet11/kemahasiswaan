<?php 
include "01_nav.php";
include "config/koneksi.php";

$id = (int)$_GET['id_surat_penelitian'];

$a = mysqli_fetch_array(mysqli_query($kon,
    "SELECT * FROM tb_surat_penelitian
     WHERE id_surat_penelitian='$id'"
));

if (!$a) {
    echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>";
    exit;
}

$sp        = $a['status_persetujuan'];
$catatan   = !empty($a['catatan_penolakan']) ? htmlspecialchars($a['catatan_penolakan']) : '';
$is_revisi = ($sp == 'Perlu_Revisi');
?>

<aside class="right-side">
<section class="content-header">
<div class="container-fluid" style="margin:10px;">

    <?php if ($is_revisi): ?>
    <div class="alert alert-warning" style="border-left: 5px solid #f39c12;">
        <h4><i class="fa fa-edit"></i> Surat Perlu Direvisi</h4>
        <p><strong>Catatan dari Resepsionis:</strong></p>
        <p style="font-style:italic;"><?php echo $catatan ?: '(tidak ada catatan)'; ?></p>
        <p class="text-muted" style="margin-bottom:0;">
            Perbaiki data di bawah lalu klik <strong>"Update & Kirim Ulang"</strong>
            agar surat kembali direview oleh resepsionis.
        </p>
    </div>
    <?php endif; ?>

    <form method="post" action="04_prosesedit_surat_penelitian.php" enctype="multipart/form-data">

        <input type="hidden" name="id_surat_penelitian" value="<?php echo $a['id_surat_penelitian']; ?>">
        <input type="hidden" name="halaman" value="<?php echo !empty($_GET['halaman']) ? $_GET['halaman'] : '0'; ?>">
        <input type="hidden" name="is_revisi" value="<?php echo $is_revisi ? '1' : '0'; ?>">

        <table width="100%" border="0" class="table table-hover">
            <tr>
                <td class="info" colspan="3"><b>Edit Surat Penelitian</b></td>
            </tr>

            <tr>
                <td width="20%">Nama Mahasiswa</td>
                <td width="2%">:</td>
                <td><input type="text" name="nama_mahasiswa" required class="form-control"
                           value="<?php echo htmlspecialchars($a['nama_mahasiswa']); ?>"></td>
            </tr>

            <tr>
                <td>NIM Mahasiswa</td>
                <td>:</td>
                <td><input type="text" name="nim_mahasiswa" class="form-control"
                           value="<?php echo htmlspecialchars($a['nim_mahasiswa']); ?>"></td>
            </tr>

            <tr>
                <td>No Handphone</td>
                <td>:</td>
                <td><input type="text" name="no_hp" required class="form-control"
                           value="<?php echo htmlspecialchars($a['no_hp']); ?>"></td>
            </tr>

            <tr>
                <td>Lama Penelitian</td>
                <td>:</td>
                <td><input type="text" name="lama_penelitian" required class="form-control"
                           value="<?php echo htmlspecialchars($a['lama_penelitian']); ?>"></td>
            </tr>

            <tr>
                <td>Tempat Penelitian</td>
                <td>:</td>
                <td><textarea name="tempat_penelitian" class="form-control"><?php echo htmlspecialchars($a['tempat_penelitian']); ?></textarea></td>
            </tr>

            <tr>
                <td>Judul KTI</td>
                <td>:</td>
                <td><textarea name="judul_kti" class="form-control"><?php echo htmlspecialchars($a['judul_kti']); ?></textarea></td>
            </tr>

            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>
                    <select name="jurusan" class="form-control">
                        <option value="<?php echo $a['jurusan']; ?>"><?php echo $a['jurusan']; ?></option>
                        <?php
                        $qJ = mysqli_query($kon, "SELECT * FROM tb_jurusan");
                        while ($row = mysqli_fetch_array($qJ)):
                        ?>
                        <option value="<?php echo $row['nama_jurusan']; ?>"><?php echo $row['nama_jurusan']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Prodi</td>
                <td>:</td>
                <td>
                    <select name="prodi" class="form-control">
                        <option value="<?php echo $a['prodi']; ?>"><?php echo $a['prodi']; ?></option>
                        <?php
                        $qP = mysqli_query($kon, "SELECT * FROM tb_prodi");
                        while ($row = mysqli_fetch_array($qP)):
                        ?>
                        <option value="<?php echo $row['program_studi']; ?>"><?php echo $row['program_studi']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Tahun Akademik</td>
                <td>:</td>
                <td>
                    <select name="tahun_akademik" class="form-control">
                        <option value="<?php echo $a['tahun_akademik']; ?>"><?php echo $a['tahun_akademik']; ?></option>
                        <?php
                        $qT = mysqli_query($kon, "SELECT * FROM tb_tahun_akademik");
                        while ($row = mysqli_fetch_array($qT)):
                        ?>
                        <option value="<?php echo $row['tahun_akademik']; ?>"><?php echo $row['tahun_akademik']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Tugas Akhir</td>
                <td>:</td>
                <td>
                    <select name="tugas_akhir" class="form-control">
                        <option value="<?php echo $a['tugas_akhir']; ?>"><?php echo $a['tugas_akhir']; ?></option>
                        <option value="Skripsi">Skripsi</option>
                        <option value="Karya Tulis Ilmiah(KTI)">Karya Tulis Ilmiah(KTI)</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Tujuan</td>
                <td>:</td>
                <td><input type="text" name="tujuan" class="form-control"
                           value="<?php echo htmlspecialchars($a['tujuan']); ?>"></td>
            </tr>

            <tr>
                <td>Tembusan</td>
                <td>:</td>
                <td><textarea name="tembusan" class="form-control"><?php echo htmlspecialchars($a['tembusan']); ?></textarea></td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
                <td>
                    <?php if ($is_revisi): ?>
                    <button type="submit" name="submit" class="btn btn-warning">
                        <i class="fa fa-paper-plane"></i> Update & Kirim Ulang
                    </button>
                    <?php else: ?>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <?php endif; ?>

                    <div style="position:fixed; bottom:20px; right:20px; z-index:999;">
                        <button type="button" onclick="history.back()" class="btn btn-default border">
                            Kembali
                        </button>
                    </div>
                </td>
            </tr>
        </table>
    </form>

</div>
</section>
</aside>