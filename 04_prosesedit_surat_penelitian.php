<?php 
error_reporting(0);
include "session.php";
require_once("config/koneksi.php");

$id           = (int)$_POST['id_surat_penelitian'];
$halaman      = $_POST['halaman'];
$is_revisi    = isset($_POST['is_revisi']) && $_POST['is_revisi'] == '1';

$nama_mahasiswa  = mysqli_real_escape_string($kon, $_POST['nama_mahasiswa']);
$nim_mahasiswa   = mysqli_real_escape_string($kon, $_POST['nim_mahasiswa']);
$no_hp           = mysqli_real_escape_string($kon, $_POST['no_hp']);
$lama_penelitian = mysqli_real_escape_string($kon, $_POST['lama_penelitian']);
$tempat_penelitian = mysqli_real_escape_string($kon, $_POST['tempat_penelitian']);
$judul_kti       = mysqli_real_escape_string($kon, $_POST['judul_kti']);
$jurusan         = mysqli_real_escape_string($kon, $_POST['jurusan']);
$prodi           = mysqli_real_escape_string($kon, $_POST['prodi']);
$tahun_akademik  = mysqli_real_escape_string($kon, $_POST['tahun_akademik']);
$tugas_akhir     = mysqli_real_escape_string($kon, $_POST['tugas_akhir']);
$tujuan          = mysqli_real_escape_string($kon, $_POST['tujuan']);
$tembusan        = mysqli_real_escape_string($kon, $_POST['tembusan']);

// Jika revisi → ubah status ke Telah_Direvisi dan kosongkan catatan
$status_sql = '';
if ($is_revisi) {
    $status_sql = ", status_persetujuan = 'Telah_Direvisi', catatan_penolakan = ''";
}

$sql = "UPDATE tb_surat_penelitian SET
            nama_mahasiswa    = '$nama_mahasiswa',
            nim_mahasiswa     = '$nim_mahasiswa',
            no_hp             = '$no_hp',
            lama_penelitian   = '$lama_penelitian',
            tempat_penelitian = '$tempat_penelitian',
            judul_kti         = '$judul_kti',
            jurusan           = '$jurusan',
            prodi             = '$prodi',
            tahun_akademik    = '$tahun_akademik',
            tugas_akhir       = '$tugas_akhir',
            tujuan            = '$tujuan',
            tembusan          = '$tembusan'
            $status_sql
        WHERE id_surat_penelitian = $id";

$qr = mysqli_query($kon, $sql);

if ($qr) {
    if ($is_revisi) {
        echo "<script>
                alert('Surat berhasil diperbarui dan dikirim ulang ke resepsionis.');
                window.location='04_daftar_surat_penelitian.php?pesan=revisi_terkirim&halaman=$halaman';
              </script>";
    } else {
        echo "<script>
                alert('Data berhasil diperbarui.');
                window.location='04_daftar_surat_penelitian.php?halaman=$halaman';
              </script>";
    }
} else {
    echo "<script>
            alert('Gagal menyimpan data: " . mysqli_error($kon) . "');
            window.history.back();
          </script>";
}
?>