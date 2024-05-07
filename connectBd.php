<?php
    $connect_string = "host=localhost port=5433 dbname=test user=postgres password=1065";
    $dbconn = pg_connect($connect_string);
    if (!$dbconn) {
        exit(header('Location: error404/'));
        die("Error connect to DataBase");
    }
?>

