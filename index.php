<?php require_once 'php/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>MUSIC</title>
	<meta charset=UTF-8>
	<link href="css/bootstrap.min.css" rel=stylesheet />
	<link href="css/style.css" rel=stylesheet />
	<?php require_once 'php/get_catalog.php';?>
</head>
<body>
	<header class="row align-items-center justify-content-center">
		<a class="col-md-3 header_logo inc_hover" href="#">MMV</a>
		<nav class="col-md-6 navbar">
			<ul class="nav nav-justified">
				<li class="nav-item">
					<a href="index.php" class="nav-link inc_hover">Главная</a>
				</li>
				<li class="nav-item">
					<a href="pages/catalog.php" class="nav-link inc_hover">Каталог</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link inc_hover">О нас</a>
				</li>
				<li class="nav-item">
					<a href="pages/user_page.php" class="nav-link inc_hover"><?php linkName(); ?></a>
				</li>
			</ul>
		</nav>
		<a class="col-md-1 inc_hover" href="pages/basket.php"><img src="img/basket.svg" alt="basket"></a>
	</header>
	<div class="jumbotron-fluid billboard"></div>
	<div class="container">
		<div class="row">
			<div class="heading">
				<h1>Каталог</h1>
			</div>
			<div class="row justify-content-center">
				<?php getPopularProducts($link)?>
			</div>
			<a class="row btn btn-light" href="pages/catalog.php">Перейти в каталог</a>
		</div>
		<div class="row">
			<div class="heading">
				<h1>О нас</h1>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p>Мы – крупнейшая сеть музыкальных магазинов в России, интернет-магазин №1 по популярности в России.</p>
					<p>У нас представлен широкий ассортимент товаров для начинающих и профессиональных  музыкантов, звукорежиссеров и продюсеров, владельцев бизнесов. Компания - официальный дилер 300 мировых брендов Yamaha, Fender, Ibanez, Gibson, Marshall, Casio, AKG, Shure, Korg, Numark, Pioneer, Tamа, Zildjian, Mackie, JBL и других.</p>
				</div>
				<div class="col-md-6">
					<p>MUSIC – это особая атмосфера, место встречи и общения, это активное  сообщество  музыкантов – более 200 000 человек присоединилось к нашим  соцсетям. Мастер-классы, фестивали, презентации, автограф-сессии в магазинах  объединяют  всех, кто любит музыку.</p>
				</div>
			</div>
		</div>
		<footer></footer>
	</div>
</body>

</html>