<?php
include "01_nav.php";
include "../config/koneksi.php";
error_reporting(0);

$id = (int) ($_GET['id_user'] ?? 0);
if (!$id) { echo "<script>window.location.href='user_edit.php';</script>"; exit; }

// Ambil data user
$data = mysqli_fetch_assoc(mysqli_query($kon, "SELECT * FROM tb_user WHERE id_user=$id"));
if (!$data) { echo "<script>window.location.href='user_edit.php';</script>"; exit; }

if (isset($_POST['submit'])) {
    $username     = mysqli_real_escape_string($kon, trim($_POST['username']));
    $nama_lengkap = mysqli_real_escape_string($kon, trim($_POST['nama_lengkap']));
    $password     = mysqli_real_escape_string($kon, trim($_POST['password']));
    $level        = mysqli_real_escape_string($kon, $_POST['level']);

    // Cek username duplikat (kecuali milik sendiri)
    $cek_query = mysqli_query($kon, "SELECT id_user FROM tb_user WHERE username='$username' AND id_user != $id");
    if (mysqli_num_rows($cek_query) > 0) {
        $error = "Username <strong>$username</strong> sudah digunakan user lain.";
    } else {
        $sql = mysqli_query($kon, "UPDATE tb_user SET username='$username', nama_lengkap='$nama_lengkap', password='$password', level='$level' WHERE id_user=$id");
        if ($sql) {
            echo "<script>window.location.href='user_edit.php?pesan=edit';</script>";
            exit;
        } else {
            $error = "Gagal memperbarui data: " . mysqli_error($kon);
        }
    }
}
?>

<aside class="right-side">
    <section class="content-header">
        <h1>Edit <small>User</small></h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="user_edit.php">Daftar User</a></li>
            <li class="active">Edit User</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Edit User</h3>
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
                                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($_POST['username'] ?? $data['username']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($_POST['nama_lengkap'] ?? $data['nama_lengkap']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($_POST['password'] ?? $data['password']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select name="level" class="form-control" required>
                                    <option value="">-- Pilih Level --</option>
                                    <?php
                                    $levels = ['administrator','karyawan','mahasiswa','wakil_direktur'];
                                    $selected_level = $_POST['level'] ?? $data['level'];
                                    foreach ($levels as $lv) {
                                        $sel = ($selected_level == $lv) ? 'selected' : '';
                                        $label = ucfirst(str_replace('_', ' ', $lv));
                                        echo "<option value='$lv' $sel>$label</option>";
                                    }
                                    ?>
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