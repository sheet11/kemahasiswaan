<?php
include "01_nav.php";
include "../config/koneksi.php";
include "../config/class_paging.php";
error_reporting(0);
?>

<aside class="right-side">
    <section class="content-header">
        <h1>Persetujuan <small>Surat Keterangan Masih Kuliah</small></h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Surat Masih Kuliah</li>
        </ol>
    </section>

    <section class="content">

        <?php if (isset($_GET['pesan'])): ?>
            <?php if ($_GET['pesan'] == 'disetujui'): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-check"></i> <strong>Berhasil!</strong> Surat telah <strong>disetujui</strong>. Resepsionis sudah dapat mencetak surat ini.
                </div>
            <?php elseif ($_GET['pesan'] == 'ditolak'): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-times"></i> <strong>Surat ditolak.</strong> Catatan penolakan telah disimpan.
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li <?php echo (!isset($_GET['filter']) || $_GET['filter']=='semua') ? 'class="active"' : ''; ?>>
                    <a href="?filter=semua">Semua</a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Menunggu') ? 'class="active"' : ''; ?>>
                    <a href="?filter=Menunggu"><span class="label label-warning">Menunggu</span></a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Disetujui') ? 'class="active"' : ''; ?>>
                    <a href="?filter=Disetujui"><span class="label label-success">Disetujui</span></a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Ditolak') ? 'class="active"' : ''; ?>>
                    <a href="?filter=Ditolak"><span class="label label-danger">Ditolak</span></a>
                </li>
            </ul>
            <div class="tab-content">

                <?php
                $filter = isset($_GET['filter']) && $_GET['filter'] != 'semua' ? $_GET['filter'] : '';
                $where  = $filter ? "WHERE status_persetujuan='$filter'" : '';
                $p      = new Paging;
                $batas  = 15;
                $posisi = $p->cariPosisi($batas);
                $query  = mysqli_query($kon, "SELECT * FROM tb_surat_keterangan_masih_kuliah $where ORDER BY id_surat_keterangan_masih_kuliah DESC LIMIT $posisi,$batas");
                $i = $posisi + 1;
                ?>

                <!-- ======== AJAX SEARCH (ditambahkan) ======== -->
                <div class="input-group" style="max-width:450px; margin-bottom:10px;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" id="keyword_wadir_mk" class="form-control" placeholder="Cari nama, NIM, jurusan..." autocomplete="off">
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="btn_reset_wadir_mk" type="button" title="Reset"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <small id="info_wadir_mk" class="text-muted"></small>
                <span id="loading_wadir_mk" style="display:none; color:#888; margin-left:8px;"><i class="fa fa-spinner fa-spin"></i></span>
                <!-- ======== /AJAX SEARCH ======== -->

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="info">
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Keperluan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="8%">Preview</th>
                            <!-- <th width="16%">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody id="tbody_wadir_mk">
                    <?php while ($a = mysqli_fetch_array($query)):
                        $sp = $a['status_persetujuan'];
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $a['nama_mahasiswa']; ?></td>
                            <td><?php echo $a['nim_mahasiswa']; ?></td>
                            <td><?php echo $a['jurusan']; ?></td>
                            <td><?php echo $a['keperluan']; ?></td>
                            <td class="text-center">
                                <?php if ($sp == 'Menunggu'): ?>
                                    <span class="label label-warning"><i class="fa fa-clock-o"></i> Menunggu</span>
                                <?php elseif ($sp == 'Disetujui'): ?>
                                    <span class="label label-success"><i class="fa fa-check"></i> Disetujui</span>
                                <?php elseif ($sp == 'Ditolak'): ?>
                                    <span class="label label-danger"><i class="fa fa-times"></i> Ditolak</span>
                                    <?php if (!empty($a['catatan_penolakan'])): ?>
                                        <br><small class="text-danger"><?php echo $a['catatan_penolakan']; ?></small>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="03_preview_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah=<?php echo $a['id_surat_keterangan_masih_kuliah']; ?>&return=03_persetujuan_surat_keterangan_masih_kuliah.php"
                                   class="btn btn-primary btn-xs" >
                                    <i class="fa fa-eye"></i> Lihat
                                </a>
                            </td>
                            <!-- <td>
                                <?php if ($sp == 'Menunggu'): ?>
                                    <a href="proses_persetujuan.php?aksi=setujui&jenis=masih_kuliah&id=<?php echo $id_s; ?>&return=03_persetujuan_surat_keterangan_masih_kuliah.php"
                                       onclick="return confirm('Setujui surat <?php echo addslashes($a['nama_mahasiswa']); ?>?')"
                                       class="btn btn-success btn-xs"><i class="fa fa-check"></i> Setujui</a>
                                    <a href="proses_persetujuan.php?aksi=tolak&jenis=masih_kuliah&id=<?php echo $id_s; ?>&return=03_persetujuan_surat_keterangan_masih_kuliah.php"
                                       class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Tolak</a>
                                <?php elseif ($sp == 'Disetujui'): ?>
                                    <a href="proses_persetujuan.php?aksi=tolak&jenis=masih_kuliah&id=<?php echo $id_s; ?>&return=03_persetujuan_surat_keterangan_masih_kuliah.php"
                                       class="btn btn-warning btn-xs"><i class="fa fa-undo"></i> Batalkan</a>
                                <?php elseif ($sp == 'Ditolak'): ?>
                                    <a href="proses_persetujuan.php?aksi=setujui&jenis=masih_kuliah&id=<?php echo $id_s; ?>&return=03_persetujuan_surat_keterangan_masih_kuliah.php"
                                       onclick="return confirm('Setujui surat ini?')"
                                       class="btn btn-success btn-xs"><i class="fa fa-check"></i> Setujui</a>
                                <?php endif; ?>
                            </td> -->
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>

                <div id="pagination_wadir_mk">
                <?php
                $jmldata     = mysqli_num_rows(mysqli_query($kon,"SELECT * FROM tb_surat_keterangan_masih_kuliah $where"));
                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                $linkHalaman = $p->navHalaman($_GET['halaman'] ?? 1, $jmlhalaman);
                echo "<div class='paginationw'>$linkHalaman</div>";
                ?>
                </div>

            </div>
        </div>
    </section>
</aside>

<script>
(function () {
    var timer = null, DELAY = 350, MIN_CHARS = 2;
    var elInput  = document.getElementById('keyword_wadir_mk');
    var elTbody  = document.getElementById('tbody_wadir_mk');
    var elPaging = document.getElementById('pagination_wadir_mk');
    var elInfo   = document.getElementById('info_wadir_mk');
    var elLoad   = document.getElementById('loading_wadir_mk');
    var elReset  = document.getElementById('btn_reset_wadir_mk');

    // Ambil nilai filter aktif dari URL (semua/Menunggu/Disetujui/Ditolak)
    var urlParams = new URLSearchParams(window.location.search);
    var filterAktif = urlParams.get('filter') || 'semua';

    function escHtml(s) {
        if (!s) return '';
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function renderStatus(r) {
        var sp = r.status_persetujuan, c = r.catatan_penolakan || '';
        if (sp === 'Menunggu') return "<span class='label label-warning'><i class='fa fa-clock-o'></i> Menunggu</span>";
        if (sp === 'Disetujui') return "<span class='label label-success'><i class='fa fa-check'></i> Disetujui</span>";
        if (sp === 'Ditolak') {
            var h = "<span class='label label-danger'><i class='fa fa-times'></i> Ditolak</span>";
            if (c) h += "<br><small class='text-danger'>" + escHtml(c) + "</small>";
            return h;
        }
        return '';
    }

    function renderAksi(r) {
        var id = r.id_surat_keterangan_masih_kuliah;
        return "<a href='03_preview_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah=" + id + "&return=03_persetujuan_surat_keterangan_masih_kuliah.php' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> Lihat</a>";
    }

    function doSearch(kw) {
        if (kw.length === 0) { reset(); return; }
        if (kw.length < MIN_CHARS) return;
        elLoad.style.display = 'inline';

        // Kirim filter aktif ke ajax agar hasil search ikut difilter
        var extra = (filterAktif && filterAktif !== 'semua') ? '&filter=' + encodeURIComponent(filterAktif) : '';

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../karyawan/ajax_search_surat.php?tabel=masih_kuliah&keyword=' + encodeURIComponent(kw) + extra, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) return;
            elLoad.style.display = 'none';
            if (xhr.status !== 200) {
                elTbody.innerHTML = "<tr><td colspan='7' class='text-center text-danger'>Gagal memuat data.</td></tr>";
                return;
            }
            var resp;
            try { resp = JSON.parse(xhr.responseText); } catch (e) {
                elTbody.innerHTML = "<tr><td colspan='7' class='text-center text-danger'>Response tidak valid.</td></tr>";
                return;
            }
            if (resp.error) {
                elTbody.innerHTML = "<tr><td colspan='7' class='text-center text-danger'>" + escHtml(resp.error) + "</td></tr>";
                return;
            }

            elPaging.style.display = 'none';
            var rows = resp.data;

            // Filter sisi client sesuai tab aktif (jika bukan semua)
            if (filterAktif && filterAktif !== 'semua') {
                rows = rows.filter(function(r){ return r.status_persetujuan === filterAktif; });
            }

            if (rows.length === 0) {
                elTbody.innerHTML = "<tr><td colspan='7' class='text-center'>Data tidak ditemukan.</td></tr>";
                elInfo.textContent = '0 hasil';
                return;
            }
            var html = '';
            for (var i = 0; i < rows.length; i++) {
                var r = rows[i];
                html += "<tr>" +
                    "<td>" + (i + 1) + "</td>" +
                    "<td>" + escHtml(r.nama_mahasiswa) + "</td>" +
                    "<td>" + escHtml(r.nim_mahasiswa) + "</td>" +
                    "<td>" + escHtml(r.jurusan) + "</td>" +
                    "<td>" + escHtml(r.keperluan) + "</td>" +
                    "<td class='text-center'>" + renderStatus(r) + "</td>" +
                    "<td class='text-center'>" + renderAksi(r) + "</td>" +
                    "</tr>";
            }
            elTbody.innerHTML = html;
            elInfo.textContent = rows.length + ' hasil ditemukan';
        };
        xhr.send();
    }

    function reset() {
        elInfo.textContent = '';
        elPaging.style.display = '';
        window.location.href = window.location.pathname + (filterAktif && filterAktif !== 'semua' ? '?filter=' + filterAktif : '');
    }

    elInput.addEventListener('input', function () {
        clearTimeout(timer);
        var kw = this.value.trim();
        timer = setTimeout(function () { doSearch(kw); }, DELAY);
    });
    elReset.addEventListener('click', function () { elInput.value = ''; reset(); });
    elInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') { clearTimeout(timer); doSearch(this.value.trim()); }
    });
}());
</script>