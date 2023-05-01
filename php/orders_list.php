<?php 
require_once '../php/session.php';
require_once '../php/connection.php';
include('../templates/product_template.php'); // Подключаем файл с классом инициирующем шаблон
$login=$_SESSION['login'];

if (isset($_POST['action'])) {
	$action = $_POST['action'];

	if ($action == 'showOrders') {

		$sql = "SELECT user_id FROM users WHERE user_login='".$login."';";
		$result = mysqli_query($link, $sql)or die("Ошибка " . mysqli_error($link));;
		if ($result) {
			while($row = mysqli_fetch_row($result)) {
				$userid = $row[0];
			}
			mysqli_free_result($result);

			$sql = "Select user_id, orders.order_id, order_date, product_name, product_price, quantity, order_price, order_status from orders JOIN order_product on (orders.order_id=order_product.order_id) JOIN products on (order_product.product_id=products.product_id) WHERE user_id=".$userid." ORDER by order_date DESC;";
			$result = mysqli_query($link, $sql);
			if ($result) {
				$i = mysqli_num_rows($result);
				while ($row = mysqli_fetch_row($result)) {
					$orderid=$row[1];
					$date=$row[2];
					$pname=$row[3];
					$price=$row[4];
					$quant=$row[5];
					$total=$row[6];
					$status=$row[7];
					echo $orderid;

					$parse->get_tpl('../templates/orders_list_table.tpl'); //Файл который мы будем парсить
					$parse->set_tpl('{orderid}', $orderid); //Установка переменной {id}
					$parse->set_tpl('{date}', $date); //Установка переменной {date}
					$parse->set_tpl('{pname}', $pname); //Установка переменной {pname}
					$parse->set_tpl('{price}', $price); //Установка переменной {pprice}
					$parse->set_tpl('{quant}', $quant); //Установка переменной {quant}
					$parse->set_tpl('{total}', $total); //Установка переменной {quant}
					$parse->set_tpl('{status}', $status); //Установка переменной {quant}

					$parse->tpl_parse(); //Парсим
					print $parse->template; //Выводим нашу страничку*/
				}
				mysqli_free_result($result);
			}
		}
	}
}

?>