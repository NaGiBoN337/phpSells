<tr class="product_list">
		<td><a href="../pages/product.php?product_id={id}"><img id="product_image" src="{pimage}"></a></td>
	<td><span>{pname}</span></td>
	<td>
	<div class="input-group">
	    <input id="down" type="button" value="-" onclick="onDown({i})">
	    <input class="form-control" id="numericUpDown{i}" name="quant[{i}]" type="number" value="1" min=1 oninput="onInput()">
	    <input id="up" type="button" value="+" onclick="onUp({i})" >
	    </div>
	</td>
	<td><div class="prodprice" value="{pprice}">{pprice}</div></td>
	<td><button type="button" onclick="delFromCart({id})">Удалить</button></td>
</tr>