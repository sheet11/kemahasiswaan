<?php 
include "01_nav.php";
include "config/koneksi.php";

$id = (int)$_GET['id_surat_keterangan_masih_kuliah'];

$a = mysqli_fetch_array(mysqli_query($kon,
    "SELECT * FROM tb_surat_keterangan_masih_kuliah
     WHERE id_surat_keterangan_masih_kuliah='$id'"
));

if (!$a) {
    echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>";
    exit;
}

$sp      = $a['status_persetujuan'];
$catatan = !empty($a['catatan_penolakan']) ? htmlspecialchars($a['catatan_penolakan']) : '';

// Mode revisi: surat sedang butuh diperbaiki oleh mahasiswa
$is_revisi = ($sp == 'Perlu_Revisi');
?>

<aside class="right-side">
    <section class="content-header">
        <div class="container-fluid" style="margin:10px;">

            <?php if ($is_revisi): ?>
            <!-- Banner catatan revisi dari resepsionis -->
            <div class="alert alert-warning" style="border-left: 5px solid #f39c12;">
                <h4><i class="fa fa-edit"></i> Surat Perlu Direvisi</h4>
                <p><strong>Catatan dari resepsionis:</strong></p>
                <p style="font-style:italic;"><?php echo $catatan ?: '(tidak ada catatan)'; ?></p>
                <p class="text-muted" style="margin-bottom:0;">
                    Perbaiki data di bawah lalu klik <strong>"Update & Kirim Ulang"</strong>
                    agar surat kembali direview oleh resepsionis.
                </p>
            </div>
            <?php endif; ?>

            <form method="post"
                  action="03_prosesedit_surat_keterangan_masih_kuliah.php"
                  enctype="multipart/form-data">

                <input type="hidden" name="id_surat_keterangan_masih_kuliah"
                       value="<?php echo $a['id_surat_keterangan_masih_kuliah']; ?>">
                <input type="hidden" name="halaman"
                       value="<?php echo !empty($_GET['halaman']) ? $_GET['halaman'] : '0'; ?>">
                <!-- Flag: apakah ini pengiriman ulang setelah revisi -->
                <input type="hidden" name="is_revisi" value="<?php echo $is_revisi ? '1' : '0'; ?>">

                <table width="100%" border="0" class="table table-hover">
                    <tr>
                        <td colspan="3">
                            <h2>Edit Surat Keterangan Masih Kuliah</h2>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" class="success"><b>Data Mahasiswa</b></td>
                    </tr>

                    <tr>
                        <td width="15%">Nama Mahasiswa</td>
                        <td width="2%">:</td>
                        <td><input type="text" name="nama_mahasiswa" required
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($a['nama_mahasiswa']); ?>"></td>
                    </tr>

                    <tr>
                        <td>NIM Mahasiswa</td>
                        <td>:</td>
                        <td><input type="text" name="nim_mahasiswa" required
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($a['nim_mahasiswa']); ?>"></td>
                    </tr>

                    <tr>
                        <td>Keperluan</td>
                        <td>:</td>
                        <td>
                            <select name="keperluan" class="form-control" required>
                                <option value="<?php echo htmlspecialchars($a['keperluan']); ?>">
                                    <?php echo htmlspecialchars($a['keperluan']); ?>
                                </option>
                                <option value="Slip Gaji/Tunjangan/Pensiun">Slip Gaji/Tunjangan/Pensiun</option>
                                <option value="Pembuatan Askes/BPJS">Pembuatan Askes/BPJS</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Tingkat</td>
                        <td>:</td>
                        <td>
                            <select name="tingkat" class="form-control" required>
                                <option value="<?php echo $a['tingkat']; ?>"><?php echo $a['tingkat']; ?></option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>
                            <select name="semester" class="form-control" required>
                                <option value="<?php echo $a['semester']; ?>"><?php echo $a['semester']; ?></option>
                                <?php foreach (['I','II','III','IV','V','VI','VII','VIII'] as $s): ?>
                                <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
                                <?php endforeach; ?>
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
                                $qTA = mysqli_query($kon, "SELECT * FROM tb_tahun_akademik");
                                while ($row = mysqli_fetch_array($qTA)):
                                ?>
                                <option value="<?php echo $row['tahun_akademik']; ?>">
                                    <?php echo $row['tahun_akademik']; ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>
                            <select name="jurusan" class="form-control" required>
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
                        <td colspan="3" class="success"><b>Data Orang Tua/Wali</b></td>
                    </tr>

                    <tr>
                        <td>Nama Orang Tua</td>
                        <td>:</td>
                        <td><input type="text" name="nama_orang_tua" required
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($a['nama_orang_tua']); ?>"></td>
                    </tr>

                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><input type="text" name="nip" required
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($a['nip']); ?>"></td>
                    </tr>

                    <tr>
                        <td>Pangkat, Golongan</td>
                        <td>:</td>
                        <td><input type="text" name="pangkat" required
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($a['pangkat']); ?>"></td>
                    </tr>

                    <tr>
                        <td>Instansi</td>
                        <td>:</td>
                        <td><input type="text" name="instansi"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($a['instansi']); ?>"></td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>
                            <?php if ($is_revisi): ?>
                            <!-- Mode revisi: tombol khusus kirim ulang -->
                            <button type="submit" name="submit" class="btn btn-warning">
                                <i class="fa fa-paper-plane"></i> Update & Kirim Ulang
                            </button>
                            <?php else: ?>
                            <!-- Mode edit biasa -->
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <?php endif; ?>

                            <div style="position:fixed; bottom:20px; right:20px; z-index:999;">
                                <button type="button" onclick="history.back()"
                                        class="btn btn-default border">
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