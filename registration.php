<?php
    session_start();
    require_once "connectBD.php";

    if (isset($_SESSION["user"])){
        header("Location: profile.php");
    }
    if (!isset($_POST["login"])){
        header("Location: index.php");
    }
    else{
        //проверка почты на авторизованность
        $email = htmlspecialchars($_POST["email"]);
        $query = "SELECT email FROM users WHERE email = '$email'";
        $check = pg_query($dbconn, $query);
        $check_email = pg_fetch_row($check);
        //если уже есть почта, то соответсвенно говорим это пользователю
        if ($check_email){
            $_SESSION["error_msg_reg"] = "Под этой почтой уже авторизировались";
            header("Location: index.php");
        }
        else{
        //все ок, заносим данные в БД и переадресовываем его на его личную страничку
        $login = htmlspecialchars($_POST["login"]);
        $password = password_hash((htmlspecialchars($_POST["password"])), PASSWORD_DEFAULT);
        $query = "INSERT INTO users (login, email, password) VALUES('$login', '$email', '$password')";
        pg_query($dbconn, $query);
        //создаем информацию о пользователе для блокировки
        //для блокировки переходов между страницами
        $_SESSION["user"] = [
            "login" => $login,
            "email" => $email
        ];
        header("Location: profile.php");
        }
    }
?>
