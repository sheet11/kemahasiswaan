<!DOCTYPE html>
<?php
    session_start();

    if(empty($_SESSION['nim']))
    {
        header("location:login.php");
    }
    include"config/koneksi.php";
    include"assets/js/date.php";
    error_reporting(0);

    $u=mysqli_fetch_array(mysqli_query($kon,"select * from tb_user where username='$_SESSION[nim]'"));
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Poltekkes Kemenkes Bengkulu</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="assets/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="assets/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="assets/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Kemahasiswaan
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
          
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">                                
                                <span>Sistem Informasi Kemahasiswaan Poltekkes Kemenkes Bengkulu</span>
                            </a>
                            
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <li class="image-center">
                        <img src="assets/img/logo.png" class="user-image img-responsive"/>
                    </li>
                        
                    </div>
                    <!-- search form -->
                    
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="02_daftar_surat_keterangan_lulus.php">
                                <i class="fa fa-laptop"></i>
                                <span>Surat Keterangan Lulus</span>
                            </a>
                        </li>

                        <li>
                            <a href="03_daftar_surat_keterangan_masih_kuliah.php">
                                <i class="fa fa-laptop"></i>
                                <span>Surat Izin Masih Kuliah</span>
                            </a>
                        </li>
                        <li>
                            <a href="05_daftar_surat_pra_penelitian.php">
                                <i class="fa fa-laptop"></i>
                                <span>Surat Izin Pra Penelitian</span>
                            </a>
                        </li>

                        <li>
                            <a href="04_daftar_surat_penelitian.php">
                                <i class="fa fa-laptop"></i>
                                <span>Surat Izin Penelitian</span>
                            </a>
                        </li>     

                         <li>
                            <a href="https://goo.gl/forms/BxvELCWTshsLvGbv1">
                                <i class="fa fa-laptop"></i>
                                <span>Questioner Tracer Studi Alumni</span>
                            </a>
                        </li>    
                         <li>
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSeQM4upbqVCoHHn5SHgHnxBeAGNTtX0h7-tYXjFfy5jzvOpLg/viewform">
                                <i class="fa fa-laptop"></i>
                                <span>Questioner Tracer Studi Pengguna</span>
                            </a>
                        </li>    
                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i>
                                <span>Log Out</span>
                            </a>
                        </li>                  
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

    


        <!-- jQuery 2.0.2 -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="assets///cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="assets/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="assets/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="assets/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="assets/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="assets/js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="assets/js/AdminLTE/dashboard.js" type="text/javascript"></script>        

    </body>
</html>