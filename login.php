<!DOCTYPE html>
<?php
    include "config/koneksi.php";
    include "assets/js/date.php";
    error_reporting(0);
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login — Poltekkes Kemenkes Bengkulu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        body {
             min-height: 100vh;
            background: linear-gradient(135deg, #eaf3f8 0%, #f0f7f4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-wrapper { width: 100%; max-width: 420px; padding: 1.5rem; }
        .logo-circle {
            width: 80px; height: 80px;
            background: #fff;
            border-radius: 50%;
            border: 1px solid #c8dfe9;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .login-card { border: 1px solid #b2dfd0; border-radius: 12px; overflow: hidden; }
        .login-card-header {
            background: #0F6E56;
            padding: 1rem 1.5rem;
            display: flex; align-items: center; gap: 10px;
        }
        .login-card-body { padding: 1.75rem 1.5rem 1.5rem; }
        .form-label { font-size: 13px; font-weight: 500; color: #444441; }
        .form-control {
            font-size: 14px;
            background: #F6FBF9;
            border: 1px solid #9FE1CB;
            border-radius: 8px;
            padding: 10px 12px;
        }
        .form-control:focus {
            border-color: #1D9E75;
            box-shadow: 0 0 0 3px rgba(29,158,117,0.12);
            background: #fff;
        }
        .pw-wrapper { position: relative; }
        .pw-toggle {
            position: absolute; right: 10px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; color: #888780; padding: 0;
        }
        .btn-login {
            width: 100%; padding: 11px;
            background: #0F6E56; color: #fff;
            border: none; border-radius: 8px;
            font-size: 14px; font-weight: 500;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: background 0.2s;
        }
        .btn-login:hover { background: #085041; color: #fff; }
        .login-card-footer {
            border-top: 1px solid #E1F5EE;
            background: #f7fbf9;
            padding: 1rem 1.5rem;
            text-align: center;
            font-size: 13px; color: #5F5E5A;
        }
        .login-card-footer a { color: #0F6E56; font-weight: 500; text-decoration: none; }
        .alert-danger { border-radius: 8px; font-size: 13px; padding: 10px 14px; }
    </style>
</head>
<body>

<?php
if (isset($_POST['login'])) {
    $nim = addslashes($_POST['nim']);
    $pw  = addslashes($_POST['password']);

    $gnim = mysqli_query($kon, "SELECT * FROM tb_user WHERE username='$nim' AND password='$pw' AND level='mahasiswa'");
    if (mysqli_num_rows($gnim) > 0) {
        $data = mysqli_fetch_array($gnim);
        session_start();
        $_SESSION['nim']   = $data['username'];
        $_SESSION['nama']  = $data['nama_lengkap'];
        $_SESSION['level'] = $data['level'];
        header("location: index.php");
        exit;
    } else {
        $error = "NIM atau password tidak valid. Silakan coba lagi.";
    }
}
?>

<div class="login-wrapper">

    <div class="text-center mb-4">
        <img src="assets/img/logo.polkeslu.png" alt="Logo Poltekkes" style="width: 110px; height: auto; margin-bottom: 0.75rem;">
        <h1 style="font-size: 17px; font-weight: 600; color: #1D9E75; margin: 0 0 4px;">Sistem Informasi Kemahasiswaan</h1>
        <!-- <p style="font-size: 13px; color: #5F5E5A; margin: 0;">Sistem Informasi Kemahasiswaan</p> -->
    </div>

    <div class="login-card">

        <div class="login-card-header">
            <i class="ti ti-login" style="font-size: 18px; color: #B5D4F4;"></i>
            <span style="font-size: 15px; font-weight: 500; color: #fff;">Masuk ke Akun Anda</span>
        </div>

        <div class="login-card-body">

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                    <i class="ti ti-alert-circle" style="font-size: 16px;"></i>
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">
                        <i class="ti ti-id-badge" style="font-size: 14px; vertical-align: -2px; margin-right: 4px; color: #1D9E75;"></i>NIM
                    </label>
                    <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM Anda" autofocus required>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="ti ti-lock" style="font-size: 14px; vertical-align: -2px; margin-right: 4px; color: #1D9E75;"></i>Password
                    </label>
                    <div class="pw-wrapper">
                        <input type="password" name="password" id="pw-input" class="form-control pe-5" placeholder="Masukkan password Anda" required>
                        <button type="button" class="pw-toggle" onclick="var el=document.getElementById('pw-input');el.type=el.type==='password'?'text':'password';this.querySelector('i').className='ti '+(el.type==='password'?'ti-eye':'ti-eye-off')">
                            <i class="ti ti-eye" style="font-size: 16px;"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" name="login" class="btn-login">
                    <i class="ti ti-login-2" style="font-size: 16px;"></i> Login
                </button>
            </form>
        </div>

        <div class="login-card-footer">
            <i class="ti ti-user-plus" style="font-size: 14px; vertical-align: -2px; margin-right: 4px; color: #1D9E75;"></i>
            Belum punya akun? <a href="daftar.php">Daftar di sini</a>
        </div>

    </div>

    <p class="text-center mt-3" style="font-size: 12px; color: #888780;">
        &copy; <?= date('Y') ?> Poltekkes Kemenkes Bengkulu &mdash; Hak cipta dilindungi
    </p>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>