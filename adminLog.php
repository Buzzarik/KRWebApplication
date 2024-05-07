<!-- Заход админа пароль -->
<?php
    session_start();
    if (isset($_SESSION["user"])){
        header("Location: profile.php");
    }
    else if (isset($_SESSION["admin"])){
        header("Location: admin.php");
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход администрации сайта</title>
    <link rel="stylesheet" href="css/adminlog.css">
</head>
<body>
    <div class="layout">
        <div class="wrapper">
            <h1>Администрация</h1>
            <form action="adminCheck.php" method="POST">
                <div class="input-box">
                    <input name="email"
                        type="email" minlength="10" maxlength="30"
                        required>
                    <label>Почта</label>
                </div>
                <div class="input-box">
                    <input name="password" type="password" minlength="10" maxlength="15" required>
                    <label>Пароль</label>
                </div>
                <button type="submit" class="btn">Вход</button>
            </form>
            <div class="return">
                <a href="index.php">
                    <p>Возврат на главную</p>
                </a>
            </div>
            <div class="error">
                <p>
                    <?php
                        if (isset($_SESSION["error_admin"])){
                            echo $_SESSION["error_admin"];
                        }
                        unset($_SESSION["error_admin"]);
                    ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>