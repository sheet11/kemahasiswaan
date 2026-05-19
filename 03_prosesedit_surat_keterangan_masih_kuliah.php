<?php 
error_reporting(0);
include "session.php";
require_once("config/koneksi.php");

/* =========================
   AMBIL DATA FORM
========================= */

$id_surat_keterangan_masih_kuliah = $_POST['id_surat_keterangan_masih_kuliah'];
$halaman        = $_POST['halaman'];

$nama_mahasiswa = $_POST['nama_mahasiswa'];
$nim_mahasiswa  = $_POST['nim_mahasiswa'];
$keperluan      = $_POST['keperluan'];
$jurusan        = $_POST['jurusan'];
$prodi          = $_POST['prodi'];
$tingkat        = $_POST['tingkat'];
$semester       = $_POST['semester'];
$tahun_akademik = $_POST['tahun_akademik'];
$nama_orang_tua = $_POST['nama_orang_tua'];
$nip            = $_POST['nip'];
$pangkat        = $_POST['pangkat'];
$instansi       = $_POST['instansi'];

/* =========================
   FILE GAMBAR
========================= */

$nama_file   = $_FILES['gambar']['name'];
$ukuran_file = $_FILES['gambar']['size'];
$tipe_file   = $_FILES['gambar']['type'];
$tmp_file    = $_FILES['gambar']['tmp_name'];

$path = "assets/img/" . $nama_file;

/* =========================
   QUERY UPDATE
========================= */

$sql = "UPDATE tb_surat_keterangan_masih_kuliah SET
            nama_mahasiswa = '$nama_mahasiswa',
            nim_mahasiswa = '$nim_mahasiswa',
            keperluan = '$keperluan',
            jurusan = '$jurusan',
            prodi = '$prodi',
            tingkat = '$tingkat',
            semester = '$semester',
            tahun_akademik = '$tahun_akademik',
            nama_orang_tua = '$nama_orang_tua',
            nip = '$nip',
            pangkat = '$pangkat',
            instansi = '$instansi'
        WHERE id_surat_keterangan_masih_kuliah = '$id_surat_keterangan_masih_kuliah'";

/* =========================
   TANPA GAMBAR
========================= */

if(empty($nama_file)){

    $qr = mysqli_query($kon, $sql);

    if($qr){

        echo "<script>
                alert('Data berhasil diperbarui');
                window.location='03_daftar_surat_keterangan_masih_kuliah.php?halaman=$halaman';
              </script>";

    }else{

        echo mysqli_error($kon);

    }

}

/* =========================
   DENGAN GAMBAR
========================= */

else{

    if(
        $tipe_file == "image/jpeg" ||
        $tipe_file == "image/png"  ||
        $tipe_file == "image/jpg"
    ){

        if($ukuran_file <= 3000000){

            if(move_uploaded_file($tmp_file, $path)){

                $qr = mysqli_query($kon, $sql);

                if($qr){

                    echo "<script>
                            alert('Data berhasil diperbarui');
                            window.location='03_daftar_surat_keterangan_masih_kuliah.php?halaman=$halaman';
                          </script>";

                }else{

                    echo mysqli_error($kon);

                }

            }else{

                echo "<script>
                        alert('Gambar gagal diupload');
                        window.location='03_daftar_surat_keterangan_masih_kuliah.php?halaman=$halaman';
                      </script>";

            }

        }else{

            echo "<script>
                    alert('Ukuran gambar maksimal 3 MB');
                    window.location='03_daftar_surat_keterangan_masih_kuliah.php?halaman=$halaman';
                  </script>";

        }

    }else{

        echo "<script>
                alert('Format gambar harus JPG, JPEG, atau PNG');
                window.location='03_daftar_surat_keterangan_masih_kuliah.php?halaman=$halaman';
              </script>";

    }

}
?>