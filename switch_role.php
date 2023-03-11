<?php
    require_once("pdo.php");
    extract($_GET);
    $sql = "UPDATE users SET role = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $role = ($role == 0) ? 1 : 0;
    $stmt->execute([$role,$id]);
    header("Location:member_list.php");
?>