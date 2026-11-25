<?php
include "01_nav.php";
$dashboard_surat = [
    ['label' => 'Keterangan Lulus', 'tabel' => 'tb_surat_keterangan_lulus', 'menunggu' => 'Menunggu', 'ditolak' => 'Ditolak', 'url' => '02_persetujuan_surat_keterangan_lulus.php', 'warna' => 'bg-yellow'],
    ['label' => 'Masih Kuliah', 'tabel' => 'tb_surat_keterangan_masih_kuliah', 'menunggu' => 'Disetujui_Resepsionis', 'ditolak' => 'Ditolak_Wadir', 'url' => '03_persetujuan_surat_keterangan_masih_kuliah.php', 'warna' => 'bg-aqua'],
    ['label' => 'Pra Penelitian', 'tabel' => 'tb_surat_pra_penelitian', 'menunggu' => 'Disetujui_Resepsionis', 'ditolak' => 'Ditolak_Wadir', 'url' => '05_persetujuan_surat_pra_penelitian.php', 'warna' => 'bg-green'],
    ['label' => 'Penelitian', 'tabel' => 'tb_surat_penelitian', 'menunggu' => 'Disetujui_Resepsionis', 'ditolak' => 'Ditolak_Wadir', 'url' => '04_persetujuan_surat_penelitian.php', 'warna' => 'bg-red'],
];
$total_dashboard_menunggu = 0;
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
}
unset($item);
?>

<style>
    .dashboard-summary-table th, .dashboard-summary-table td { vertical-align:middle !important; }
    .dashboard-summary-table td.text-center { white-space:nowrap; }
    .dashboard-summary-table .label { display:inline-block; min-width:34px; }
    @media (max-width:767px) { .dashboard-summary-table { min-width:620px; } }
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
        <div class="callout callout-info" style="margin-bottom:15px;">
            <h4><i class="fa fa-clock-o"></i> <?php echo $total_dashboard_menunggu; ?> surat menunggu persetujuan</h4>
            <p>Ringkasan status persetujuan surat berdasarkan jenis.</p>
        </div>

        <div class="row">
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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dashboard-summary-table">
                        <thead><tr class="info">
                            <th>Jenis Surat</th>
                            <th class="text-center"><span class="label label-warning">Menunggu</span></th>
                            <th class="text-center"><span class="label label-success">Disetujui</span></th>
                            <th class="text-center"><span class="label label-danger">Ditolak</span></th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Daftar</th>
                        </tr></thead>
                        <tbody>
                            <?php foreach ($dashboard_surat as $surat): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($surat['label'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="text-center"><span class="label label-warning"><?php echo $surat['jumlah_menunggu']; ?></span></td>
                                    <td class="text-center"><span class="label label-success"><?php echo $surat['jumlah_disetujui']; ?></span></td>
                                    <td class="text-center"><span class="label label-danger"><?php echo $surat['jumlah_ditolak']; ?></span></td>
                                    <td class="text-center"><strong><?php echo $surat['total']; ?></strong></td>
                                    <td class="text-center"><a class="btn btn-primary btn-xs" href="<?php echo htmlspecialchars($surat['url'], ENT_QUOTES, 'UTF-8'); ?>"><i class="fa fa-list"></i> Lihat</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</aside>
