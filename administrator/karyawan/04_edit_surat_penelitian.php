<?php 
include "01_nav.php"; 
include "../config/koneksi.php";

$id    = (int)($_GET['id_surat_penelitian'] ?? 0);
$query = mysqli_query($kon, "SELECT * FROM tb_surat_penelitian WHERE id_surat_penelitian=$id");
$a     = mysqli_fetch_array($query);

$list_jurusan = mysqli_query($kon, "SELECT * FROM tb_jurusan");
$list_prodi   = mysqli_query($kon, "SELECT * FROM tb_prodi");
$list_tahun   = mysqli_query($kon, "SELECT * FROM tb_tahun_akademik");
?>

<div style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">
    <button type="button" onclick="history.back()" class="btn btn-light border">
        Kembali
    </button>
</div>

<aside class="right-side">
    <section class="content-header">
        <div class="container-fluid" style="margin:10px;">
            <form method="post" action="04_prosesedit_surat_penelitian.php" enctype="multipart/form-data">
                <table width="100%" border="0" class="table table-hover">

                    <tr style="display:none">
                        <td>
                            <input type="hidden" name="id_surat_penelitian" value="<?= $a['id_surat_penelitian'] ?>">
                            <input type="hidden" name="halaman" value="<?= !empty($_GET['halaman']) ? (int)$_GET['halaman'] : 0 ?>">
                        </td>
                    </tr>

                    <tr><td class="info"><b>Edit Surat Penelitian</b></td></tr>

                    <tr><td>Nama Mahasiswa</td></tr>
                    <tr>
                        <td><input type="text" name="nama_mahasiswa" class="form-control" required
                            value="<?= htmlspecialchars($a['nama_mahasiswa']) ?>"></td>
                    </tr>

                    <tr><td>NIM Mahasiswa</td></tr>
                    <tr>
                        <td><input type="text" name="nim_mahasiswa" class="form-control"
                            value="<?= htmlspecialchars($a['nim_mahasiswa']) ?>"></td>
                    </tr>

                    <tr><td>No Handphone</td></tr>
                    <tr>
                        <td><input type="text" name="no_hp" class="form-control" required
                            value="<?= htmlspecialchars($a['no_hp']) ?>"></td>
                    </tr>

                    <tr><td>Lama Penelitian</td></tr>
                    <tr>
                        <td><input type="text" name="lama_penelitian" class="form-control" required
                            value="<?= htmlspecialchars($a['lama_penelitian']) ?>"></td>
                    </tr>

                    <tr><td>Tempat Penelitian</td></tr>
                    <tr>
                        <td><textarea name="tempat_penelitian" class="form-control" required><?= htmlspecialchars($a['tempat_penelitian']) ?></textarea></td>
                    </tr>

                    <tr><td>Judul KTI</td></tr>
                    <tr>
                        <td><textarea name="judul_kti" class="form-control"><?= htmlspecialchars($a['judul_kti']) ?></textarea></td>
                    </tr>

                    <tr><td>Jurusan</td></tr>
                    <tr>
                        <td>
                            <select name="jurusan" class="form-control">
                                <option value="">-- Silahkan Dipilih --</option>
                                <?php while ($row = mysqli_fetch_array($list_jurusan)): ?>
                                    <option value="<?= htmlspecialchars($row['nama_jurusan']) ?>"
                                        <?= $row['nama_jurusan'] == $a['jurusan'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['nama_jurusan']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                    </tr>

                    <tr><td>Prodi</td></tr>
                    <tr>
                        <td>
                            <select name="prodi" class="form-control">
                                <option value="">-- Silahkan Dipilih --</option>
                                <?php while ($row = mysqli_fetch_array($list_prodi)): ?>
                                    <option value="<?= htmlspecialchars($row['program_studi']) ?>"
                                        <?= $row['program_studi'] == $a['prodi'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['program_studi']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                    </tr>

                    <tr><td>Tahun Akademik</td></tr>
                    <tr>
                        <td>
                            <select name="tahun_akademik" class="form-control">
                                <option value="">-- Silahkan Dipilih --</option>
                                <?php while ($row = mysqli_fetch_array($list_tahun)): ?>
                                    <option value="<?= htmlspecialchars($row['tahun_akademik']) ?>"
                                        <?= $row['tahun_akademik'] == $a['tahun_akademik'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['tahun_akademik']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                    </tr>

                    <tr><td>Tugas Akhir</td></tr>
                    <tr>
                        <td>
                            <select name="tugas_akhir" class="form-control">
                                <option value="">-- Silahkan Dipilih --</option>
                                <option value="Karya Tulis Ilmiah (KTI)" <?= $a['tugas_akhir'] == 'Karya Tulis Ilmiah (KTI)' ? 'selected' : '' ?>>Karya Tulis Ilmiah (KTI)</option>
                                <option value="Skripsi" <?= $a['tugas_akhir'] == 'Skripsi' ? 'selected' : '' ?>>Skripsi</option>
                            </select>
                        </td>
                    </tr>

                    <tr><td>Tujuan</td></tr>
                    <tr>
                        <td><input type="text" name="tujuan" class="form-control"
                            value="<?= htmlspecialchars($a['tujuan']) ?>"></td>
                    </tr>

                    <tr><td>Tanggal Cetak</td></tr>
                    <tr>
                        <td><input type="text" name="tanggal_cetak" class="form-control"
                            placeholder="Format: Tahun-Bulan-Tanggal"
                            value="<?= htmlspecialchars($a['tanggal_cetak']) ?>"></td>
                    </tr>

                    <tr><td>Tembusan</td></tr>
                    <tr>
                        <td><textarea name="tembusan" class="form-control"><?= htmlspecialchars($a['tembusan']) ?></textarea></td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Simpan" class="btn btn-danger">
                            <input type="reset" value="Hapus" class="btn btn-success">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </section>
</aside>