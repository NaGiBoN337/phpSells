<div class="row" id="adminTab">
	<ul class="col-12 nav nav-tabs">
		<li class="nav-item"><a class="nav-link" href="#" data-tab="insert_tab">Добавить данные</a></li>
		<li class="nav-item"><a class="nav-link" href="#">Удалить данные</a></li>
		<li class="nav-item"><a class="nav-link" href="#">Изменить данные</a></li>
	</ul>
	<div class="col-12 tab-content">

		<div id="insert_tab" class="tab-pane">
			<form onsubmit="return checkForm(this)" action="../php/add_product.php" method="POST">
				<div class="container">
					<div class="row">
						<h5>Введите информацию о товаре</h5>
					</div>
					<div class="row input-group form-inline">
						<label class="form-control col-3" >Артикул*:</label>
						<input class="form-control col-9" type="text" id="product_code" name="product_code">
					</div>
					<div class="row input-group form-inline">
						<label class="form-control col-3" >Название товара*:</label>
						<input class="form-control col-9" type="text" id="product_name" name="product_name">
					</div>
					<div class="row input-group form-inline">
						<label class="form-control col-3" >Категория*:</label>
						<select class="form-control col-9" type="text" id="category_id" name="category_id" list=cat_val>
							<?php getOptionValue($link, 'categories'); ?>
						</select>
					</div>
					<div class="row input-group form-inline">
						<label class="form-control col-3" >Описание товара:</label>
						<input class="form-control col-9"  type="textarea" name="product_desc">
					</div>
					<div class="row input-group form-inline">
						<label class="form-control col-3" >Цена*:</label>
						<input class="form-control col-9" type="text" id="product_price" name="product_price">
					</div>
					<div class="row input-group form-inline">
						<label class="form-control col-3" >Бренд*:</label>
						<select class="form-control col-9" type="text" id="brand_id" name="brand_id">
							<?php getOptionValue($link, 'brands'); ?>
						</select>
					</div>
					<div class="row input-group form-inline">
						<label class="form-control col-3" >Изображение*:</label>
						<input class="form-control col-9" type="text" id="product_image" name="product_image">
					</div>
				</div>
				<button class="row btn btn-light" type="submit">Добавить</button>
			</form>

		</div>
		<div id="delete_tab" class="tab-pane">
			<?php	include "../core/delete_data.php"; ?>
		</div>
		<div id="edit_tab" class="tab-pane">
			<form action="../php/update_data.php" method="POST">
				<div class="container">
					<div class="row">
						<h5>Изменить уровень доступа</h5>
					</div>
					<div class="row">
						<div class="input-group">
							<label class="form-control col-3" for="username">Введите имя пользователя:</label>
							<input class="form-control col-9" type="text" id="username" name="username" placeholder="логин">
						</div>
					</div>
					<div class="row">
						<div class="input-group">
							<p class="form-control col-3">Выберите уровень доступа:</p>
							<select class="form-control col-9" name="status" id="status" required>
								<option selected disabled value=''></option>
								<option value="user">user</option>
								<option value="admin">admin</option>
							</select>
						</div>
					</div>
				</div>
				<button class="row btn btn-light" type="submit">Изменить</button>
			</form>
		</div>
	</div>
	<div id="err">
		<?php
		if (isset($_GET['message'])) {
			echo $_GET['message'];
			unset($_GET['message']);
		}
		?>
	</div>
</div>

<script type="text/javascript" src="../js/admin.js"></script>

