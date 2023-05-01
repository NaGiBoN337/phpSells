<?php include '../php/session.php'; 
require_once '../php/connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>MUSIC</title>
    <meta charset=UTF-8>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/admin.js"></script>
    <link href="../css/bootstrap.min.css" rel=stylesheet />
    <link href="../css/style.css" rel=stylesheet />
    <?php require '../php/get_functions.php';?>
</head>
<body>
    <?php include '../templates/header.php'; ?>
    <div class="container">
        <?php
        
        if (isset($_COOKIE['access'])) {
            if ($_COOKIE['access'] == true) {
                ?>
                    <div class="row">
                            <span class="align-self-center mr-2">Вы зашли под именем <?php echo $_SESSION['login'] ?></span>
                            <form method="post" action="../php/access.php">
                                <button class="btn btn-light" type="submit" name="logout">Выход</button>
                            </form>
                    </div>

                    <?php

                    if (isset($_SESSION['login'])) { $login = $_SESSION['login'];}
                    $sql = "SELECT * FROM users WHERE user_login='$login'";
                    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
                    $object = mysqli_fetch_object($result)  ;
                    $user_status = $object->user_status;
                    if ($user_status=="admin") {
                        include "../core/admin_ability.php";
                    }
                    else {
                        include "../core/user_ability.php"; 
                    }
                }
            }
            else {
                include "../pages/login_page.php";
            }
        if (isset($_GET['message'])) echo $_GET['message']; unset($_GET['message']);

            ?>
    </div>
    <footer></footer>
</body>
</html>