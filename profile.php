<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: index.php");
    }
    require_once "selectBD.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <h2 class="header__logo"><a href="profile.php">Информашки</a></h2>
                <nav class="header__navigation">
                    <a class="navig" href="profile.php?type=Европа">Европа</a>
                    <a class="navig" href="profile.php?type=Россия">Россия</a>
                    <a class="navig" href="profile.php?type=Спорт">Спорт</a>
                    <a class="navig" href="profile.php?type=Культура">Культура</a>
                    <a class="navig" href="profile.php?type=Образование">Образование</a>
                    <button class="header__btn-login btn-publish">Публикация</button>
                    <button class="header__btn-login"><a href="exit.php">Выход</a></button>
                </nav>
            </header>

            <div class="wrapper publish">
                <span class="icon-close"><button></button></span>
                <div class="form-box">
                    <h2>Публикация</h2>
                    <form action="publish.php" enctype="multipart/form-data" method="POST" >
                        <div class="input-box">
                            <select class="select-css" name="type_new">
                                    <option value="Россия" selected>Россия</option>
                                    <option value="Европа">Европа</option>
                                    <option value="Образование">Образование</option>
                                    <option value="Культура">Культура</option>
                                    <option value="Спорт">Спорт</option>
                            </select>
                            <label>Тип новости</label>
                        </div>
                        <div class="input-box">
                            <input name="header"
                                type="text" minlength="10" maxlength="100"
                                required> 
                            <label>Заголовок</label>
                        </div>
                        <div class="input-box">
                            <input class="file_style" name="new" type="file" accept=".txt" required>
                            <label>Файл публикации (.txt)</label>
                        </div>
                        <div class="input-box">
                            <input class="file_style" name="photo" type="file" accept="image/png, image/jpeg">
                            <label>Картинка (.png, .jpeg)</label>
                        </div>
                        <button type="submit" class="btn">Опубликовать</button>
                        <p class="error_publish">
                                <?php
                                if (isset($_SESSION["error_msg_publish"])) {
                                    echo $_SESSION["error_msg_publish"];
                                }
                                ?>
                        </p>
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
                                    echo printAllNews($dbconn, true,  $_GET['type']);
                                }
                            }
                            else{
                                echo printAllNews($dbconn, true);
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
                    <p>Почта: news@gmail.com</p>
                </div>
            </footer>
        </div>
    </div> 
    <?php
        if (isset($_SESSION["error_msg_publish"])) {
            echo '<script src="script/publish_error.js"></script>';
    }
        unset($_SESSION["error_msg_publish"]);
    ?>
    <script src="script/publish.js"></script> 
</body>

</html>