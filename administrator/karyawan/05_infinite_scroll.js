(function () {
    var timer = null, delay = 350, batchSize = 50, keyword = '';
    var offset, total, hasMore, loading = false, requestId = 0, activeRequest = null;
    document.documentElement.classList.add('surat-page-scroll-locked');
    document.body.classList.add('surat-page-scroll-locked');

    var input = document.getElementById('keyword_pra');
    var tbody = document.getElementById('tbody_pra');
    var scroller = document.getElementById('surat_table_scroll');
    var sentinel = document.getElementById('surat_scroll_sentinel');
    var status = document.getElementById('surat_scroll_status');
    var info = document.getElementById('info_pra');
    var loader = document.getElementById('loading_pra');
    var reset = document.getElementById('btn_reset_pra');
    var filter = new URLSearchParams(window.location.search).get('filter') || 'semua';

    offset = parseInt(tbody.getAttribute('data-loaded'), 10) || 0;
    total = parseInt(tbody.getAttribute('data-total'), 10) || 0;
    hasMore = offset < total;

    function esc(value) {
        return String(value == null ? '' : value).replace(/&/g, '&amp;').replace(/</g, '&lt;')
            .replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }

    function renderStatus(row) {
        var state = row.status_persetujuan, printed = row.status, note = row.catatan_penolakan || '';
        switch (state) {
            case 'Menunggu': return "<span class='label label-warning'><i class='fa fa-clock-o'></i> Menunggu Review</span>";
            case 'Perlu_Revisi':
                var revised = "<span class='label label-warning' style='background:#e67e22;'><i class='fa fa-edit'></i> Perlu Revisi</span>";
                if (note) revised += "<br><small class='text-warning'>" + esc(note) + '</small>';
                return revised;
            case 'Telah_Direvisi': return "<span class='label label-info'><i class='fa fa-refresh'></i> Telah Direvisi</span>";
            case 'Disetujui_Resepsionis': return "<span class='label label-default' style='background:#8e44ad;color:#fff;'><i class='fa fa-arrow-up'></i> Diproses Wadir</span>";
            case 'Disetujui':
                if (printed === 'Sudah Dicetak') return "<span class='label label-primary'><i class='fa fa-print'></i> Sudah Dicetak</span>";
                return "<span class='label label-success'><i class='fa fa-check-circle'></i> Disetujui Wadir</span>";
            default: return "<span class='label label-default'>" + esc(state) + '</span>';
        }
    }

    function renderActions(row) {
        var id = parseInt(row.id_surat_pra_penelitian, 10) || 0;
        var name = esc(row.nama_mahasiswa), state = row.status_persetujuan;
        var base = '05_daftar_surat_pra_penelitian.php', html = '';
        if (state === 'Disetujui') html += "<a href='05_cetak_surat_pra_penelitian.php?id_surat_pra_penelitian=" + id + "' class='btn btn-info btn-xs' title='Cetak'><span class='glyphicon glyphicon-print'></span></a> ";
        if (state === 'Menunggu' || state === 'Telah_Direvisi') {
            var label = state === 'Telah_Direvisi' ? 'Setujui Revisi ke Wadir' : 'Setujui & Teruskan ke Wadir';
            html += "<a href='proses_karyawan.php?aksi=setujui&jenis=pra_penelitian&id=" + id + '&return=' + base + "' onclick=\"return confirm('" + label + "?')\" class='btn btn-success btn-xs'><i class='fa fa-check'></i></a> ";
            html += "<a href='proses_karyawan.php?aksi=tolak&jenis=pra_penelitian&id=" + id + '&return=' + base + "' class='btn btn-warning btn-xs'><i class='fa fa-undo'></i></a> ";
        }
        html += "<a href='05_preview_surat_pra_penelitian.php?id_surat_pra_penelitian=" + id + '&return=' + base + "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i></a> ";
        html += "<a href='05_edit_surat_pra_penelitian.php?id_surat_pra_penelitian=" + id + "' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-pencil'></span></a> ";
        html += "<a href='05_delete_surat_pra_penelitian.php?id_surat_pra_penelitian=" + id + "' onclick=\"return confirm('Hapus " + name + "?')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span></a>";
        return html;
    }

    function renderRow(row, number) {
        return '<tr><td>' + number + '</td><td>' + esc(row.nama_mahasiswa) + '</td><td>' + esc(row.nim_mahasiswa) +
            '</td><td>' + esc(row.prodi) + '</td><td>' + esc(row.judul_kti) + '</td><td>' + esc(row.tujuan) +
            '</td><td>' + esc(row.keterangan) + '</td><td>' + renderStatus(row) + "</td><td class='text-nowrap'>" +
            renderActions(row) + '</td></tr>';
    }

    function updateStatus() {
        if (loading) status.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Memuat data berikutnya...";
        else if (total === 0) status.textContent = keyword ? 'Tidak ada surat yang sesuai.' : 'Belum ada surat pada filter ini.';
        else if (!hasMore) status.textContent = 'Semua ' + total + ' data sudah ditampilkan.';
        else status.textContent = 'Menampilkan ' + offset + ' dari ' + total + ' surat. Gulir tabel ke bawah untuk memuat berikutnya.';
    }

    function maybeLoad() {
        if (loading || !hasMore) return;
        var bounds = scroller.getBoundingClientRect();
        if (sentinel.getBoundingClientRect().top <= bounds.bottom + 700) load(false);
    }

    function load(resetRows) {
        if (loading && !resetRows) return;
        if (resetRows) {
            if (activeRequest) activeRequest.abort();
            requestId++;
            offset = 0; total = 0; hasMore = true;
            tbody.innerHTML = ''; info.textContent = ''; scroller.scrollTop = 0;
        }
        loading = true; loader.style.display = 'inline'; updateStatus();
        var currentRequest = ++requestId, xhr = new XMLHttpRequest();
        activeRequest = xhr;
        xhr.open('GET', 'ajax_load_daftar_surat.php?jenis=pra_penelitian&filter=' + encodeURIComponent(filter) +
            '&keyword=' + encodeURIComponent(keyword) + '&offset=' + offset + '&limit=' + batchSize, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4 || currentRequest !== requestId) return;
            loading = false; activeRequest = null; loader.style.display = 'none';
            var response;
            try { response = JSON.parse(xhr.responseText); } catch (e) { response = null; }
            if (xhr.status !== 200 || !response || response.error) {
                status.textContent = 'Gagal memuat data. Gulir kembali untuk mencoba lagi.';
                return;
            }
            var rows = response.data || [], html = '';
            for (var i = 0; i < rows.length; i++) html += renderRow(rows[i], offset + i + 1);
            if (resetRows && rows.length === 0) html = "<tr><td colspan='9' class='text-center text-muted'>Data tidak ditemukan.</td></tr>";
            tbody.insertAdjacentHTML('beforeend', html);
            offset += rows.length; total = parseInt(response.total, 10) || 0; hasMore = !!response.has_more;
            if (keyword) info.textContent = offset + ' dari ' + total + ' hasil pencarian dimuat';
            updateStatus();
            if (hasMore) window.requestAnimationFrame(maybeLoad);
        };
        xhr.send();
    }

    scroller.addEventListener('scroll', maybeLoad, { passive: true });
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) { if (entries[0].isIntersecting) load(false); },
            { root: scroller, rootMargin: '0px 0px 700px 0px' });
        observer.observe(sentinel);
    }
    updateStatus(); window.requestAnimationFrame(maybeLoad);
    input.addEventListener('input', function () {
        clearTimeout(timer); keyword = this.value.trim();
        timer = setTimeout(function () {
            if (keyword && keyword.length < 2) { info.textContent = 'Masukkan minimal 2 karakter untuk mencari.'; return; }
            load(true);
        }, delay);
    });
    input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') { clearTimeout(timer); keyword = this.value.trim(); if (!keyword || keyword.length >= 2) load(true); }
    });
    reset.addEventListener('click', function () { input.value = ''; keyword = ''; load(true); });
}());
