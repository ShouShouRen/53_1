<?php
    require_once("pdo.php");
    extract($_GET);
    $sql = "DELETE FROM users WHERE id = {$id}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location:member_list.php");
?>