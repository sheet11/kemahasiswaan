<?php 
error_reporting(0);

include "session.php";
require_once("config/koneksi.php");

/* =========================
   AMBIL DATA FORM
========================= */

$id_surat_keterangan_lulus = $_POST['id_surat_keterangan_lulus'];
$halaman       = $_POST['halaman'];

$nama_mahasiswa = $_POST['nama_mahasiswa'];
$nim_mahasiswa  = $_POST['nim_mahasiswa'];
$keperluan      = $_POST['keperluan'];
$tempat_lahir   = $_POST['tempat_lahir'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$jurusan        = $_POST['jurusan'];
$prodi          = $_POST['prodi'];
$tahun_akademik = $_POST['tahun_akademik'];
$nomor_surat    = $_POST['nomor_surat'];
$tanggal_sk     = $_POST['tanggal_sk'];
$tanggal_wisudah = $_POST['tanggal_wisudah'];

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

$sql = "UPDATE tb_surat_keterangan_lulus SET
            nama_mahasiswa = '$nama_mahasiswa',
            nim_mahasiswa = '$nim_mahasiswa',
            keperluan = '$keperluan',
            tempat_lahir = '$tempat_lahir',
            tanggal_lahir = '$tanggal_lahir',
            jurusan = '$jurusan',
            prodi = '$prodi',
            tahun_akademik = '$tahun_akademik',
            nomor_surat = '$nomor_surat',
            tanggal_sk = '$tanggal_sk',
            tanggal_wisudah = '$tanggal_wisudah'
        WHERE id_surat_keterangan_lulus = '$id_surat_keterangan_lulus'";

/* =========================
   TANPA GAMBAR
========================= */

if(empty($nama_file)){

    $qr = mysqli_query($kon, $sql);

    if($qr){

        echo "<script>
                alert('Data berhasil diperbarui');
                window.location='02_daftar_surat_keterangan_lulus.php?halaman=$halaman';
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
                            window.location='02_daftar_surat_keterangan_lulus.php?halaman=$halaman';
                          </script>";

                }else{

                    echo mysqli_error($kon);

                }

            }else{

                echo "<script>
                        alert('Gambar gagal diupload');
                        window.location='02_daftar_surat_keterangan_lulus.php?halaman=$halaman';
                      </script>";

            }

        }else{

            echo "<script>
                    alert('Ukuran gambar maksimal 3 MB');
                    window.location='02_daftar_surat_keterangan_lulus.php?halaman=$halaman';
                  </script>";

        }

    }else{

        echo "<script>
                alert('Format gambar harus JPG, JPEG, atau PNG');
                window.location='02_daftar_surat_keterangan_lulus.php?halaman=$halaman';
              </script>";

    }

}
?>