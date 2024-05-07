<?php
    require_once "connectBD.php";

    //создание списка новостей еще не проверенных
    function printNewsAdmin($db){
        $query = "SELECT a.id, b.type, c.login FROM news as a JOIN type_news as b ON
                a.id_type_new = b.id JOIN users as c ON
                c.id = a.id_author WHERE id_confirm=3 ORDER BY id ASC";
        $res = pg_query($db, $query);
        $cnt_news = pg_num_rows($res);
        if ($cnt_news > 0){
            echo "<ul>";
            while ($row = pg_fetch_array($res, NULL, PGSQL_ASSOC)){
                printNewAdmin($i, $row);
            }
            echo "</u>";
        }
    }

    //создание элемента списка с ссылкой get-запроса,чтобы при нажатии выводил на экран эту новость
    function printNewAdmin(&$i, &$new){
        $id = $new["id"];
        $type = $new["type"];
        $login = $new["login"];
        echo "<li><a href='admin.php?type=$type&id=$id&ath=$login'>Новость $type</a></li>";
    }

    //вывод отдельной новости,если пользователь нажал на нее
    function printOnlyOneNew($db, $id){
        $query = "SELECT image, title, data, text_file FROM news WHERE id = '$id'";
        $res = pg_query($db, $query);
        $new = pg_fetch_array($res);
        if ($new != false){
            //изображение
            if (($new['image'] != null)){
                echo "<img class='image' src='image/" . $new['image'] . "' alt='альтернативный текст' width='700' height='400'>";
            }
            $file = file_get_contents("filestxt/" . $new['text_file']);
            echo "<p class='new_header'><b>" . $new['title'] . "</b></p><br>";
            echo "<p class='new_page'>" . htmlspecialchars($file) . '</p><br>';
        }
    }

    //показ новости и ее дополнительные поля
    function printNewShow($db, $id, $type, $ath){
        if (isset($id))
        {
            echo "<div class='full_new'>";
            printOnlyOneNew($db, $id);
            echo "    
            </div>
            <div class='info'>
                <div>
                    <span>Тип: </span>
                    <span>
                        $type
                    </span>
                </div>
                <div>
                    <span>Автор: </span>
                    <span>
                        $ath
                    </span>
                </div>
            </div>";
        }
    }
?>