<?php
    session_start();
    require_once "connectBD.php";

    if (isset($_SESSION["user"])){
        header("Location: profile.php");
    }

    if (!isset($_POST["email"])){
        header("Location: index.php");
    }
    else{
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $query = "SELECT email, password FROM users WHERE email = '$email'";
        $check = pg_query($dbconn, $query);
        $check_log = pg_fetch_row($check);
        if ($check_log[0] == $email && password_verify($password, $check_log[1])){
            $_SESSION["user"] = [
                "login" => $password,
                "email" => $email
            ];
            header("Location: profile.php");
        }
        else{
        $_SESSION["error_msg_log"] = "Неверный логин или пароль";
        header("Location: index.php");
        }
    }
    
?>