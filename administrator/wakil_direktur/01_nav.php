<!DOCTYPE html>
<?php
    include "session.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Poltekkes Kemenkes Bengkulu - Wakil Direktur</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <style>
            .badge-menunggu  { background-color: #f39c12; }
            .badge-disetujui { background-color: #00a65a; }
            .badge-ditolak   { background-color: #dd4b39; }
        </style>
    </head>
    <body class="skin-black">
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
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span>Sistem Informasi Kemahasiswaan Poltekkes Kemenkes Bengkulu</span>
                            </a>
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
                        <img src="../assets/img/logo-poltekkes-bengkulu.png" class="user-image img-responsive" />
                    </li>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="header">
                            <b><?php echo $_SESSION['nama_lengkap']; ?></b><br>
                            <small>Wakil Direktur / Kasubak ADAK</small>
                        </li>

                        <li>
                            <a href="index.php">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href=""><i class="fa fa-envelope"></i> Persetujuan Surat
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!-- <li>
                                    <a href="02_persetujuan_surat_keterangan_lulus.php">
                                        <i class="fa fa-circle-o"></i>
                                        <span>Surat Keterangan Lulus</span>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="03_persetujuan_surat_keterangan_masih_kuliah.php">
                                        <i class="fa fa-circle-o"></i>
                                        <span>Surat Masih Kuliah</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="05_persetujuan_surat_pra_penelitian.php">
                                        <i class="fa fa-circle-o"></i>
                                        <span>Surat Pra Penelitian</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="04_persetujuan_surat_penelitian.php">
                                        <i class="fa fa-circle-o"></i>
                                        <span>Surat Penelitian</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>

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
        <script src="../assets/js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../assets/js/AdminLTE/dashboard.js" type="text/javascript"></script>
    </body>
</html>
