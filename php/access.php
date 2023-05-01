<?php
require_once '../php/connection.php'; 

if (isset($_POST['login']) && isset($_POST['password']))
{
	$username=$_POST['login'];
	$userpass=$_POST['password'];
	
    $stmt = $link->prepare("SELECT * FROM users WHERE user_login=? and user_password=?");
    $stmt->bind_param("ss", $username, $userpass);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $email= $row['user_email'];
            setcookie('access', true, time()+1200, '/');
            setcookie('cart', '', time()+1200, '/');
            session_start();
            $_SESSION['login'] = $username;
            $_SESSION['password'] = $userpass;
            $_SESSION['email'] = $email;
            
            header("Location: ../pages/user_page.php");
        }
        $stmt->close();
	}
	else{
        $mes="Неверный логин или пароль";
        header("Location: ../pages/user_page.php?message=$mes");
    }
}

if (isset($_POST['logout']) && isset($_COOKIE['access']) && $_COOKIE['access']==true) 
{ 
	setcookie('access', false, time()-100); 
	session_unset();
	foreach ($_COOKIE as $key => $value) { setcookie($key, '', time()-1000, '/'); }
	header("Location: ../pages/user_page.php");
}