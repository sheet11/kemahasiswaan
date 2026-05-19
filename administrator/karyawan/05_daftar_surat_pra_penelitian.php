<?php 
    include"01_nav.php";
    error_reporting(0);
    include"../config/class_paging.php";
?>
<aside class="right-side">
    <section class="content-header">
        <div class="container-fluid" style="margin:10px;">   
            <table style="width:100%;">
                <tr class="info">
                    <td align="left" colspan="6"><b><h4>Daftar Surat Pra Penelitian</h4></b></td>   
                </tr>
                <tr>
                    <td colspan="6">
                        <a href="05_tambah_surat_pra_penelitian.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah data</a>
                        <a class="btn btn-info"><i class="fa fa-cloud fa-sm"></i> | Jumlah : <?php
                            require_once("../config/koneksi.php");
                            echo mysqli_num_rows(mysqli_query($kon,"SELECT * FROM tb_surat_pra_penelitian")); ?></a>
                        <a class="btn btn-success"><i class="fa fa-spinner fa-sm"></i> | Belum Di Proses : <?php
                            echo mysqli_num_rows(mysqli_query($kon,"SELECT * FROM tb_surat_pra_penelitian WHERE status='Belum Dicetak'")); ?></a>
                        <a class="btn btn-danger"><i class="fa fa-spinner fa-sm"></i> | Sudah Di Proses : <?php
                            echo mysqli_num_rows(mysqli_query($kon,"SELECT * FROM tb_surat_pra_penelitian WHERE status='Sudah Dicetak'")); ?></a>
                    </td>
                    <td colspan="6">
                        <div class="input-group" style="max-width:450px;">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" id="keyword_pra" class="form-control" placeholder="Cari nama, NIM, prodi, judul..." autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="btn_reset_pra" type="button" title="Reset"><i class="fa fa-times"></i></button>
                            </span>
                        </div>
                        <small id="info_pra" class="text-muted"></small>
                        <span id="loading_pra" style="display:none; color:#888; margin-left:8px;"><i class="fa fa-spinner fa-spin"></i></span>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            </table>

            <table style="width:100%;" class="table table-bordered">    
                <thead>
                    <tr class="info">
                        <th>No.</th><th>Nama Mahasiswa</th><th>NIM</th><th>Prodi</th><th>Judul</th><th>Tujuan</th><th>Keterangan</th><th>Status</th><th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody_pra">
                <?php 
                    include "../config/koneksi.php";
                    function kolomStatus($a) {
                        $sp=$a['status_persetujuan'];$st=$a['status'];
                        $catatan=!empty($a['catatan_penolakan'])?htmlspecialchars($a['catatan_penolakan']):'';
                        if($st=='Sudah Dicetak') return "<span class='label label-primary' style='font-size:12px;'><i class='fa fa-print'></i> Sudah Dicetak</span>";
                        if($sp=='Disetujui')     return "<span class='label label-success' style='font-size:12px;'><i class='fa fa-check'></i> Disetujui</span>";
                        if($sp=='Ditolak'){$h="<span class='label label-danger' style='font-size:12px;'><i class='fa fa-times'></i> Ditolak</span>";if($catatan)$h.="<br><small style='color:#dd4b39;'><i class='fa fa-comment-o'></i> <i>$catatan</i></small>";return $h;}
                        return "<span class='label label-warning' style='font-size:12px;'><i class='fa fa-clock-o'></i> Menunggu</span>";
                    }
                    function kolomAksi($a,$id,$hal=''){
                        $p=$hal?"&halaman=$hal":'';$h='';
                        if($a['status_persetujuan']=='Disetujui') $h.="<a href='05_cetak_surat_pra_penelitian.php?id_surat_pra_penelitian=$id$p' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-print'></span></a> ";
                        $h.="<a href='05_edit_surat_pra_penelitian.php?id_surat_pra_penelitian=$id$p' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-pencil'></span></a> ";
                        $h.="<a href='05_kembalikan_surat_pra_penelitian.php?id_surat_pra_penelitian=$id$p' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-envelope'></span></a> ";
                        $h.="<a href='05_delete_surat_pra_penelitian.php?id_surat_pra_penelitian=$id$p' onclick='return confirm(\"Hapus {$a['nama_mahasiswa']}?\")' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span></a>";
                        return $h;
                    }
                    $p=new Paging;$batas=10;$posisi=$p->cariPosisi($batas);
                    $query=mysqli_query($kon,"SELECT * FROM tb_surat_pra_penelitian ORDER BY id_surat_pra_penelitian DESC LIMIT $posisi,$batas");
                    $i=$posisi+1;
                    while($a=mysqli_fetch_array($query)){
                        $id=$a['id_surat_pra_penelitian'];$hal=$_GET['halaman']??'';
                        echo "<tr><td>$i</td><td>$a[nama_mahasiswa]</td><td>$a[nim_mahasiswa]</td><td>$a[prodi]</td><td>$a[judul_kti]</td><td>$a[tujuan]</td><td>$a[keterangan]</td><td>".kolomStatus($a)."</td><td>".kolomAksi($a,$id,$hal)."</td></tr>";
                        $i++;
                    }
                ?>
                </tbody>
            </table>
            <div id="pagination_pra">
            <?php
                $jml=$p->jumlahHalaman(mysqli_num_rows(mysqli_query($kon,"SELECT * FROM tb_surat_pra_penelitian")),$batas);
                echo "<div class='paginationw'>".$p->navHalaman($_GET['halaman']??1,$jml)."</div>";
            ?>
            </div>
        </div>
    </section>
</aside>

<script>
(function(){
    var timer=null,DELAY=350,MIN_CHARS=2;
    var elInput=document.getElementById('keyword_pra'),elTbody=document.getElementById('tbody_pra'),
        elPaging=document.getElementById('pagination_pra'),elInfo=document.getElementById('info_pra'),
        elLoad=document.getElementById('loading_pra'),elReset=document.getElementById('btn_reset_pra');
    function escHtml(s){if(!s)return '';return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}
    function renderStatus(r){
        var sp=r.status_persetujuan,st=r.status,c=r.catatan_penolakan||'';
        if(st==='Sudah Dicetak') return "<span class='label label-primary' style='font-size:12px;'><i class='fa fa-print'></i> Sudah Dicetak</span>";
        if(sp==='Disetujui')     return "<span class='label label-success' style='font-size:12px;'><i class='fa fa-check'></i> Disetujui</span>";
        if(sp==='Ditolak'){var h="<span class='label label-danger' style='font-size:12px;'><i class='fa fa-times'></i> Ditolak</span>";if(c)h+="<br><small style='color:#dd4b39;'><i class='fa fa-comment-o'></i> <i>"+escHtml(c)+"</i></small>";return h;}
        return "<span class='label label-warning' style='font-size:12px;'><i class='fa fa-clock-o'></i> Menunggu</span>";
    }
    function renderAksi(r){
        var id=r.id_surat_pra_penelitian,nama=escHtml(r.nama_mahasiswa),h='';
        if(r.status_persetujuan==='Disetujui') h+="<a href='05_cetak_surat_pra_penelitian.php?id_surat_pra_penelitian="+id+"' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-print'></span></a> ";
        h+="<a href='05_edit_surat_pra_penelitian.php?id_surat_pra_penelitian="+id+"' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-pencil'></span></a> ";
        h+="<a href='05_kembalikan_surat_pra_penelitian.php?id_surat_pra_penelitian="+id+"' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-envelope'></span></a> ";
        h+="<a href='05_delete_surat_pra_penelitian.php?id_surat_pra_penelitian="+id+"' onclick=\"return confirm('Hapus "+nama+"?')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span></a>";
        return h;
    }
    function doSearch(kw){
        if(kw.length===0){reset();return;}if(kw.length<MIN_CHARS)return;
        elLoad.style.display='inline';
        var xhr=new XMLHttpRequest();
        xhr.open('GET','ajax_search_surat.php?tabel=pra_penelitian&keyword='+encodeURIComponent(kw),true);
        xhr.onreadystatechange=function(){
            if(xhr.readyState!==4)return;elLoad.style.display='none';
            if(xhr.status!==200){elTbody.innerHTML="<tr><td colspan='9' class='text-center text-danger'>Gagal memuat data.</td></tr>";return;}
            var resp;try{resp=JSON.parse(xhr.responseText);}catch(e){elTbody.innerHTML="<tr><td colspan='9' class='text-center text-danger'>Response tidak valid.</td></tr>";return;}
            if(resp.error){elTbody.innerHTML="<tr><td colspan='9' class='text-center text-danger'>"+escHtml(resp.error)+"</td></tr>";return;}
            elPaging.style.display='none';
            var rows=resp.data;
            if(rows.length===0){elTbody.innerHTML="<tr><td colspan='9' class='text-center'>Data tidak ditemukan.</td></tr>";elInfo.textContent='0 hasil';return;}
            var html='';
            for(var i=0;i<rows.length;i++){var r=rows[i];
                html+="<tr><td>"+(i+1)+"</td><td>"+escHtml(r.nama_mahasiswa)+"</td><td>"+escHtml(r.nim_mahasiswa)+"</td><td>"+escHtml(r.prodi)+"</td><td>"+escHtml(r.judul_kti)+"</td><td>"+escHtml(r.tujuan)+"</td><td>"+escHtml(r.keterangan)+"</td><td>"+renderStatus(r)+"</td><td>"+renderAksi(r)+"</td></tr>";
            }
            elTbody.innerHTML=html;elInfo.textContent=resp.total+' hasil ditemukan';
        };xhr.send();
    }
    function reset(){elInfo.textContent='';elPaging.style.display='';window.location.href=window.location.pathname;}
    elInput.addEventListener('input',function(){clearTimeout(timer);var kw=this.value.trim();timer=setTimeout(function(){doSearch(kw);},DELAY);});
    elReset.addEventListener('click',function(){elInput.value='';reset();});
    elInput.addEventListener('keydown',function(e){if(e.key==='Enter'){clearTimeout(timer);doSearch(this.value.trim());}});
}());
</script>