<?php
    // require_once("pdo.php");
    // extract($_GET);
    // $sql = "DELETE FROM users WHERE id = {$id}";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();
    // header("Location:member_list.php");

    require_once("pdo.php");
extract($_GET);

// 取得該使用者的使用者編號
$sql = "SELECT user_id FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$user_id = $stmt->fetch(PDO::FETCH_COLUMN, 0);

// 刪除使用者
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// 將該使用者後面的所有使用者編號減 1
$sql = "UPDATE users SET user_id = LPAD(CAST(user_id - 1 AS UNSIGNED), 4, '0') WHERE user_id > ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

header("Location: member_list.php");

?>