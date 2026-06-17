-- ============================================================
-- MIGRATION QUERY: Upgrade DB LAMA (db_kemahasiswaan_8)
--                  agar struktur = DB BARU (db_kemahasiswaan)
-- 
-- ✅ AMAN: Data yang sudah ada di DB LAMA tidak akan hilang
-- ✅ Semua perintah menggunakan ADD COLUMN (bukan DROP/RECREATE)
-- ✅ MODIFY COLUMN pada enum hanya menambah nilai baru
--
-- Jalankan query ini pada DATABASE LAMA: db_kemahasiswaan_8
-- ============================================================


-- ============================================================
-- 1. tb_user
--    Tambah nilai enum 'resepsionis' pada kolom `level`
-- ============================================================
ALTER TABLE `tb_user`
  MODIFY COLUMN `level` 
    ENUM('administrator','karyawan','mahasiswa','wakil_direktur','resepsionis') 
    NOT NULL;


-- ============================================================
-- 2. tb_surat_keterangan_lulus
--    a) Tambah nilai enum 'Disetujui_Resepsionis' pada status_persetujuan
--    b) Tambah kolom: nim_pengaju, tanggal_pengajuan, is_revisi
-- ============================================================
ALTER TABLE `tb_surat_keterangan_lulus`
  MODIFY COLUMN `status_persetujuan`
    ENUM('Menunggu','Disetujui_Resepsionis','Disetujui','Ditolak')
    NOT NULL DEFAULT 'Menunggu',

  ADD COLUMN IF NOT EXISTS `nim_pengaju` 
    VARCHAR(100) DEFAULT NULL 
    AFTER `tanggal_persetujuan`,

  ADD COLUMN IF NOT EXISTS `tanggal_pengajuan` 
    DATETIME DEFAULT NULL 
    AFTER `nim_pengaju`,

  ADD COLUMN IF NOT EXISTS `is_revisi` 
    TINYINT(1) NOT NULL DEFAULT 0 
    AFTER `tanggal_pengajuan`;


-- ============================================================
-- 3. tb_surat_keterangan_masih_kuliah
--    a) Tambah nilai enum 'Disetujui_Resepsionis', 'Perlu_Revisi',
--       'Telah_Direvisi' pada status_persetujuan
--    b) Tambah kolom: jumlah_cetak, nim_pengaju, tanggal_pengajuan, is_revisi
-- ============================================================
ALTER TABLE `tb_surat_keterangan_masih_kuliah`
  MODIFY COLUMN `status_persetujuan`
    ENUM('Menunggu','Disetujui_Resepsionis','Disetujui','Ditolak','Perlu_Revisi','Telah_Direvisi')
    NOT NULL DEFAULT 'Menunggu',

  ADD COLUMN IF NOT EXISTS `jumlah_cetak`
    INT(11) NOT NULL DEFAULT 0
    AFTER `status_persetujuan`,

  ADD COLUMN IF NOT EXISTS `nim_pengaju`
    VARCHAR(100) DEFAULT NULL
    AFTER `tanggal_persetujuan`,

  ADD COLUMN IF NOT EXISTS `tanggal_pengajuan`
    DATETIME DEFAULT NULL
    AFTER `nim_pengaju`,

  ADD COLUMN IF NOT EXISTS `is_revisi`
    TINYINT(1) NOT NULL DEFAULT 0
    AFTER `tanggal_pengajuan`;


-- ============================================================
-- 4. tb_surat_penelitian
--    a) Tambah nilai enum 'Disetujui_Resepsionis', 'Perlu_Revisi',
--       'Telah_Direvisi' pada status_persetujuan
--    b) Tambah kolom: nim_pengaju, tanggal_pengajuan, is_revisi
-- ============================================================
ALTER TABLE `tb_surat_penelitian`
  MODIFY COLUMN `status_persetujuan`
    ENUM('Menunggu','Disetujui_Resepsionis','Disetujui','Ditolak','Perlu_Revisi','Telah_Direvisi')
    NOT NULL DEFAULT 'Menunggu',

  ADD COLUMN IF NOT EXISTS `nim_pengaju`
    VARCHAR(100) DEFAULT NULL
    AFTER `tanggal_persetujuan`,

  ADD COLUMN IF NOT EXISTS `tanggal_pengajuan`
    DATETIME DEFAULT NULL
    AFTER `nim_pengaju`,

  ADD COLUMN IF NOT EXISTS `is_revisi`
    TINYINT(1) NOT NULL DEFAULT 0
    AFTER `tanggal_pengajuan`;


-- ============================================================
-- 5. tb_surat_pra_penelitian
--    a) Tambah nilai enum 'Disetujui_Resepsionis', 'Perlu_Revisi',
--       'Telah_Direvisi' pada status_persetujuan
--    b) Tambah kolom: nim_pengaju, tanggal_pengajuan, is_revisi
-- ============================================================
ALTER TABLE `tb_surat_pra_penelitian`
  MODIFY COLUMN `status_persetujuan`
    ENUM('Menunggu','Disetujui_Resepsionis','Disetujui','Ditolak','Perlu_Revisi','Telah_Direvisi')
    NOT NULL DEFAULT 'Menunggu',

  ADD COLUMN IF NOT EXISTS `nim_pengaju`
    VARCHAR(100) DEFAULT NULL
    AFTER `tanggal_persetujuan`,

  ADD COLUMN IF NOT EXISTS `tanggal_pengajuan`
    DATETIME DEFAULT NULL
    AFTER `nim_pengaju`,

  ADD COLUMN IF NOT EXISTS `is_revisi`
    TINYINT(1) NOT NULL DEFAULT 0
    AFTER `tanggal_pengajuan`;


-- ============================================================
-- SELESAI
-- Data lama tetap aman. Kolom baru terisi nilai DEFAULT-nya:
--   nim_pengaju       → NULL
--   tanggal_pengajuan → NULL
--   is_revisi         → 0
--   jumlah_cetak      → 0
-- ============================================================