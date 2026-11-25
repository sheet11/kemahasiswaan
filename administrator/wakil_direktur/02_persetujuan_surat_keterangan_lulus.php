<?php
include "01_nav.php";
include "../config/koneksi.php";
include "../config/class_paging.php";
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$jumlah_menunggu_bulk = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_lulus FROM tb_surat_keterangan_lulus WHERE status_persetujuan='Menunggu'"));
$jumlah_disetujui = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_lulus FROM tb_surat_keterangan_lulus WHERE status_persetujuan='Disetujui'"));
$jumlah_ditolak = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_lulus FROM tb_surat_keterangan_lulus WHERE status_persetujuan='Ditolak'"));
error_reporting(0);
?>

<aside class="right-side">
<style>
    .nav-tabs-custom .nav-tabs > li.bulk-approve-tab { float:right !important; padding:8px 10px 0; }
    .bulk-approve-tab form { margin:0; }
    .search-bar-wrap { display:flex; align-items:center; flex-wrap:wrap; gap:8px; margin:12px 0; }
    .search-bar-wrap .input-group { margin:0; width:100%; max-width:450px; }
    .table-responsive-wrap { width:100%; overflow-x:auto; -webkit-overflow-scrolling:touch; }
    .table-responsive-wrap table { min-width:760px; margin-bottom:0; }
    .table-responsive-wrap th,.table-responsive-wrap td { vertical-align:middle !important; }
    .table-responsive-wrap .action-buttons { display:flex; justify-content:center; flex-wrap:wrap; gap:5px; }
    .table-responsive-wrap .action-buttons form { margin:0; }
    .page-result-count { margin:10px 0; }
    @media(max-width:767px) {
        .content-header h1 { font-size:20px; }
        .nav-tabs-custom .nav-tabs { display:flex; flex-wrap:wrap; }
        .nav-tabs-custom .nav-tabs>li { float:none; }
        .nav-tabs-custom .nav-tabs>li.bulk-approve-tab { float:none !important; flex:1 0 100%; padding:6px 8px; }
        .nav-tabs-custom .nav-tabs>li.bulk-approve-tab button { width:100%; white-space:normal; }
        .search-bar-wrap .input-group { max-width:100%; }
    }
</style>
    <section class="content-header">
        <h1>Persetujuan <small>Surat Keterangan Lulus</small></h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Surat Keterangan Lulus</li>
        </ol>
    </section>

    <section class="content">

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'bulk_disetujui'): ?>
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-check"></i> <strong>Berhasil!</strong> <?php echo (int)($_GET['jumlah'] ?? 0); ?> surat keterangan lulus berhasil disetujui.
            </div>
        <?php elseif (isset($_GET['pesan']) && in_array($_GET['pesan'], ['bulk_gagal', 'gagal', 'tidak_dapat_disetujui'], true)): ?>
            <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Persetujuan surat gagal. Silakan coba lagi.</div>
        <?php endif; ?>

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

        <!-- Filter Tab -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li <?php echo (!isset($_GET['filter']) || $_GET['filter']=='semua') ? 'class="active"' : ''; ?>>
                    <a href="02_persetujuan_surat_keterangan_lulus.php?filter=semua">Semua</a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Menunggu') ? 'class="active"' : ''; ?>>
                    <a href="02_persetujuan_surat_keterangan_lulus.php?filter=Menunggu">
                        <span class="label label-warning">Menunggu (<?php echo $jumlah_menunggu_bulk; ?>)</span>
                    </a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Disetujui') ? 'class="active"' : ''; ?>>
                    <a href="02_persetujuan_surat_keterangan_lulus.php?filter=Disetujui">
                        <span class="label label-success">Disetujui (<?php echo $jumlah_disetujui; ?>)</span>
                    </a>
                </li>
                <li <?php echo (isset($_GET['filter']) && $_GET['filter']=='Ditolak') ? 'class="active"' : ''; ?>>
                    <a href="02_persetujuan_surat_keterangan_lulus.php?filter=Ditolak">
                        <span class="label label-danger">Ditolak (<?php echo $jumlah_ditolak; ?>)</span>
                    </a>
                </li>
                <li class="bulk-approve-tab">
                    <form method="post" action="proses_setujui_semua.php" onsubmit="return confirm('Konfirmasi: setujui semua <?php echo (int)$jumlah_menunggu_bulk; ?> surat keterangan lulus yang masih menunggu?');">
                        <input type="hidden" name="jenis" value="ket_lulus">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                        <button type="submit" class="btn btn-success btn-sm" <?php echo $jumlah_menunggu_bulk === 0 ? 'disabled title="Tidak ada surat menunggu"' : ''; ?>><i class="fa fa-check"></i> Setujui Semua (<?php echo (int)$jumlah_menunggu_bulk; ?>)</button>
                    </form>
                </li>
            </ul>
            <div class="tab-content">

                <div class="search-bar-wrap">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" id="keyword_lulus" class="form-control" placeholder="Cari nama, NIM, jurusan, keperluan..." autocomplete="off">
                        <span class="input-group-btn"><button class="btn btn-default" id="btn_reset_lulus" type="button" title="Reset pencarian"><i class="fa fa-times"></i></button></span>
                    </div>
                    <small id="info_lulus" class="text-muted" aria-live="polite"></small>
                    <span id="loading_lulus" style="display:none;color:#888"><i class="fa fa-spinner fa-spin"></i> Mencari...</span>
                </div>

                <?php
                $filter = isset($_GET['filter']) && in_array($_GET['filter'], ['Menunggu', 'Disetujui', 'Ditolak'], true) ? $_GET['filter'] : '';
                $where  = $filter ? "WHERE status_persetujuan='$filter'" : '';

                $p      = new Paging;
                $batas  = 15;
                $posisi = $p->cariPosisi($batas);
                $query  = mysqli_query($kon, "SELECT * FROM tb_surat_keterangan_lulus $where ORDER BY id_surat_keterangan_lulus DESC LIMIT $posisi,$batas");
                $i = $posisi + 1;
                ?>

                <div class="table-responsive-wrap"><table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="info">
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Keperluan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_lulus">
                    <?php $ada = false; while ($a = mysqli_fetch_array($query)):
                        $ada = true;
                        $sp = $a['status_persetujuan'];
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td title="<?php echo htmlspecialchars($a['nama_mahasiswa'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($a['nama_mahasiswa'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($a['nim_mahasiswa'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($a['jurusan'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td title="<?php echo htmlspecialchars($a['keperluan'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($a['keperluan'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center">
                                <?php if ($sp == 'Menunggu'): ?>
                                    <span class="label label-warning"><i class="fa fa-clock-o"></i> Menunggu</span>
                                <?php elseif ($sp == 'Disetujui'): ?>
                                    <span class="label label-success"><i class="fa fa-check"></i> Disetujui</span>
                                <?php elseif ($sp == 'Ditolak'): ?>
                                    <span class="label label-danger"><i class="fa fa-times"></i> Ditolak</span>
                                    <?php if (!empty($a['catatan_penolakan'])): ?>
                                        <br><small class="text-danger" title="<?php echo htmlspecialchars($a['catatan_penolakan'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($a['catatan_penolakan'], ENT_QUOTES, 'UTF-8'); ?></small>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                <?php if ($sp == 'Menunggu'): ?>
                                    <form method="post" action="proses_setujui_satu.php" onsubmit="return confirm('Setujui surat ini?');">
                                        <input type="hidden" name="jenis" value="ket_lulus"><input type="hidden" name="id" value="<?php echo (int)$a['id_surat_keterangan_lulus']; ?>">
                                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Setujui</button>
                                    </form>
                                <?php endif; ?>
                                <a href="02_preview_surat_keterangan_lulus.php?id_surat_keterangan_lulus=<?php echo $a['id_surat_keterangan_lulus']; ?>&return=02_persetujuan_surat_keterangan_lulus.php"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if (!$ada): ?><tr><td colspan="7" class="text-center text-muted">Belum ada surat pada filter ini.</td></tr><?php endif; ?>
                    </tbody>
                </table></div>

                <?php
                $jmldata     = mysqli_num_rows(mysqli_query($kon,"SELECT * FROM tb_surat_keterangan_lulus $where"));
                echo "<div class='page-result-count text-muted'>Menampilkan ".($jmldata ? $posisi + 1 : 0)."–".min($posisi + $batas, $jmldata)." dari $jmldata surat.</div>";
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
    var timer = null, delay = 350, minChars = 2;
    var input = document.getElementById('keyword_lulus');
    var tbody = document.getElementById('tbody_lulus');
    var paging = document.querySelector('.paginationw');
    var resultCount = document.querySelector('.page-result-count');
    var info = document.getElementById('info_lulus');
    var loading = document.getElementById('loading_lulus');
    var resetButton = document.getElementById('btn_reset_lulus');
    var filterAktif = new URLSearchParams(window.location.search).get('filter') || 'semua';
    var validStatus = ['Menunggu', 'Disetujui', 'Ditolak'];
    var csrfToken = <?php echo json_encode($_SESSION['csrf_token']); ?>;

    function esc(value) {
        return String(value || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }
    function renderStatus(row) {
        if (row.status_persetujuan === 'Menunggu') return "<span class='label label-warning'><i class='fa fa-clock-o'></i> Menunggu</span>";
        if (row.status_persetujuan === 'Disetujui') return "<span class='label label-success'><i class='fa fa-check'></i> Disetujui</span>";
        if (row.status_persetujuan === 'Ditolak') return "<span class='label label-danger'><i class='fa fa-times'></i> Ditolak</span>";
        return '';
    }
    function renderActions(row) {
        var id = parseInt(row.id_surat_keterangan_lulus, 10) || 0;
        var approve = row.status_persetujuan === 'Menunggu'
            ? "<form method='post' action='proses_setujui_satu.php' onsubmit=\"return confirm('Setujui surat ini?');\"><input type='hidden' name='jenis' value='ket_lulus'><input type='hidden' name='id' value='" + id + "'><input type='hidden' name='csrf_token' value='" + esc(csrfToken) + "'><button type='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Setujui</button></form>"
            : '';
        return "<div class='action-buttons'>" + approve + "<a class='btn btn-primary btn-xs' href='02_preview_surat_keterangan_lulus.php?id_surat_keterangan_lulus=" + id + "&return=02_persetujuan_surat_keterangan_lulus.php'><i class='fa fa-eye'></i> Lihat</a></div>";
    }
    function resetPage() {
        info.textContent = '';
        if (paging) paging.style.display = '';
        if (resultCount) resultCount.style.display = '';
        window.location.href = window.location.pathname + (filterAktif !== 'semua' ? '?filter=' + encodeURIComponent(filterAktif) : '');
    }
    function search(keyword) {
        if (!keyword) { resetPage(); return; }
        if (keyword.length < minChars) { info.textContent = 'Masukkan minimal 2 karakter untuk mencari.'; return; }
        loading.style.display = 'inline';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../karyawan/ajax_search_surat.php?tabel=keterangan_lulus&keyword=' + encodeURIComponent(keyword) + '&filter_persetujuan=' + encodeURIComponent(filterAktif), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) return;
            loading.style.display = 'none';
            if (xhr.status !== 200) { tbody.innerHTML = "<tr><td colspan='7' class='text-center text-danger'>Pencarian gagal dimuat.</td></tr>"; return; }
            var response;
            try { response = JSON.parse(xhr.responseText); } catch (e) { tbody.innerHTML = "<tr><td colspan='7' class='text-center text-danger'>Respons pencarian tidak valid.</td></tr>"; return; }
            if (response.error) { tbody.innerHTML = "<tr><td colspan='7' class='text-center text-danger'>" + esc(response.error) + "</td></tr>"; return; }
            if (paging) paging.style.display = 'none';
            if (resultCount) resultCount.style.display = 'none';
            var rows = (response.data || []).filter(function (row) {
                if (filterAktif !== 'semua') return row.status_persetujuan === filterAktif;
                return validStatus.indexOf(row.status_persetujuan) !== -1;
            });
            if (!rows.length) {
                tbody.innerHTML = "<tr><td colspan='7' class='text-center text-muted'>Tidak ada surat yang cocok dengan pencarian.</td></tr>";
                info.textContent = '0 hasil ditemukan';
                return;
            }
            var html = '';
            rows.forEach(function (row, index) {
                html += '<tr><td>' + (index + 1) + '</td><td title="' + esc(row.nama_mahasiswa) + '">' + esc(row.nama_mahasiswa) + '</td><td>' + esc(row.nim_mahasiswa) + '</td><td>' + esc(row.jurusan) + '</td><td title="' + esc(row.keperluan) + '">' + esc(row.keperluan) + '</td><td class="text-center">' + renderStatus(row) + '</td><td class="text-center">' + renderActions(row) + '</td></tr>';
            });
            tbody.innerHTML = html;
            info.textContent = rows.length + ' hasil ditemukan' + (response.total >= 200 ? ' (maksimal 200 hasil)' : '');
        };
        xhr.send();
    }
    input.addEventListener('input', function () {
        clearTimeout(timer);
        var keyword = this.value.trim();
        timer = setTimeout(function () { search(keyword); }, delay);
    });
    input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') { clearTimeout(timer); search(this.value.trim()); }
    });
    resetButton.addEventListener('click', function () { input.value = ''; resetPage(); });
}());
</script>
