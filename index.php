   <?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$logo = "fotolar/logo.png";

$apps = array(
 array(
        "icon"   => "fotolar/esign.png",
        "name"   => "Esign NoLog",
        "version"=> "Sürüm 5.0.0 (5)",
        "link"   => "https://ipalinks.ru/wh/VUJtck",
        "extra"  => array(
            array("name" => "Sertifikayı İndir", "url" => "https://rootra.xo.je/Cert.zip")
        )
    ),
    array(
        "icon"   => "fotolar/king.png",
        "name"   => "King Ios Full Global 4.0",
        "version"=> "Sürüm V2 (2)",
        "link"   => "https://ipalinks.ru/dl/LCoLUI",
 "extra"  => array(
            array("name" => "Yedek İndirme Linki 1 ", "url" => "https://ipalinks.ru/wh/gzFV5yddQ")
        )
    ),
    array(
        "icon"   => "fotolar/king.png",
        "name"   => "King Ios Lite Global 4.0",
        "version"=> "Sürüm V2 (2)",
        "link"   => "https://ipalinks.ru/dl/NXgC4EyBxc",
 "extra"  => array(
            array("name" => "Yedek İndirme Linki 1 ", "url" => "https://ipalinks.ru/wh/vR3W41Bu")
        )
    ),
    array(
        "icon"   => "fotolar/star.png",
        "name"   => "Star Ios Global 4.0",
        "version"=> "Sürüm V1.2 (1.2)",
        "link"   => "https://ipalinks.ru/wh/Pp7ui",
 "extra"  => array(
            array("name" => "Yedek İndirme Linki 1 ", "url" => "https://ipalinks.ru/wh/a1smzqy11a")
        )
    ),
    array(
        "icon"   => "fotolar/danger.png",
        "name"   => "Danger Ios Global 4.0",
        "version"=> "Sürüm v2 (2)",
        "link"   => "https://ipalinks.ru/wh/gocVVqVe3"
    ),
    array(
        "icon"   => "fotolar/vn.png",
        "name"   => "VnHax Ios Global 4.0",
        "version"=> "Sürüm V1 NHF (1 NHF)",
        "link"=> "https://ipalinks.ru/wh/SCUVE",
 "extra"  => array(
            array("name" => "Yedek İndirme Linki 1 ", "url" => "https://ipalinks.ru/wh/KO6emZVQ1")
        )
    ),
    array(
        "icon"   => "fotolar/zoon.png",
        "name"   => "Zoon Ios Global 4.0",
        "version"=> "Sürüm 1.0 (1.0)",
        "link"   => "https://ipalinks.ru/wh/csuRieGpag"
    )
);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RootRa</title>
<link rel="icon" type="image/x-icon" href="fotolar/root.ico">
<style>
body {
    margin:0;
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Arial,sans-serif;
    background: linear-gradient(135deg, #0f0f0f, #1a1a1a 40%, #000);
    color:#fff;
}
.header {
    position:relative;
    padding:20px;
    font-size:22px;
    font-weight:700;
}
.logo {
    position:absolute;
    right:15px;
    top:15px;
    width:42px;
    height:42px;
    border-radius:50%;
}
/* 🔍 buton */
.search-btn {
    position:absolute;
    right:15px;
    top:70px; /* logo altı */
    background:none;
    border:none;
    font-size:24px;
    color:#fff;
    cursor:pointer;
    transition:transform 0.3s ease;
    z-index:10;
}
.search-btn:hover { transform:scale(1.1); }

/* input butonun solunda açılsın */
.search-box {
    position:absolute;
    top:70px;
    right:55px;
    width:0;
    padding:8px 12px;
    border-radius:18px;
    border:none;
    outline:none;
    font-size:14px;
    opacity:0;
    transition:all 0.4s ease;
}
.search-box.active {
    width:200px;
    opacity:1;
    background:rgba(255,255,255,0.1);
    color:#fff;
}
.section {
    padding:15px 20px;
    font-size:18px;
    color:#ccc;
}
.app {
    display:flex;
    align-items:center;
    backdrop-filter: blur(20px) saturate(150%);
    -webkit-backdrop-filter: blur(20px) saturate(150%);
    background-color: rgba(255,255,255,0.07);
    border-radius:18px;
    padding:14px;
    margin:12px 16px;
    box-shadow:0 4px 20px rgba(0,0,0,0.5);
    flex-wrap:wrap;
}
.app img.icon {
    width:64px;
    height:64px;
    border-radius:16px;
    margin-right:14px;
    flex-shrink:0;
}
.info { flex:1; }
.info .name { font-size:16px; font-weight:600; }
.info .version { font-size:13px; color:#aaa; }
.install-btn {
    background: linear-gradient(135deg, #007aff, #0a84ff);
    color:#fff;
    border:none;
    padding:8px 16px;
    border-radius:18px;
    font-size:14px;
    cursor:pointer;
    text-decoration:none;
    font-weight:500;
    box-shadow:0 2px 6px rgba(0,122,255,0.5);
    transition: all 0.2s ease-in-out;
    margin-left:5px;
}
.install-btn:hover {
    box-shadow:0 4px 12px rgba(0,122,255,0.7);
    transform:scale(1.05);
}
.extra-links {
    display:none;
    width:100%;
    margin-top:10px;
}
.extra-links a {
    display:block;
    color:#4da6ff;
    text-decoration:none;
    margin:5px 0;
}
.extra-links a:hover {text-decoration:underline;}
@media(max-width:480px){
    .header {font-size:20px;padding:15px}
    .section {font-size:16px}
    .app img.icon{width:54px;height:54px}
    .info .name{font-size:15px}
    .install-btn{font-size:13px;padding:6px 12px}
}
</style>
</head>
<body>
<div class="header">
  RootRa Store
  <img src="<?php echo $logo; ?>" class="logo" alt="logo">

  <!-- Büyüteç + Arama -->
  <button type="button" class="search-btn" id="searchToggle">🔍</button>
  <input type="text" id="searchBox" class="search-box" placeholder="Ara...">
</div>

<div class="section">RootRa Store V2</div>
<div id="appList">
<?php foreach($apps as $index => $app): ?>
  <div class="app">
    <img src="<?php echo $app['icon']; ?>" class="icon" alt="app icon">
    <div class="info">
      <div class="name"><?php echo $app['name']; ?></div>
      <div class="version"><?php echo $app['version']; ?></div>
    </div>
    <a class="install-btn" href="<?php echo $app['link']; ?>">Yükle</a>

    <?php if (strpos(strtolower($app['name']), "esign") !== false): ?>
      <button class="install-btn" onclick="toggleExtra(<?php echo $index; ?>)">Cert</button>
    <?php endif; ?>
        
    <?php if (strpos(strtolower($app['name']), "king") !== false): ?>
  <button class="install-btn" onclick="toggleExtra(<?php echo $index; ?>)">More</button>
<?php endif; ?>
        
        <?php if (strpos(strtolower($app['name']), "vn") !== false): ?>
  <button class="install-btn" onclick="toggleExtra(<?php echo $index; ?>)">More</button>
<?php endif; ?>
            
            
        <?php if (strpos(strtolower($app['name']), "star") !== false): ?>
  <button class="install-btn" onclick="toggleExtra(<?php echo $index; ?>)">More</button>
<?php endif; ?>
            
            
    <?php if (isset($app['extra'])): ?>
      <div class="extra-links" id="extra-<?php echo $index; ?>">
        <?php foreach($app['extra'] as $extra): ?>
          <a href="<?php echo $extra['url']; ?>"><?php echo $extra['name']; ?></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>

<script>
const toggleBtn = document.getElementById("searchToggle");
const searchBox = document.getElementById("searchBox");
const apps = document.querySelectorAll(".app");

toggleBtn.addEventListener("click", () => {
  searchBox.classList.toggle("active");
  if (searchBox.classList.contains("active")) {
    searchBox.focus();
  }
});

searchBox.addEventListener("input", () => {
  let filter = searchBox.value.toLowerCase();
  apps.forEach(app => {
    let name = app.querySelector(".name").textContent.toLowerCase();
    if (name.includes(filter)) {
      app.style.display = "flex";
    } else {
      app.style.display = "none";
    }
  });
});

function toggleExtra(id){
  let el = document.getElementById("extra-"+id);
  if(el.style.display === "block"){
    el.style.display = "none";
  } else {
    el.style.display = "block";
  }
}
</script>
</body>
</html>