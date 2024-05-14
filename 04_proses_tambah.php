<?php
    include "config/koneksi.php";
	if(isset($_POST['submit'])){
		$date = date("Y-m-d");	
		$nama = $_POST['nama_mahasiswa'];
		$nim = $_POST['nim_mahasiswa'];
		$hp = $_POST['no_hp'];
        $lama_penelitian = $_POST['lama_penelitian'];
        $tempat = $_POST['tempat_penelitian'];
        $judul = $_POST['judul_kti'];
        $jurusan = $_POST['jurusan'];
        $prodi = $_POST['prodi'];
        $tugas_akhir = $_POST['tugas_akhir'];
        $tujuan = $_POST['tujuan'];
        $tahunakademik = $_POST['tahun_akademik'];
        $tembusan = $_POST['tembusan'];
        
		$query=mysqli_query($kon,"insert into tb_surat_penelitian (nama_mahasiswa, nim_mahasiswa, no_hp, lama_penelitian,tempat_penelitian, judul_kti, jurusan,  prodi, tugas_akhir, tujuan, tanggal_cetak,tahun_akademik, tembusan) values('$nama','$nim','$hp','$lama_penelitian','$tempat','$judul','$jurusan','$prodi','$tugas_akhir','$tujuan','$date','$tahunakademik','$tembusan')");				
			if($query){
				echo"<script>alert('Data Berhasil di Simpan');window.location='04_daftar_surat_penelitian.php'</script>";
			} else {
				echo "gagal";
			}
		}					
?>