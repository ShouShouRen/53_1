<?php
session_start();
$max_attempts = 3;
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}
if ($_SESSION['attempts'] === $max_attempts) {
    $_SESSION['attempts'] = 0;
    header("Location: login_failed.php");
    exit;
}
try {
    require_once("pdo.php");
    extract($_POST);
    $sql = "SELECT * FROM users WHERE user = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        $_SESSION['attempts']++;
        $_SESSION['error'] = 'account';
        header("Location: login.php");
        exit;
    } else {
        if ($pw != $row['pw']) {
            $_SESSION['attempts']++;
            $_SESSION['error'] = 'password';
            header("Location: login.php");
            exit;
        } else {
            if ($_POST['captcha'] !== $_SESSION['captcha']) {
                $_SESSION['attempts']++;
                $_SESSION['error'] = 'captcha';
                header("Location: login.php");
                exit;
            }
            unset($_SESSION['attempts']);
            $_SESSION["AUTH"] = $row;
            header("Location: login_check_2.php");
            exit;
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>