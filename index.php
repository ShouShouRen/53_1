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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height:100px">
                    <li class="nav-item">
                        <?php if($_SESSION["AUTH"]["role"]==0){echo '<a class="nav-link" href="create_product.php">上架商品</a>';} ?>
                    </li>
                    <li class="nav-item">
                        <?php if($_SESSION["AUTH"]["role"]==0){echo '<a class="nav-link" href="member_list.php">會員管理</a>';} ?>
                    </li>
                    <li class="nav-item">
                        <?php if(isset($_SESSION["AUTH"])){echo '<a class="nav-link btn btn-outline-warning" href="logout.php">登出</a>';} ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
<script src="./js/jquery-3.6.3.min.js"></script>
<script src="./js/bootstrap.js"></script>

</html>