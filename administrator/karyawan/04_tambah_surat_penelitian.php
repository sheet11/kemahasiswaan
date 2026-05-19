<?php 
include "01_nav.php";
include "../assets/js/date.php";
include "../config/koneksi.php";
?>

<?php if ($_SESSION['level'] == "karyawan"): ?>
<aside class="right-side">
    <section class="content-header">
        <div class="container-fluid" style="margin:10px;">

            <?php
            if (isset($_POST['submit'])) {
                $date = date("Y-m-d");
                $nama            = mysqli_real_escape_string($kon, $_POST['nama_mahasiswa']);
                $nim             = mysqli_real_escape_string($kon, $_POST['nim_mahasiswa']);
                $no_hp           = mysqli_real_escape_string($kon, $_POST['no_hp']);
                $lama            = mysqli_real_escape_string($kon, $_POST['lama_penelitian']);
                $tempat          = mysqli_real_escape_string($kon, $_POST['tempat_penelitian']);
                $judul           = mysqli_real_escape_string($kon, $_POST['judul_kti']);
                $prodi           = mysqli_real_escape_string($kon, $_POST['prodi']);
                $tugas_akhir     = mysqli_real_escape_string($kon, $_POST['tugas_akhir']);
                $tujuan          = mysqli_real_escape_string($kon, $_POST['tujuan']);
                $tahun_akademik  = mysqli_real_escape_string($kon, $_POST['tahun_akademik']);
                $tembusan        = mysqli_real_escape_string($kon, $_POST['tembusan']);

                $query = mysqli_query($kon, "
                    INSERT INTO tb_surat_penelitian
                    (nama_mahasiswa, nim_mahasiswa, no_hp, lama_penelitian, tempat_penelitian, judul_kti, prodi, tugas_akhir, tujuan, tanggal_cetak, tahun_akademik, tembusan)
                    VALUES
                    ('$nama','$nim','$no_hp','$lama','$tempat','$judul','$prodi','$tugas_akhir','$tujuan','$date','$tahun_akademik','$tembusan')
                ");

                if ($query) {
                    echo "<script>alert('Data Berhasil di Simpan'); window.location='04_daftar_surat_penelitian.php'</script>";
                } else {
                    echo "<script>alert('Gagal simpan: " . mysqli_error($kon) . "')</script>";
                }
            }
            ?>

            <form method="post" action="" enctype="multipart/form-data">
                <table style="width:100%" class="table table-basic">
                    <tr>
                        <td class="info" colspan="3"><b>Tambah Data Surat Penelitian</b></td>
                    </tr>
                    <tr><td>Nama Mahasiswa</td></tr>
                    <tr>
                        <td><input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa" required class="form-control"></td>
                    </tr>
                    <tr><td>NIM Mahasiswa</td></tr>
                    <tr>
                        <td><input type="text" placeholder="NIM Mahasiswa huruf P dibuat huruf kapital contoh P0" name="nim_mahasiswa" required class="form-control"></td>
                    </tr>
                    <tr><td>No Handphone</td></tr>
                    <tr>
                        <td><input type="text" placeholder="No Handphone" name="no_hp" required class="form-control"></td>
                    </tr>
                    <tr><td>Lama Penelitian</td></tr>
                    <tr>
                        <td><input type="text" placeholder="Lama Penelitian" name="lama_penelitian" required class="form-control"></td>
                    </tr>
                    <tr><td>Tempat Penelitian</td></tr>
                    <tr>
                        <td><textarea placeholder="Tempat Penelitian" name="tempat_penelitian" class="form-control" required></textarea></td>
                    </tr>
                    <tr><td>Judul</td></tr>
                    <tr>
                        <td><textarea placeholder="Judul Awal Kata Huruf Besar" name="judul_kti" class="form-control" required></textarea></td>
                    </tr>
                    <tr><td>Prodi</td></tr>
                    <tr>
                        <td>
                            <select name="prodi" class="form-control">
                                <option value="">..: Silahkan Dipilih :..</option>
                                <?php
                                $query_prodi = mysqli_query($kon, "SELECT * FROM tb_prodi");
                                while ($row = mysqli_fetch_array($query_prodi)) {
                                    echo "<option value='{$row['program_studi']}'>{$row['program_studi']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr><td><b>Tahun Akademik</b></td></tr>
                    <tr>
                        <td>
                            <select name="tahun_akademik" class="form-control">
                                <option value="">-- Silahkan Dipilih --</option>
                                <?php
                                $query_tahun = mysqli_query($kon, "SELECT * FROM tb_tahun_akademik");
                                while ($row = mysqli_fetch_array($query_tahun)) {
                                    echo "<option value='{$row['tahun_akademik']}'>{$row['tahun_akademik']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr><td>Tugas Akhir</td></tr>
                    <tr>
                        <td>
                            <select name="tugas_akhir" class="form-control" required>
                                <option value="">-- Silahkan Dipilih --</option>
                                <option value="Karya Tulis Ilmiah (KTI)">Karya Tulis Ilmiah (KTI)</option>
                                <option value="Skripsi">Skripsi</option>
                            </select>
                        </td>
                    </tr>
                    <tr><td>Tujuan Surat</td></tr>
                    <tr>
                        <td><input type="text" placeholder="Ditujukan Kemana" name="tujuan" class="form-control" required></td>
                    </tr>
                    <tr><td>Tembusan</td></tr>
                    <tr>
                        <td><textarea placeholder="Tembusan" name="tembusan" class="form-control" required></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                            <input type="reset" value="Hapus" class="btn btn-danger">
                        </td>
						<div style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">

								<button 
									type="button"
									onclick="history.back()" 
									class="btn btn-light border"
								>
									Kembali
								</button>

							</div>
                    </tr>
                </table>
            </form>

        </div>
    </section>
</aside>
<?php endif; ?>