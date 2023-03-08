<?php
    $db_host = "localhost";
    $db_name = "53_1";
    $db_user = "admin";
    $db_pw = "1234";
    $db_charset = "utf8mb4";
    $dsn = "mysql:host{$db_host};dbname:{$db_name};charset:{$db_charset}";

    try{
        $pdo = new PDO($dsn,$db_user,$db_pw);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
