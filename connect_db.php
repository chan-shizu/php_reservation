<?php
$dsn = 'mysql:dbname=shizuya_control;host=localhost';
    $user = 'root';
    $password = 'password';
    //require_once("config_db.php");

    $PDO = new PDO($dsn, $user, $password); //MySQLのデータベースに接続
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示
?>