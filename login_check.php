<?php
session_start();

try {
    require_once("pdo.php");
    extract($_POST);
    $sql = "SELECT * FROM users WHERE user = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        $_SESSION['error'] = 'account';
        header("Location: login.php");
        exit;
    } else {
        if ($pw != $row['pw']) {
            $_SESSION['error'] = 'password';
            header("Location: login.php");
            exit;
        } else {
            // 驗證碼判斷
            if ($_POST['captcha'] !== $_SESSION['captcha']) {
                $_SESSION['error'] = 'captcha';
                header("Location: login.php");
                exit;
            }
            $_SESSION["AUTH"] = $row;
            header("Location:login_check_2.php");
            exit;
        }
    }
    
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>