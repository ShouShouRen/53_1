<?php
    require_once("pdo.php");
    session_start();
    if(!isset($_SESSION["AUTH"])){
        header("Location: login.php");
    }
    try{
        extract($_POST);
        // $sql = "SELECT * FROM products ORDER BY products.time DESC";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="zh-Hant-tw">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>商店首頁</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">
                <img src="./images/logos.png" class="logo mx-3" alt="">
                <span>咖啡商品展示系統</span>
            </a>
        </div>
    </nav>
</body>

</html>