<?php 

error_reporting(0);

include "session.php";
include "config/koneksi.php";

/* =========================
   AMBIL DATA POST
========================= */

$id               = $_POST['id_surat_pra_penelitian'];
$halaman          = $_POST['halaman'];

$nama_mahasiswa   = $_POST['nama_mahasiswa'];
$nim_mahasiswa    = $_POST['nim_mahasiswa'];
$no_hp            = $_POST['no_hp'];
$tujuan           = $_POST['tujuan'];
$judul_kti        = $_POST['judul_kti'];
$lokasi           = $_POST['lokasi'];
$jurusan          = $_POST['jurusan'];
$prodi            = $_POST['prodi'];
$tahun_akademik   = $_POST['tahun_akademik'];
$tugas_akhir      = $_POST['tugas_akhir'];

/* =========================
   UPLOAD GAMBAR
========================= */

$nama_file   = $_FILES['gambar']['name'];
$ukuran_file = $_FILES['gambar']['size'];
$tipe_file   = $_FILES['gambar']['type'];
$tmp_file    = $_FILES['gambar']['tmp_name'];

$path = "assets/img/".$nama_file;

/* =========================
   JIKA TANPA GAMBAR
========================= */

if(empty($nama_file)){

    $qr = mysqli_query(
        $kon,
        "UPDATE tb_surat_pra_penelitian SET

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

         WHERE id_surat_pra_penelitian='$id'"
    );

    if($qr){

        echo "
        <script>

            alert('Data berhasil diperbarui');

            window.location='05_daftar_surat_pra_penelitian.php?halaman=$halaman';

        </script>
        ";

    }else{

        echo mysqli_error($kon);

    }

}

/* =========================
   JIKA ADA GAMBAR
========================= */

else{

    if(
        $tipe_file == "image/jpeg" ||
        $tipe_file == "image/png"  ||
        $tipe_file == "image/jpg"
    ){

        if($ukuran_file <= 3000000){

            if(move_uploaded_file($tmp_file, $path)){

                $qr = mysqli_query(
                    $kon,
                    "UPDATE tb_surat_pra_penelitian SET

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

                     WHERE id_surat_pra_penelitian='$id'"
                );

                if($qr){

                    echo "
                    <script>

                        alert('Data berhasil diperbarui');

                        window.location='05_daftar_surat_pra_penelitian.php?halaman=$halaman';

                    </script>
                    ";

                }else{

                    echo mysqli_error($kon);

                }

            }else{

                echo "
                <script>

                    alert('Gambar gagal upload');

                    history.back();

                </script>
                ";

            }

        }else{

            echo "
            <script>

                alert('Ukuran gambar terlalu besar');

                history.back();

            </script>
            ";

        }

    }else{

        echo "
        <script>

            alert('Format gambar harus JPG / PNG');

            history.back();

        </script>
        ";

    }

}

?>