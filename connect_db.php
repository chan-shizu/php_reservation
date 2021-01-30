<?php
//$dsn = 'mysql:dbname=shizuya_control;host=localhost';
//    $user = 'root';
//    $password = 'password';
//    //require_once("config_db.php");
//
//    $PDO = new PDO($dsn, $user, $password); //MySQLのデータベースに接続
//    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示

//"mysql://b64195afff2cd8:e60f9c72@us-cdbr-east-03.cleardb.com/heroku_49ec5ffd2a8ed28?reconnect=true"
    $db = parse_url($_SERVER["mysql://b64195afff2cd8:e60f9c72@us-cdbr-east-03.cleardb.com/heroku_49ec5ffd2a8ed28"]);
    $db['dbname'] = ltrim($db['path'], '/');
    $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
    $user = $db['user'];
    $password = $db['pass'];
    //$options = array(
    //  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //  PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
    //);
    $PDO = new PDO($dsn,$user,$password);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示

//CLEARDB_DATABASE_URL: mysql://[ユーザー名]:[パスワード]@[ホスト名]/[データベース名]?reconnect=true
//$url = parse_url(getenv("mysql://b64195afff2cd8:e60f9c72@us-cdbr-east-03.cleardb.com/heroku_49ec5ffd2a8ed28"));
//
//$server = $url["host"];
//$username = $url["user"];
//$password = $url["pass"];
//$db = substr($url["path"], 1);
//
//$PDO = new PDO(
//  'mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8mb4',
//  $username,
//  $password,
//  [
//    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
//  ])
?>