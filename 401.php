<?php
http_response_code(401);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>401 - Yetkisiz Erişim</title>
    <style>
        body { background:#111; color:#eee; font-family:sans-serif; text-align:center; margin-top:10%; }
        img { width:120px; margin-bottom:20px; }
        h1 { font-size:42px; margin-bottom:10px; }
        p { font-size:20px; color:#aaa; }
        a { color:#0af; text-decoration:none; font-size:18px; }
        a:hover { text-decoration:underline; }
    </style>
</head>
<body>
    <img src="fotolar/logo.png" alt="Logo">
    <h1>🚫 401 - Yetkisiz Erişim 🚫</h1>
    <p>Bu sayfaya erişim iznin yok kanka</p>
    <p><a href="index.php">Anasayfaya Dön</a></p>
</body>
</html>