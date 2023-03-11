<?php
    require_once("pdo.php");
    extract($_GET);
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $stmt = $pdo->prepare($sql);
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>