<?php include '../php/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>MUSIC</title>
	<meta charset=UTF-8>
	<link href="../css/bootstrap.min.css" rel=stylesheet />
	<link href="../css/style.css" rel=stylesheet />
	<?php require '../php/get_catalog.php';?>
</head>
<body>
	<?php include '../templates/header.php'; ?>
	<div class="container">

		<div class="heading">
			<h1>Каталог</h1>
		</div>
		<div class="row">
			<aside class="col-md-3 col-lg-2">
				<form id="prop_form" action="catalog.php" method="POST">
					<div class="form-group">
						<h6>Сортировка:</h6>
						<select class="btn-responsive dropdown-toggle form-control" id="prop_form_item1" name="sort_list">
							<option class="dropdown-item" value="sort_new">По новизне</option>
							<option class="dropdown-item" value="sort_inc">По возрастанию цены</option>
							<option class="dropdown-item" value="sort_dec">По убыванию цены</option>
						</select>
					</div>
					<div class="form-group">
						<h6>Категория:</h6>
						<div id="prop_form_item2">
							<?php $categories = getCheckbox($link, "categories", 1)?>
						</div>
					</div>
					<div class="form-group">
						<h6>Бренд:</h6>
						<div id="prop_form_item5">
							<?php $brands = getCheckbox($link, "brands", 1) ?>
						</div>
					</div>
					<div class="form-group">
						<h6>Страна производитель:</h6>
						<div id="prop_form_item6">
							<?php $countries = getCountry($link)  ?>
						</div>
					</div>
					<div class="form-group">
						<h6>Минимальная цена:</h6>
						<input class="form-control" id="prop_form_item3" type="number" name="min_price_check">
					</div>
					<div class="prop_form_item form-group">
						<h6>Максимальная цена:</h6>
						<input class="form-control" id="prop_form_item4" type="number" name="max_price_check">
					</div>
					<button class="btn btn-light" type="submit">Показать</button>
				</form>
			</aside>
			<content class="col-md-9 col-lg-10">
				<div class="row justify-content-center">
					<?php  getProducts($link); ?>
				</div>
			</content>
		</div>
		
		<footer></footer>
	</body>

	</html>