<?php
include"01_nav.php";  
session_start();
?>

<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="small-box bg-green" style="height:auto;">

                        <div class="inner">

                            <h3 style="
                                font-size:24px;
                                white-space:normal;
                                word-wrap:break-word;
                            ">
                                Selamat Datang 
                                <?php echo $_SESSION['nama']; ?>
                            </h3>

                            <p>
                                Terima Kasih Telah Berkunjung di Aplikasi Administrasi Kemahasiswaan
                            </p>

                        </div>

                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
           