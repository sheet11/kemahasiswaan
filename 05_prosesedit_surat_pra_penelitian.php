<?php 
error_reporting(0);
include "session.php";
include "config/koneksi.php";

$id           = (int)$_POST['id_surat_pra_penelitian'];
$halaman      = $_POST['halaman'];
$is_revisi    = isset($_POST['is_revisi']) && $_POST['is_revisi'] == '1';

$nama_mahasiswa = mysqli_real_escape_string($kon, $_POST['nama_mahasiswa']);
$nim_mahasiswa  = mysqli_real_escape_string($kon, $_POST['nim_mahasiswa']);
$no_hp          = mysqli_real_escape_string($kon, $_POST['no_hp']);
$tujuan         = mysqli_real_escape_string($kon, $_POST['tujuan']);
$judul_kti      = mysqli_real_escape_string($kon, $_POST['judul_kti']);
$lokasi         = mysqli_real_escape_string($kon, $_POST['lokasi']);
$jurusan        = mysqli_real_escape_string($kon, $_POST['jurusan']);
$prodi          = mysqli_real_escape_string($kon, $_POST['prodi']);
$tahun_akademik = mysqli_real_escape_string($kon, $_POST['tahun_akademik']);
$tugas_akhir    = mysqli_real_escape_string($kon, $_POST['tugas_akhir']);

// Jika revisi → ubah status ke Telah_Direvisi dan kosongkan catatan
$status_sql = '';
if ($is_revisi) {
    $status_sql = ", status_persetujuan = 'Telah_Direvisi', catatan_penolakan = ''";
}

$sql = "UPDATE tb_surat_pra_penelitian SET
            nama_mahasiswa = '$nama_mahasiswa',
            nim_mahasiswa  = '$nim_mahasiswa',
            no_hp          = '$no_hp',
            tujuan         = '$tujuan',
            judul_kti      = '$judul_kti',
            lokasi         = '$lokasi',
            jurusan        = '$jurusan',
            prodi          = '$prodi',
            tahun_akademik = '$tahun_akademik',
            tugas_akhir    = '$tugas_akhir'
            $status_sql
        WHERE id_surat_pra_penelitian = $id";

$qr = mysqli_query($kon, $sql);

if ($qr) {
    if ($is_revisi) {
        echo "<script>
                alert('Surat berhasil diperbarui dan dikirim ulang ke resepsionis.');
                window.location='05_daftar_surat_pra_penelitian.php?pesan=revisi_terkirim&halaman=$halaman';
              </script>";
    } else {
        echo "<script>
                alert('Data berhasil diperbarui.');
                window.location='05_daftar_surat_pra_penelitian.php?halaman=$halaman';
              </script>";
    }
} else {
    echo "<script>
            alert('Gagal menyimpan data: " . mysqli_error($kon) . "');
            window.history.back();
          </script>";
}
?>