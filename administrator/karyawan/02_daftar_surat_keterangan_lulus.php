<?php
    include "01_nav.php";
    error_reporting(0);
?>
<aside class="right-side">
    <style>
        html.surat-page-scroll-locked, body.surat-page-scroll-locked { overflow-y:hidden !important; }
        .surat-table-scroll { height:calc(100vh - 270px); min-height:260px; overflow-x:hidden; overflow-y:auto; overscroll-behavior:contain; overflow-anchor:none; border:1px solid #ddd; background:#fff; }
        .surat-table-scroll .table { width:100%; min-width:0; margin-bottom:0; table-layout:fixed; border-collapse:separate; border-spacing:0; }
        .surat-table-scroll th:first-child, .surat-table-scroll td:first-child { width:4%; text-align:center; }
        .surat-table-scroll th,.surat-table-scroll td { white-space:normal !important; overflow-wrap:anywhere; }
        .surat-table-scroll th:nth-child(2),.surat-table-scroll td:nth-child(2) { width:19%; }
        .surat-table-scroll th:nth-child(3),.surat-table-scroll td:nth-child(3) { width:12%; }
        .surat-table-scroll th:nth-child(4),.surat-table-scroll td:nth-child(4) { width:17%; }
        .surat-table-scroll th:nth-child(5),.surat-table-scroll td:nth-child(5) { width:13%; }
        .surat-table-scroll th:nth-child(6),.surat-table-scroll td:nth-child(6) { width:11%; }
        .surat-table-scroll th:nth-child(7),.surat-table-scroll td:nth-child(7) { width:12%; }
        .surat-table-scroll th:nth-child(8),.surat-table-scroll td:nth-child(8) { width:12%; }
        .surat-table-scroll td:nth-child(7) .label { display:inline-block; max-width:100%; white-space:normal !important; line-height:1.3; }
        .surat-table-scroll td:last-child .btn { margin:1px 2px 1px 0; }
        .surat-table-scroll thead th { position:sticky; top:0; z-index:5; background:#d9edf7 !important; background-clip:padding-box; box-shadow:0 1px 0 #c8dce7; }
        .surat-scroll-status { padding:10px; text-align:center; color:#777; background:#f9f9f9; }
        @media(max-width:767px) { .surat-table-scroll { height:calc(100vh - 330px); min-height:220px; } }
        .surat-list-table { border-collapse:separate; border-spacing:0; }
        .surat-list-table thead th { position:sticky; top:0; z-index:5; background:#d9edf7 !important; background-clip:padding-box; box-shadow:0 1px 0 #c8dce7; }
    </style>
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
                $batas      = 50;
                $total_rows = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_keterangan_lulus FROM tb_surat_keterangan_lulus $where_filter"));

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

            <div class="surat-table-scroll" id="surat_table_scroll" tabindex="0" aria-label="Daftar surat; gulir tabel untuk memuat data berikutnya">
            <table style="width:100%;" class="table table-bordered surat-list-table">
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
                <tbody id="tbody_lls" data-loaded="<?php echo min($batas, $total_rows); ?>" data-total="<?php echo (int)$total_rows; ?>">
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

                    $posisi = 0;
                    $order  = "ORDER BY
                        FIELD(status, 'Belum Dicetak', 'Sudah Dicetak'),
                        id_surat_keterangan_lulus DESC";

                    $query = mysqli_query($kon,
                        "SELECT * FROM tb_surat_keterangan_lulus
                         $where_filter $order
                         LIMIT $posisi,$batas");
                    $i = $posisi + 1;
                    $initial_rows = mysqli_num_rows($query);

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
                    if ($initial_rows === 0) echo "<tr><td colspan='8' class='text-center text-muted'>Tidak ada surat pada filter ini.</td></tr>";
                ?>
                </tbody>
            </table>
            <div id="surat_scroll_sentinel" style="height:1px;"></div>
            </div>
            <div id="surat_scroll_status" class="surat-scroll-status" role="status" aria-live="polite">
                <?php if ($total_rows > 0): ?>Menampilkan <?php echo min($batas, $total_rows); ?> dari <?php echo (int)$total_rows; ?> surat. Gulir tabel ke bawah untuk memuat berikutnya.<?php else: ?>Belum ada surat pada filter ini.<?php endif; ?>
            </div>

        </div>
    </section>
</aside>

<script>
(function () {
    var timer=null, delay=350, batchSize=50, keyword='', offset=0, total=0, hasMore=true, loading=false, requestId=0, activeRequest=null;
    document.documentElement.classList.add('surat-page-scroll-locked');
    document.body.classList.add('surat-page-scroll-locked');
    var input=document.getElementById('keyword_lls'), tbody=document.getElementById('tbody_lls');
    var scroller=document.getElementById('surat_table_scroll'), sentinel=document.getElementById('surat_scroll_sentinel');
    var status=document.getElementById('surat_scroll_status'), info=document.getElementById('info_lls'), loader=document.getElementById('loading_lls');
    var reset=document.getElementById('btn_reset_lls'), filter=new URLSearchParams(location.search).get('filter')||'semua';
    offset=parseInt(tbody.getAttribute('data-loaded'),10)||0;
    total=parseInt(tbody.getAttribute('data-total'),10)||0;
    hasMore=offset<total;
    function esc(value){return String(value==null?'':value).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');}
    function renderRow(r,n){
        var id=parseInt(r.id_surat_keterangan_lulus,10)||0, name=esc(r.nama_mahasiswa);
        var state=r.status==='Sudah Dicetak'?"<span class='label label-success'><i class='fa fa-print'></i> Sudah Dicetak</span>":"<span class='label label-warning'><i class='fa fa-clock-o'></i> Belum Dicetak</span>";
        var actions="<a href='02_cetak_surat_keterangan_lulus.php?id_surat_keterangan_lulus="+id+"' class='btn btn-info btn-xs' title='Cetak'><span class='glyphicon glyphicon-print'></span></a> ";
        actions+="<a href='02_preview_surat_keterangan_lulus.php?id_surat_keterangan_lulus="+id+"&return=02_daftar_surat_keterangan_lulus.php' class='btn btn-primary btn-xs' title='Preview'><i class='fa fa-eye'></i></a> ";
        actions+="<a href='02_edit_surat_keterangan_lulus.php?id_surat_keterangan_lulus="+id+"' class='btn btn-default btn-xs' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a> ";
        actions+="<a href='02_delete_surat_keterangan_lulus.php?id_surat_keterangan_lulus="+id+"' onclick=\"return confirm('Hapus "+name+"?')\" class='btn btn-danger btn-xs' title='Hapus'><span class='glyphicon glyphicon-remove'></span></a>";
        return "<tr><td>"+n+"</td><td>"+esc(r.nama_mahasiswa)+"</td><td>"+esc(r.nim_mahasiswa)+"</td><td>"+esc(r.jurusan)+"</td><td>"+esc(r.tempat_lahir)+"</td><td>"+esc(r.tanggal_lahir)+"</td><td>"+state+"</td><td class='text-nowrap'>"+actions+"</td></tr>";
    }
    function updateStatus(){
        if(loading) status.innerHTML="<i class='fa fa-spinner fa-spin'></i> Memuat data berikutnya...";
        else if(total===0) status.textContent=keyword?'Tidak ada surat yang sesuai.':'Belum ada surat pada filter ini.';
        else if(!hasMore) status.textContent='Semua '+total+' data sudah ditampilkan.';
        else status.textContent='Menampilkan '+offset+' dari '+total+' surat. Gulir tabel ke bawah untuk memuat berikutnya.';
    }
    function maybeLoad(){if(loading||!hasMore)return;var box=scroller.getBoundingClientRect(),mark=sentinel.getBoundingClientRect();if(mark.top<=box.bottom+700)load(false);}
    function load(resetRows){
        if(loading&&!resetRows)return;
        if(resetRows){if(activeRequest)activeRequest.abort();requestId++;offset=0;total=0;hasMore=true;tbody.innerHTML='';info.textContent='';scroller.scrollTop=0;}
        loading=true;loader.style.display='inline';updateStatus();var id=++requestId,xhr=new XMLHttpRequest();activeRequest=xhr;
        xhr.open('GET','ajax_load_daftar_surat.php?jenis=keterangan_lulus&filter='+encodeURIComponent(filter)+'&keyword='+encodeURIComponent(keyword)+'&offset='+offset+'&limit='+batchSize,true);
        xhr.onreadystatechange=function(){if(xhr.readyState!==4||id!==requestId)return;loading=false;activeRequest=null;loader.style.display='none';var res;try{res=JSON.parse(xhr.responseText);}catch(e){res=null;}
            if(xhr.status!==200||!res||res.error){status.textContent='Gagal memuat data. Gulir kembali untuk mencoba lagi.';return;}
            var rows=res.data||[],html='';for(var i=0;i<rows.length;i++)html+=renderRow(rows[i],offset+i+1);
            if(resetRows&&rows.length===0)html="<tr><td colspan='8' class='text-center text-muted'>Data tidak ditemukan.</td></tr>";
            tbody.insertAdjacentHTML('beforeend',html);offset+=rows.length;total=parseInt(res.total,10)||0;hasMore=!!res.has_more;
            if(keyword)info.textContent=offset+' dari '+total+' hasil pencarian dimuat';updateStatus();if(hasMore)requestAnimationFrame(maybeLoad);
        };xhr.send();
    }
    scroller.addEventListener('scroll',maybeLoad,{passive:true});
    if('IntersectionObserver' in window){var observer=new IntersectionObserver(function(entries){if(entries[0].isIntersecting)load(false);},{root:scroller,rootMargin:'0px 0px 700px 0px'});observer.observe(sentinel);}
    updateStatus();requestAnimationFrame(maybeLoad);
    input.addEventListener('input',function(){clearTimeout(timer);keyword=this.value.trim();timer=setTimeout(function(){if(keyword&&keyword.length<2){info.textContent='Masukkan minimal 2 karakter untuk mencari.';return;}load(true);},delay);});
    input.addEventListener('keydown',function(e){if(e.key==='Enter'){clearTimeout(timer);keyword=this.value.trim();if(!keyword||keyword.length>=2)load(true);}});
    reset.addEventListener('click',function(){input.value='';keyword='';load(true);});
}());
</script>
