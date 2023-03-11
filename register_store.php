<?php
try{
    session_start();
    require_once("pdo.php");
    extract($_POST);
    $sql_check = "SELECT * FROM users WHERE user = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$user]);
    if ($stmt_check->rowCount() > 0) {
        echo "帳號已存在，請重新申請";
        header("Refresh:1;url=member_list.php");
        return;
    }
    $sql_last_user = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
    $stmt_last_user = $pdo->prepare($sql_last_user);
    $stmt_last_user->execute();
    $row_last_user = $stmt_last_user->fetch(PDO::FETCH_COLUMN, 0);
    $row_last_user + 1;
    $user_id = sprintf("%04d", $row_last_user);
    $role = 1;

    $sql = "INSERT INTO users(user, user_name, pw, user_id, role) VALUES (?, ?, ?, ?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user, $user_name, $pw, $user_id,$role]);
    header("Refresh:1;url=login.php");
}catch(PDOException $e){
    echo $e->getMessage();
}