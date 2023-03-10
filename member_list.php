<?php
    session_start();
    if(!isset($_SESSION["AUTH"]) || $_SESSION["AUTH"]["role"] != 0){
        header("Location:login.php");
    }
    try{
        require_once("pdo.php");
        $sql = "SELECT * FROM users";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>會員管理後台管理模組</title>
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
    <div class="container" style="margin-top:86px;">
        <div class="pt-3 pb-5">
            <div class="row justify-content-between align-items-center">
                <h5 class="text-center text-white border-start font-weight-bolder">會員管理</h5>
                <div class="d-flex justify-content-around align-items-center text-white py-3 w-25">
                    <input type="number" value="60" id="timeInput" class="form-control w-25">
                    <button id="setTimeBtn" class="btn btn-sm btn-outline-light">設定</button>
                    <span id="countdown">60秒</span>
                    <button id="resetTimeBtn" class="btn btn-sm btn-outline-light">重新計時</button>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-6">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#adduser">新增使用者</button>
                        <!-- Modal -->
                        <div class="modal fade" id="adduser">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="adduserLabel">新增使用者</h5>
                                        <button class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-sm px-5 py-4">
                                            <form action="register_store.php" method="post">
                                                <label for="">帳號</label>
                                                <input type="text" name="user" class="form-control my-2" require>
                                                <label for="">使用者姓名</label>
                                                <input type="text" name="user_name" class="form-control my-2" require>
                                                <label for="">密碼</label>
                                                <input type="password" name="pw" class="form-control my-2" require>
                                                <div class="text-right"><input type="submit" value="註冊" class="btn btn-success"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <form action="search_member.php" id="search-member" class="d-flex justify-content-end align-items-center">
                        <div class="d-flex px-2">
                            <label for="">升冪</label>
                            <input type="radio" name="use" id="" value="up">
                        </div>
                        <div class="d-flex px-2">
                            <label for="">降冪</label>
                            <input type="radio" name="use" id="" value="down">
                        </div>
                        <input type="search" name="search" id="search-input" placeholder="請輸入使用者資料"
                            class="form-control w-50 mr-2">
                        <button type="submit" class="btn btn-secondary">查詢</button>
                        </form>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <th>使用者編號</th>
                        <th>使用者帳號</th>
                        <th>使用者密碼</th>
                        <th>使用者名稱</th>
                        <th>使用者權限</th>
                        <th>操作</th>
                    </tr>
                    <tbody id="search_result">

                    </tbody>
                    <?php foreach($result as $row) { ?>
                        <tr class="show-all">
                            <td><?= $row["user_id"]; ?></td>
                            <td><?= $row["user"]; ?></td>
                            <td><?= $row["pw"]; ?></td>
                            <td><?= $row["user_name"]; ?></td>
                            <td><?php switch ($row["role"]) { case 0: echo "管理員"; break; case 1: echo "一般使用者"; break; } ?></td>
                            <td>
                                <?php if ($row["id"] == 1) { ?>
                                <?php } elseif ($row["id"] == $_SESSION["AUTH"]["id"]) { ?>
                                <span class="text-secondary">切換權限</span>
                                <?php } else { ?>
                                    <a class="btn btn-outline-secondary" href="switch_role.php?role=<?= $row["role"]; ?>&id=<?= $row["id"]; ?>">權限修改</a>
                                <?php } ?>
                                <?php if ($row["id"] == 1) { ?>
                                    <!-- 隱藏修改的連結 -->
                                <?php } else { ?>
                            <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="./js/jquery-3.6.3.min.js"></script>
<script src="./js/bootstrap.js"></script>
</html>