<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>咖啡商品展示系統-會員登入</title>
</head>

<body>
    <div class="container">
        <div class="position-relative">
            <div class="d-center">
                <div class="col-12 p-5 rounded-lg shadow-lg text-light" style="backdrop-fliter: bluer(500px); background-color: rgba(255,255,255,.1) ">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="images/logos.png" class="w-25" alt="">
                        <h2 class="p-3">咖啡商品展示系統</h2>
                    </div>
                    <form class="p-4" action="login_check.php" method="post">
                        <div class="my-1">
                            <label for="">帳號:</label>
                            <input type="text" name="user" class="form-control my-3" required>
                            <?php if (isset($_SESSION['error']) && $_SESSION['error'] === 'account'): ?>
                            <div class="text-danger font-weight-bolder">帳號有誤</div>
                            <?php endif; ?>
                        </div>
                        <div class="my-1">
                            <label for="">密碼:</label>
                            <input type="password" name="pw" class="form-control my-3" required>
                            <?php if (isset($_SESSION['error']) && $_SESSION['error'] === 'password'): ?>
                            <div class="text-danger font-weight-bolder">密碼有誤</div>
                            <?php endif; ?>
                        </div>
                        <div class="my-1">
                            <div class="d-flex align-items-center">
                                <label for="">驗證碼:</label>
                                <img src="captcha.php" class="ml-3" alt="">
                            </div>
                            <input type="text" name="captcha" class="form-control my-3" required>
                            <?php if (isset($_SESSION['error']) && $_SESSION['error'] === 'captcha'): ?>
                            <div class="text-danger font-weight-bolder">驗證碼有誤</div>
                            <?php endif; ?>
                        </div>
                        <div class="row justify-content-between mx-1 my-4">
                            <div class="btn btn-outline-light" id="refresh">重新產生</div>
                            <input type="submit" class="btn btn-light" value="確認登入">
                        </div>
                    </form>
                    <?php
                        unset($_SESSION['error']);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./js/jquery-3.6.3.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./js/function.js"></script>

</html>