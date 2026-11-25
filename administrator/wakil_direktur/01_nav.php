<!DOCTYPE html>
<?php
    include "session.php";
    $wadirCurrentPage = basename($_SERVER['PHP_SELF'] ?? '');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Poltekkes Kemenkes Bengkulu - Wakil Direktur</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
        <link rel="shortcut icon" type="image/x-icon" href="../assets/favicon.ico">
        <style>
            :root {
                --wadir-green: #087f5b;
                --wadir-green-deep: #075b45;
                --wadir-ink: #19342d;
                --wadir-muted: #71817b;
                --wadir-canvas: #f3f7f5;
                --wadir-line: #e3ece7;
                --wadir-shadow: 0 16px 38px rgba(25, 60, 47, .08);
            }
            body.wadir-shell {
                background: var(--wadir-canvas);
                color: var(--wadir-ink);
                font-family: "Segoe UI", Inter, -apple-system, BlinkMacSystemFont, sans-serif;
                -webkit-font-smoothing: antialiased;
            }
            body.wadir-shell .header {
                background: linear-gradient(105deg, #075b45 0%, #087f5b 65%, #12966b 100%);
                box-shadow: 0 5px 20px rgba(7, 91, 69, .18);
            }
            body.wadir-shell .header .logo {
                background: transparent;
                color: #fff;
                border-right: 0;
                font-weight: 700;
                letter-spacing: .02em;
            }
            body.wadir-shell .header .navbar { background: transparent; }
            body.wadir-shell .header .navbar .navbar-btn { color: #fff; }
            body.wadir-shell .header .navbar .navbar-btn .icon-bar {
                background: rgba(255,255,255,.88) !important;
            }
            body.wadir-shell .header .navbar .navbar-btn:hover,
            body.wadir-shell .header .navbar .navbar-btn:focus {
                border-radius: 9px;
                background: rgba(255,255,255,.12) !important;
            }
            body.wadir-shell .header .navbar-nav > li > a {
                color: rgba(255,255,255,.92);
                font-size: 13px;
            }
            body.wadir-shell .header .navbar-nav > li.wadir-topbar-title {
                padding: 0 22px;
                color: rgba(255,255,255,.94);
                font-size: 13px;
                font-weight: 600;
                line-height: 50px;
                white-space: nowrap;
            }
            body.wadir-shell.skin-black .sidebar { border-bottom: 0 !important; }
            body.wadir-shell.skin-black .sidebar > .sidebar-menu > li,
            body.wadir-shell.skin-black .sidebar > .sidebar-menu > li:first-of-type {
                border: 0 !important;
            }
            body.wadir-shell .left-side {
                background: #fff;
                border-right: 1px solid var(--wadir-line);
                box-shadow: 7px 0 24px rgba(25,60,47,.035);
            }
            body.wadir-shell .sidebar { padding-top: 14px; }
            body.wadir-shell .user-panel {
                margin: 2px 18px 18px;
                padding: 15px 12px;
                border: 1px solid var(--wadir-line);
                border-radius: 15px;
                background: linear-gradient(145deg, #f8fcfa, #edf7f2);
            }
            body.wadir-shell .user-panel .image-center { list-style: none; text-align: center; }
            body.wadir-shell .user-panel .user-image {
                display: inline-block;
                float: none;
                width: 86px;
                max-width: 100%;
                height: auto;
                padding: 8px;
                background: #fff;
                border: 1px solid #e0eee7;
                border-radius: 18px;
                box-shadow: 0 7px 18px rgba(7,91,69,.08);
            }
            body.wadir-shell .sidebar-menu { padding: 0 12px 18px; }
            body.wadir-shell .sidebar-menu > .header {
                height: auto;
                margin: 0 4px 12px;
                padding: 12px 10px;
                border: 0;
                background: transparent;
                color: var(--wadir-ink);
                line-height: 1.6;
            }
            body.wadir-shell .sidebar-menu > .header b { font-size: 13px; }
            body.wadir-shell .sidebar-menu > .header small { color: var(--wadir-muted); }
            body.wadir-shell .sidebar-menu > li:not(.header) { margin: 4px 0; }
            body.wadir-shell .sidebar-menu > li > a {
                padding: 12px 13px;
                border-radius: 11px;
                border: 0 !important;
                color: #52645d;
                font-size: 13px;
                transition: background .2s ease, color .2s ease, transform .2s ease;
            }
            body.wadir-shell .sidebar-menu > li > a:hover {
                background: #eff8f3 !important;
                color: var(--wadir-green-deep) !important;
                transform: translateX(3px);
            }
            body.wadir-shell .sidebar-menu > li.active > a,
            body.wadir-shell .sidebar-menu > li.active > a:hover {
                background: linear-gradient(100deg, #e8f6ee, #f3faf6) !important;
                color: var(--wadir-green-deep) !important;
                font-weight: 600;
                box-shadow: inset 3px 0 #0b8a61;
            }
            body.wadir-shell.skin-black .sidebar > .sidebar-menu > li > a:hover,
            body.wadir-shell.skin-black .sidebar > .sidebar-menu > li.active > a,
            body.wadir-shell.skin-black .sidebar > .sidebar-menu > li.active > a:hover {
                background: linear-gradient(100deg, #e8f6ee, #f3faf6) !important;
                color: var(--wadir-green-deep) !important;
            }
            body.wadir-shell .sidebar-menu > li > a > .fa {
                width: 20px;
                color: #729087;
            }
            body.wadir-shell .sidebar-menu > li.active > a > .fa { color: var(--wadir-green); }
            body.wadir-shell .right-side { background: var(--wadir-canvas); }
            body.wadir-shell .content-header {
                padding: 22px 24px 12px;
                background: transparent;
            }
            body.wadir-shell .content-header h1 {
                color: var(--wadir-ink);
                font-size: 25px;
                font-weight: 700;
                letter-spacing: -.025em;
            }
            body.wadir-shell .content-header h1 small { color: var(--wadir-muted); font-size: 13px; }
            body.wadir-shell .breadcrumb {
                top: 25px;
                right: 24px;
                padding: 7px 11px;
                border: 1px solid var(--wadir-line);
                border-radius: 20px;
                background: rgba(255,255,255,.75);
            }
            body.wadir-shell .breadcrumb > li,
            body.wadir-shell .breadcrumb > li a { color: #6f8079; }
            body.wadir-shell .breadcrumb { display: none !important; }
            body.wadir-shell > .no-print { display: none !important; }
            body.wadir-shell .content { padding: 12px 24px 30px; }
            body.wadir-shell .box,
            body.wadir-shell .nav-tabs-custom {
                overflow: hidden;
                border: 1px solid var(--wadir-line);
                border-top: 0;
                border-radius: 16px;
                background: #fff;
                box-shadow: var(--wadir-shadow);
            }
            body.wadir-shell .box-header {
                padding: 16px 20px;
                border-bottom: 1px solid var(--wadir-line);
                background: #fff;
            }
            body.wadir-shell .box-title { color: var(--wadir-ink); font-size: 15px; font-weight: 700; }
            body.wadir-shell .box-body { padding: 18px 20px; }
            body.wadir-shell .table { color: #344b42; }
            body.wadir-shell .table > thead > tr > th {
                border-bottom: 1px solid #dce9e2;
                background: #f3f8f5;
                color: #5a7066;
                font-size: 11px;
                letter-spacing: .045em;
                text-transform: uppercase;
            }
            body.wadir-shell .table > tbody > tr > td { border-color: #edf2ef; }
            body.wadir-shell .table-hover > tbody > tr:hover { background: #f7fbf8; }
            body.wadir-shell .btn { border-radius: 8px; transition: transform .18s ease, box-shadow .18s ease, filter .18s ease; }
            body.wadir-shell .btn:hover { transform: translateY(-1px); box-shadow: 0 5px 12px rgba(25,60,47,.12); }
            body.wadir-shell .alert { border: 0; border-radius: 12px; box-shadow: 0 8px 22px rgba(25,60,47,.06); }
            body.wadir-shell .search-bar-wrap .form-control,
            body.wadir-shell .search-bar-wrap .input-group-addon,
            body.wadir-shell .search-bar-wrap .btn { min-height: 38px; border-color: var(--wadir-line); }
            body.wadir-shell .search-bar-wrap .form-control { border-radius: 9px 0 0 9px; box-shadow: none; }
            body.wadir-shell .search-bar-wrap .input-group-addon { border-radius: 9px 0 0 9px; background: #f6faf7; color: #779087; }
            body.wadir-shell .search-bar-wrap .input-group-addon + .form-control { border-radius: 0; }
            body.wadir-shell .paginationw ul.pagination > li > a,
            body.wadir-shell .paginationw ul.pagination > li > span {
                margin: 0 2px;
                border: 1px solid var(--wadir-line);
                border-radius: 7px !important;
                color: var(--wadir-green-deep);
            }
            body.wadir-shell .paginationw ul.pagination > .active > a,
            body.wadir-shell .paginationw ul.pagination > .active > span { border-color: var(--wadir-green); background: var(--wadir-green); color: #fff; }
            body.wadir-shell .label { border-radius: 20px; padding: .38em .72em; }
            body.wadir-shell .wadir-filter-toolbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                padding: 13px 16px;
                border-bottom: 1px solid var(--wadir-line);
                background: #fff;
            }
            body.wadir-shell .wadir-status-tabs { display: flex; min-width: 0; align-items: center; gap: 7px; }
            body.wadir-shell .wadir-filter-chip {
                display: inline-flex;
                min-height: 36px;
                align-items: center;
                justify-content: center;
                padding: 7px 12px;
                border: 1px solid transparent;
                border-radius: 20px;
                color: #60746a;
                font-size: 12px;
                font-weight: 600;
                text-decoration: none;
                white-space: nowrap;
                transition: background .18s ease, color .18s ease, transform .18s ease;
            }
            body.wadir-shell .wadir-filter-chip:hover,
            body.wadir-shell .wadir-filter-chip.active { background: #eaf6ef; color: var(--wadir-green-deep); text-decoration: none; }
            body.wadir-shell .wadir-filter-chip:active { transform: scale(.97); }
            body.wadir-shell .wadir-bulk-form { flex: 0 0 auto; margin: 0; }
            body.wadir-shell .wadir-bulk-form .btn { min-height: 38px; padding: 8px 14px; }
            body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards { width: 100%; }
            body.wadir-shell .small-box {
                overflow: hidden;
                min-height: 158px;
                border-radius: 16px;
                box-shadow: var(--wadir-shadow);
                transition: transform .24s ease, box-shadow .24s ease;
                animation: wadir-rise .55s both;
            }
            body.wadir-shell .small-box:hover { transform: translateY(-5px); box-shadow: 0 22px 42px rgba(25,60,47,.15); }
            body.wadir-shell .small-box .small-box-footer { padding: 11px 14px; background: rgba(0,0,0,.12); text-align: left; }
            body.wadir-shell .small-box .inner { padding: 20px; }
            body.wadir-shell .small-box .inner h3 { font-size: 34px; }
            body.wadir-shell .small-box .icon { top: 16px; right: 18px; opacity: .27; transition: transform .25s ease, opacity .25s ease; }
            body.wadir-shell .small-box:hover .icon { opacity: .42; transform: scale(1.08) rotate(-5deg); }
            body.wadir-shell .callout { border-radius: 13px; box-shadow: 0 8px 22px rgba(25,60,47,.05); }
            body.wadir-shell .nav-tabs-custom > .nav-tabs > li.active { border-top-color: var(--wadir-green); }
            body.wadir-shell .nav-tabs-custom > .nav-tabs > li > a { color: #60746a; }
            body.wadir-shell .nav-tabs-custom > .nav-tabs > li.active > a { color: var(--wadir-green-deep); font-weight: 600; }
            body.wadir-shell .right-side > .content-header,
            body.wadir-shell .right-side > .content { animation: wadir-fade-in .4s ease both; }
            body.wadir-shell .wadir-mobile-tabbar { display: none; }
            @keyframes wadir-rise { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
            @keyframes wadir-fade-in { from { opacity: 0; } to { opacity: 1; } }
            .badge-menunggu  { background-color: #f39c12; }
            .badge-disetujui { background-color: #00a65a; }
            .badge-ditolak   { background-color: #dd4b39; }
            body.sidebar-collapsed > .header .logo { display: none !important; }
            body.sidebar-collapsed > .header .navbar { margin-left: 0 !important; }
            @media (max-width: 767px) {
                body.wadir-shell > .header {
                    position: relative;
                    display: block;
                    height: 58px;
                    min-height: 58px;
                }
                body.wadir-shell > .header .logo {
                    display: block !important;
                    float: none;
                    width: 100%;
                    height: 58px;
                    padding: 0 12px;
                    font-size: 21px;
                    line-height: 58px;
                    text-align: center;
                }
                body.wadir-shell > .header .navbar { display: none; }
                body.wadir-shell .left-side.sidebar-offcanvas { display: none !important; }
                body.wadir-shell .right-side {
                    width: 100% !important;
                    margin-left: 0 !important;
                    padding-bottom: calc(78px + env(safe-area-inset-bottom));
                }
                body.wadir-shell .wadir-filter-toolbar {
                    display: grid;
                    gap: 10px;
                    padding: 12px;
                }
                body.wadir-shell .wadir-status-tabs {
                    width: 100%;
                    overflow-x: auto;
                    padding-bottom: 2px;
                    scrollbar-width: none;
                    -webkit-overflow-scrolling: touch;
                }
                body.wadir-shell .wadir-status-tabs::-webkit-scrollbar { display: none; }
                body.wadir-shell .wadir-filter-chip { flex: 0 0 auto; min-height: 36px; padding: 7px 10px; font-size: 11px; }
                body.wadir-shell .wadir-bulk-form,
                body.wadir-shell .wadir-bulk-form .btn { width: 100%; }
                body.wadir-shell .table-responsive-wrap { overflow: visible !important; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards,
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody {
                    display: block;
                    width: 100%;
                    min-width: 0 !important;
                    border: 0;
                    background: transparent;
                }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > thead { display: none; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr {
                    display: block;
                    margin: 0 0 12px;
                    padding: 10px 14px;
                    border: 1px solid #e5eee9;
                    border-radius: 14px;
                    background: #fff !important;
                    box-shadow: 0 7px 20px rgba(25,60,47,.055);
                }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td {
                    display: grid;
                    grid-template-columns: 86px minmax(0,1fr);
                    align-items: start;
                    gap: 8px;
                    width: 100%;
                    padding: 8px 0 !important;
                    border: 0 !important;
                    border-bottom: 1px solid #f0f4f1 !important;
                    background: transparent !important;
                    color: #334b41;
                    font-size: 12px;
                    line-height: 1.45;
                    text-align: left !important;
                    white-space: normal !important;
                    overflow-wrap: anywhere;
                }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td::before {
                    color: #84958d;
                    content: attr(data-mobile-label);
                    font-size: 10px;
                    font-weight: 700;
                    letter-spacing: .035em;
                    text-transform: uppercase;
                }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td:nth-child(1) { display: none; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td:nth-child(2) {
                    display: block;
                    padding: 4px 0 11px !important;
                    border-bottom: 1px solid #eaf0ec !important;
                    color: #193c30;
                    font-size: 15px;
                    font-weight: 700;
                }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td:nth-child(2)::before { content: none; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td:last-child { border-bottom: 0 !important; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td[data-mobile-label="Status"] { align-items: center; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td[data-mobile-label="Aksi"] { display: block; padding-top: 11px !important; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards > tbody > tr > td[data-mobile-label="Aksi"]::before { display: block; margin-bottom: 8px; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards .action-buttons { justify-content: flex-start; gap: 8px; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards .action-buttons .btn { min-height: 36px; padding: 8px 12px; }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards td[colspan] {
                    display: block !important;
                    padding: 14px 4px !important;
                    border: 0 !important;
                    text-align: center !important;
                }
                body.wadir-shell .table-responsive-wrap table.wadir-mobile-cards td[colspan]::before { content: none; }
                body.wadir-shell .wadir-mobile-tabbar {
                    position: fixed;
                    z-index: 1040;
                    right: 0;
                    bottom: 0;
                    left: 0;
                    display: grid;
                    grid-template-columns: repeat(5, minmax(0, 1fr));
                    min-height: calc(66px + env(safe-area-inset-bottom));
                    padding: 7px 5px calc(7px + env(safe-area-inset-bottom));
                    border-top: 1px solid rgba(20, 70, 52, .1);
                    background: rgba(255,255,255,.96);
                    box-shadow: 0 -8px 28px rgba(23, 62, 47, .1);
                    backdrop-filter: blur(16px);
                }
                body.wadir-shell .wadir-mobile-tabbar a {
                    display: flex;
                    min-width: 0;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    gap: 4px;
                    border-radius: 11px;
                    color: #74847d;
                    font-size: 9px;
                    font-weight: 600;
                    line-height: 1.1;
                    text-align: center;
                    text-decoration: none;
                    transition: color .18s ease, background .18s ease, transform .18s ease;
                    -webkit-tap-highlight-color: transparent;
                }
                body.wadir-shell .wadir-mobile-tabbar a .fa { font-size: 17px; }
                body.wadir-shell .wadir-mobile-tabbar a:active { transform: scale(.94); }
                body.wadir-shell .wadir-mobile-tabbar a.active {
                    color: var(--wadir-green-deep);
                    background: #eaf6ef;
                }
                body.wadir-shell .content-header { padding: 18px 15px 10px; }
                body.wadir-shell .content-header h1 { font-size: 21px; }
                body.wadir-shell .breadcrumb { position: static; float: none; display: inline-block; margin-top: 8px; }
                body.wadir-shell .content { padding: 10px 14px 22px; }
                body.wadir-shell .box-body { padding: 14px; }
            }
            @media (prefers-reduced-motion: reduce) {
                body.wadir-shell *, body.wadir-shell *::before, body.wadir-shell *::after {
                    animation-duration: .01ms !important;
                    animation-iteration-count: 1 !important;
                    scroll-behavior: auto !important;
                    transition-duration: .01ms !important;
                }
            }
        </style>
    </head>
    <body class="skin-black wadir-shell">
        <header class="header">
            <a href="index.php" class="logo">
                Kemahasiswaan
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="wadir-topbar-title">
                            <span>Sistem Informasi Kemahasiswaan Poltekkes Kemenkes Bengkulu</span>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <li class="image-center">
                            <img src="../assets/img/logo.polkeslu.png" class="user-image img-responsive" />
                        </li>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="header">
                            <b><?php echo htmlspecialchars($_SESSION['nama_lengkap'] ?? 'Wakil Direktur', ENT_QUOTES, 'UTF-8'); ?></b><br>
                            <small>Wakil Direktur / Kasubak ADAK</small>
                        </li>
                        <li class="<?php echo $wadirCurrentPage === 'index.php' ? 'active' : ''; ?>">
                            <a href="index.php">
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php echo $wadirCurrentPage === '03_persetujuan_surat_keterangan_masih_kuliah.php' ? 'active' : ''; ?>">
                            <a href="03_persetujuan_surat_keterangan_masih_kuliah.php">
                                <span>Surat Masih Kuliah</span>
                            </a>
                        </li>
                        <li class="<?php echo $wadirCurrentPage === '05_persetujuan_surat_pra_penelitian.php' ? 'active' : ''; ?>">
                            <a href="05_persetujuan_surat_pra_penelitian.php">
                                <span>Surat Pra Penelitian</span>
                            </a>
                        </li>
                        <li class="<?php echo $wadirCurrentPage === '04_persetujuan_surat_penelitian.php' ? 'active' : ''; ?>">
                            <a href="04_persetujuan_surat_penelitian.php">
                                <span>Surat Penelitian</span>
                            </a>
                        </li>
                        <li class="wadir-logout">
                            <a href="logout.php">
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>

            <nav class="wadir-mobile-tabbar" aria-label="Navigasi utama">
                <a class="<?php echo $wadirCurrentPage === 'index.php' ? 'active' : ''; ?>" href="index.php">
                    <i class="fa fa-th-large" aria-hidden="true"></i><span>Dashboard</span>
                </a>
                <a class="<?php echo $wadirCurrentPage === '03_persetujuan_surat_keterangan_masih_kuliah.php' ? 'active' : ''; ?>" href="03_persetujuan_surat_keterangan_masih_kuliah.php">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Masih Kuliah</span>
                </a>
                <a class="<?php echo $wadirCurrentPage === '05_persetujuan_surat_pra_penelitian.php' ? 'active' : ''; ?>" href="05_persetujuan_surat_pra_penelitian.php">
                    <i class="fa fa-flask" aria-hidden="true"></i><span>Pra Penelitian</span>
                </a>
                <a class="<?php echo $wadirCurrentPage === '04_persetujuan_surat_penelitian.php' ? 'active' : ''; ?>" href="04_persetujuan_surat_penelitian.php">
                    <i class="fa fa-search" aria-hidden="true"></i><span>Penelitian</span>
                </a>
                <a href="logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i><span>Keluar</span>
                </a>
            </nav>

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets///cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../assets/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="../assets/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="../assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <script src="../assets/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="../assets/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <script src="../assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="../assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script src="../assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script src="../assets/js/AdminLTE/app.js?v=sidebar-brand-20261124" type="text/javascript"></script>
        <script src="../assets/js/AdminLTE/dashboard.js" type="text/javascript"></script>
    </body>
</html>
