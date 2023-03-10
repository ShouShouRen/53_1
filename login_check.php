<?php
// session_start();
// $max_attempts = 3;
// if (!isset($_SESSION['attempts'])) {
//     $_SESSION['attempts'] = 0;
// }
// if ($_SESSION['attempts'] === $max_attempts) {
//     $_SESSION['attempts'] = 0;
//     header("Location: login_failed.php");
//     exit;
// }
// try {
//     require_once("pdo.php");
//     extract($_POST);
//     $sql = "SELECT * FROM users WHERE user = ?";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([$user]);
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);
//     if (!$row) {
//         $_SESSION['attempts']++;
//         $_SESSION['error'] = 'account';
//         header("Location: login.php");
//         exit;
//     } else {
//         if ($pw != $row['pw']) {
//             $_SESSION['attempts']++;
//             $_SESSION['error'] = 'password';
//             header("Location: login.php");
//             exit;
//         } else {
//             if ($_POST['captcha'] !== $_SESSION['captcha']) {
//                 $_SESSION['attempts']++;
//                 $_SESSION['error'] = 'captcha';
//                 header("Location: login.php");
//                 exit;
//             }
//             unset($_SESSION['attempts']);
//             $_SESSION["AUTH"] = $row;
//             header("Location: login_check_2.php");
//             exit;
//         }
//     }
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }<?php
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
            
            // 登入成功的紀錄
            $user = $_SESSION["AUTH"]["user"];
            $log_time = date('Y-m-d H:i:s');
            $log_status = '登入成功';
            $log_message = "使用者 {$user} 登入成功，時間為 {$log_time}";
            $log_sql = "INSERT INTO login_log (user, time, status, message) 
                        VALUES (?, ?, ?, ?)";
            $log_stmt = $pdo->prepare($log_sql);
            $log_stmt->execute([$user, $log_time, $log_status, $log_message]);
            
            header("Location: login_check_2.php");
            exit;
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
    $user = $_POST['user'];
    $log_time = date('Y-m-d H:i:s');
    $log_status = '登入失敗';
    $log_message = "使用者 {$user} 登入失敗，時間為 {$log_time}";
    $log_sql = "INSERT INTO login_log (user, time, status, message) 
            VALUES (?, ?, ?, ?)";
    $log_stmt = $pdo->prepare($log_sql);
    $log_stmt->execute([$user, $log_time, $log_status, $log_message]);
}
?>