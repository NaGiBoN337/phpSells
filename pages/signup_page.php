<?php include '../php/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>MUSIC</title>
	<meta charset=UTF-8>
	<link href="../css/bootstrap.min.css" rel=stylesheet />
	<link href="../css/style.css" rel=stylesheet />
	<?php require '../php/get_functions.php';?>
</head>
<body>
	<?php include '../templates/header.php'; ?>
	<div class="container">
			<div class="heading">
				<h2>Введите информацию о себе</h2>
			</div>
		<div class="row">
		
			<form class="col-md-8 com-lg-8 col-sm-12" onsubmit="return checkForm(this)" method="POST" action="../php/create_user.php">
				<div class="form-group form-inline">
					<h6 class="col-6"> Логин: </h6>
					<input class="form-control " id="login_field" type="text" name="signup_login">
				</div>
				<div class="form-group form-inline">
					<h6 class="col-6"> Пароль: </h6>
					<input class="form-control" id="pass_field" type="password" name="signup_password">
				</div>
				<div class="form-group form-inline">
					<h6 class="col-6"> Ваше имя: </h6>
					<input class="form-control" id="name_field" type="text" name="signup_name">
				</div>
				<div class="form-group form-inline">
					<h6 class="col-6"> Ваша фамилия: </h6>
					<input class="form-control" id="surname_field" type="text" name="signup_surname">
				</div>
				<div class="form-group form-inline">
					<h6 class="col-6"> Email: </h6>
					<input class="form-control" id="email_field" type="email" name="signup_email">
				</div>
				<br>
				<button class="btn btn-light" type="submit">Зарегистрироваться</button>
			</form>
		</div>
		
		<div class="row" id="err">
			<?php
			if (isset($_GET["message"])){
				echo $_GET["message"];
				unset($_GET["message"]);
			}
			?>
		</div>
	</div>
	<footer></footer>
</body>
</html>
<script type="text/javascript">
	
	/// проверка формы на заполение 
	function checkForm(form){  
		if (
			(document.getElementById("login_field").value=="")||
			(document.getElementById("pass_field").value=="")||
			(document.getElementById("name_field").value=="")||
			(document.getElementById("surname_field").value=="")||
			(document.getElementById("email_field").value=="")
			) {
			document.getElementById('err').innerHTML='Поля со звездочкой должны быть заполнены';  
		return false; 
	};  
	return true;  
};


</script>
