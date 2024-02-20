<!DOCTYPE html>
<?php
    include"config/koneksi.php";
    include"assets/js/date.php";
    error_reporting(0);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Poltekkes Kemenkes Bengkulu</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    </head>
    <body>
        <div class="container-fluid">
            <div align="center">
                <div class="col-md-4">
                    <img src="https://poltekkesbengkulu.ac.id/wp-content/uploads/2022/09/cropped-1.lg_web-removebg-preview.png">
                    <?php 
                        if(isset($_POST['daftar']))
                        {
                            $nim    = addslashes($_POST['nim']);
                            $nama    = addslashes($_POST['nama']);
                            $pw    = addslashes($_POST['password']);

                            $gnim=mysqli_query($kon,"select * from tb_user where username='$nim'");
                            if(mysqli_num_rows($gnim)==0)
                            {
                                $daftar=mysqli_query($kon,"insert into tb_user (username,nama_lengkap,password,level) values ('$nim','$nama','$pw','mahasiswa')");
                                if($daftar)
                                {
                                    ?>
                                    <div class="alert alert-success">
                                        <b>Sukses</b> Akun berhasil didaftarkan
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <div class="alert alert-danger">
                                        <b>Gagal</b> Akun gagal didaftarkan
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-danger">
                                    <b>Gagal</b> Akun sudah pernah didaftarkan sebelumnya.
                                </div>
                                <?php
                            }

                            echo "<br>";
                        }
                    ?>  


                    <div class="card">
                        <div class="card-header bg-success text-white">
                            Daftar
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>NIM <br><small class="text-danger">Contoh : P05120213020</small></label>
                                    <input type="text" name="nim" class="form-control" autofocus required placeholder="Contoh : P05120213020">
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-success" name="daftar">Daftar</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="login.php" class="btn-link" >Klik disini</a> Untuk Login
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</html>