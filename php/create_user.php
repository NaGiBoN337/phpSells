<?php
require_once '../php/connection.php';

if (!empty($_POST['signup_login']) &&
    !empty($_POST['signup_password']) &&
    !empty($_POST['signup_name']) &&
    !empty($_POST['signup_surname']) &&
    !empty($_POST['signup_email'])
    )
{
    $login=$_POST['signup_login'];
    $pass=$_POST['signup_password'];
    $status='user';
    $name=$_POST['signup_name'];
    $surname=$_POST['signup_surname'];
    $email=$_POST['signup_email'];
	
    $stmt = $link->prepare("SELECT * FROM users WHERE user_login=?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows>0) {
        header("Location: ../pages/signup_page.php?message=Пользователь с таким логином уже существует");
	}
	else {
        $stmt->close();
        
        $stmt = $link->prepare("SELECT * FROM users WHERE user_email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows>0) {
            header("Location: ../pages/signup_page.php?message=Пользователь с таким email уже существует");
    	}
    	else {
    	    $stmt->close();
        
            $stmt = $link->prepare("INSERT INTO users(user_login, user_password, user_status, user_name, user_surname, user_email) VALUES(?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("ssssss", $login, $pass, $status, $name, $surname, $email);
            $stmt->execute();
            $stmt->close();
            
            setcookie('access', true, time()+120, '/');
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $pass;
            header("Location: ../pages/user_page.php");
    	}
    }
}
else header("Location: ../pages/signup_page.php?message=Заполните все поля");
    
?>