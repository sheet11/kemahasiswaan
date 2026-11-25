<?php
include "01_nav.php";
$dashboard_surat = [
    ['label' => 'Masih Kuliah', 'tabel' => 'tb_surat_keterangan_masih_kuliah', 'menunggu' => 'Disetujui_Resepsionis', 'ditolak' => 'Ditolak_Wadir', 'url' => '03_persetujuan_surat_keterangan_masih_kuliah.php', 'warna' => 'bg-aqua'],
    ['label' => 'Pra Penelitian', 'tabel' => 'tb_surat_pra_penelitian', 'menunggu' => 'Disetujui_Resepsionis', 'ditolak' => 'Ditolak_Wadir', 'url' => '05_persetujuan_surat_pra_penelitian.php', 'warna' => 'bg-green'],
    ['label' => 'Penelitian', 'tabel' => 'tb_surat_penelitian', 'menunggu' => 'Disetujui_Resepsionis', 'ditolak' => 'Ditolak_Wadir', 'url' => '04_persetujuan_surat_penelitian.php', 'warna' => 'bg-red'],
];
$total_dashboard_menunggu = 0;
$dashboard_chart_max = 1;
foreach ($dashboard_surat as &$item) {
    $table = $item['tabel'];
    $waiting_status = mysqli_real_escape_string($kon, $item['menunggu']);
    $rejected_status = mysqli_real_escape_string($kon, $item['ditolak']);
    $pending_query = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM `$table` WHERE status_persetujuan='$waiting_status'");
    $approved_query = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM `$table` WHERE status_persetujuan='Disetujui'");
    $rejected_query = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM `$table` WHERE status_persetujuan='$rejected_status'");
    $item['jumlah_menunggu'] = $pending_query ? (int)mysqli_fetch_assoc($pending_query)['jumlah'] : 0;
    $item['jumlah_disetujui'] = $approved_query ? (int)mysqli_fetch_assoc($approved_query)['jumlah'] : 0;
    $item['jumlah_ditolak'] = $rejected_query ? (int)mysqli_fetch_assoc($rejected_query)['jumlah'] : 0;
    $item['total'] = $item['jumlah_menunggu'] + $item['jumlah_disetujui'] + $item['jumlah_ditolak'];
    $total_dashboard_menunggu += $item['jumlah_menunggu'];
    $dashboard_chart_max = max($dashboard_chart_max, $item['jumlah_menunggu'], $item['jumlah_disetujui'], $item['jumlah_ditolak']);
}
unset($item);
?>

<style>
    .wadir-chart-intro { margin:0 0 18px; color:#71817b; font-size:12px; }
    .wadir-chart-list { display:grid; gap:2px; }
    .wadir-chart-row {
        display:grid;
        grid-template-columns:minmax(145px,.8fr) minmax(0,2fr);
        align-items:center;
        gap:24px;
        padding:18px 8px;
        border-bottom:1px solid #edf2ef;
        transition:background .18s ease, transform .18s ease;
    }
    .wadir-chart-row:last-child { border-bottom:0; }
    .wadir-chart-row:hover { transform:translateX(3px); background:#f8fbf9; }
    .wadir-chart-name { color:#29473b; font-size:14px; font-weight:700; }
    .wadir-chart-total { display:block; margin-top:5px; color:#84938d; font-size:11px; font-weight:400; }
    .wadir-chart-metrics { display:grid; gap:10px; }
    .wadir-chart-metric { display:grid; grid-template-columns:92px minmax(40px,1fr) 48px; align-items:center; gap:10px; }
    .wadir-chart-label { color:#71817b; font-size:11px; }
    .wadir-chart-track { height:9px; overflow:hidden; border-radius:20px; background:#edf2ef; }
    .wadir-chart-bar { display:block; height:100%; min-width:0; border-radius:inherit; transition:width .65s cubic-bezier(.2,.7,.2,1); }
    .wadir-chart-bar.is-positive { min-width:4px; }
    .wadir-chart-bar.pending { background:linear-gradient(90deg,#e69b2f,#f7bf58); }
    .wadir-chart-bar.approved { background:linear-gradient(90deg,#16845d,#4bb982); }
    .wadir-chart-bar.rejected { background:linear-gradient(90deg,#c95155,#ec8174); }
    .wadir-chart-value { color:#334d42; font-size:12px; font-variant-numeric:tabular-nums; text-align:right; }
    .wadir-welcome {
        position:relative;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:24px;
        overflow:hidden;
        margin:4px 0 22px;
        padding:26px 30px;
        border-radius:18px;
        color:#fff;
        background:linear-gradient(115deg,#075b45 0%,#087f5b 58%,#16a477 100%);
        box-shadow:0 16px 36px rgba(7,91,69,.18);
        animation:wadir-fade-in .45s ease both;
    }
    .wadir-welcome::after {
        position:absolute;
        content:"";
        width:260px;
        height:260px;
        right:13%;
        top:-170px;
        border:1px solid rgba(255,255,255,.14);
        border-radius:50%;
        box-shadow:0 0 0 28px rgba(255,255,255,.035),0 0 0 58px rgba(255,255,255,.025);
        pointer-events:none;
    }
    .wadir-welcome-copy,.wadir-welcome-total { position:relative; z-index:1; }
    .wadir-welcome .eyebrow { color:#b8e8d4; font-size:10px; font-weight:700; letter-spacing:.14em; }
    .wadir-welcome h2 { margin:8px 0 7px; color:#fff; font-size:24px; font-weight:700; }
    .wadir-welcome p { margin:0; color:rgba(255,255,255,.78); font-size:13px; }
    .wadir-welcome-total { min-width:142px; padding:13px 18px; border:1px solid rgba(255,255,255,.2); border-radius:14px; background:rgba(255,255,255,.12); backdrop-filter:blur(8px); }
    .wadir-welcome-total span { display:block; color:#d6f2e5; font-size:11px; }
    .wadir-welcome-total strong { display:block; margin-top:2px; color:#fff; font-size:34px; line-height:1.1; }
    .dashboard-cards > div:nth-child(2) .small-box { animation-delay:.06s; }
    .dashboard-cards > div:nth-child(3) .small-box { animation-delay:.12s; }
    .dashboard-cards > div:nth-child(4) .small-box { animation-delay:.18s; }
    .dashboard-cards .small-box.bg-yellow { background:linear-gradient(135deg,#c58017,#efb64d) !important; }
    .dashboard-cards .small-box.bg-aqua { background:linear-gradient(135deg,#147a88,#35b5b1) !important; }
    .dashboard-cards .small-box.bg-green { background:linear-gradient(135deg,#087451,#29a879) !important; }
    .dashboard-cards .small-box.bg-red { background:linear-gradient(135deg,#a94748,#e57867) !important; }
    @media (max-width:767px) {
        .wadir-welcome { align-items:flex-start; flex-direction:column; padding:22px; }
        .wadir-welcome h2 { font-size:21px; }
        .wadir-welcome-total { display:flex; align-items:center; justify-content:space-between; width:100%; }
        .wadir-welcome-total strong { font-size:28px; }
        .wadir-chart-row { grid-template-columns:1fr; gap:12px; padding:16px 2px; }
        .wadir-chart-metric { grid-template-columns:82px minmax(30px,1fr) 42px; gap:8px; }
    }
</style>

<aside class="right-side">
    <section class="content-header">
        <h1>Dashboard <small>Wakil Direktur / Kasubak ADAK</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="wadir-welcome">
            <div class="wadir-welcome-copy">
                <span class="eyebrow">PANEL WAKIL DIREKTUR</span>
                <h2>Selamat datang, <?php echo htmlspecialchars($_SESSION['nama_lengkap'] ?? 'Wakil Direktur', ENT_QUOTES, 'UTF-8'); ?></h2>
                <p>Pantau dan kelola persetujuan surat mahasiswa dari satu tempat.</p>
            </div>
            <div class="wadir-welcome-total">
                <span><i class="fa fa-clock-o"></i> Menunggu ditinjau</span>
                <strong><?php echo $total_dashboard_menunggu; ?></strong>
            </div>
        </div>

        <div class="row dashboard-cards">
            <?php foreach ($dashboard_surat as $surat): ?>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="small-box <?php echo $surat['warna']; ?>">
                        <div class="inner">
                            <h3><?php echo $surat['jumlah_menunggu']; ?></h3>
                            <p>Menunggu Persetujuan<br><small><?php echo htmlspecialchars($surat['label'], ENT_QUOTES, 'UTF-8'); ?></small></p>
                        </div>
                        <div class="icon"><i class="ion ion-clock"></i></div>
                        <a href="<?php echo htmlspecialchars($surat['url'], ENT_QUOTES, 'UTF-8'); ?>" class="small-box-footer">Lihat daftar <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bar-chart"></i> Rekapitulasi Persetujuan</h3>
            </div>
            <div class="box-body">
                <p class="wadir-chart-intro">Perbandingan jumlah surat per status. Panjang batang menggunakan skala yang sama; angka menunjukkan jumlah tepat.</p>
                <div class="wadir-chart-list" role="list" aria-label="Grafik rekapitulasi persetujuan surat">
                    <?php
                    $chartStatuses = [
                        ['key' => 'jumlah_menunggu', 'label' => 'Menunggu', 'class' => 'pending'],
                        ['key' => 'jumlah_disetujui', 'label' => 'Disetujui', 'class' => 'approved'],
                        ['key' => 'jumlah_ditolak', 'label' => 'Ditolak', 'class' => 'rejected'],
                    ];
                    foreach ($dashboard_surat as $surat):
                    ?>
                        <article class="wadir-chart-row" role="listitem">
                            <div class="wadir-chart-name">
                                <?php echo htmlspecialchars($surat['label'], ENT_QUOTES, 'UTF-8'); ?>
                                <span class="wadir-chart-total"><?php echo number_format($surat['total']); ?> surat</span>
                            </div>
                            <div class="wadir-chart-metrics">
                                <?php foreach ($chartStatuses as $status):
                                    $value = (int)$surat[$status['key']];
                                    $width = round(($value / $dashboard_chart_max) * 100, 1);
                                ?>
                                    <div class="wadir-chart-metric">
                                        <span class="wadir-chart-label"><?php echo $status['label']; ?></span>
                                        <div class="wadir-chart-track" role="progressbar" aria-label="<?php echo htmlspecialchars($surat['label'] . ' — ' . $status['label'], ENT_QUOTES, 'UTF-8'); ?>" aria-valuemin="0" aria-valuemax="<?php echo $dashboard_chart_max; ?>" aria-valuenow="<?php echo $value; ?>">
                                            <span class="wadir-chart-bar <?php echo $status['class']; ?><?php echo $value > 0 ? ' is-positive' : ''; ?>" style="width:<?php echo $width; ?>%"></span>
                                        </div>
                                        <strong class="wadir-chart-value"><?php echo number_format($value); ?></strong>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</aside>
