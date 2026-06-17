<?php 
    include"01_nav.php";
    error_reporting(0);
    include"../config/class_paging.php";
?>
<aside class="right-side">
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

                $cnt_semua    = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_penelitian FROM tb_surat_penelitian"));
                $cnt_tunggu   = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_penelitian FROM tb_surat_penelitian WHERE status_persetujuan='Menunggu'"));
                $cnt_revisi   = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_penelitian FROM tb_surat_penelitian WHERE status_persetujuan='Perlu_Revisi'"));
                $cnt_direvisi = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_penelitian FROM tb_surat_penelitian WHERE status_persetujuan='Telah_Direvisi'"));
                $cnt_wadir    = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_penelitian FROM tb_surat_penelitian WHERE status_persetujuan='Disetujui_Resepsionis'"));
                $cnt_cetak    = mysqli_num_rows(mysqli_query($kon,"SELECT id_surat_penelitian FROM tb_surat_penelitian WHERE status_persetujuan='Disetujui'"));

                function isActive($f, $current) {
                    return $f === $current ? 'style="box-shadow:0 0 0 3px rgba(0,0,0,0.25); opacity:1;"' : 'style="opacity:0.7;"';
                }
            ?>

            <table style="width:100%;">
                <tr class="info">
                    <td align="left" colspan="6"><b><h4>Surat Penelitian</h4></b></td>
                </tr>
                <tr>
                    <td colspan="12">
                        <a href="04_tambah_surat_penelitian.php" class="btn btn-primary">Tambah data +</a>

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
                            <input type="text" id="keyword_pen" class="form-control"
                                   placeholder="Cari nama, NIM, jurusan, judul..." autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="btn_reset_pen" type="button" title="Reset">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                        </div>
                        <small id="info_pen" class="text-muted"></small>
                        <span id="loading_pen" style="display:none; color:#888; margin-left:8px;">
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

            <table style="width:100%;" class="table table-bordered">
                <thead>
                    <tr class="info">
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Judul KTI</th>
                        <th>Tempat Penelitian</th>
                        <th>Status</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody_pen">
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
                        $hal_ini = '04_daftar_surat_penelitian.php';
                        $html    = '';

                        // Cetak — hanya jika wadir sudah setujui
                        if ($sp == 'Disetujui')
                            $html .= "<a href='04_cetak_surat_penelitian.php?id_surat_penelitian=$id$param' class='btn btn-info btn-xs' title='Cetak Surat'><span class='glyphicon glyphicon-print'></span></a> ";

                        // Setujui & Tolak — jika masih bisa diproses karyawan
                        if ($sp == 'Menunggu' || $sp == 'Telah_Direvisi') {
                            $lbl = ($sp == 'Telah_Direvisi') ? 'Setujui Revisi ke Wadir' : 'Setujui & Teruskan ke Wadir';
                            $html .= "<a href='proses_karyawan.php?aksi=setujui&jenis=penelitian&id=$id&return=$hal_ini' onclick=\"return confirm('$lbl?')\" class='btn btn-success btn-xs' title='$lbl'><i class='fa fa-check'></i></a> ";
                            $html .= "<a href='proses_karyawan.php?aksi=tolak&jenis=penelitian&id=$id&return=$hal_ini' class='btn btn-warning btn-xs' title='Kembalikan ke Mahasiswa'><i class='fa fa-undo'></i></a> ";
                        }

                        // Preview selalu tampil
                        $html .= "<a href='04_preview_surat_penelitian.php?id_surat_penelitian=$id&return=$hal_ini' class='btn btn-primary btn-xs' title='Preview'><i class='fa fa-eye'></i></a> ";
                        $html .= "<a href='04_edit_surat_penelitian.php?id_surat_penelitian=$id$param' class='btn btn-default btn-xs' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a> ";
                        $html .= "<a href='04_delete_surat_penelitian.php?id_surat_penelitian=$id$param' onclick='return confirm(\"Hapus surat {$a['nama_mahasiswa']}?\")' class='btn btn-danger btn-xs' title='Hapus'><span class='glyphicon glyphicon-remove'></span></a>";
                        return $html;
                    }

                    $p      = new Paging;
                    $batas  = 10;
                    $posisi = $p->cariPosisi($batas);
                    $order  = "ORDER BY
                        FIELD(status_persetujuan,
                            'Telah_Direvisi','Menunggu','Perlu_Revisi',
                            'Disetujui_Resepsionis','Disetujui'
                        ),
                        COALESCE(tanggal_pengajuan, '1970-01-01') DESC,
                        id_surat_penelitian DESC";

                    $query = mysqli_query($kon,
                        "SELECT * FROM tb_surat_penelitian
                         $where_filter $order
                         LIMIT $posisi,$batas");
                    $i = $posisi + 1;

                    while ($a = mysqli_fetch_array($query)) {
                        $id  = $a['id_surat_penelitian'];
                        $hal = $_GET['halaman'] ?? '';
                        echo "<tr>
                                <td>$i</td>
                                <td>{$a['nama_mahasiswa']}</td>
                                <td>{$a['nim_mahasiswa']}</td>
                                <td>{$a['jurusan']}</td>
                                <td>{$a['judul_kti']}</td>
                                <td>{$a['tempat_penelitian']}</td>
                                <td>" . kolomStatus($a) . "</td>
                                <td>" . kolomAksi($a, $id, $hal) . "</td>
                              </tr>";
                        $i++;
                    }
                ?>
                </tbody>
            </table>

            <div id="pagination_pen">
            <?php
                $jmldata     = mysqli_num_rows(mysqli_query($kon, "SELECT id_surat_penelitian FROM tb_surat_penelitian $where_filter"));
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
    var elInput  = document.getElementById('keyword_pen');
    var elTbody  = document.getElementById('tbody_pen');
    var elPaging = document.getElementById('pagination_pen');
    var elInfo   = document.getElementById('info_pen');
    var elLoad   = document.getElementById('loading_pen');
    var elReset  = document.getElementById('btn_reset_pen');
    var urlParams = new URLSearchParams(window.location.search);
    var FILTER    = urlParams.get('filter') || 'semua';

    function escHtml(s) {
        if (!s) return '';
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function renderStatus(r) {
        var sp=r.status_persetujuan, st=r.status, cat=r.catatan_penolakan||'';
        switch(sp) {
            case 'Menunggu':              return "<span class='label label-warning' style='font-size:12px;'><i class='fa fa-clock-o'></i> Menunggu Review</span>";
            case 'Perlu_Revisi':          var h="<span class='label label-warning' style='font-size:12px;background:#e67e22;'><i class='fa fa-edit'></i> Perlu Revisi</span>"; if(cat) h+="<br><small style='color:#d68910;'>"+escHtml(cat)+"</small>"; return h;
            case 'Telah_Direvisi':        return "<span class='label label-info' style='font-size:12px;'><i class='fa fa-refresh'></i> Telah Direvisi</span>";
            case 'Disetujui_Resepsionis': return "<span class='label label-default' style='font-size:12px;background:#8e44ad;color:#fff;'><i class='fa fa-arrow-up'></i> Diproses Wadir</span>";
            case 'Disetujui':             if(st==='Sudah Dicetak') return "<span class='label label-primary' style='font-size:12px;'><i class='fa fa-print'></i> Sudah Dicetak</span>"; return "<span class='label label-success' style='font-size:12px;'><i class='fa fa-check-circle'></i> Disetujui Wadir</span>";
            default:                      return "<span class='label label-default'>"+escHtml(sp)+"</span>";
        }
    }

    function renderAksi(r) {
        var id=r.id_surat_penelitian, nama=escHtml(r.nama_mahasiswa), sp=r.status_persetujuan, html='';
        var hal_ini='04_daftar_surat_penelitian.php';
        if(sp==='Disetujui')
            html+="<a href='04_cetak_surat_penelitian.php?id_surat_penelitian="+id+"' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-print'></span></a> ";
        if(sp==='Menunggu'||sp==='Telah_Direvisi'){
            var lbl=sp==='Telah_Direvisi'?'Setujui Revisi ke Wadir':'Setujui & Teruskan ke Wadir';
            html+="<a href='proses_karyawan.php?aksi=setujui&jenis=penelitian&id="+id+"&return="+hal_ini+"' onclick=\"return confirm('"+lbl+"?')\" class='btn btn-success btn-xs'><i class='fa fa-check'></i></a> ";
            html+="<a href='proses_karyawan.php?aksi=tolak&jenis=penelitian&id="+id+"&return="+hal_ini+"' class='btn btn-warning btn-xs'><i class='fa fa-undo'></i></a> ";
        }
        html+="<a href='04_preview_surat_penelitian.php?id_surat_penelitian="+id+"&return="+hal_ini+"' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i></a> ";
        html+="<a href='04_edit_surat_penelitian.php?id_surat_penelitian="+id+"' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-pencil'></span></a> ";
        html+="<a href='04_delete_surat_penelitian.php?id_surat_penelitian="+id+"' onclick=\"return confirm('Hapus "+nama+"?')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span></a>";
        return html;
    }

    function doSearch(kw) {
        if(kw.length===0){resetView();return;}
        if(kw.length<MIN_CHARS) return;
        elLoad.style.display='inline';
        var xhr=new XMLHttpRequest();
        xhr.open('GET','ajax_search_surat.php?tabel=penelitian&kolom=nama_mahasiswa&keyword='+encodeURIComponent(kw)+'&filter='+encodeURIComponent(FILTER),true);
        xhr.onreadystatechange=function(){
            if(xhr.readyState!==4) return;
            elLoad.style.display='none';
            var resp; try{resp=JSON.parse(xhr.responseText);}catch(e){return;}
            elPaging.style.display='none';
            var rows=resp.data;
            if(!rows||rows.length===0){elTbody.innerHTML="<tr><td colspan='8' class='text-center'>Data tidak ditemukan.</td></tr>";elInfo.textContent='0 hasil';return;}
            var html='';
            for(var i=0;i<rows.length;i++){
                var r=rows[i];
                html+="<tr><td>"+(i+1)+"</td><td>"+escHtml(r.nama_mahasiswa)+"</td><td>"+escHtml(r.nim_mahasiswa)+"</td><td>"+escHtml(r.jurusan)+"</td><td>"+escHtml(r.judul_kti)+"</td><td>"+escHtml(r.tempat_penelitian)+"</td><td>"+renderStatus(r)+"</td><td>"+renderAksi(r)+"</td></tr>";
            }
            elTbody.innerHTML=html;
            elInfo.textContent=resp.total+' hasil ditemukan';
        };
        xhr.send();
    }

    function resetView(){
        elInfo.textContent=''; elPaging.style.display='';
        window.location.href=window.location.pathname+(FILTER!=='semua'?'?filter='+FILTER:'');
    }
    elInput.addEventListener('input',function(){clearTimeout(timer);var kw=this.value.trim();timer=setTimeout(function(){doSearch(kw);},DELAY);});
    elReset.addEventListener('click',function(){elInput.value='';resetView();});
    elInput.addEventListener('keydown',function(e){if(e.key==='Enter'){clearTimeout(timer);doSearch(this.value.trim());}});
}());
</script>