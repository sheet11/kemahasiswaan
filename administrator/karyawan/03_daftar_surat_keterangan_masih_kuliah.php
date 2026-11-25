<?php 
    include"01_nav.php";
    error_reporting(0);
?>
<aside class="right-side">
    <style>
        html.mk-page-scroll-locked, body.mk-page-scroll-locked { overflow-y:hidden !important; }
        .mk-table-scroll { height:calc(100vh - 270px); min-height:260px; overflow-x:hidden; overflow-y:auto; overscroll-behavior:contain; overflow-anchor:none; border:1px solid #ddd; background:#fff; }
        .mk-table-scroll .table { width:100%; min-width:0; margin-bottom:0; table-layout:fixed; border-collapse:separate; border-spacing:0; }
        .mk-table-scroll th:first-child, .mk-table-scroll td:first-child { width:4%; text-align:center; }
        .mk-table-scroll thead th { position:sticky; top:0; z-index:5; background:#d9edf7 !important; background-clip:padding-box; box-shadow:0 1px 0 #c8dce7; }
        .mk-table-scroll tbody td { vertical-align:middle !important; }
        .mk-table-scroll tbody tr:hover { background-color:#f5faff; }
        .mk-table-scroll th,.mk-table-scroll td { white-space:normal !important; overflow-wrap:anywhere; }
        .mk-table-scroll th:nth-child(1),.mk-table-scroll td:nth-child(1) { width:55px; }
        .mk-table-scroll th:nth-child(2),.mk-table-scroll td:nth-child(2) { width:220px; }
        .mk-table-scroll th:nth-child(3),.mk-table-scroll td:nth-child(3) { width:160px; }
        .mk-table-scroll th:nth-child(4),.mk-table-scroll td:nth-child(4) { width:190px; }
        .mk-table-scroll th:nth-child(5),.mk-table-scroll td:nth-child(5) { width:85px; }
        .mk-table-scroll th:nth-child(6),.mk-table-scroll td:nth-child(6) { width:150px; }
        .mk-table-scroll th:nth-child(7),.mk-table-scroll td:nth-child(7) { width:190px; }
        .mk-table-scroll th:nth-child(8),.mk-table-scroll td:nth-child(8) { width:210px; }
        .mk-table-scroll td { overflow:hidden; text-overflow:ellipsis; }
        .mk-table-scroll th:nth-child(2),.mk-table-scroll td:nth-child(2) { width:17%; }
        .mk-table-scroll th:nth-child(3),.mk-table-scroll td:nth-child(3) { width:12%; }
        .mk-table-scroll th:nth-child(4),.mk-table-scroll td:nth-child(4) { width:18%; }
        .mk-table-scroll th:nth-child(5),.mk-table-scroll td:nth-child(5) { width:7%; }
        .mk-table-scroll th:nth-child(6),.mk-table-scroll td:nth-child(6) { width:14%; }
        .mk-table-scroll th:nth-child(7),.mk-table-scroll td:nth-child(7) { width:13%; }
        .mk-table-scroll th:nth-child(8),.mk-table-scroll td:nth-child(8) { width:15%; }
        .mk-table-scroll td:nth-child(7) .label { display:inline-block; max-width:100%; white-space:normal !important; line-height:1.3; }
        .mk-table-scroll td:last-child .btn { margin:1px 2px 1px 0; }
        .mk-scroll-status { padding:10px; text-align:center; color:#777; background:#f9f9f9; }
        @media(max-width:767px) { .mk-table-scroll { height:calc(100vh - 330px); min-height:220px; } }
    </style>
    <section class="content-header">
        <div class="container-fluid" style="margin:10px;">

            <?php
                require_once("../config/koneksi.php");
                $filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';

                switch ($filter) {
                    case 'Menunggu':              $where_filter = "WHERE status_persetujuan='Menunggu'"; break;
                    case 'Perlu_Revisi':          $where_filter = "WHERE status_persetujuan='Perlu_Revisi'"; break;
                    case 'Telah_Direvisi':        $where_filter = "WHERE status_persetujuan='Telah_Direvisi'"; break;
                    case 'Disetujui_Resepsionis': $where_filter = "WHERE status_persetujuan='Disetujui_Resepsionis'"; break;
                    case 'Disetujui':             $where_filter = "WHERE status_persetujuan='Disetujui'"; break;
                    default:                      $where_filter = ''; break;
                }

                $cnt_semua    = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_keterangan_masih_kuliah FROM tb_surat_keterangan_masih_kuliah"));
                $cnt_tunggu   = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_keterangan_masih_kuliah FROM tb_surat_keterangan_masih_kuliah WHERE status_persetujuan='Menunggu'"));
                $cnt_revisi   = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_keterangan_masih_kuliah FROM tb_surat_keterangan_masih_kuliah WHERE status_persetujuan='Perlu_Revisi'"));
                $cnt_direvisi = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_keterangan_masih_kuliah FROM tb_surat_keterangan_masih_kuliah WHERE status_persetujuan='Telah_Direvisi'"));
                $cnt_wadir    = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_keterangan_masih_kuliah FROM tb_surat_keterangan_masih_kuliah WHERE status_persetujuan='Disetujui_Resepsionis'"));
                $cnt_cetak    = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_keterangan_masih_kuliah FROM tb_surat_keterangan_masih_kuliah WHERE status_persetujuan='Disetujui'"));
                $batas        = 50;
                $total_rows   = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_masih_kuliah FROM tb_surat_keterangan_masih_kuliah $where_filter"));

                function isActive($f, $current) {
                    return $f === $current ? 'style="box-shadow:0 0 0 3px rgba(0,0,0,0.25); opacity:1;"' : 'style="opacity:0.7;"';
                }
            ?>

            <table style="width:100%;">
                <tr class="info">
                    <td align="left" colspan="6"><b><h4>Surat Keterangan Masih Kuliah</h4></b></td>
                </tr>
                <tr>
                    <td colspan="12">
                        <a href="03_tambah_surat_keterangan_masih_kuliah.php" class="btn btn-primary">Tambah data +</a>

                        <a href="?filter=semua" class="btn btn-info" <?php echo isActive('semua',$filter); ?>>
                            <i class="fa fa-list fa-sm"></i> Semua : <?php echo $cnt_semua; ?>
                        </a>
                        <a href="?filter=Menunggu" class="btn btn-warning" <?php echo isActive('Menunggu',$filter); ?>>
                            <i class="fa fa-clock-o fa-sm"></i> Menunggu Review : <?php echo $cnt_tunggu; ?>
                        </a>
                        <a href="?filter=Perlu_Revisi" class="btn btn-danger" <?php echo isActive('Perlu_Revisi',$filter); ?>>
                            <i class="fa fa-edit fa-sm"></i> Perlu Revisi : <?php echo $cnt_revisi; ?>
                        </a>
                        <a href="?filter=Telah_Direvisi" class="btn btn-info" <?php echo isActive('Telah_Direvisi',$filter); ?>>
                            <i class="fa fa-refresh fa-sm"></i> Telah Direvisi : <?php echo $cnt_direvisi; ?>
                        </a>
                        <!-- BARU: filter surat yang sedang diproses wadir -->
                        <a href="?filter=Disetujui_Resepsionis" class="btn btn-default" <?php echo isActive('Disetujui_Resepsionis',$filter); ?>>
                            <i class="fa fa-arrow-up fa-sm"></i> Diproses Wadir : <?php echo $cnt_wadir; ?>
                        </a>
                        <a href="?filter=Disetujui" class="btn btn-success" <?php echo isActive('Disetujui',$filter); ?>>
                            <i class="fa fa-print fa-sm"></i> Siap Cetak : <?php echo $cnt_cetak; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="input-group" style="max-width:450px; margin-top:8px;">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" id="keyword_mk" class="form-control"
                                   placeholder="Cari nama, NIM, jurusan..." autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="btn_reset_mk" type="button" title="Reset">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                        </div>
                        <small id="info_mk" class="text-muted"></small>
                        <span id="loading_mk" style="display:none; color:#888; margin-left:8px;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            </table>

            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'disetujui'): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-check"></i> Surat berhasil diteruskan ke Wakil Direktur.
                    </div>
                <?php elseif ($_GET['pesan'] == 'perlu_revisi' || $_GET['pesan'] == 'ditolak'): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-edit"></i> Surat dikembalikan ke mahasiswa untuk direvisi.
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="mk-table-scroll" id="mk_table_scroll" tabindex="0" aria-label="Daftar surat; gulir tabel untuk memuat data berikutnya">
            <table style="width:100%;" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="info">
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Tingkat</th>
                        <th>Tahun Akademik</th>
                        <th>Status</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody_mk" data-loaded="<?php echo min($batas, $total_rows); ?>" data-total="<?php echo (int)$total_rows; ?>">
                <?php 
                    function kolomStatus($a) {
                        $sp     = $a['status_persetujuan'];
                        $st     = $a['status'];
                        $catKar = !empty($a['catatan_penolakan']) ? htmlspecialchars($a['catatan_penolakan']) : '';
                        switch ($sp) {
                            case 'Menunggu':
                                return "<span class='label label-warning' style='font-size:12px;'><i class='fa fa-clock-o'></i> Menunggu Review</span>";
                            case 'Perlu_Revisi':
                                $h = "<span class='label label-warning' style='font-size:12px;background:#e67e22;'><i class='fa fa-edit'></i> Perlu Revisi</span>";
                                if ($catKar) $h .= "<br><small style='color:#d68910;'><i class='fa fa-comment-o'></i> <i>$catKar</i></small>";
                                return $h;
                            case 'Telah_Direvisi':
                                return "<span class='label label-info' style='font-size:12px;'><i class='fa fa-refresh'></i> Telah Direvisi</span><br><small class='text-info'>Siap direview ulang</small>";
                            case 'Disetujui_Resepsionis':
                                return "<span class='label label-default' style='font-size:12px;background:#8e44ad;color:#fff;'><i class='fa fa-arrow-up'></i> Diproses Wadir</span>";
                            case 'Disetujui':
                                if ($st == 'Sudah Dicetak') return "<span class='label label-primary' style='font-size:12px;'><i class='fa fa-print'></i> Sudah Dicetak</span>";
                                return "<span class='label label-success' style='font-size:12px;'><i class='fa fa-check-circle'></i> Disetujui Wadir</span><br><small class='text-success'>Siap cetak</small>";
                            default:
                                return "<span class='label label-default' style='font-size:12px;'>$sp</span>";
                        }
                    }

                    function kolomAksi($a, $id, $hal = '') {
                        $param   = $hal ? "&halaman=$hal" : '';
                        $sp      = $a['status_persetujuan'];
                        $hal_ini = '03_daftar_surat_keterangan_masih_kuliah.php';
                        $html    = '';

                        // Cetak — hanya jika wadir sudah setujui
                        if ($sp == 'Disetujui')
                            $html .= "<a href='03_cetak_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah=$id$param' class='btn btn-info btn-xs' title='Cetak Surat'><span class='glyphicon glyphicon-print'></span></a> ";

                        // Setujui & Tolak — jika masih bisa diproses karyawan
                        if ($sp == 'Menunggu' || $sp == 'Telah_Direvisi') {
                            $lbl = ($sp == 'Telah_Direvisi') ? 'Setujui Revisi ke Wadir' : 'Setujui & Teruskan ke Wadir';
                            $html .= "<a href='proses_karyawan.php?aksi=setujui&jenis=masih_kuliah&id=$id&return=$hal_ini' onclick=\"return confirm('$lbl?')\" class='btn btn-success btn-xs' title='$lbl'><i class='fa fa-check'></i></a> ";
                            $html .= "<a href='proses_karyawan.php?aksi=tolak&jenis=masih_kuliah&id=$id&return=$hal_ini' class='btn btn-warning btn-xs' title='Kembalikan ke Mahasiswa'><i class='fa fa-undo'></i></a> ";
                        }

                        // Preview selalu tampil
                        $html .= "<a href='03_preview_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah=$id&return=$hal_ini' class='btn btn-primary btn-xs' title='Preview'><i class='fa fa-eye'></i></a> ";
                        $html .= "<a href='03_edit_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah=$id$param' class='btn btn-default btn-xs' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a> ";
                        $html .= "<a href='03_delete_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah=$id$param' onclick='return confirm(\"Hapus surat {$a['nama_mahasiswa']}?\")' class='btn btn-danger btn-xs' title='Hapus'><span class='glyphicon glyphicon-remove'></span></a>";
                        return $html;
                    }

                    $posisi = 0;
                    $order  = "ORDER BY
                        FIELD(status_persetujuan,
                            'Telah_Direvisi','Menunggu','Perlu_Revisi',
                            'Disetujui_Resepsionis','Disetujui'
                        ),
                        COALESCE(tanggal_pengajuan, '1970-01-01') DESC,
                        id_surat_keterangan_masih_kuliah DESC";

                    $query = mysqli_query($kon,
                        "SELECT * FROM tb_surat_keterangan_masih_kuliah
                         $where_filter $order
                         LIMIT $posisi,$batas");
                    $i = $posisi + 1;
                    $initial_rows = mysqli_num_rows($query);

                    while ($a = mysqli_fetch_array($query)) {
                        $id  = $a['id_surat_keterangan_masih_kuliah'];
                        $hal = $_GET['halaman'] ?? '';
                        echo "<tr>
                                <td>$i</td>
                                <td>{$a['nama_mahasiswa']}</td>
                                <td>{$a['nim_mahasiswa']}</td>
                                <td>{$a['jurusan']}</td>
                                <td>{$a['tingkat']}</td>
                                <td>{$a['tahun_akademik']}</td>
                                <td>" . kolomStatus($a) . "</td>
                                <td>" . kolomAksi($a, $id, $hal) . "</td>
                              </tr>";
                        $i++;
                    }
                    if ($initial_rows === 0) {
                        echo "<tr><td colspan='8' class='text-center text-muted'>Tidak ada surat pada filter ini.</td></tr>";
                    }
                ?>
                </tbody>
            </table>
            <div id="mk_scroll_sentinel" style="height:1px;"></div>
            </div>
            <div id="mk_scroll_status" class="mk-scroll-status" role="status" aria-live="polite">
                <?php if ($total_rows > 0): ?>Menampilkan <?php echo min($batas, $total_rows); ?> dari <?php echo (int)$total_rows; ?> surat. Gulir tabel ke bawah untuk memuat data berikutnya.<?php else: ?>Belum ada surat pada filter ini.<?php endif; ?>
            </div>

        </div>
    </section>
</aside>

<script>
(function () {
    var timer = null, delay = 350, batchSize = 50;
    document.documentElement.classList.add('mk-page-scroll-locked');
    document.body.classList.add('mk-page-scroll-locked');
    var input = document.getElementById('keyword_mk');
    var tbody = document.getElementById('tbody_mk');
    var tableScroll = document.getElementById('mk_table_scroll');
    var sentinel = document.getElementById('mk_scroll_sentinel');
    var scrollStatus = document.getElementById('mk_scroll_status');
    var info = document.getElementById('info_mk');
    var loading = document.getElementById('loading_mk');
    var resetButton = document.getElementById('btn_reset_mk');
    var filter = new URLSearchParams(window.location.search).get('filter') || 'semua';
    var offset = parseInt(tbody.getAttribute('data-loaded'), 10) || 0;
    var total = parseInt(tbody.getAttribute('data-total'), 10) || 0;
    var hasMore = offset < total, isLoading = false, keyword = '', activeRequest = null, requestId = 0;

    function escHtml(value) {
        return String(value || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');
    }
    function renderStatus(r) {
        var sp=r.status_persetujuan, st=r.status, cat=r.catatan_penolakan||'';
        switch(sp) {
            case 'Menunggu': return "<span class='label label-warning'><i class='fa fa-clock-o'></i> Menunggu Review</span>";
            case 'Perlu_Revisi': var h="<span class='label label-warning' style='background:#e67e22;'><i class='fa fa-edit'></i> Perlu Revisi</span>"; if(cat) h+="<br><small class='text-warning'>"+escHtml(cat)+"</small>"; return h;
            case 'Telah_Direvisi': return "<span class='label label-info'><i class='fa fa-refresh'></i> Telah Direvisi</span>";
            case 'Disetujui_Resepsionis': return "<span class='label label-default' style='background:#8e44ad;color:#fff;'><i class='fa fa-arrow-up'></i> Diproses Wadir</span>";
            case 'Disetujui': if(st==='Sudah Dicetak') return "<span class='label label-primary'><i class='fa fa-print'></i> Sudah Dicetak</span>"; return "<span class='label label-success'><i class='fa fa-check-circle'></i> Disetujui Wadir</span>";
            default: return "<span class='label label-default'>"+escHtml(sp)+"</span>";
        }
    }
    function renderActions(r) {
        var id=parseInt(r.id_surat_keterangan_masih_kuliah,10)||0, nama=escHtml(r.nama_mahasiswa), sp=r.status_persetujuan, html='';
        var base='03_daftar_surat_keterangan_masih_kuliah.php';
        if(sp==='Disetujui') html+="<a href='03_cetak_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah="+id+"' class='btn btn-info btn-xs' title='Cetak Surat'><span class='glyphicon glyphicon-print'></span></a> ";
        if(sp==='Menunggu'||sp==='Telah_Direvisi') {
            var label=sp==='Telah_Direvisi'?'Setujui Revisi ke Wadir':'Setujui & Teruskan ke Wadir';
            html+="<a href='proses_karyawan.php?aksi=setujui&jenis=masih_kuliah&id="+id+"&return="+base+"' onclick=\"return confirm('"+label+"?')\" class='btn btn-success btn-xs' title='"+label+"'><i class='fa fa-check'></i></a> ";
            html+="<a href='proses_karyawan.php?aksi=tolak&jenis=masih_kuliah&id="+id+"&return="+base+"' class='btn btn-warning btn-xs' title='Kembalikan ke Mahasiswa'><i class='fa fa-undo'></i></a> ";
        }
        html+="<a href='03_preview_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah="+id+"&return="+base+"' class='btn btn-primary btn-xs' title='Preview'><i class='fa fa-eye'></i></a> ";
        html+="<a href='03_edit_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah="+id+"' class='btn btn-default btn-xs' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a> ";
        html+="<a href='03_delete_surat_keterangan_masih_kuliah.php?id_surat_keterangan_masih_kuliah="+id+"' onclick=\"return confirm('Hapus "+nama+"?')\" class='btn btn-danger btn-xs' title='Hapus'><span class='glyphicon glyphicon-remove'></span></a>";
        return html;
    }
    function renderRow(r, number) {
        return "<tr><td>"+number+"</td><td title='"+escHtml(r.nama_mahasiswa)+"'>"+escHtml(r.nama_mahasiswa)+"</td><td title='"+escHtml(r.nim_mahasiswa)+"'>"+escHtml(r.nim_mahasiswa)+"</td><td title='"+escHtml(r.jurusan)+"'>"+escHtml(r.jurusan)+"</td><td>"+escHtml(r.tingkat)+"</td><td>"+escHtml(r.tahun_akademik)+"</td><td>"+renderStatus(r)+"</td><td class='text-nowrap'>"+renderActions(r)+"</td></tr>";
    }
    function updateStatus() {
        if (isLoading) scrollStatus.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Memuat data berikutnya...";
        else if (total === 0) scrollStatus.textContent = keyword ? 'Tidak ada surat yang sesuai.' : 'Belum ada surat pada filter ini.';
        else if (!hasMore) scrollStatus.textContent = 'Semua ' + total + ' data sudah ditampilkan.';
        else scrollStatus.textContent = 'Menampilkan ' + offset + ' dari ' + total + ' surat. Gulir ke bawah untuk memuat berikutnya.';
    }
    function maybeLoadMore() {
        if (isLoading || !hasMore) return;
        var box = tableScroll.getBoundingClientRect();
        var mark = sentinel.getBoundingClientRect();
        if (mark.top <= box.bottom + 700) loadBatch(false);
    }
    function loadBatch(reset) {
        if (isLoading && !reset) return;
        if (reset) {
            if (activeRequest) activeRequest.abort();
            requestId++;
            offset = 0; total = 0; hasMore = true;
            tbody.innerHTML = '';
            info.textContent = '';
        }
        isLoading = true;
        loading.style.display = 'inline';
        updateStatus();
        var thisRequest = ++requestId;
        var xhr = new XMLHttpRequest();
        activeRequest = xhr;
        var url = 'ajax_load_masih_kuliah.php?filter=' + encodeURIComponent(filter) + '&offset=' + offset + '&limit=' + batchSize + '&keyword=' + encodeURIComponent(keyword);
        xhr.open('GET', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4 || thisRequest !== requestId) return;
            isLoading = false; activeRequest = null; loading.style.display = 'none';
            var response;
            try { response = JSON.parse(xhr.responseText); } catch (e) { response = null; }
            if (xhr.status !== 200 || !response || response.error) {
                if (reset) tbody.innerHTML = "<tr><td colspan='8' class='text-center text-danger'>" + escHtml(response && response.error ? response.error : 'Gagal memuat data. Silakan coba lagi.') + "</td></tr>";
                scrollStatus.textContent = 'Gagal memuat data. Gulir kembali untuk mencoba lagi.';
                return;
            }
            var rows = response.data || [], html = '';
            for (var i=0; i<rows.length; i++) html += renderRow(rows[i], offset + i + 1);
            if (reset && rows.length === 0) html = "<tr><td colspan='8' class='text-center text-muted'>Data tidak ditemukan.</td></tr>";
            tbody.insertAdjacentHTML('beforeend', html);
            offset += rows.length; total = parseInt(response.total, 10) || 0; hasMore = !!response.has_more;
            if (keyword) info.textContent = offset + ' dari ' + total + ' hasil pencarian dimuat';
            updateStatus();
            if (hasMore) window.requestAnimationFrame(maybeLoadMore);
        };
        xhr.send();
    }

    tableScroll.addEventListener('scroll', maybeLoadMore, { passive:true });
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            if (entries[0].isIntersecting) loadBatch(false);
        }, { root: tableScroll, rootMargin: '0px 0px 700px 0px' });
        observer.observe(sentinel);
    }
    updateStatus();
    window.requestAnimationFrame(maybeLoadMore);
    input.addEventListener('input', function () {
        clearTimeout(timer); keyword = this.value.trim();
        timer = setTimeout(function () {
            if (keyword.length > 0 && keyword.length < 2) { info.textContent = 'Masukkan minimal 2 karakter untuk mencari.'; return; }
            loadBatch(true);
        }, delay);
    });
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') { clearTimeout(timer); keyword = this.value.trim(); if (keyword.length === 0 || keyword.length >= 2) loadBatch(true); }
    });
    resetButton.addEventListener('click', function () { input.value = ''; keyword = ''; loadBatch(true); });
}());
</script>
