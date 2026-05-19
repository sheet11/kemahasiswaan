-- =====================================================
-- SQL UPDATE: Tambah Fitur Persetujuan Role Wakil Direktur/Kasubak ADAK
-- Jalankan file ini di phpMyAdmin atau MySQL CLI
-- =====================================================

-- 1. Ubah kolom level di tb_user untuk menambahkan role wakil_direktur
ALTER TABLE `tb_user` MODIFY `level` ENUM('administrator','karyawan','mahasiswa','wakil_direktur') NOT NULL;

-- 2. Tambah user wakil direktur (password: wakdir123)
INSERT INTO `tb_user` (`username`, `nama_lengkap`, `password`, `level`) 
VALUES ('wakdir', 'Wakil Direktur', 'wakdir123', 'wakil_direktur');

-- 3. Tambah kolom persetujuan ke tb_surat_keterangan_lulus
ALTER TABLE `tb_surat_keterangan_lulus` 
  ADD COLUMN `status_persetujuan` ENUM('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu' AFTER `status`,
  ADD COLUMN `catatan_penolakan` TEXT NULL AFTER `status_persetujuan`,
  ADD COLUMN `tanggal_persetujuan` VARCHAR(100) NULL AFTER `catatan_penolakan`;

-- 4. Tambah kolom persetujuan ke tb_surat_keterangan_masih_kuliah
ALTER TABLE `tb_surat_keterangan_masih_kuliah` 
  ADD COLUMN `status_persetujuan` ENUM('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu' AFTER `status`,
  ADD COLUMN `catatan_penolakan` TEXT NULL AFTER `status_persetujuan`,
  ADD COLUMN `tanggal_persetujuan` VARCHAR(100) NULL AFTER `catatan_penolakan`;

-- 5. Tambah kolom persetujuan ke tb_surat_penelitian
ALTER TABLE `tb_surat_penelitian` 
  ADD COLUMN `status_persetujuan` ENUM('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu' AFTER `status`,
  ADD COLUMN `catatan_penolakan` TEXT NULL AFTER `status_persetujuan`,
  ADD COLUMN `tanggal_persetujuan` VARCHAR(100) NULL AFTER `catatan_penolakan`;

-- 6. Tambah kolom persetujuan ke tb_surat_pra_penelitian
ALTER TABLE `tb_surat_pra_penelitian` 
  ADD COLUMN `status_persetujuan` ENUM('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu' AFTER `status`,
  ADD COLUMN `catatan_penolakan` TEXT NULL AFTER `status_persetujuan`,
  ADD COLUMN `tanggal_persetujuan` VARCHAR(100) NULL AFTER `catatan_penolakan`;

-- =====================================================
-- SELESAI
-- =====================================================
