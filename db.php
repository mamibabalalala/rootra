<?php
$host = "sql100.infinityfree.com";
$user = "if0_39813243";  // MySQL kullanıcı adın
$pass = "3tMa6F0kP3ys";      // MySQL şifren
$db   = "if0_39813243_rootra";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
    }
    ?>