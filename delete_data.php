<form action="../php/delete_product.php" method="POST">
	<div class="container">
		<div class="row">
			<h5>Выберите артикул или название товара</h5>
		</div>
		<div class="row">
			<select class="col-3 form-control" name="param" id="param" required>
				<option selected disabled value=''>Выберите:</option>
				<option value="1">Артикул</option>
				<option value="2">Название</option>
			</select>
			<input class="col-9 form-control" id="selector" type=text name="param_val" list=param_val disabled required>
			<datalist id="param_val"></datalist>
		</div>
		<button class="row btn btn-light" type="submit">Удалить</button>
		<div>
			<?php 
			if (isset($_GET["message"])){
				$m=$_GET["message"];
				echo $m;
			} 
			?>
		</div>
	</div>
</form>