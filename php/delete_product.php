<?php 
require_once '../php/connection.php'; 

$param = $_POST['param'];
$value = $_POST['param_val'];
if (isset($_POST['action']) && ($_POST['action']=='change')) {
    $sql = "SELECT * FROM products order by product_name";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if ($result) {
    	while($row = mysqli_fetch_row($result)) {
    		$str = $row[$param];
    		echo '<option value="'.$str.'"></option>';
    	}
    	mysqli_free_result($result);
    }
}
$col="";
if ($param==1) {
    $col = "product_code=";
}
elseif ($param==2) {
    $col = "product_name=";
}
$sql = "delete from products where ".$col."'".$value."';";
$result = mysqli_query($link, $sql);
/* передаем пользователю результат попытки */
if ($result) {
	$message = "Товар удален";
}
else {
	$message = "Ошибка при удалении товара";
}
header("Location: ../pages/user_page.php?message=$message");

?>

