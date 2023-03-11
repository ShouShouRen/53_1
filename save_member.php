<?php
    require_once("pdo.php");
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);
    
    $user = $input["user"];
    $user_name = $input["user_name"];
    $pw = $input["pw"];
    $id = $input["id"];


    $sql = "UPDATE users SET user = ?, user_name = ?, pw = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user, $user_name, $pw, $id]);

    // $result = array("success" => true);
    // echo json_encode($result);
?>