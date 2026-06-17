<?php
    include "01_nav.php";
    error_reporting(0);
    include "../config/class_paging.php";
?>
<aside class="right-side">
    <section class="content-header">
        <div class="container-fluid" style="margin:10px;">

            <?php
                require_once("../config/koneksi.php");
                $filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';

                switch ($filter) {
                    case 'Belum Dicetak': $where_filter = "WHERE status='Belum Dicetak'"; break;
                    case 'Sudah Dicetak': $where_filter = "WHERE status='Sudah Dicetak'"; break;
                    default:              $where_filter = ''; break;
                }

                $cnt_semua  = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_lulus FROM tb_surat_keterangan_lulus"));
                $cnt_belum  = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_lulus FROM tb_surat_keterangan_lulus WHERE status='Belum Dicetak'"));
                $cnt_sudah  = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_lulus FROM tb_surat_keterangan_lulus WHERE status='Sudah Dicetak'"));

                function isActive($f, $current) {
                    return $f === $current ? 'style="box-shadow:0 0 0 3px rgba(0,0,0,0.25); opacity:1;"' : 'style="opacity:0.7;"';
                }
            ?>

            <table style="width:100%;">
                <tr class="info">
                    <td align="left" colspan="6"><b><h4>Surat Keterangan Lulus</h4></b></td>
                </tr>
                <tr>
                    <td colspan="12">
                        <a href="02_tambah_surat_keterangan_lulus.php" class="btn btn-primary">Tambah data +</a>

                        <a href="?filter=semua" class="btn btn-info" <?php echo isActive('semua', $filter); ?>>
                            <i class="fa fa-list fa-sm"></i> Semua : <?php echo $cnt_semua; ?>
                        </a>
                        <a href="?filter=Belum Dicetak" class="btn btn-warning" <?php echo isActive('Belum Dicetak', $filter); ?>>
                            <i class="fa fa-clock-o fa-sm"></i> Belum Dicetak : <?php echo $cnt_belum; ?>
                        </a>
                        <a href="?filter=Sudah Dicetak" class="btn btn-success" <?php echo isActive('Sudah Dicetak', $filter); ?>>
                            <i class="fa fa-print fa-sm"></i> Sudah Dicetak : <?php echo $cnt_sudah; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="input-group" style="max-width:450px; margin-top:8px;">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" id="keyword_lls" class="form-control"
                                   placeholder="Cari nama, NIM, jurusan..." autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="btn_reset_lls" type="button" title="Reset">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                        </div>
                        <small id="info_lls" class="text-muted"></small>
                        <span id="loading_lls" style="display:none; color:#888; margin-left:8px;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            </table>

            <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil'): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-check"></i> Data berhasil disimpan.
                </div>
            <?php endif; ?>

            <table style="width:100%;" class="table table-bordered">
                <thead>
                    <tr class="info">
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody_lls">
                <?php
                    function kolomStatus($a) {
                        if ($a['status'] == 'Sudah Dicetak')
                            return "<span class='label label-success' style='font-size:12px;'><i class='fa fa-print'></i> Sudah Dicetak</span>";
                        return "<span class='label label-warning' style='font-size:12px;'><i class='fa fa-clock-o'></i> Belum Dicetak</span>";
                    }

                    function kolomAksi($a, $id, $hal = '') {
                        $param = $hal ? "&halaman=$hal" : '';
                        $html  = '';
                        // Cetak selalu tersedia — tidak perlu persetujuan
                        $html .= "<a href='02_cetak_surat_keterangan_lulus.php?id_surat_keterangan_lulus=$id$param' class='btn btn-info btn-xs' title='Cetak Surat'><span class='glyphicon glyphicon-print'></span></a> ";
                        // Preview
                        $html .= "<a href='02_preview_surat_keterangan_lulus.php?id_surat_keterangan_lulus=$id&return=02_daftar_surat_keterangan_lulus.php' class='btn btn-primary btn-xs' title='Preview'><i class='fa fa-eye'></i></a> ";
                        $html .= "<a href='02_edit_surat_keterangan_lulus.php?id_surat_keterangan_lulus=$id$param' class='btn btn-default btn-xs' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a> ";
                        $html .= "<a href='02_delete_surat_keterangan_lulus.php?id_surat_keterangan_lulus=$id$param' onclick='return confirm(\"Hapus surat {$a['nama_mahasiswa']}?\")' class='btn btn-danger btn-xs' title='Hapus'><span class='glyphicon glyphicon-remove'></span></a>";
                        return $html;
                    }

                    $p      = new Paging;
                    $batas  = 10;
                    $posisi = $p->cariPosisi($batas);
                    $order  = "ORDER BY
                        FIELD(status, 'Belum Dicetak', 'Sudah Dicetak'),
                        id_surat_keterangan_lulus DESC";

                    $query = mysqli_query($kon,
                        "SELECT * FROM tb_surat_keterangan_lulus
                         $where_filter $order
                         LIMIT $posisi,$batas");
                    $i = $posisi + 1;

                    while ($a = mysqli_fetch_array($query)) {
                        $id  = $a['id_surat_keterangan_lulus'];
                        $hal = $_GET['halaman'] ?? '';
                        echo "<tr>
                                <td>$i</td>
                                <td>{$a['nama_mahasiswa']}</td>
                                <td>{$a['nim_mahasiswa']}</td>
                                <td>{$a['jurusan']}</td>
                                <td>{$a['tempat_lahir']}</td>
                                <td>{$a['tanggal_lahir']}</td>
                                <td>" . kolomStatus($a) . "</td>
                                <td>" . kolomAksi($a, $id, $hal) . "</td>
                              </tr>";
                        $i++;
                    }
                ?>
                </tbody>
            </table>

            <div id="pagination_lls">
            <?php
                $jmldata     = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_lulus FROM tb_surat_keterangan_lulus $where_filter"));
                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                $linkHalaman = $p->navHalaman($_GET['halaman'] ?? 1, $jmlhalaman);
                echo "<div class='paginationw'>$linkHalaman</div>";
            ?>
            </div>

        </div>
    </section>
</aside>

<script>
(function () {
    var timer = null, DELAY = 350, MIN_CHARS = 2;
    var elInput  = document.getElementById('keyword_lls');
    var elTbody  = document.getElementById('tbody_lls');
    var elPaging = document.getElementById('pagination_lls');
    var elInfo   = document.getElementById('info_lls');
    var elLoad   = document.getElementById('loading_lls');
    var elReset  = document.getElementById('btn_reset_lls');
    var urlParams = new URLSearchParams(window.location.search);
    var FILTER    = urlParams.get('filter') || 'semua';

    function escHtml(s) {
        if (!s) return '';
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function renderStatus(r) {
        if (r.status === 'Sudah Dicetak')
            return "<span class='label label-success' style='font-size:12px;'><i class='fa fa-print'></i> Sudah Dicetak</span>";
        return "<span class='label label-warning' style='font-size:12px;'><i class='fa fa-clock-o'></i> Belum Dicetak</span>";
    }

    function renderAksi(r) {
        var id   = r.id_surat_keterangan_lulus;
        var nama = escHtml(r.nama_mahasiswa);
        var html = '';
        html += "<a href='02_cetak_surat_keterangan_lulus.php?id_surat_keterangan_lulus="+id+"' class='btn btn-info btn-xs' title='Cetak'><span class='glyphicon glyphicon-print'></span></a> ";
        html += "<a href='02_preview_surat_keterangan_lulus.php?id_surat_keterangan_lulus="+id+"&return=02_daftar_surat_keterangan_lulus.php' class='btn btn-primary btn-xs' title='Preview'><i class='fa fa-eye'></i></a> ";
        html += "<a href='02_edit_surat_keterangan_lulus.php?id_surat_keterangan_lulus="+id+"' class='btn btn-default btn-xs' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a> ";
        html += "<a href='02_delete_surat_keterangan_lulus.php?id_surat_keterangan_lulus="+id+"' onclick=\"return confirm('Hapus "+nama+"?')\" class='btn btn-danger btn-xs' title='Hapus'><span class='glyphicon glyphicon-remove'></span></a>";
        return html;
    }

    function doSearch(kw) {
        if (kw.length === 0) { resetView(); return; }
        if (kw.length < MIN_CHARS) return;
        elLoad.style.display = 'inline';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'ajax_search_surat.php?tabel=keterangan_lulus&kolom=nama_mahasiswa&keyword=' + encodeURIComponent(kw) + '&filter=' + encodeURIComponent(FILTER), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) return;
            elLoad.style.display = 'none';
            var resp; try { resp = JSON.parse(xhr.responseText); } catch (e) { return; }
            elPaging.style.display = 'none';
            var rows = resp.data;
            if (!rows || rows.length === 0) {
                elTbody.innerHTML = "<tr><td colspan='8' class='text-center'>Data tidak ditemukan.</td></tr>";
                elInfo.textContent = '0 hasil'; return;
            }
            var html = '';
            for (var i = 0; i < rows.length; i++) {
                var r = rows[i];
                html += "<tr><td>" + (i+1) + "</td>" +
                        "<td>" + escHtml(r.nama_mahasiswa) + "</td>" +
                        "<td>" + escHtml(r.nim_mahasiswa) + "</td>" +
                        "<td>" + escHtml(r.jurusan) + "</td>" +
                        "<td>" + escHtml(r.tempat_lahir) + "</td>" +
                        "<td>" + escHtml(r.tanggal_lahir) + "</td>" +
                        "<td>" + renderStatus(r) + "</td>" +
                        "<td>" + renderAksi(r) + "</td></tr>";
            }
            elTbody.innerHTML = html;
            elInfo.textContent = resp.total + ' hasil ditemukan';
        };
        xhr.send();
    }

    function resetView() {
        elInfo.textContent = ''; elPaging.style.display = '';
        window.location.href = window.location.pathname + (FILTER !== 'semua' ? '?filter=' + encodeURIComponent(FILTER) : '');
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