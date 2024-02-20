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
                      <br><?php 
                        if(isset($_POST['login']))
                        {
                            $nim    = addslashes($_POST['nim']);
                            $pw    = addslashes($_POST['password']);

                            $gnim=mysqli_query($kon,"select * from tb_user where username='$nim' and password='$pw' and level='mahasiswa'");
                            if(mysqli_num_rows($gnim)>0)
                            {
                                session_start();
                                $_SESSION['nim']=$nim;
                                $_SESSION['level']='mahasiswa';
                                header("location:index.php");
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-danger">
                                    <b>Gagal</b> Username atau Password tidak sesuai. Atau anda belum terdaftar
                                </div>
                                <?php
                            }
                        }


                    ?>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Login
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>NIM</label>
                                    <input type="text" name="nim" class="form-control" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary" name="login">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="daftar.php" class="btn-link" >Klik disini</a> Untuk daftar
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</html>