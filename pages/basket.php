<?php include '../php/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>MUSIC</title>
	<meta charset=UTF-8>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/cart.js"></script>
	<link href="../css/bootstrap.min.css" rel=stylesheet />
	<link href="../css/style.css" rel=stylesheet />
	<?php require_once '../php/cart.php';?>
</head>
<body>
	<?php include '../templates/header.php'; ?>
	<div class="container">
		<div class="heading">
			<h2>Корзина</h2>
		</div>
		<section class="row">
		<?php 
			if (!isset($_COOKIE['access']) || $_COOKIE['access'] == false)
    		{
		?>
				<div class="col-12">
					<p>Корзина доступна только зарегистрированным пользователям</p>
					<p>Войдите или зарегистируйтесь</p>
					<button class="btn btn-light" onclick='location.href="../pages/user_page.php"'>Войти</button>
				</div>
		<?php 
			}
			elseif (isset($_SESSION['login'])) {
		?> 
			<form class="col-12" action="../php/order.php" method="POST">
				<table class="table table-hover">
					<thead>
						<tr>
					      <th>Фото</th>
					      <th>Название</th>
					      <th>Количество</th>
					      <th>Стоимость</th>
					      <th>Удалить</th>
					    </tr>
					</thead>
				  	<tbody id="basket_product">
						<script>showCart()</script>
				  	</tbody>
				</table>
				
				<div>
					<p id="total-cart-summa">Итого: <?php totalPrice(); ?> руб.</p> 
				</div>
<input id ="total" name="total" type="hidden" value="<?php totalPrice(); ?>">
            	<button class="btn btn-light" onclick="getOrder()" type="submit" style="padding: 5px;">Оформить заказ</button>
			</form>
		<?php
			}
		?>
	</section>

	<footer></footer>
</body>

</html>