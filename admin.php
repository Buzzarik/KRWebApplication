<!-- Интерфейс админа -->
<?php
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: adminLog.php");
    }
    require_once "instructAd.php";
    $id = isset($_GET["id"]) ? $_GET["id"] : null;
    $type = isset($_GET["type"]) ? $_GET["type"] : null;
    $ath = isset($_GET["ath"]) ? $_GET["ath"] : null;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/admin.css">
    <title>Админ</title>
</head>
<body>
    <div class="section">
        <div class="contents">  
            <div class="new_info">
                <?php
                    printNewShow($dbconn, $id, $type, $ath);
                ?>
            </div>
            <nav class="spisok">
                <p>Список непросмотренных новостей</p>
                <?php
                    printNewsAdmin($dbconn);
                ?>
            </nav>
        </div>
        <div class="action">
            <a href="updateNew.php?id=<?php echo $id?>&conf=1"><p>Разрешить</p></a>
            <a href="updateNew.php?id=<?php echo $id?>&conf=2"><p>Отклонить</p></a>
            <a href="exitAdmin.php"><p>Выйти</p></a>
        </div>
    </div>
</body>
</html>