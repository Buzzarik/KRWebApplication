<?php
    require_once "connectBD.php";
    //вывод мини-новости на экран
    function printStrNew(&$news, $isuser, $id, $cnt_news){
        $data = "";
        $title = "";
        if ($id < $cnt_news){
            $type = $news[$id]['type'];
            $data = $news[$id]['data'];
            $title = $news[$id]['title'];
            $id = $news[$id]['id'];
            //здесь прописываем ссылку при нажатие(неавторизированный/авторизированный пользователь)
            if (!$isuser){
                $id = "index.php?type=$type&id=$id"; 
            }
            else{
                $id = "profile.php?type=$type&id=$id"; 
            }
        }
        else{
            $id = "#";
        }
        return
            "<div class='card mini'>
                <a href=
                '$id'
                 class='card-mini'>
                    <div class='card-mini__title'>
                        <span>
                            " .
                            $title
                            . "
                        </span>
                    </div>
                    <div class='time_new'>
                        " .
                            $data
                        . "
                    </div>
                </a>
            </div>";
    }

    //Вывод на экран строки из 3 новостей
    function printStrRowNews(&$news, $isuser, $ids, $cnt_news){
        $start = "<div class='topnews__row'>
                    <div class='cards-mini'> ";
        $end =   "</div></div>";

        for ($i = 0; $i < 3; $i++){
            $start .= printStrNew($news, $isuser, $ids, $cnt_news);
            $ids++;
        }
        return $start . $end;
    }

    //Вывод всех новостей на экран
    function printAllNews(&$db, $isuser,  $type=NULL){
        //в зависимости нажал ли пользователь на отделльный тип новостей(get запрос)
        if (isset($type)){
            $query = "SELECT a.id, image, title, data, type
            FROM news a JOIN type_news b ON a.id_type_new = b.id
            WHERE type = '$type' AND id_confirm = 1 ORDER BY data DESC";
        }
        else{
            $query = "SELECT a.id, image, title, data, type
            FROM news a JOIN type_news b ON a.id_type_new = b.id
            WHERE id_confirm = 1 ORDER BY data DESC";
        }
        $res = pg_query($db, $query);
        //возвращает все найденные строки
        $news = pg_fetch_all($res);

        $len = count($news);
        $current = 0;
        $rows = ceil($len / 3);
        $result = "";
        for ($i = 0; $i < $rows; $i++){
            $result .= printStrRowNews($news, $isuser, $current, $len);
            $current += 3;
        }
        return $result;
    }

    //вывод отдельной новости,если пользователь нажал на нее
    function printOnlyOneNew($db, $id){
        $query = "SELECT image, title, data, text_file FROM news WHERE id = '$id'";
        $res = pg_query($db, $query);
        $new = pg_fetch_array($res);    //получаем массив строк
        if ($new != false){
            //проверяем есть ли изображение
            if (($new['image'] != null)){
                echo "<img class='image' src='image/" . $new['image'] . "' alt='альтернативный текст' width='700' height='400'>";
            }
            $file = file_get_contents("filestxt/" . $new['text_file']);
            echo "<p class='new_header'><b>" . $new['title'] . "</b></p><br>";
            echo "<p class='new_page'>" . htmlspecialchars($file) . '</p><br>';
        }
    }
?>



