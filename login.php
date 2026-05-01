<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Transit Query System 大眾運輸查詢系統</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="./js/jquery.js"></script>
    <script src="./js/jquery-ui.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/vue.3.5.13.js"></script>
</head>
<body>
    <?php include_once("./include/header.php");include_once("./include/db.php"); ?>
    <main>
        <form action="" method="post">
            <h2>網站管理-登入</h2>
            <div id="username_div">
                <label for="username">帳號</label>
                <input type="text" name="username" id="username">
            </div>
            <div id="password_div">
                <label for="password">密碼</label>
                <input type="password" name="password" id="password">
            </div>
            <div id="ver_div">
                <label for="ver">驗證碼</label>
                <input type="number" name="ver" id="ver">
            </div>
            <div>
                <div class="btn btn-primary btn-lg m-2" id="captcha"></div>
            </div>
        </form>
    </main>
    <script>
        getCode()

        //重設驗證碼時，使用ajax向後端請求新的驗證碼，並更新至btnCode按鈕中
        $("#captcha").on('click',function(){
            getCode()
        })


        //將更新驗證碼的功能包裝成一個函式
        function getCode(){
            $.get("./api/captcha.php",(captcha)=>{
                $("#captcha").text(captcha)
            })
        }
    </script>
</body>
</html>