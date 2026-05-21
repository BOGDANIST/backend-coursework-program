<?php
// 1. Отримуємо дані про користувача
$ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

// REQUEST_URI містить ту адресу, яку людина ввела в браузері (неіснуючу)
$requested_url = $_SERVER['REQUEST_URI'] ?? 'UNKNOWN';

// HTTP_REFERER показує, з якої сторінки людина клікнула на бите посилання.
// ВАЖЛИВО: Цей параметр передається не завжди (наприклад, якщо людина ввела адресу вручну, 
// або якщо перехід був з HTTPS на HTTP). Тому ставимо заглушку на випадок порожнечі.
$referrer = $_SERVER['HTTP_REFERER'] ?? 'Прямий перехід (або приховано браузером)';

// 2. Підключаємося до БД
$host = 'localhost';
$db   = 'college'; // Заміни на свою БД
$user = 'root';
$pass = '';



try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Записуємо інцидент у базу даних
    $stmt = $pdo->prepare("INSERT INTO error_logs (ip_address, requested_url, referrer_url) VALUES (?, ?, ?)");
    $stmt->execute([$ip, $requested_url, $referrer]);

} catch (PDOException $e) {
    // Якщо БД впала, ми не виводимо помилку на екран, щоб не лякати користувача, 
    // але записуємо її в системний лог сервера
    error_log("Помилка логування 404: " . $e->getMessage());
}

// 4. Обов'язково віддаємо браузеру та пошуковим роботам (Google) статус 404,
// інакше вони думатимуть, що ця сторінка з помилкою — це нормальний контент (200 OK).
http_response_code(404);
?>


<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>Сторінку не знайдено</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background:rgb(123, 185, 247);
      color: #333;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
    }
    .box {
      padding: 40px;
      border-radius: 10px;
      background-color: white;
      box-shadow: 0 0 30px rgba(0,0,0,0.1);
    }
    .box h1 {
      font-size: 64px;
      color: #dc3545;
    }
    .box a {
      margin-top: 20px;
      display: inline-block;
      padding: 10px 25px;
      background: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    .box a:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="box">
    <h1>404</h1>
    <p>Ой! Сторінку не знайдено 😕</p>
    <a href="admin_panel.php">На головну</a>
  </div>
</body>
</html>
