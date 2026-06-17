<!DOCTYPE html>
<?php
    include "config/koneksi.php";
    include "assets/js/date.php";
    error_reporting(0);
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar — Poltekkes Kemenkes Bengkulu</title>
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
        .register-wrapper { width: 100%; max-width: 420px; padding: 1.5rem; }
        .logo-circle {
            width: 80px; height: 80px;
            background: #fff;
            border-radius: 50%;
            border: 1px solid #c8dfe9;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .register-card { border: 1px solid #b2dfd0; border-radius: 12px; overflow: hidden; }
        .register-card-header {
            background: #0F6E56;
            padding: 1rem 1.5rem;
            display: flex; align-items: center; gap: 10px;
        }
        .register-card-body { padding: 1.75rem 1.5rem 1.5rem; }
        .info-box {
            background: #EAF3DE;
            border: 1px solid #C0DD97;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 1.25rem;
            display: flex; align-items: flex-start; gap: 8px;
            font-size: 12px; color: #3B6D11; line-height: 1.5;
        }
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
        .btn-daftar {
            width: 100%; padding: 11px;
            background: #0F6E56; color: #fff;
            border: none; border-radius: 8px;
            font-size: 14px; font-weight: 500;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: background 0.2s;
        }
        .btn-daftar:hover { background: #085041; color: #fff; }
        .register-card-footer {
            border-top: 1px solid #E1F5EE;
            background: #f7fbf9;
            padding: 1rem 1.5rem;
            text-align: center;
            font-size: 13px; color: #5F5E5A;
        }
        .register-card-footer a { color: #0F6E56; font-weight: 500; text-decoration: none; }
        .alert { border-radius: 8px; font-size: 13px; padding: 10px 14px; }
    </style>
</head>
<body>

<?php
$success = '';
$error   = '';

if (isset($_POST['daftar'])) {
    $nim  = addslashes($_POST['nim']);
    $nama = addslashes($_POST['nama']);
    $pw   = addslashes($_POST['password']);

    $gnim = mysqli_query($kon, "SELECT * FROM tb_user WHERE username='$nim'");
    if (mysqli_num_rows($gnim) == 0) {
        $daftar = mysqli_query($kon, "INSERT INTO tb_user (username, nama_lengkap, password, level) VALUES ('$nim','$nama','$pw','mahasiswa')");
        if ($daftar) {
            $success = "Akun berhasil didaftarkan. Silakan login.";
        } else {
            $error = "Pendaftaran gagal. Silakan coba lagi.";
        }
    } else {
        $error = "NIM ini sudah terdaftar sebelumnya.";
    }
}
?>

<div class="register-wrapper">

    <div class="text-center mb-4">
        <img src="assets/img/logo.polkeslu.png" alt="Logo Poltekkes" style="width: 110px; height: auto; margin-bottom: 0.75rem;">
        <h1 style="font-size: 17px; font-weight: 600; color: #1D9E75; margin: 0 0 4px;">Sistem Informasi Kemahasiswaan</h1>
        <!-- <p style="font-size: 13px; color: #5F5E5A; margin: 0;">Sistem Informasi Kemahasiswaan</p> -->
    </div>

    <div class="register-card">

        <div class="register-card-header">
            <i class="ti ti-user-plus" style="font-size: 18px; color: #9FE1CB;"></i>
            <span style="font-size: 15px; font-weight: 500; color: #fff;">Daftar Akun Baru</span>
        </div>

        <div class="register-card-body">

            <?php if ($success): ?>
                <div class="alert d-flex align-items-center gap-2 mb-3"
                     style="background: #EAF3DE; border: 1px solid #C0DD97; color: #3B6D11;">
                    <i class="ti ti-circle-check" style="font-size: 16px;"></i>
                    <?= $success ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert d-flex align-items-center gap-2 mb-3"
                     style="background: #FCEBEB; border: 1px solid #F7C1C1; color: #A32D2D;">
                    <i class="ti ti-alert-circle" style="font-size: 16px;"></i>
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <div class="info-box">
                <i class="ti ti-info-circle" style="font-size: 15px; flex-shrink: 0; margin-top: 1px;"></i>
                <span>Gunakan NIM aktif Anda sebagai identitas akun. Contoh: <strong>P05120213020</strong></span>
            </div>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">
                        <i class="ti ti-id-badge" style="font-size: 14px; vertical-align: -2px; margin-right: 4px; color: #1D9E75;"></i>NIM
                    </label>
                    <input type="text" name="nim" class="form-control"
                           placeholder="Contoh: P05120213020" autofocus required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="ti ti-user" style="font-size: 14px; vertical-align: -2px; margin-right: 4px; color: #1D9E75;"></i>Nama Lengkap
                    </label>
                    <input type="text" name="nama" class="form-control"
                           placeholder="Masukkan nama lengkap Anda" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="ti ti-lock" style="font-size: 14px; vertical-align: -2px; margin-right: 4px; color: #1D9E75;"></i>Password
                    </label>
                    <div class="pw-wrapper">
                        <input type="password" name="password" id="pw-input" class="form-control pe-5"
                               placeholder="Buat password yang kuat" required>
                        <button type="button" class="pw-toggle"
                                onclick="var el=document.getElementById('pw-input');el.type=el.type==='password'?'text':'password';this.querySelector('i').className='ti '+(el.type==='password'?'ti-eye':'ti-eye-off')">
                            <i class="ti ti-eye" style="font-size: 16px;"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" name="daftar" class="btn-daftar">
                    <i class="ti ti-user-check" style="font-size: 16px;"></i>
                    Daftar Sekarang
                </button>
            </form>
        </div>

        <div class="register-card-footer">
            <i class="ti ti-login" style="font-size: 14px; vertical-align: -2px; margin-right: 4px; color: #1D9E75;"></i>
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>

    </div>

    <p class="text-center mt-3" style="font-size: 12px; color: #888780;">
        &copy; <?= date('Y') ?> Poltekkes Kemenkes Bengkulu &mdash; Hak cipta dilindungi
    </p>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>