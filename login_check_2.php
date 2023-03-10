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
<script src="./js/function.js"></script>
</html>