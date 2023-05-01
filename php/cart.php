<?php 
require_once '../php/get_functions.php';
require_once '../php/session.php';
require_once '../php/connection.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

/// вывод корзины на экран
    if ($action == 'show') {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { echo "Ваша корзина пуста"; exit;}
        else {
            $cart = $_SESSION['cart'];
            include('../templates/product_template.php'); // Подключаем файл с классом инициирующим шаблон
            for ($i=0; $i < count($cart); $i++) { 
                
                $id = $cart[$i]['product_id'];
                $obj=getProduct($link, $id);
                $image=$obj->product_image;
                $pname=$obj->product_name;
                $price=$obj->product_price;
                while($link->next_result()) $link->store_result(); //освобождаем

                $parse->get_tpl('../templates/cart_table.tpl'); //Файл который мы будем парсить
                $parse->set_tpl('{i}', $i); //Установка переменной {i}
                $parse->set_tpl('{id}', $id); //Установка переменной {id}
                $parse->set_tpl('{pname}', $pname); //Установка переменной {pname}
                $parse->set_tpl('{pprice}', $price); //Установка переменной {pprice}
                $parse->set_tpl('{pimage}', $image); //Установка переменной {pprice}

                $parse->tpl_parse(); //Парсим
                print $parse->template; //Выводим нашу страничку
            }
        }
    }

/// добавление товара в корзину
    if ($action == 'add') {
        $newProduct = array();
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }
        else $cart = array();

        $id = $_POST['id'];
        
        $arr = search($cart, 'product_id', $id);
        if (!search($cart, 'product_id', $id)) {

            $obj=getProduct($link, $id);
            $pname=$obj->product_name;
            $price=$obj->product_price;
            $quant=1;
            
            $newProduct['product_id'] = $id;
            $newProduct['name'] = $pname;
            $newProduct['price'] = $price;
            $newProduct['quant'] = $quant;
            $cart[count($cart)] = $newProduct;
            $_SESSION['cart']=$cart;
            echo "Товар добавлен в корзину";
        }
        else { echo "Товар уже добавлен в корзину. Чтобы изменить количество товара, перейдите в корзину"; }
    }

/// удаление товара из корзины
    if ($action == 'del') { 
        $id = $_POST['id'];
        $newCart = array();
        $cart = $_SESSION['cart'];
        for ($i=0; $i < count($cart); $i++) {
            $product_id = $cart[$i]['product_id'];
            if ($id != $product_id) {
                $newCart[count($newCart)] = $cart[$i];
            }
        }
        $_SESSION['cart']=$newCart;
    }
    
    if ($action =='total') {
        totalPrice();
    }
}

/// так как корзина это массив с массивами, поиск по ключ=>значение становится сложнее
/// эта функция ищет пару ключ=>значение в подмассиве массива корзины
/// и возвращает найденное
function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;

}

function totalPrice() {
    $sum = 0;
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        $sum;
        foreach ($cart as $arr) {
            $sum += intval($arr['price'])*intval($arr['quant']);
        }
    }
    echo $sum;
}