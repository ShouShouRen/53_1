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
                <div class="col-12 p-5 bg-light rounded-lg">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="images/logos.png" class="w-25" alt="">
                        <h2 class="p-3">咖啡商品展示系統</h2>
                    </div>
                    <form class="p-4" action="login_check.php" method="post">
                        <div>
                            <label for="">帳號</label>
                            <input type="text" name="user" class="form-control my-2" required>
                            <?php if (isset($_SESSION['error']) && $_SESSION['error'] === 'account'): ?>
                            <div class="text-danger">帳號有誤</div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="">密碼:</label>
                            <input type="password" name="pw" class="form-control my-2" required>
                            <?php if (isset($_SESSION['error']) && $_SESSION['error'] === 'password'): ?>
                            <div class="text-danger">密碼有誤</div>
                            <?php endif; ?>
                        </div>
                        <div class="my-2">
                            <label for="">驗證碼:</label>
                            <input type="text" name="captcha" class="form-control my-2" required>
                            <?php if (isset($_SESSION['error']) && $_SESSION['error'] === 'captcha'): ?>
                            <div class="text-danger">驗證碼有誤</div>
                            <?php endif; ?>
                            <img src="captcha.php" alt="captcha">
                            <input type="text" name="captcha" required>
                        </div>
                        <div class="row justify-content-between mx-1 my-4">
                            <div class="btn btn-outline-dark">重新產生</div>
                            <input type="submit" class="btn btn-dark" value="確認登入">
                        </div>
                    </form>
                    <?php
                        unset($_SESSION['error']);
                        unset($_SESSION['failCount']);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>