<script type="text/javascript">
	function showOrders() {
    $.ajax({

            url: '../php/orders_list.php',
            type: 'POST',
            dataType: "text",
            data: 'action=showOrders',
            error: function() {
                alert("Ошибка при добавлении товара в корзину");
            },
            success: function (response) {
                $('#order_list').html(response);
            }
        });
}
</script>

<section class="row">
	<div>
		<h5>Ваши заказы:</h5>
	</div>
	<div class="container">
		<table class="table text-center">
			<thead>
				<tr>
			      <th>Номер заказа</th>
			      <th>Дата</th>
			      <th>Позиция</th>
			      <th>Цена</th>
			      <th>Количество</th>
			      <th>Сумма</th>
			      <th>Статус</th>
			    </tr>
			</thead>
		  	<tbody id="order_list">
				<script>showOrders()</script>
		  	</tbody>
		</table>
	</div>
	
</section>

