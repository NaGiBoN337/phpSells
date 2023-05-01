<section class="row">
		<div class="col-6">
			<h2>Введите логин и пароль</h2>
			<div class="row">
				<form method="POST" action="../php/access.php">
					<div class="form-group">
						<h6>Логин: </h6>
						<input class="form-control" id="login_field" type="text" name="login">
					</div>
					<div class="form-group">
						<h6>Пароль: </h6>
						<input class="form-control" id="password_field" type="password" name="password">
					</div>
					<button class="btn btn-light" type="submit">Войти</button>
				</form>
			</div>
			
			<?php 
			    if (isset($_GET['message'])) {
		        	echo $_GET['message'];
		        	unset($_GET['message']);
		    	}
		    ?>
		</div>

		<div class="col-6">
			<h2>Еще не зарегистрированы?</h2>
			<div class="row">
				<button class="btn btn-light" onclick='location.href="../pages/signup_page.php"'>Регистрация</button>
			</div>
		</div>
</section>