<?php require_once '../php/connection.php'; 
/* Проверяем, что все поля формы заполнены и не пусты */
if (isset($_POST['product_code']) && !empty($_POST['product_code']) && isset($_POST['product_name']) && !empty($_POST['product_name']) && isset($_POST['category_id']) && !empty($_POST['category_id']) && isset($_POST['product_price']) && !empty($_POST['product_price']) && isset($_POST['brand_id']) && !empty($_POST['brand_id']) && isset($_POST['product_image']) && !empty($_POST['product_image']))
{
    /* переносим значения из формы в переменные */
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_desc = $_POST['product_desc'];
    $product_price = $_POST['product_price'];
    $brand_id = $_POST['brand_id'];
    $product_image = $_POST['product_image'];
    $message = "";
    
    /* формируем строку запроса */
    $sql = "INSERT INTO products (product_code, product_name, category_id, product_desc, product_price, brand_id, product_image) VALUES ('$product_code', '$product_name', '$category_id', '$product_desc', '$product_price', '$brand_id', '$product_image')";
    $result = mysqli_query($link, $sql);
    
    /* передаем пользователю результат попытки */
    if ($result) {
		header("Location: ../pages/user_page.php?message=Товар добавлен");
	}
	else {
		header("Location: ../pages/user_page.php?message=Ошибка при добавлении товара");
	}
}
else {
	echo "Поля со звездочкой должны быть заполнены";
}
?>





