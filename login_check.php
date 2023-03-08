<?php
session_start();
require_once("pdo.php");
extract($_POST);
$sql = "SELECT * FROM users WHERE user = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($captcha !== $_SESSION['captcha']) {
    $_SESSION['error'] = 'captcha';
    header('Location: login.php');
    exit;
}

if (!$row || !password_verify($pw, $row['pw'])) {
    if (!isset($_SESSION['error'])) {
        $_SESSION['error'] = 'account';
        $_SESSION['failCount'] = 1;
    } else {
        $_SESSION['failCount']++;
        if ($_SESSION['failCount'] >= 3) {
    
            $_SESSION['error'] = 'fail';
            header('Location: login_fail.php');
            exit;
        }
    }
    header('Location: login.php');
    exit;
}
$_SESSION['user'] = $row['user'];
header('Location: index.php');
exit;