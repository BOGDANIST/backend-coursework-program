<?php
session_start();
session_unset(); // Очистити всі змінні сесії
session_destroy(); // Завершити сесію

header("Location: ../index.php"); // Перенаправити на сторінку логіну
exit();
?>
