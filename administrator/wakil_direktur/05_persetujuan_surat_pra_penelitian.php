<?php
include "01_nav.php";
include "../config/koneksi.php";
include "../config/class_paging.php";
error_reporting(0);
?>

<style>
    /* ===== Responsive styling tambahan (tidak mengubah logika PHP/JS) ===== */
    .content-header h1 small {
        font-size: 14px;
    }

    .nav-tabs-custom .nav-tabs > li > a {
        font-weight: 500;
    }

    .search-bar-wrap {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 12px;
    }

    .search-bar-wrap .input-group {
        margin-bottom: 0;
        width: 100%;
        max-width: 450px;
    }

    .bulk-action-bar {
        display: flex; align-items: center; flex-wrap: wrap;
        gap: 10px; margin-bottom: 10px;
        padding: 10px 14px;
        background: #f0f7ff;
        border: 1px solid #c2d9f0;
        border-radius: 4px;
    }
    .bulk-action-bar .bulk-info {
        flex: 1; font-size: 13px; color: #31708f; font-weight: 500;
    }
    table.table.table-striped > tbody > tr.row-checked > td,
    table.table.table-striped > tbody > tr.row-checked.row-checked > td {
        background-color: #ffe066 !important;
    }
    tr.row-menunggu { cursor: pointer; }
    tr.row-menunggu td:first-child { color: #337ab7; }

    .table-responsive-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-responsive-wrap table {
        margin-bottom: 0;
    }

    .table-responsive-wrap th,
    .table-responsive-wrap td {
        white-space: nowrap;
        vertical-align: middle !important;
    }

    .table-responsive-wrap td.col-judul,
    .table-responsive-wrap td.col-nama,
    .table-responsive-wrap td.col-lokasi {
        white-space: normal;
        min-width: 140px;
    }

    .status-note {
        white-space: normal !important;
        display: block;
        max-width: 180px;
    }

    .btn-aksi {
        white-space: nowrap;
    }

    .paginationw {
        margin-top: 15px;
        text-align: center;
    }

    .paginationw ul.pagination {
        margin: 0;
        flex-wrap: wrap;
    }

    /* ===== Tampilan khusus HP ===== */
    @media (max-width: 767px) {
        .content-header h1 {
            font-size: 20px;
        }

        .nav-tabs-custom .nav-tabs {
            display: flex;
            flex-wrap: wrap;
        }

        .nav-tabs-custom .nav-tabs > li {
            float: none;
        }

        .nav-tabs-custom .nav-tabs > li > a {
            padding: 8px 10px;
            font-size: 12px;
        }

        .table-responsive-wrap th,
        .table-responsive-wrap td {
            font-size: 12px;
            padding: 6px 8px;
        }

        .btn-aksi {
            font-size: 11px;
            padding: 5px 8px;
        }

        .label {
            font-size: 10px;
        }

        .search-bar-wrap .input-group {
            max-width: 100%;
        }

        .bulk-action-bar { flex-direction: column; align-items: flex-start; }
    }
</style>

<aside class="right-side">
    <section class="content-header">
        <h1>Persetujuan <small>Surat Pra Penelitian</small></h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Surat Pra Penelitian</li>
        </ol>
    </section>

    <section class="content">

        <?php if (isset($_GET['pesan'])): ?>
            <?php if ($_GET['pesan'] == 'disetujui'): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-check"></i> <strong>Berhasil!</strong> Surat telah <strong>disetujui</strong>. Resepsionis sudah dapat mencetak surat ini.
                </div>
            <?php elseif ($_GET['pesan'] == 'disetujui_massal'): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-check-circle"></i> <strong>Berhasil!</strong>
                    <strong><?php echo (int)$_GET['jml']; ?> surat</strong> telah disetujui sekaligus.
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
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Disetujui_Resepsionis') ? 'class="active"' : ''; ?>>
                    <a href="?filter=Disetujui_Resepsionis"><span class="label label-warning">Menunggu Persetujuan Saya</span></a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Disetujui') ? 'class="active"' : ''; ?>>
                    <a href="?filter=Disetujui"><span class="label label-success">Disetujui</span></a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Ditolak_Wadir') ? 'class="active"' : ''; ?>>
                    <a href="?filter=Ditolak_Wadir"><span class="label label-danger">Ditolak</span></a>
                </li>
            </ul>
            <div class="tab-content">

                <?php
                $filter = isset($_GET['filter']) && $_GET['filter'] != 'semua' ? $_GET['filter'] : '';
                if ($filter) {
                    $where = "WHERE status_persetujuan='$filter'";
                } else {
                    $where = "WHERE status_persetujuan IN ('Disetujui_Resepsionis','Disetujui','Ditolak_Wadir')";
                }
                $p      = new Paging;
                $batas  = 15;
                $posisi = $p->cariPosisi($batas);
                $query  = mysqli_query($kon, "SELECT * FROM tb_surat_pra_penelitian $where ORDER BY id_surat_pra_penelitian DESC LIMIT $posisi,$batas");
                $i      = $posisi + 1;

                $rows_temp    = [];
                $ada_menunggu = false;
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $rows_temp[] = $row;
                    if ($row['status_persetujuan'] == 'Disetujui_Resepsionis') {
                        $ada_menunggu = true;
                    }
                }
                ?>

                <?php if ($ada_menunggu): ?>
                <div class="bulk-action-bar" id="bulkBar">
                    <span class="bulk-info" id="bulkInfo">
                        <i class="fa fa-info-circle"></i>
                        Klik baris surat yang ingin disetujui, lalu klik tombol <strong>Setujui Terpilih</strong>.
                    </span>
                    <button type="button" class="btn btn-success btn-sm" id="btnBulkSetujui" style="display:none;">
                        <i class="fa fa-check-circle"></i> Setujui Terpilih
                        (<span id="badgeCount">0</span>)
                    </button>
                    <button type="button" class="btn btn-default btn-sm" id="btnPilihSemua">
                        <i class="fa fa-check-square-o"></i> Pilih Semua
                    </button>
                    <button type="button" class="btn btn-default btn-sm" id="btnBatalSemua" style="display:none;">
                        <i class="fa fa-square-o"></i> Batalkan Semua
                    </button>
                </div>
                <?php endif; ?>

                <div class="search-bar-wrap">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" id="keyword_pra" class="form-control"
                               placeholder="Cari nama, NIM, jurusan, judul..." autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="btn_reset_pra" type="button" title="Reset">
                                <i class="fa fa-times"></i>
                            </button>
                        </span>
                    </div>
                    <small id="info_pra" class="text-muted"></small>
                    <span id="loading_pra" style="display:none; color:#888;">
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </div>

                <div class="table-responsive-wrap">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="info">
                                <th>No.</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Jurusan</th>
                                <th>Judul KTI</th>
                                <th>Lokasi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="8%">Preview</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_pra">
                        <?php
                        $ada = false;
                        foreach ($rows_temp as $a):
                            $ada     = true;
                            $sp      = $a['status_persetujuan'];
                            $id      = $a['id_surat_pra_penelitian'];
                            $bisa_cb = ($sp == 'Disetujui_Resepsionis');
                        ?>
                            <tr id="row-<?php echo $id; ?>" <?php echo $bisa_cb ? 'class="row-menunggu" data-id="'.$id.'"' : ''; ?>>
                                <td><?php echo $i++; ?></td>
                                <td class="col-nama"><?php echo $a['nama_mahasiswa']; ?></td>
                                <td><?php echo $a['nim_mahasiswa']; ?></td>
                                <td><?php echo $a['jurusan']; ?></td>
                                <td class="col-judul"><?php echo substr($a['judul_kti'], 0, 50) . (strlen($a['judul_kti']) > 50 ? '...' : ''); ?></td>
                                <td class="col-lokasi"><?php echo $a['lokasi']; ?></td>
                                <td class="text-center">
                                    <?php if ($sp == 'Disetujui_Resepsionis'): ?>
                                        <span class="label label-warning"><i class="fa fa-clock-o"></i> Menunggu Persetujuan</span>
                                    <?php elseif ($sp == 'Disetujui'): ?>
                                        <span class="label label-success"><i class="fa fa-check"></i> Disetujui</span>
                                    <?php elseif ($sp == 'Ditolak_Wadir'): ?>
                                        <span class="label label-danger"><i class="fa fa-times"></i> Ditolak</span>
                                        <?php if (!empty($a['catatan_penolakan'])): ?>
                                            <span class="status-note text-danger"><?php echo $a['catatan_penolakan']; ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="05_preview_surat_pra_penelitian.php?id_surat_pra_penelitian=<?php echo $id; ?>&return=05_persetujuan_surat_pra_penelitian.php"
                                       class="btn btn-primary btn-xs btn-aksi">
                                        <i class="fa fa-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (!$ada): ?>
                            <tr><td colspan="8" class="text-center text-muted">Tidak ada data.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div id="pagination_pra">
                <?php
                $jmldata    = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM tb_surat_pra_penelitian $where"));
                $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
                echo "<div class='paginationw'>" . $p->navHalaman($_GET['halaman'] ?? 1, $jmlhalaman) . "</div>";
                ?>
                </div>

            </div>
        </div>
    </section>
</aside>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="modalBulkSetujui" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#00a65a;color:#fff;border-radius:4px 4px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4 class="modal-title"><i class="fa fa-check-circle"></i> Konfirmasi Persetujuan</h4>
            </div>
            <div class="modal-body text-center">
                <p style="font-size:15px;">Anda akan menyetujui<br>
                    <strong><span id="modalJml">0</span> surat</strong> sekaligus.
                </p>
                <p class="text-muted" style="font-size:12px;">
                    Surat yang dipilih akan langsung berstatus <strong>Disetujui</strong>
                    dan resepsionis dapat mencetak surat tersebut.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-success" id="btnKonfirmasiBulk">
                    <i class="fa fa-check"></i> Ya, Setujui Semua
                </button>
            </div>
        </div>
    </div>
</div>

<script>
/* updateUI dibuat global agar bisa dipanggil dari bagian lain jika perlu */
function applyRowColor(row) {
    var tds = row.querySelectorAll('td');
    if (row.classList.contains('row-checked')) {
        tds.forEach(function(td) { td.style.setProperty('background-color', '#ffe066', 'important'); });
    } else {
        tds.forEach(function(td) { td.style.removeProperty('background-color'); });
    }
}

function updateUI() {
    var semua   = document.querySelectorAll('tr.row-menunggu');
    var checked = document.querySelectorAll('tr.row-menunggu.row-checked');
    var jml     = checked.length;
    var total   = semua.length;

    var btnBulk  = document.getElementById('btnBulkSetujui');
    var badge    = document.getElementById('badgeCount');
    var bulkInfo = document.getElementById('bulkInfo');
    var btnPilih = document.getElementById('btnPilihSemua');
    var btnBatal = document.getElementById('btnBatalSemua');

    /* Terapkan warna kuning langsung via inline style agar pasti menang
       melawan CSS tema (table-striped, dsb). */
    semua.forEach(function(row) { applyRowColor(row); });

    /* Tombol Setujui Terpilih — muncul kalau minimal 1 dipilih */
    if (btnBulk) {
        if (jml > 0) {
            btnBulk.style.display = 'inline-block';
        } else {
            btnBulk.style.display = 'none';
        }
    }

    /* Badge jumlah di dalam tombol */
    if (badge) badge.textContent = jml;

    /* Teks info */
    if (bulkInfo) {
        if (jml === 0) {
            bulkInfo.innerHTML = '<i class="fa fa-info-circle"></i> Klik baris surat yang ingin disetujui, lalu klik tombol <strong>Setujui Terpilih</strong>.';
        } else {
            bulkInfo.innerHTML = '<i class="fa fa-check-square-o" style="color:#00a65a;"></i> <strong>' + jml + ' dari ' + total + '</strong> surat dipilih.';
        }
    }

    /* Tombol Pilih Semua / Batalkan Semua */
    if (btnPilih && btnBatal) {
        if (jml === total && total > 0) {
            btnPilih.style.display = 'none';
            btnBatal.style.display = 'inline-block';
        } else {
            btnPilih.style.display = 'inline-block';
            btnBatal.style.display = 'none';
        }
    }
}

(function () {
    /* Pilih Semua */
    var btnPilih = document.getElementById('btnPilihSemua');
    if (btnPilih) {
        btnPilih.addEventListener('click', function() {
            document.querySelectorAll('tr.row-menunggu').forEach(function(row) { row.classList.add('row-checked'); });
            updateUI();
        });
    }

    /* Batalkan Semua */
    var btnBatal = document.getElementById('btnBatalSemua');
    if (btnBatal) {
        btnBatal.addEventListener('click', function() {
            document.querySelectorAll('tr.row-menunggu').forEach(function(row) { row.classList.remove('row-checked'); });
            updateUI();
        });
    }

    /* Klik baris (selain tombol Lihat) men-toggle pilihan.
       Tidak ada checkbox; seleksi murni lewat class row-checked
       pada elemen <tr>, di-trigger oleh klik di mana saja pada baris. */
    var tbody = document.getElementById('tbody_pra');
    if (tbody) {
        tbody.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;

            var row = e.target.closest('tr.row-menunggu');
            if (!row) return;

            row.classList.toggle('row-checked');
            updateUI();
        });
    }

    /* Buka modal saat klik Setujui Terpilih */
    var btnBulk = document.getElementById('btnBulkSetujui');
    if (btnBulk) {
        btnBulk.addEventListener('click', function() {
            var jml = document.querySelectorAll('tr.row-menunggu.row-checked').length;
            if (jml === 0) return;
            document.getElementById('modalJml').textContent = jml;
            $('#modalBulkSetujui').modal('show');
        });
    }

    /* Konfirmasi → kirim AJAX */
    var btnKonfirmasi = document.getElementById('btnKonfirmasiBulk');
    if (btnKonfirmasi) {
        btnKonfirmasi.addEventListener('click', function() {
            var checked = document.querySelectorAll('tr.row-menunggu.row-checked');
            var ids = [];
            checked.forEach(function(row) { ids.push(row.getAttribute('data-id')); });
            if (ids.length === 0) return;

            btnKonfirmasi.disabled = true;
            btnKonfirmasi.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses...';

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'proses_bulk_setujui.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState !== 4) return;
                $('#modalBulkSetujui').modal('hide');
                var resp;
                try { resp = JSON.parse(xhr.responseText); } catch(e) { resp = {status:'error'}; }
                if (resp.status === 'ok') {
                    var filterNow = new URLSearchParams(window.location.search).get('filter') || 'semua';
                    window.location.href = window.location.pathname
                        + '?filter=' + filterNow
                        + '&pesan=disetujui_massal&jml=' + resp.jml;
                } else {
                    alert('Terjadi kesalahan: ' + (resp.pesan || 'Silakan coba lagi.'));
                    btnKonfirmasi.disabled = false;
                    btnKonfirmasi.innerHTML = '<i class="fa fa-check"></i> Ya, Setujui Semua';
                }
            };
            xhr.send('ids=' + encodeURIComponent(JSON.stringify(ids)) + '&jenis=pra_penelitian');
        });
    }
}());

/* ================================================================
   LIVE SEARCH
   ================================================================ */
(function () {
    var timer = null, DELAY = 350, MIN_CHARS = 2;
    var elInput  = document.getElementById('keyword_pra');
    var elTbody  = document.getElementById('tbody_pra');
    var elPaging = document.getElementById('pagination_pra');
    var elInfo   = document.getElementById('info_pra');
    var elLoad   = document.getElementById('loading_pra');
    var elReset  = document.getElementById('btn_reset_pra');
    var filterAktif  = new URLSearchParams(window.location.search).get('filter') || 'semua';
    var validStatus  = ['Disetujui_Resepsionis', 'Disetujui', 'Ditolak_Wadir'];

    function escHtml(s) {
        if (!s) return '';
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function renderJudul(j) {
        if (!j) return '';
        var e = escHtml(j);
        return e.length > 50 ? e.substring(0, 50) + '...' : e;
    }

    function renderStatus(r) {
        var sp = r.status_persetujuan, c = r.catatan_penolakan || '';
        if (sp === 'Disetujui_Resepsionis') return "<span class='label label-warning'><i class='fa fa-clock-o'></i> Menunggu Persetujuan</span>";
        if (sp === 'Disetujui')             return "<span class='label label-success'><i class='fa fa-check'></i> Disetujui</span>";
        if (sp === 'Ditolak_Wadir') {
            var h = "<span class='label label-danger'><i class='fa fa-times'></i> Ditolak</span>";
            if (c) h += "<span class='status-note text-danger'>" + escHtml(c) + "</span>";
            return h;
        }
        return '';
    }

    function renderAksi(r) {
        var id = r.id_surat_pra_penelitian;
        return "<a href='05_preview_surat_pra_penelitian.php?id_surat_pra_penelitian=" + id + "&return=05_persetujuan_surat_pra_penelitian.php' class='btn btn-primary btn-xs btn-aksi'><i class='fa fa-eye'></i> Lihat</a>";
    }

    function doSearch(kw) {
        if (kw.length === 0) { resetView(); return; }
        if (kw.length < MIN_CHARS) return;
        elLoad.style.display = 'inline';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../karyawan/ajax_search_surat.php?tabel=pra_penelitian&keyword=' + encodeURIComponent(kw), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) return;
            elLoad.style.display = 'none';
            if (xhr.status !== 200) {
                elTbody.innerHTML = "<tr><td colspan='8' class='text-center text-danger'>Gagal memuat data.</td></tr>";
                return;
            }
            var resp;
            try { resp = JSON.parse(xhr.responseText); } catch (e) {
                elTbody.innerHTML = "<tr><td colspan='8' class='text-center text-danger'>Response tidak valid.</td></tr>";
                return;
            }
            if (resp.error) {
                elTbody.innerHTML = "<tr><td colspan='8' class='text-center text-danger'>" + escHtml(resp.error) + "</td></tr>";
                return;
            }
            elPaging.style.display = 'none';

            // Filter sisi client: hanya tampilkan status relevan wadir
            var rows = resp.data.filter(function (r) {
                if (filterAktif && filterAktif !== 'semua') return r.status_persetujuan === filterAktif;
                return validStatus.indexOf(r.status_persetujuan) !== -1;
            });

            if (rows.length === 0) {
                elTbody.innerHTML = "<tr><td colspan='8' class='text-center'>Data tidak ditemukan.</td></tr>";
                elInfo.textContent = '0 hasil';
                return;
            }
            var html = '';
            for (var i = 0; i < rows.length; i++) {
                var r = rows[i];
                var isMenunggu = (r.status_persetujuan === 'Disetujui_Resepsionis');
                html += "<tr id='row-" + r.id_surat_pra_penelitian + "'" + (isMenunggu ? " class='row-menunggu' data-id='" + r.id_surat_pra_penelitian + "'" : "") + ">" +
                    "<td>" + (i + 1) + "</td>" +
                    "<td class='col-nama'>" + escHtml(r.nama_mahasiswa) + "</td>" +
                    "<td>" + escHtml(r.nim_mahasiswa) + "</td>" +
                    "<td>" + escHtml(r.jurusan) + "</td>" +
                    "<td class='col-judul'>" + renderJudul(r.judul_kti) + "</td>" +
                    "<td class='col-lokasi'>" + escHtml(r.lokasi) + "</td>" +
                    "<td class='text-center'>" + renderStatus(r) + "</td>" +
                    "<td class='text-center'>" + renderAksi(r) + "</td>" +
                    "</tr>";
            }
            elTbody.innerHTML = html;
            elInfo.textContent = rows.length + ' hasil ditemukan';
            updateUI();
        };
        xhr.send();
    }

    function resetView() {
        elInfo.textContent = '';
        elPaging.style.display = '';
        window.location.href = window.location.pathname + (filterAktif && filterAktif !== 'semua' ? '?filter=' + filterAktif : '');
    }

    elInput.addEventListener('input', function () {
        clearTimeout(timer); var kw = this.value.trim();
        timer = setTimeout(function () { doSearch(kw); }, DELAY);
    });
    elReset.addEventListener('click', function () { elInput.value = ''; resetView(); });
    elInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') { clearTimeout(timer); doSearch(this.value.trim()); }
    });
}());
</script>