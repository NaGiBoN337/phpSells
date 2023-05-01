<script type="text/javascript" src="../js/cart.js"></script>
<section class="container">
	<div class="row heading">
		<h1>{pname}</h1>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><img class="col-12" src='{pimage}'></div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 justify-content-end">
			<div class="row">
				<h3> {pname} </h1>
			</div>
			<div class="row">
				<h3 class="col-6">Категория: </h1><p class="col-6">{pcat}</p>
			</div>
			<div class="row">
				<h3 class="col-6">Бренд: </h1><p class="col-6"> {pbrand} </p>
			</div>
			<div class="row">
				<h3 class="col-6">Страна производитель: </h1><p class="col-6"> {pcountry} </p>
			</div>
			<div class="row">
				<h3 class="col-6">Цена: </h1><p class="col-6"> {pprice} </p>
			</div>
			<div class="row">
				<button class="btn btn-light" onclick="CheckToAdd('{id}')" >Добавить в корзину</button>
			</div>
			<div class="row" id="resp"></div>
		</div>
	</div>
	<div class="row">
		<h3>Описание: </h1> 
		<p>{pdesc}</p>
	</div>
</section>