<?php
// 404.php - logolu 404 sayfası
http_response_code(404);
$request_uri = htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>404 Sayfa Bulunamadı</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        :root{
            --bg:#0d1117;
            --card:#161b22;
            --muted:#aab1bb;
            --accent:#29b6f6;
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:var(--bg);
            color:#fff;
            font-family:Inter,Arial,sans-serif;
        }
        .card{
            background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border:1px solid rgba(255,255,255,0.04);
            padding:36px;
            border-radius:12px;
            width:min(920px,92%);
            display:flex;
            gap:28px;
            align-items:center;
            box-shadow:0 12px 30px rgba(2,6,23,0.6);
        }
        .logo{
            flex:0 0 140px;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .logo img{
            width:120px;
            height:auto;
            display:block;
        }
        .content{
            flex:1;
        }
        h1{
            margin:0;
            font-size:36px;
            letter-spacing:-0.02em;
        }
        p.lead{
            margin:10px 0 18px 0;
            color:var(--muted);
            font-size:16px;
        }
        .info{
            font-size:13px;
            color:#8891a0;
            background:rgba(255,255,255,0.02);
            padding:10px 12px;
            border-radius:8px;
            display:inline-block;
        }
        .actions{
            margin-top:18px;
            display:flex;
            gap:10px;
            align-items:center;
            flex-wrap:wrap;
        }
        .btn{
            padding:10px 16px;
            border-radius:10px;
            text-decoration:none;
            font-weight:600;
            display:inline-block;
            border:0;
            cursor:pointer;
        }
        .btn-primary{
            background:var(--accent);
            color:#051622;
        }
        .btn-ghost{
            background:transparent;
            color:var(--muted);
            border:1px solid rgba(255,255,255,0.04);
        }
        footer{
            margin-top:12px;
            color:#6f7786;
            font-size:13px;
        }
        @media (max-width:640px){
            .card{flex-direction:column; text-align:center}
            .logo{order:0}
        }
    </style>
</head>
<body>
    <div class="card" role="main" aria-labelledby="title">
        <div class="logo" aria-hidden="true">
            <img src="fotolar/logo.png" alt="Site Logo">
        </div>
        <div class="content">
            <h1 id="title">404 — Sayfa Bulunamadı</h1>
            <p class="lead">Aradığınız sayfa bulunamadı veya silinmiş olabilir.</p>
            <div class="info">İstenen yol: <strong><?php echo $request_uri; ?></strong></div>
            <div class="actions">
                <a class="btn btn-primary" href="/index.php">Anasayfaya Dön</a>
                <a class="btn btn-ghost" href="/" onclick="history.back();return false">Geri Git</a>
            </div>
            <footer>© <?php echo date('Y'); ?> Tüm hakları saklıdır.</footer>
        </div>
    </div>
</body>
</html>