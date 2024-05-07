<?php
    session_start();
    require_once "connectBD.php";

    function removeNew($db, $confirm, $id){
        $query = "SELECT text_file, image FROM news WHERE id='$id'";
        $res = pg_query($db, $query);
        $res = pg_fetch_array($res);
        $textfile = $res["text_file"];
        $image = $res["image"];
        $uploaddirText = '/Users/evgeniy/localhost/kr2023/filestxt/';
        $uploaddirImage = '/Users/evgeniy/localhost/kr2023/image/';
        unlink($uploaddirText . $textfile);
        if (isset($image)){
            unlink($uploaddirImage . $image);
        }
        $query = "UPDATE users as a SET raiting=raiting - 1 WHERE a.id=
        (SELECT id_author FROM news as b WHERE b.id='$id')";
        $res1 = pg_query($db, $query);
        $query = "UPDATE news SET id_confirm='$confirm' WHERE id='$id'";
        $res = pg_query($db, $query);
    }

    function successNew($db, $confirm, $id){
        $query = "UPDATE news SET id_confirm='$confirm' WHERE id='$id'";
        $res = pg_query($db, $query);
        $query = "UPDATE users as a SET raiting=raiting + 1 WHERE a.id=
        (SELECT id_author FROM news as b WHERE b.id='$id')";
        $res1 = pg_query($db, $query);
    }


    if (isset($_SESSION["admin"])){
        $id = $_GET["id"];
        $conf = $_GET["conf"];
       if (isset($id) && is_numeric($id) && isset($conf) && is_numeric($conf)){
        $conf = (int)$conf;
        $id = (int)$id;
        $query = "SELECT id FROM news WHERE id='$id'";
        $res = pg_query($dbconn, $query);
        $res = pg_fetch_array($res);    //получаем массив строк
        if ($res != false){
            if ($conf == 1){
                successNew($dbconn, $conf, $id);
            }
            else{
                if ($conf == 2){
                    removeNew($dbconn, $conf, $id);
                }
            }
        }
       }
    header("Location: admin.php");
    }
    else{
        if (isset($_SESSION["user"]))
        {
            header("Location: profile.php");
        }
        else{
            header("Location: index.php");
        }
    }

    ?>