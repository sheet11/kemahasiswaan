<?php
include "01_nav.php";
include "../config/koneksi.php";
error_reporting(0);

if (isset($_POST['submit'])) {
    $username     = mysqli_real_escape_string($kon, trim($_POST['username']));
    $nama_lengkap = mysqli_real_escape_string($kon, trim($_POST['nama_lengkap']));
    $password     = mysqli_real_escape_string($kon, trim($_POST['password']));
    $level        = mysqli_real_escape_string($kon, $_POST['level']);

    // Cek username sudah ada atau belum
    $cek_query = mysqli_query($kon, "SELECT id_user FROM tb_user WHERE username='$username'");
    $cek = $cek_query ? mysqli_num_rows($cek_query) : 0;
    if ($cek > 0) {
        $error = "Username <strong>$username</strong> sudah digunakan. Gunakan username lain.";
    } else {
        $sql = mysqli_query($kon, "INSERT INTO tb_user (username, nama_lengkap, password, level)
                                   VALUES ('$username', '$nama_lengkap', '$password', '$level')");
        if ($sql) {
            echo "<script>window.location.href='user_edit.php?pesan=berhasil';</script>";
            exit;
        } else {
            $error = "Gagal menyimpan data: " . mysqli_error($kon);
        }
    }
}
?>

<aside class="right-side">
    <section class="content-header">
        <h1>Tambah <small>User Baru</small></h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="user_edit.php">Daftar User</a></li>
            <li class="active">Tambah User</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Tambah User</h3>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" style="margin:15px;">
                            <i class="fa fa-times"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <div class="box-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" value="<?php echo isset($_POST['nama_lengkap']) ? htmlspecialchars($_POST['nama_lengkap']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Masukkan password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select name="level" class="form-control" required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="administrator"  <?php echo (isset($_POST['level']) && $_POST['level']=='administrator')  ? 'selected' : ''; ?>>Administrator</option>
                                    <option value="karyawan"       <?php echo (isset($_POST['level']) && $_POST['level']=='karyawan')       ? 'selected' : ''; ?>>Karyawan</option>
                                    <option value="mahasiswa"      <?php echo (isset($_POST['level']) && $_POST['level']=='mahasiswa')      ? 'selected' : ''; ?>>Mahasiswa</option>
                                    <option value="wakil_direktur" <?php echo (isset($_POST['level']) && $_POST['level']=='wakil_direktur') ? 'selected' : ''; ?>>Wakil Direktur</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top:20px;">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                                <a href="user_edit.php" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>