<?php
    session_start();
    require_once "connectBD.php";

    //для корректного названия текстового файла на сервере
    function printType($type){
        switch ($type) {
            case "Россия":
                return "russia";
                break;
            case "Культура":
                return "culture";
                break;
            case "Образование":
                return "education";
                break;
            case "Спорт":
                return "sport";
                break;
            case "Европа":
                return "europa";
                break;
        }
    }

    //проверка на авторизированного пользователя
    if (isset($_SESSION["user"])){
        //проверка на удачную загрузку файла
        if (isset($_FILES["new"]) && $_FILES["new"]["type"] == "text/plain" && $_FILES["new"]["error"] == UPLOAD_ERR_OK){

            $header = $_POST["header"];
            $type = $_POST["type_new"];
            $photo = null;
            $en_type = printType($type);
            $email = $_SESSION["user"]["email"];
            $uploaddir = '/Users/evgeniy/localhost/kr2023/';

            //проверка на удачную загрузку фото
            if (isset($_FILES["photo"]) &&  ($_FILES["photo"]["type"] == "image/png" || $_FILES["photo"]["type"] == "image/jpeg")
                 && $_FILES["photo"]["error"] == UPLOAD_ERR_OK)
            {
                //махинации с названием файла и его созданием на сервере
                $type_photo = mb_substr($_FILES["photo"]["type"], 6);
                $photo = $en_type . time() . "." . $type_photo;
                $uploadfile = $uploaddir . "image/" . $photo;
                move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadfile);
            }

            //махинации с названием файла и его созданием на сервере
            $new = $en_type . time() . ".txt";
            $uploadfile = $uploaddir . "filestxt/" . $new;
            move_uploaded_file($_FILES["new"]["tmp_name"], $uploadfile);

            $query = "SELECT id FROM type_news WHERE type = '$type'";
            $type_id = pg_query($dbconn, $query);
            $type_id = pg_fetch_array($type_id);
            $type_id = $type_id['id'];
            $query = "SELECT id FROM users WHERE email = '$email'";
            $id = pg_query($dbconn, $query);
            $id = pg_fetch_array($id);
            $id = $id['id'];


            $query = "INSERT INTO news (id_author, id_type_new, image, title, text_file) VALUES('$id', '$type_id', '$photo', '$header', '$new')";
            pg_query($dbconn, $query);

        }
        else{
            $_SESSION["error_msg_publish"] = "Данные не приняты";
        }
        header("Location: profile.php");
    }
    else{
        header("Location: index.php");
    }

    ?>