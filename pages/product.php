<?php include '../php/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>MUSIC</title>
	<meta charset=UTF-8>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<link href="../css/bootstrap.min.css" rel=stylesheet />
	<link href="../css/style.css" rel=stylesheet />
	<?php require '../php/get_functions.php';?>
</head>
<body>
	<?php include '../templates/header.php'; ?>
	<content class="container">
		<div class="row">
			<?php
			$id=$_GET['product_id'];
			$obj=getProduct($link, $id);
			$pname=$obj->product_name;
			$cat=$obj->category_name;
			$brand=$obj->brand_name;
			$country=$obj->country;
			$desc=$obj->product_desc;
			$price=$obj->product_price;
			$image=$obj->product_image;

				include('../templates/product_template.php'); // Подключаем файл с классом инициирующем шаблон
				
				$parse->get_tpl('../templates/product.tpl'); //Файл который мы будем парсить
				$parse->set_tpl('{id}', $id); //Установка переменной {pname}
				$parse->set_tpl('{pname}', $pname); //Установка переменной {pname}
				$parse->set_tpl('{pcat}',$cat); //Установка переменной { pcat }
				$parse->set_tpl('{pbrand}', $brand); //Установка переменной {pbrand}
				$parse->set_tpl('{pcountry}', $country); //Установка переменной {pcountry}
				$parse->set_tpl('{pprice}', $price); //Установка переменной {pprice}
				$parse->set_tpl('{pimage}', $image); //Установка переменной {pprice}
				$parse->set_tpl('{pdesc}', $desc); //Установка переменной {pprice}

				$parse->tpl_parse(); //Парсим
				print $parse->template; //Выводим нашу страничку
				?>
			</div>
		</content>
		<footer></footer>
	</body>

</html>