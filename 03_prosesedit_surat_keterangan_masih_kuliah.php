<?php 
error_reporting(0);
include "session.php";
require_once("config/koneksi.php");

// ── Ambil data form ───────────────────────────────────────────────────────────
$id             = (int)$_POST['id_surat_keterangan_masih_kuliah'];
$halaman        = $_POST['halaman'];
$is_revisi      = isset($_POST['is_revisi']) && $_POST['is_revisi'] == '1';

$nama_mahasiswa = mysqli_real_escape_string($kon, $_POST['nama_mahasiswa']);
$nim_mahasiswa  = mysqli_real_escape_string($kon, $_POST['nim_mahasiswa']);
$keperluan      = mysqli_real_escape_string($kon, $_POST['keperluan']);
$jurusan        = mysqli_real_escape_string($kon, $_POST['jurusan']);
$prodi          = mysqli_real_escape_string($kon, $_POST['prodi']);
$tingkat        = mysqli_real_escape_string($kon, $_POST['tingkat']);
$semester       = mysqli_real_escape_string($kon, $_POST['semester']);
$tahun_akademik = mysqli_real_escape_string($kon, $_POST['tahun_akademik']);
$nama_orang_tua = mysqli_real_escape_string($kon, $_POST['nama_orang_tua']);
$nip            = mysqli_real_escape_string($kon, $_POST['nip']);
$pangkat        = mysqli_real_escape_string($kon, $_POST['pangkat']);
$instansi       = mysqli_real_escape_string($kon, $_POST['instansi']);

// ── Jika ini pengiriman ulang setelah revisi → ubah status ───────────────────
// status_persetujuan = 'Telah_Direvisi' agar karyawan tahu surat sudah diperbaiki
// catatan_penolakan dikosongkan karena sudah ditindaklanjuti
$status_sql = '';
if ($is_revisi) {
    $status_sql = ", status_persetujuan = 'Telah_Direvisi', catatan_penolakan = ''";
}

// ── Query UPDATE ──────────────────────────────────────────────────────────────
$sql = "UPDATE tb_surat_keterangan_masih_kuliah SET
            nama_mahasiswa = '$nama_mahasiswa',
            nim_mahasiswa  = '$nim_mahasiswa',
            keperluan      = '$keperluan',
            jurusan        = '$jurusan',
            prodi          = '$prodi',
            tingkat        = '$tingkat',
            semester       = '$semester',
            tahun_akademik = '$tahun_akademik',
            nama_orang_tua = '$nama_orang_tua',
            nip            = '$nip',
            pangkat        = '$pangkat',
            instansi       = '$instansi'
            $status_sql
        WHERE id_surat_keterangan_masih_kuliah = $id";

$qr = mysqli_query($kon, $sql);

if ($qr) {
    if ($is_revisi) {
        // Kembali ke daftar dengan pesan revisi terkirim
        echo "<script>
                alert('Surat berhasil diperbarui dan dikirim ulang ke resepsionis.');
                window.location='03_daftar_surat_keterangan_masih_kuliah.php?pesan=revisi_terkirim&halaman=$halaman';
              </script>";
    } else {
        echo "<script>
                alert('Data berhasil diperbarui.');
                window.location='03_daftar_surat_keterangan_masih_kuliah.php?halaman=$halaman';
              </script>";
    }
} else {
    echo "<script>
            alert('Gagal menyimpan data: " . mysqli_error($kon) . "');
            window.history.back();
          </script>";
}
?>