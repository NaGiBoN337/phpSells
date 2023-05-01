<?php 
require_once 'session.php';

if (isset($_POST['username']) && !empty($_POST['username'])) {
	$username = $_POST['username'];
	$status = $_POST['status'];
	$sql = "SELECT * FROM users WHERE user_login='$username'";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if (($result) && mysqli_num_rows($result)>0) {
    	$sql = "UPDATE users SET user_status = '".$status."' WHERE user_login='".$username."';";
    	$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    	if($result) $mes = "Статус пользователя успешно изменен";
    }
    else $mes = "Пользователя с таким логином не существует";
}
else $mes = "Введите имя пользователя";
header("Location: ../pages/user_page.php?message=$mes");

?>