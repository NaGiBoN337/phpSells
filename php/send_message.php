<?php
require_once '../php/session.php'; 

$login = $_SESSION['login'];
$email = $_SESSION['email'];
$login = htmlspecialchars($login);
$email = htmlspecialchars($email);
$login = urldecode($login);
$email = urldecode($email);
$login = trim($login);
$email = trim($email);

$subject = "Магазин музыкальных инструментов";
$charset = "utf-8";
$headers="From: webmaster@example.com\r\n";
$headers.="Content-type: text/html; charset=$charset\r\n";
$headers.="MIME-Version: 1.0\r\n";
$headers.="Date: ".date('D, d M Y h:i:s O')."\r\n";
$msg = $login.", Ваш заказ в обработке!\n";
$send = mail($email, $subject, $msg, $headers);
if ($send) {
    header("Location: ../pages/user_page.php?mes=Ваш заказ в обработке!");
}
else {
    header("Location: ../pages/catalog.php?mes=При отправке сообщения возникли ошибки");
}
?>