<?php
require_once '../php/connection.php';

function getUsers($link) {
	$sql = "SELECT * FROM users";
	$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
	if ($result) {
		while($row = mysqli_fetch_row($result)) {
      	$username=$row[1];
      	$userpass=$row[2];
      	if (($_POST['login'] == $username) && ($_POST['password'] == $userpass))
			{
				setcookie('access', true, time()+120, '/');
				$_SESSION['login'] = $_POST['login'];
		        $_SESSION['password'] = $_POST['password'];
		        echo "<meta http-equiv='refresh' content='0'>";
			}
    	}
    	mysqli_free_result($result);
	}	
}

function getProduct($link, $id){
    $id = intval($id);
    $sql="CALL getProduct($id)";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    $object = mysqli_fetch_object($result);
    mysqli_free_result($result);
    return $object;
}

function getOptionValue($link, $tname) {
    $sql = 'SELECT * FROM '.$tname;
	$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
	if ($result) {
		while($row = mysqli_fetch_row($result)) {
			echo "<option value='$row[0]'>$row[1]</option>";
		}
		mysqli_free_result($result);
	}
}