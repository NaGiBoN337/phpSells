<?php
require "../php/session.php";
require "../php/connection.php";
if (isset ($_SESSION['cart']) && isset($_POST)) {
    $cart = $_SESSION['cart'];
    $post = $_POST['quant'];
    $username = $_SESSION['login'];
    $email = $_SESSION['email'];
    
    
    //меняем количество товара.
    //для всех позиций в корзине сравниваем с входящими данными о количестве и изменяем при совпадении
    foreach ($cart as $pkey => &$product) {
        foreach ($post as $qkey => $quantity) {
            if ($pkey==$qkey) {
                $product['quant']=$quantity;
            }
        }
    }
    ///находим данные о пользователе
    $sql = "SELECT * FROM users WHERE user_login='$username'";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if ($result) {
        while ($row = mysqli_fetch_row($result)) {
            $userid = $row[0];
        }
        mysqli_free_result($result);
    }
    
    //подготавляваем данные о заказе
    $orderdate = date("Y-m-d H:i:s");
    $orderprice = intval($_POST['total']);
    $orderstatus = 'waiting';
    $delivery = 'delivery';
   
    //добавляем заказ в базу данных
    $sql = "INSERT INTO orders (user_id, order_date, order_price, order_status, delivery_type) VALUES ($userid, '$orderdate', $orderprice, '$orderstatus', '$delivery')";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));;
    
    //чтобы добавить данные о товарах в заказе получаем id заказа, который только что добавили
    $sql = "SELECT order_id FROM orders WHERE (user_id=$userid) AND (order_date='$orderdate');";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    while ($row = mysqli_fetch_row($result)) {
        $orderid = $row[0];
    }
    
    
    //для каждого элемента в корзине выбираем его id и количество
    //и добавляем в таблицу заказ-товар
    foreach ($cart as $help) {
        $pid = $help['product_id'];
        $pq = $help['quant'];
        $sql = "INSERT INTO order_product (order_id, product_id, quantity) VALUES ($orderid, $pid, $pq);";
        $result = mysqli_query($link, $sql) or die("Ошибка при оформлении заказа");
    }
    sendMessage($username, $email);
    unset($_SESSION['cart']);
    header("Location: ../pages/user_page.php");
}
else header("Location: ../pages/basket.php");


///функция отправки сообщения пользователю
function sendMessage($login, $email) {
    $subject = "Магазин музыкальных инструментов";
    $charset = "utf-8";
    $headers="From: mymusicvision@example.com\r\n";
    $headers.="Content-type: text/html; charset=$charset\r\n";
    $headers.="MIME-Version: 1.0\r\n";
    $headers.="Date: ".date('D, d M Y h:i:s O')."\r\n";
    $msg = $login.", Ваш заказ в обработке! Спасибо, что пользуетесь нашими услугами\n";
    $send = mail($email, $subject, $msg, $headers);
}

?>
