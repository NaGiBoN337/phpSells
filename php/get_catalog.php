<?php 

function getCheckbox($link, $table_name, $column) {
	$result = mysqli_query($link, 'SELECT * FROM '.$table_name);
	if ($result) {
		while ($row = mysqli_fetch_row($result)) {
      		echo "<div class='form-check'><label class='form-check-label'><input class='form-check-input' type='checkbox' name='".$table_name.$column."[]' value='$row[0]'>$row[$column]</label></div>";
    	}
    	mysqli_free_result($result);
	}
}
function getCountry($link) {
	$result = mysqli_query($link, 'SELECT * FROM brands');
	if ($result) {
		while ($row = mysqli_fetch_row($result)) {
      		echo "<div class='form-check'><label class='form-check-label'><input class='form-check-input' type='checkbox' name='brands2[]' value='$row[2]'>$row[2]</label></div>";
    	}
    	mysqli_free_result($result);
	}
}

function getProducts($link) {
	
    $querycategory = "";
    $querybrand = "";
    $querycountry= "";
    $queryminprice = "";
    $querymaxprice="";
    $sort_check = "";

	if (isset($_POST['sort_list'])) { $sort_list = $_POST['sort_list']; }
	else {$sort_list = 'sort_new';}

	if ($sort_list=='sort_new') { $sort_check = "ORDER BY product_id DESC";}
	elseif ($sort_list=='sort_inc') { $sort_check = "ORDER BY product_price";}
	else { $sort_check = "ORDER BY product_price DESC";}


	if (isset($_POST['categories1'])) { $cat_check = implode(',',$_POST['categories1']); $querycategory = "AND category_id IN ($cat_check)"; }
	if (isset($_POST['brands1'])) { $brnd_check = implode(',',$_POST['brands1']); $querybrand = "AND brands.brand_id IN ($brnd_check)";  }
	if (isset($_POST['brands2'])) { $cntr_check = implode("','",$_POST['brands2']); $querycountry = "AND country IN ($cntr_check)";  }
	if (isset($_POST['min_price_check']) && !empty($_POST['min_price_check'])) { $min_price_check = intval($_POST['min_price_check']); } else $min_price_check = 0;
	$queryminprice = "AND (product_price BETWEEN $min_price_check";
	if (isset($_POST['max_price_check']) && !empty($_POST['max_price_check'])) { $max_price_check = intval($_POST['max_price_check']); } 
	else {
		$qr = mysqli_query($link, "SELECT max(product_price) as maxprice FROM products");
		$max_price_check = mysqli_fetch_array($qr);
		$max_price_check = $max_price_check['maxprice'];
	}
	$querymaxprice = "AND $max_price_check)";
	$sql = "SELECT DISTINCT * FROM products NATURAL JOIN brands WHERE product_id>=0 ".$querycategory." ".$querybrand." ".$querycountry." ".$queryminprice." ".$querymaxprice." ".$sort_check;
	$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
	if ($result) {
		while($row = mysqli_fetch_row($result)) {
      	$id=$row[1];
      	echo "
      	<div class='col-md-6 col-lg-3 col-sm-9 product shadow_hover'>
	      		<a href='../pages/product.php?product_id=$id'>
	      			<div class='product_photo' ><img src='$row[8]' onerror='onerrorImage(this)'></div>
	      			<div class='align-items-end'>
	      				<h4 class=''>$row[3]</h4>
	    				<p class=''><br>Цена: $row[6] </p>
	      			</div>
	      		</a>
      	</div>";
    	}
	}
    else { echo "<p>Товары не найдены</p>"; }
    mysqli_free_result($result);
}

function getPopularProducts($link) {
	$sql = "SELECT * FROM popular";
	$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

	if ($result) {
		while($row = mysqli_fetch_row($result)) {
      	$id=$row[1];
      	echo 
      	"
      	<div class='col-sm-9 col-md-6 col-lg-3 col-xl-2 product shadow_hover'>
      		<a href='pages/product.php?product_id=$id'>
      			<div class='product_photo'><img class='card-img-top' src='".substr($row[4],3)."' onerror='onerrorImage(this)'></div>
      			<div class='align-items-end'>
      				<h6 class='card-title'>$row[2]</h4>
    				<p class='card-text'><br>Цена: $row[3] </p>
    			</div>
      		</a>
      	</div>";
    	}
    	mysqli_free_result($result);
    }
}
?>

<script>
function onerrorImage(image) {
	image.onerror = "";
	image.src = '../img/noimage.png'; // подгружаем картинку с альтернативного ресурса
}
</script>

