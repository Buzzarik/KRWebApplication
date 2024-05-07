<?php
    session_start();
    $admin_pass = password_hash(1234567890, PASSWORD_DEFAULT);
    $admin_email = "news@gmail.com";
    if (isset($_SESSION["user"])){
        header("Location: profile.php");
    }
    if (isset($_SESSION["admin"])){
        header("Location: admin.php");
    }
    //если пользователь случайно зашел в этот файл,
    //то возвращают на основную страницу
    if (!isset($_POST["email"])){
        header("Location: adminLog.php");
    }
    else{
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        if ($email == $admin_email && password_verify($password, $admin_pass)){
            $_SESSION["admin"] = [
                "login" => $password,
                "email" => $email
            ];
            header("Location: admin.php");
        }
        else{
        $_SESSION["error_admin"] = "Неверный логин или пароль";
        header("Location: adminLog.php");
        }
    }
    
?>