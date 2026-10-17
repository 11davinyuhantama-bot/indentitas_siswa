<?php
$nama = "";
$kelas = "";
$jurusan = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $kelas = trim($_POST["kelas"] ?? "");
    $jurusan = trim($_POST["jurusan"] ?? "");

    if ($nama === "" || $kelas === "" || $jurusan === "") {
        $error = "Semua kolom wajib diisi.";
    }
}

function aman($teks) {
    return htmlspecialchars($teks, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#101a19">
    <title>Identitas Siswa — Atelier Akademik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink:#172321; --muted:#78817c; --gold:#bd9a5b; --paper:#fbfaf7; }
        * { box-sizing: border-box; }
        body { margin:0; min-height:100vh; padding:32px; display:grid; place-items:center; color:var(--ink); font-family:'DM Sans',sans-serif; background:#e9e8e2; }
        .shell { width:min(1100px,100%); min-height:650px; display:grid; grid-template-columns: .92fr 1.08fr; overflow:hidden; border-radius:22px; background:var(--paper); box-shadow:0 28px 80px #17232124, 0 4px 14px #1723210d; }
        .brand-panel { position:relative; display:flex; flex-direction:column; justify-content:space-between; padding:42px 44px; overflow:hidden; color:#f4f0e7; background:radial-gradient(ellipse at 75% 20%,#31514a 0%,transparent 42%), linear-gradient(145deg,#172522,#101917 72%); }
        .brand-panel:before,.brand-panel:after { content:""; position:absolute; border:1px solid #c9a96a35; border-radius:50%; width:420px;height:420px; right:-230px; bottom:-160px; }
        .brand-panel:after { width:320px;height:320px;right:-180px;bottom:-110px; }
        .brand, .brand-copy, .brand-foot { position:relative; z-index:1; }
        .brand { display:flex; align-items:center; gap:12px; font-size:12px; letter-spacing:.18em; text-transform:uppercase; font-weight:700; }
        .crest { display:grid; place-items:center; width:38px;height:38px; border:1px solid #bd9a5b; color:#d6b776; border-radius:50%; font-family:'Playfair Display',serif; font-size:19px; }
        .eyebrow { display:flex; align-items:center; gap:10px; color:#d0b477; font-size:10px; letter-spacing:.22em; text-transform:uppercase; font-weight:700; }
        .eyebrow:before { content:""; width:24px; height:1px; background:#bd9a5b; }
        .brand-copy h1 { max-width:380px; margin:20px 0 18px; font:500 clamp(38px,4.2vw,54px)/1.12 'Playfair Display',serif; letter-spacing:-.025em; }
        .brand-copy p { max-width:330px; color:#c1c9c2; font-size:14px; line-height:1.8; }
        .brand-foot { display:flex; align-items:center; gap:12px; color:#9da9a1; font-size:11px; letter-spacing:.05em; }
        .brand-foot span { color:#d0b477; }
        .form-panel { padding:58px clamp(34px,6vw,76px); display:flex; flex-direction:column; justify-content:center; }
        .form-top { margin-bottom:34px; }
        .form-top .eyebrow { color:#a17d43; font-size:10px; }
        h2 { margin:13px 0 8px; font:600 32px/1.2 'Playfair Display',serif; letter-spacing:-.02em; }
        .intro { margin:0; color:var(--muted); font-size:13px; line-height:1.65; }
        .field { margin-top:21px; }
        label { display:flex; justify-content:space-between; align-items:center; margin-bottom:9px; font-size:12px; font-weight:600; }
        label span { color:#a1a8a2; font-size:10px; font-weight:500; }
        input { width:100%; height:50px; padding:0 15px; border:1px solid #e2e2dc; border-radius:8px; outline:none; background:#fff; color:var(--ink); font:500 13px 'DM Sans',sans-serif; transition:border .2s,box-shadow .2s,background .2s; }
        input::placeholder { color:#aeb4ae; font-weight:400; }
        input:focus { border-color:#b2925c; background:#fffefa; box-shadow:0 0 0 3px #bd9a5b20; }
        .submit { width:100%; height:51px; margin-top:28px; display:flex; align-items:center; justify-content:center; gap:12px; border:0; border-radius:8px; color:#fff; background:#172522; font:600 12px 'DM Sans',sans-serif; letter-spacing:.08em; cursor:pointer; transition:background .2s,transform .2s,box-shadow .2s; }
        .submit:hover { background:#294139; transform:translateY(-1px); box-shadow:0 8px 18px #17252220; }
        .submit svg { width:16px; height:16px; }
        .note { display:flex; align-items:center; justify-content:center; gap:8px; margin-top:18px; color:#9ba29c; font-size:10px; }
        .note svg { width:13px;height:13px; color:#a17d43; }
        .alert { margin-top:20px; padding:13px 15px; border:1px solid #f1c9c2; border-radius:8px; background:#fff5f3; color:#9d4439; font-size:12px; }
        .result { margin-top:24px; padding:20px; border:1px solid #e4dfd2; border-radius:10px; background:#f7f5ef; }
        .result-head { display:flex; align-items:center; gap:10px; padding-bottom:14px; border-bottom:1px solid #e6e1d7; }
        .result-icon { display:grid; place-items:center; width:32px;height:32px; border-radius:50%; color:#8b6c39; background:#eee5d3; }
        .result-icon svg { width:16px;height:16px; }
        .result-head h3 { margin:0; font:600 16px 'Playfair Display',serif; }
        .result p { margin:12px 0 0; color:#7c837d; font-size:11px; }
        .result strong { display:block; margin-top:4px; color:#27342f; font-size:13px; font-weight:600; }
        @media(max-width:760px) { body { padding:18px; } .shell { grid-template-columns:1fr; max-width:520px; } .brand-panel { min-height:260px; padding:28px 30px; } .brand-copy { margin-top:38px; } .brand-copy h1 { max-width:460px; margin:12px 0 8px; font-size:36px; } .brand-copy p { margin:0; font-size:12px; } .brand-foot { display:none; } .form-panel { padding:38px 30px 34px; } .form-top { margin-bottom:24px; } }
        @media(max-width:420px) { body { padding:0; background:var(--paper); } .shell { min-height:100vh; border-radius:0; box-shadow:none; } .brand-panel { min-height:230px; padding:24px; } .brand-copy { margin-top:28px; } .brand-copy h1 { font-size:32px; } .form-panel { padding:32px 24px; } h2 { font-size:29px; } }
        @media(prefers-reduced-motion:reduce) { *,*:before,*:after { transition:none !important; } }
    </style>
</head>
<body>
<main class="shell">
    <section class="brand-panel" aria-label="Informasi formulir">
        <div class="brand"><div class="crest">A</div><div>Atelier Akademik</div></div>
        <div class="brand-copy">
            <div class="eyebrow">Ruang data siswa</div>
            <h1>Awal yang baik dimulai dari identitas.</h1>
            <p>Lengkapi informasi diri Anda dengan benar untuk memastikan data akademik tersimpan secara tepat.</p>
        </div>
        <div class="brand-foot"><span>●</span> Pendidikan dengan karakter dan tujuan</div>
    </section>
    <section class="form-panel">
        <div class="form-top">
            <div class="eyebrow">Formulir · 01</div>
            <h2>Identitas Siswa</h2>
            <p class="intro">Masukkan informasi berikut untuk melanjutkan.</p>
        </div>
        <form method="POST" action="">
            <div class="field">
                <label for="nama">Nama lengkap <span>01 / 03</span></label>
                <input type="text" id="nama" name="nama" placeholder="Contoh: Aditya Pratama" value="<?= aman($nama) ?>" autocomplete="name" required>
            </div>
            <div class="field">
                <label for="kelas">Kelas <span>02 / 03</span></label>
                <input type="text" id="kelas" name="kelas" placeholder="Contoh: XI" value="<?= aman($kelas) ?>" required>
            </div>
            <div class="field">
                <label for="jurusan">Jurusan <span>03 / 03</span></label>
                <input type="text" id="jurusan" name="jurusan" placeholder="Contoh: Rekayasa Perangkat Lunak" value="<?= aman($jurusan) ?>" required>
            </div>
            <button class="submit" type="submit">SIMPAN IDENTITAS
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div class="note"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3 5 6v5c0 4.5 3 8 7 10 4-2 7-5.5 7-10V6l-7-3Z" stroke="currentColor" stroke-width="1.5"/><path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>Informasi Anda ditampilkan dengan aman.</div>
        </form>
        <?php if ($error !== ""): ?>
            <div class="alert" role="alert"><?= aman($error) ?></div>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <div class="result" role="status">
                <div class="result-head"><div class="result-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div><h3>Identitas berhasil dicatat</h3></div>
                <p>Nama<strong><?= aman($nama) ?></strong></p>
                <p>Kelas<strong><?= aman($kelas) ?></strong></p>
                <p>Jurusan<strong><?= aman($jurusan) ?></strong></p>
            </div>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
