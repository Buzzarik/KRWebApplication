<?php
    session_start();
    if (isset($_SESSION["user"])){
        header("Location: profile.php");
    }
    else if (isset($_SESSION["admin"])){
        header("Location: admin.php");
    }
    require_once "selectBD.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/config.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Новости</title>
</head>

<body>
    <div class="layout">
        <div class="section__header">
            <header class="header">
                <h2 class="header__logo"><a href="index.php">Информашки</a></h2>
                <nav class="header__navigation">
                    <a class="navig" href="index.php?type=Европа">Европа</a>
                    <a class="navig" href="index.php?type=Россия">Россия</a>
                    <a class="navig" href="index.php?type=Спорт">Спорт</a>
                    <a class="navig" href="index.php?type=Культура">Культура</a>
                    <a class="navig" href="index.php?type=Образование">Образование</a>
                    <button class="header__btn-login">Вход</button>
                </nav>
            </header>

            <div class="wrapper">
                <span class="icon-close"><button></button></span>
                <div class="form-box login">
                    <h2>Вход</h2>
                    <form action="login.php" method="POST">
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
                        <div class="login-register">
                            <p>Вы еще не зарегестрированы? <a href="#" class="register-link">Зарегестрируйтесь</a></p>
                        </div>
                        <p class="error_log">
                                <?php
                                if (isset($_SESSION["error_msg_log"])) {
                                    echo $_SESSION["error_msg_log"];
                                }
                                ?>
                        </p>
                    </form>
                </div>
                <div class="form-box register">
                    <h2>Регистрация</h2>
                    <form action="registration.php" method="POST">
                        <div class="input-box">
                            <input name="email"
                                type="email" minlength="10" maxlength="30"
                                required>
                            <label>Почта</label>
                        </div>
                        <div class="input-box">
                            <input name="login"
                                type="text" minlength="10" maxlength="20"
                                required>
                            <label>Имя пользователя</label>
                        </div>
                        <div class="input-box">
                            <input name="password" type="password" minlength="10" maxlength="15" required>
                            <label>Пароль</label>
                        </div>
                        <button type="submit" class="btn">Регистрация</button>
                        <div class="login-register">
                            <p>У вас есть аккаунт? <a href="#" class="login-link">Войдите</a></p>
                            <p class="error_registr">
                                <?php
                                if (isset($_SESSION["error_msg_reg"])) {
                                    echo $_SESSION["error_msg_reg"];
                                }
                                ?>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="section__main">
            <div class="main-page__section">
                    <div class="main-container">
                        <?php
                            if (isset($_GET['type'])){
                                if (isset($_GET['id'])){
                                    //Вывод всей инфы новости то есть текст + фото))))
                                    printOnlyOneNew($dbconn, (int)$_GET['id']);
                                }
                                else{
                                    echo printAllNews($dbconn, false,  $_GET['type']);
                                }
                            }
                            else{
                                echo printAllNews($dbconn, false);
                            }
                        ?>
                    </div>
                    <div class="sidebar">
                        <img src="image/reklama1.png" alt="reklama1" class="siderbar__image">
                        <img src="image/reklama2.png" alt="reklama2" class="siderbar__image">
                        <img src="image/reklama3.jpg" alt="reklama3" class="siderbar__image">
                    </div>
            </div>
        </div>

        <div class="section__footer">
            <footer class="footer">
                <div class="footer__info">
                    <p>Контакный телефон: 8(999)-999-99-99</p>
                    <a href="adminLog.php">админ</a>
                    <p>Почта: news@gmail.com</p>
                    <!-- Ссылка на переход к входу админа -->
                </div>
            </footer>
        </div>
    </div>
<?php
    if (isset($_SESSION["error_msg_reg"])) {
        echo '<script src="script/registr_error.js"></script>';
    }
    unset($_SESSION["error_msg_reg"]);
?>
<?php
    if (isset($_SESSION["error_msg_log"])) {
        echo '<script src="script/log_error.js"></script>';
    }
    unset($_SESSION["error_msg_log"]);
?>
    <script src="script/login-registration.js"></script>    
</body>

</html>