<?php 
    $error = "";
    $username = "";
    $password = "";

    if (isset($data["info"])) {
        $username = $data["info"]["username"];
        $password = $data["info"]["password"];
    }
    if (isset($data["error-login"])) {        
        $error = $data["error-login"];
    }

    if (isset($_GET["url"])) {
        $url = explode("/", filter_var(trim($_GET["url"], "/")));
    } else {
        $url = [];
    }

    $level = count($url);
    $root = "";

    while ($level > 1) {
        $root = $root . "../";
        $level--;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="<?= $root . "public/style.css" ?>">
    <script src="<?= $root . "public/main.js" ?>"></script>
</head>

<body>
<div id="container">
    <div class="header-login">
        <div class="container">
            <div class="row px-5">
                <div class="col-lg-8 col-md-7 col-sm-12">
                    <div class="pt-5 pb-4 mt-3">
                        <img src="<?= $root . "public/imgs/logo-login.png" ?> " alt="Google classroom" width="250px" height="125px">
                    </div>
                    <div class="line-content-login pb-2 pb-2">
                        Giáo dục là vũ khí mạnh nhất mà người ta có thể sử dụng để thay đổi cả thế giới
                    </div>
                </div>

                <div class="col-lg-4 col-md-5 col-sm-0 shadow p-3 mb-5 bg-white rounded">
                    <form id="form-login" method="POST" action="<?= $root . "Account/Login" ?>" onsubmit="return checkInput()">
                        
                        <div id="line-username" class="line">
                            <input value="<?= $username ?>" id="username-login" type="text" placeholder="Tên truy cập" name="username" onkeypress="clearErrorMessage()">
                        </div>
                        <div id="line-password" class="line">
                            <input value="<?= $password ?>" id="password-login" type="password" placeholder="Mật khẩu" name="password" onkeypress="clearErrorMessage()">
                        </div>
                        <p id="error-mess" class="error-mess"><?= $error ?></p>
                        <div>
                            <button type="submit" class="btn btn-primary btn-login">Đăng nhập</button>
                        </div>
                        <div class="text-center pt-2"><a href="<?= $root . "Account/ForgotPassword" ?> ">Quên mật khẩu?</a></div>
                        <hr width="90%">
                        <div class="text-center"><a href=" <?= $root . "Account/Register" ?> " class="btn btn-create-account" role="button">Tạo tài khoản mới</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container text-center pt-1">
            <div>Copyright © 2020 Build by Chi Vi, Cam Phu, Quach Thinh, Thanh Tri</div>
        </div>
    </div>
</div>
</body>
</html>