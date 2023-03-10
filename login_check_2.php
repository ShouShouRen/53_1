<?php
// require_once("pdo.php");
// session_start();
// if(isset($_SESSION["AUTH"]["user"])){
//     $user = $_SESSION["AUTH"]["user"];
//     $log_time = date('Y-m-d H:i:s');
//     $log_status = '登入成功';
//     $log_message = "使用者 {$user} 登入成功，時間為 {$log_time}";
//     $log_sql = "INSERT INTO login_log (user, time, status, message) 
//                 VALUES (?, ?, ?, ?)";
//     $log_stmt = $pdo->prepare($log_sql);
//     $log_stmt->execute([$user, $log_time, $log_status, $log_message]);
// } else {
//     $user = $_POST['user'];
//     $log_time = date('Y-m-d H:i:s');
//     $log_status = '登入失敗';
//     $log_message = "使用者 {$user} 登入失敗，時間為 {$log_time}";
//     $log_sql = "INSERT INTO login_log (user, time, status, message) 
//                 VALUES (?, ?, ?, ?)";
//     $log_stmt = $pdo->prepare($log_sql);
//     $log_stmt->execute([$user, $log_time, $log_status, $log_message]);
// }
?>
<!DOCTYPE html>
<html lang="zh-Hant-tw">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
    td {
        width: 180px;
        height: 180px;
        border: 2px solid #fff;
        text-align: center;
        font-size: 24px;
        cursor: pointer;
    }
    </style>
    <title>二次驗證</title>
</head>

<body>
    <div class="container">
        <div class="d-center text-center d-flex flex-column justify-content-center align-items-center">
            <table>
                <tr>
                    <td data-id="1"></td>
                    <td data-id="2"></td>
                </tr>
                <tr>
                    <td data-id="3"></td>
                    <td data-id="4"></td>
                </tr>
            </table>
            <p class="py-3 m-0 text-white">請選擇兩個相鄰的格子，以連成一條水平或垂直線。</p>
            <button id="validate" class="btn btn-outline-light">驗證</button>
        </div>
    </div>
</body>
<script src="./js/jquery-3.6.3.min.js"></script>
<!-- <script src="./js/function.js"></script> -->
<script>
function check() {
    const selectedCells = [];
    $("td").click(function() {
        const index = $(this).data("id") - 1;
        if (selectedCells.length < 2 && !selectedCells.includes(index)) {
            selectedCells.push(index);
            $(this).addClass("selected");
        } else if (selectedCells.includes(index)) {
            selectedCells.splice(selectedCells.indexOf(index), 1);
            $(this).removeClass("selected");
        }
    });

    $("#validate").click(function() {
        if (selectedCells.length === 2) {
            const row1 = Math.floor(selectedCells[0] / 2);
            const col1 = selectedCells[0] % 2;
            const row2 = Math.floor(selectedCells[1] / 2);
            const col2 = selectedCells[1] % 2;
            if ((row1 === row2 && Math.abs(col1 - col2) === 1) || (col1 === col2 && Math.abs(row1 - row2) ===
                1)) {
                $.ajax({
                    url: "check_login.php",
                    method: "POST",
                    data: {
                        status: "success"
                    },
                    success: function(response) {
                        alert("登入成功！");
                        location.href = "index.php";
                    },
                    error: function() {
                        alert("發生錯誤！");
                    },
                });
            } else {
                $.ajax({
                    url: "check_login.php",
                    method: "POST",
                    data: {
                        status: "fail"
                    },
                    success: function(response) {
                        alert("二次驗證錯誤！");
                        location.href = "login.php";
                    },
                    error: function() {
                        alert("發生錯誤！");
                    },
                });
            }
        }
    });
}

check();
</script>

</html>