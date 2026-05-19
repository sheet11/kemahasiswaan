<?php
include "01_nav.php";
include "../config/koneksi.php";
include "../config/class_paging.php";
error_reporting(0);
?>

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
                $query  = mysqli_query($kon, "SELECT * FROM tb_surat_pra_penelitian $where ORDER BY id_surat_pra_penelitian DESC LIMIT $posisi,$batas");
                $i = $posisi + 1;
                ?>

                <!-- ======== AJAX SEARCH (ditambahkan) ======== -->
                <div class="input-group" style="max-width:450px; margin-bottom:10px;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" id="keyword_pra" class="form-control" placeholder="Cari nama, NIM, prodi, judul..." autocomplete="off">
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="btn_reset_pra" type="button" title="Reset"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <small id="info_pra" class="text-muted"></small>
                <span id="loading_pra" style="display:none; color:#888; margin-left:8px;"><i class="fa fa-spinner fa-spin"></i></span>
                <!-- ======== /AJAX SEARCH ======== -->

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
                    <?php while ($a = mysqli_fetch_array($query)):
                        $sp = $a['status_persetujuan'];
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $a['nama_mahasiswa']; ?></td>
                            <td><?php echo $a['nim_mahasiswa']; ?></td>
                            <td><?php echo $a['jurusan']; ?></td>
                            <td><?php echo substr($a['judul_kti'], 0, 50) . (strlen($a['judul_kti']) > 50 ? '...' : ''); ?></td>
                            <td><?php echo $a['lokasi']; ?></td>
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
                                <a href="05_preview_surat_pra_penelitian.php?id_surat_pra_penelitian=<?php echo $a['id_surat_pra_penelitian']; ?>&return=05_persetujuan_surat_pra_penelitian.php"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>

                <div id="pagination_pra">
                <?php
                $jmldata     = mysqli_num_rows(mysqli_query($kon,"SELECT * FROM tb_surat_pra_penelitian $where"));
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
    var elInput  = document.getElementById('keyword_pra');
    var elTbody  = document.getElementById('tbody_pra');
    var elPaging = document.getElementById('pagination_pra');
    var elInfo   = document.getElementById('info_pra');
    var elLoad   = document.getElementById('loading_pra');
    var elReset  = document.getElementById('btn_reset_pra');

    // Ambil filter tab aktif dari URL
    var urlParams    = new URLSearchParams(window.location.search);
    var filterAktif  = urlParams.get('filter') || 'semua';

    function escHtml(s) {
        if (!s) return '';
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function renderStatus(r) {
        var sp = r.status_persetujuan, c = r.catatan_penolakan || '';
        if (sp === 'Menunggu')  return "<span class='label label-warning'><i class='fa fa-clock-o'></i> Menunggu</span>";
        if (sp === 'Disetujui') return "<span class='label label-success'><i class='fa fa-check'></i> Disetujui</span>";
        if (sp === 'Ditolak') {
            var h = "<span class='label label-danger'><i class='fa fa-times'></i> Ditolak</span>";
            if (c) h += "<br><small class='text-danger'>" + escHtml(c) + "</small>";
            return h;
        }
        return '';
    }

    function renderAksi(r) {
        var id = r.id_surat_pra_penelitian;
        return "<a href='05_preview_surat_pra_penelitian.php?id_surat_pra_penelitian=" + id + "&return=05_persetujuan_surat_pra_penelitian.php' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> Lihat</a>";
    }

    function renderJudul(judul) {
        if (!judul) return '';
        var j = escHtml(judul);
        return j.length > 50 ? j.substring(0, 50) + '...' : j;
    }

    function doSearch(kw) {
        if (kw.length === 0) { reset(); return; }
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
            var rows = resp.data;

            // Filter sisi client sesuai tab aktif
            if (filterAktif && filterAktif !== 'semua') {
                rows = rows.filter(function (r) { return r.status_persetujuan === filterAktif; });
            }

            if (rows.length === 0) {
                elTbody.innerHTML = "<tr><td colspan='8' class='text-center'>Data tidak ditemukan.</td></tr>";
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
                    "<td>" + renderJudul(r.judul_kti) + "</td>" +
                    "<td>" + escHtml(r.lokasi) + "</td>" +
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