 <?php
session_start();

// Admin kullanıcı adı ve şifre (burayı sabit tanımladım, veritabanından da çekebilirsin)
$admin_user = "Mamix";
$admin_pass = "Mamix-Purno-Admin-Baba"; // gerçek projede hash kullan

// Çıkış işlemi
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Giriş kontrolü
if (isset($_POST['username'], $_POST['password'])) {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $_SESSION['is_admin'] = true;
    } else {
        $error = "Hatalı kullanıcı adı veya şifre!";
    }
}

// Admin değilse giriş ekranı göster
if (empty($_SESSION['is_admin'])): ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0"> <!-- Mobil uyum -->
  <title>Admin Giriş</title>
  <style>
    body { font-family:sans-serif;background:#111;color:#fff;padding:20px; }
    form {
      background:#222;
      padding:20px;
      border-radius:10px;
      max-width:400px;
      width:90%;   /* mobil uyum */
      margin:auto;
      box-shadow:0 0 10px rgba(0,0,0,0.5);
    }
    h2 { text-align:center;margin-bottom:15px; }
    input, button {
      width:100%;
      padding:12px;
      margin:8px 0;
      border:none;
      border-radius:5px;
      font-size:16px;
    }
    input { background:#333;color:#fff; }
    button {
      background:#0af;
      color:#fff;
      cursor:pointer;
      transition:0.3s;
    }
    button:hover { background:#08c; }
    .error { color:#f55;margin-top:10px;text-align:center; }
  </style>
</head>
<body>
  <form method="post">
    <h2>Admin Girişi</h2>
    <input type="text" name="username" placeholder="Kullanıcı Adı" required>
    <input type="password" name="password" placeholder="Şifre" required>
    <button type="submit">Giriş Yap</button>
    <?php if (!empty($error)): ?><div class="error"><?= $error ?></div><?php endif; ?>
  </form>
</body>
</html>
<?php exit; endif; ?>

<?php
// Buradan sonrası admin panel kodun
include("db.php");

// kullanıcı ekleme
if (isset($_POST['add_user'])) {
    $new_username = trim($_POST['new_username']);
    $new_password = trim($_POST['new_password']);
    $new_refcode  = trim($_POST['new_refcode']);

    if ($new_username && $new_password) {
        $hashed_pass = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, ref_code) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $new_username, $hashed_pass, $new_refcode);
        $stmt->execute();
    }
}

// kullanıcı silme (admin silinemez)
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    if ($delete_id > 0) {
        $sql = "DELETE FROM users WHERE id=? AND username!='admin'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
    }
}

// kullanıcıları çek
$result = $conn->query("SELECT * FROM users ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0"> <!-- Mobil uyum -->
  <title>Admin Paneli</title>
  <style>
    body { font-family:sans-serif;background:#111;color:#fff;padding:20px; }
    h1 { margin-bottom:20px;text-align:center; }
    .top-bar {
      display:flex;
      justify-content:space-between;
      align-items:center;
      flex-wrap:wrap;
      margin-bottom:15px;
    }
    a { color:#0af;text-decoration:none;margin:5px 0; }
    a:hover { text-decoration:underline; }

    form {
      background:#222;
      padding:15px;
      border-radius:10px;
      max-width:500px;
      width:100%;
      margin:auto;
      box-shadow:0 0 10px rgba(0,0,0,0.5);
    }
    form input, form button {
      width:100%;
      padding:10px;
      margin:6px 0;
      border:none;
      border-radius:5px;
    }
    form input { background:#333;color:#fff; }
    form button { background:#0af;color:#fff;cursor:pointer; }
    form button:hover { background:#08c; }

    table { 
      width:100%;
      border-collapse:collapse;
      margin-top:20px;
      font-size:14px;
    }
    table, th, td { border:1px solid #444; }
    th, td { padding:10px;text-align:left;word-break:break-word; }
    .delete-btn { color:#f55;text-decoration:none; }
    .delete-btn:hover { text-decoration:underline; }

    /* Mobilde tablo kaydırma */
    .table-container {
      overflow-x:auto;
    }
  </style>
</head>
<body>
  <div class="top-bar">
    <h1>Admin Paneli</h1>
    <div>
      <a href="admin.php">Yenile</a> | 
      <a href="admin.php?logout=1">Çıkış Yap</a>
    </div>
  </div>
  
  <h2>Kullanıcı Ekle</h2>
  <form method="post">
    <input type="text" name="new_username" placeholder="Kullanıcı Adı" required>
    <input type="password" name="new_password" placeholder="Şifre" required>
    <input type="text" name="new_refcode" placeholder="Referans Kodu (opsiyonel)">
    <button type="submit" name="add_user">Ekle</button>
  </form>

  <h2>Kullanıcılar</h2>
  <div class="table-container">
    <table>
      <tr>
        <th>ID</th>
        <th>Kullanıcı Adı</th>
        <th>Referans Kodu</th>
        <th>İşlem</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['username']) ?></td>
          <td><?= htmlspecialchars($row['ref_code'] ?? '') ?></td>
          <td>
            <?php if ($row['username'] !== 'admin'): ?>
              <a class="delete-btn" href="admin.php?delete=<?= $row['id'] ?>" onclick="return confirm('Silinsin mi?')">Sil</a>
            <?php else: ?>
              (Admin)
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html