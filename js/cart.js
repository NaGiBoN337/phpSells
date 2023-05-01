//проверяем что пользователь авторизован
function CheckToAdd(id) {
    var access = getcookie("access");
    if (access) {
        addToCart(id);
    }
    else {
        alert('Чтобы добавить товар в корзину необходимо войти');
    }
}
//проверяем наличие куки доступа
function getcookie(a) {
    var b = new RegExp(a+'=([^;]){1,}');
    var c = b.exec(document.cookie);
    if (c) {
        c = c[0].split('='); 
    }
    else return false;
    return c[1] ? c[1] : false;
}

//добавление товара в корзину
function addToCart(id) {
    $.ajax({
        url: '../php/cart.php',
        type: 'POST',
        dataType: "text",
        data: { action: 'add',
                id: id },
        error: function() {
            alert("Ошибка при добавлении товара в корзину");
        },
        success: function (response) {
            alert(response);
        }
    });
}
//удаление товара из корзины
function delFromCart(id) {
    $.ajax({
        url: '../php/cart.php',
        type: 'POST',
        dataType: "text",
        data: { action: 'del',
                id: id },
        error: function() {
            alert("Ошибка при удалении товара из корзины");
        },
        success: function (response) {
            $('#basket_product_section').html(response);
            showTotal();
            showCart();
        }
    });
}

function showTotal() {
    console.log("tot");
    $.ajax({
        url: '../php/cart.php',
        type: 'POST',
        dataType: "text",
        data: { action: 'total'},
        error: function() {
            alert("Ошибка");
        },
        success: function (response) {
            $('#total-cart-summa').html(response);
        }
    });
}
//вывод корзины на экран
function showCart() {
    $.ajax({
        url: '../php/cart.php',
        type: 'POST',
        dataType: "text",
        data: 'action=show',
        error: function() {
            alert("Ошибка при добавлении товара в корзину");
        },
        success: function (response) {
            $('#basket_product').html(response);
        }
    });
}
//при нажатии на кнопку увеличения/уменьшения количества товара меняется общая стоимость
function onUp(num) {
    var numericUpDown = document.getElementById("numericUpDown"+num);
    if (isNaN(numericUpDown.value)) {
        numericUpDown.value = 1;
    }
    else {
        numericUpDown.value = parseInt(numericUpDown.value)+1;
        setSum();
    }
}
function onDown(num) {
    var numericUpDown = document.getElementById("numericUpDown"+num);
    if (numericUpDown.value >1) {
        numericUpDown.value=numericUpDown.value-1
        setSum();
    }
    else {
        numericUpDown.value =1;
    }
}

//так же при вводе количества товара вручную
function onInput(num) {
    setSum();
}

//функция изменения общей суммы и вывода на экран
function setSum() {
    var summa = document.getElementById("total-cart-summa");
    let sum=0;
    let products = document.querySelectorAll('tr.product_list');
    for (let elem of products) {
        numericUpDown = elem.querySelector('input.form-control');
        price = elem.querySelector('div.prodprice');
        sum += parseInt(price.innerHTML) * numericUpDown.value;
    }
    summa.innerHTML = sum;
    var total = document.getElementById("total");
    total.value = sum;
}
