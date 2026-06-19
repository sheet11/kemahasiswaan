<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Aplikasi Akademik</title>
<link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>

  :root{
    --ink:#1b2420;
    --ink-soft:#5b665f;
    --paper:#f3f1ea;
    --panel:#ffffff;
    --line:#e4dfd2;

    /* Kemenkes greens + accent blue, used sparingly */
    --kemenkes-green:#00824a;
    --kemenkes-green-deep:#005c34;
    --kemenkes-blue:#0067ac;
    --gold:#c9a24a;
  }

  *{ box-sizing:border-box; }

  html,body{
    margin:0;
    padding:0;
    min-height:100vh;
    font-family:'Inter', -apple-system, sans-serif;
    color:var(--ink);
    background:var(--paper);
  }

  body{
    display:flex;
    align-items:center;
    justify-content:center;
    min-height:100vh;
    padding:24px;
    position:relative;
    overflow-x:hidden;
  }

  body::before{
    content:"";
    position:fixed;
    inset:0;
    background:
      radial-gradient(circle at 15% 20%, rgba(0,130,74,0.08), transparent 45%),
      radial-gradient(circle at 85% 85%, rgba(0,103,172,0.07), transparent 45%);
    pointer-events:none;
    z-index:0;
  }

  /* === Card === */
  .card{
    position:relative;
    z-index:1;
    width:100%;
    max-width:380px;
    background:var(--panel);
    border-radius:6px;
    box-shadow: 0 26px 54px -20px rgba(0,60,40,0.28);
    overflow:hidden;
  }

  .card-top{
    background:linear-gradient(155deg, var(--kemenkes-green) 0%, var(--kemenkes-green-deep) 100%);
    padding:38px 40px 32px;
    text-align:center;
    position:relative;
    display:flex;
    flex-direction:column;
    align-items:center;
  }

  .card-top::after{
    content:"";
    position:absolute;
    left:0; right:0; bottom:0;
    height:3px;
    background:linear-gradient(90deg, var(--kemenkes-blue), var(--gold));
  }

  .mark-glyph{
    width:48px;
    height:48px;
    margin:0 0 16px;
    border-radius:50%;
    background:rgba(255,255,255,0.1);
    border:1.5px solid rgba(255,255,255,0.55);
    display:flex;
    align-items:center;
    justify-content:center;
  }

  .mark-glyph svg{ width:24px; height:24px; }

  .eyebrow{
    font-size:11px;
    letter-spacing:0.16em;
    text-transform:uppercase;
    color:#cdeede;
    margin:0 0 8px;
  }

  .title{
    font-family:'Fraunces', serif;
    font-weight:600;
    font-size:21px;
    line-height:1.3;
    color:#ffffff;
    margin:0;
    letter-spacing:0.01em;
    max-width:260px;
  }

  /* === Form body === */
  .card-body{
    padding:36px 40px 40px;
  }

  form{
    display:flex;
    flex-direction:column;
    gap:22px;
  }

  .field{
    position:relative;
    display:flex;
    flex-direction:column;
  }

  .field label{
    display:block;
    font-size:11px;
    letter-spacing:0.06em;
    text-transform:uppercase;
    color:var(--ink-soft);
    margin-bottom:8px;
  }

  .field input{
    width:100%;
    height:44px;
    font-family:'Inter', sans-serif;
    font-size:14.5px;
    color:var(--ink);
    background:#f7f5ef;
    border:1.5px solid var(--line);
    border-radius:9px;
    padding:0 14px;
    transition:border-color 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
  }

  .field input#password{
    padding-right:44px;
  }

  .toggle-eye{
    position:absolute;
    right:8px;
    bottom:0;
    width:44px;
    height:44px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:none;
    border:none;
    padding:0;
    cursor:pointer;
    color:#a8a294;
    transition:color 0.2s ease;
  }

  .toggle-eye:hover{
    color:var(--kemenkes-green-deep);
  }

  .toggle-eye:focus-visible{
    outline:2px solid var(--kemenkes-blue);
    outline-offset:2px;
    border-radius:6px;
  }

  .toggle-eye svg{
    width:18px;
    height:18px;
    pointer-events:none;
  }

  .toggle-eye .eye-off{
    display:none;
  }

  .toggle-eye.is-visible .eye-on{
    display:none;
  }

  .toggle-eye.is-visible .eye-off{
    display:block;
  }

  .field input::placeholder{
    color:#bdb6a4;
  }

  .field input:focus{
    outline:none;
    border-color:var(--kemenkes-green);
    background:#ffffff;
    box-shadow: 0 0 0 3px rgba(0,130,74,0.10);
  }

  .submit{
    margin-top:4px;
    width:100%;
    height:46px;
    font-family:'Inter', sans-serif;
    font-size:13px;
    font-weight:600;
    letter-spacing:0.05em;
    text-transform:uppercase;
    color:#ffffff;
    background:var(--kemenkes-green-deep);
    border:none;
    border-radius:9px;
    cursor:pointer;
    transition:background 0.25s ease, transform 0.15s ease;
  }

  .submit:hover{
    background:var(--kemenkes-green);
  }

  .submit:active{
    transform:translateY(1px);
  }

  .submit:focus-visible{
    outline:2px solid var(--kemenkes-blue);
    outline-offset:3px;
  }

  .copyright{
    margin-top:18px;
    text-align:center;
    font-size:11px;
    color:#8b8576;
    position:relative;
    z-index:1;
  }

  .copyright a{
    color:#8b8576;
    text-decoration:none;
  }

  @media (max-width: 420px){
    .card-top{ padding:32px 28px 28px; }
    .card-body{ padding:32px 28px 36px; }
  }

  @media (prefers-reduced-motion: reduce){
    *{ transition:none !important; }
  }
</style>
</head>
<body>

  <div>
    <div class="card">

      <div class="card-top">
        <div class="mark-glyph">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 3L3 8L12 13L21 8L12 3Z" stroke="#ffffff" stroke-width="1.3" stroke-linejoin="round"/>
            <path d="M6 11V17C6 17 8.5 19 12 19C15.5 19 18 17 18 17V11" stroke="#ffffff" stroke-width="1.3" stroke-linejoin="round"/>
          </svg>
        </div>
        <p class="eyebrow">Poltekkes Kemenkes Bengkulu</p>
        <h1 class="title">Sistem Informasi Kemahasiswaan</h1>
      </div>

      <div class="card-body">
        <form action="proseslogin.php" method="post" enctype="multipart/form-data">

          <div class="field">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required>
          </div>

          <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            <button type="button" class="toggle-eye" id="toggleEye" aria-label="Tampilkan password" aria-pressed="false">
              <svg class="eye-on" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 12s3.5-6.5 10-6.5S22 12 22 12s-3.5 6.5-10 6.5S2 12 2 12Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/>
              </svg>
              <svg class="eye-off" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 12s3.5-6.5 10-6.5S22 12 22 12s-3.5 6.5-10 6.5S2 12 2 12Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/>
                <line x1="3.5" y1="20.5" x2="20.5" y2="3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
              </svg>
            </button>
          </div>

          <button type="submit" name="sent" class="submit">Login</button>

        </form>

      </div>

    </div>

    <p class="copyright">Copyright &copy; 2026. Created by <a href="" target="_blank">Poltekkes Kemenkes Bengkulu</a></p>
  </div>

  <script>
    const pwdInput = document.getElementById('password');
    const eyeBtn = document.getElementById('toggleEye');

    eyeBtn.addEventListener('click', function(){
      const isVisible = pwdInput.type === 'text';
      pwdInput.type = isVisible ? 'password' : 'text';
      eyeBtn.classList.toggle('is-visible', !isVisible);
      eyeBtn.setAttribute('aria-pressed', String(!isVisible));
      eyeBtn.setAttribute('aria-label', isVisible ? 'Tampilkan password' : 'Sembunyikan password');
    });
  </script>

</body>
</html>