<?php
    $check = false;
    if (time() - $_SESSION["ResetPass"] > 60*3) {
        $check = true;
    }

    $error = "";

    if (isset($data["error-reset"])) {        
        $error = $data["error-reset"];
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
    <title>Khôi phục mật khẩu</title>
    <link rel="stylesheet" href="../public/style.css">
    <script src="../public/main.js"></script>
</head>

<body>
<div id="container">
    <!--content-->
    <div class="confirmPW mx-auto w-50">
        <div class="py-4 mx-auto">
            <div class="text-center">
                <a href="../"><img src="../public/imgs/logo-login.png" alt="Google classroom" width="175px" height="100px"></a>
            </div>
            <form id="form-confirm-password" onsubmit="return checkInputConfirm()" method="POST" action="./ConfirmPassword">
                <div class="shadow rounded pt-3 mt-4">
                    <div class="mt-1 mr-3 px-3">
                        <h5 class="font-weight-bold text-center">Đặt lại mật khẩu</h5>
                    </div>
                    <hr>
                    <div class="py-1 mb-2">
                        <div class="mx-3">
                            <h6 class="pl-1">Nhập mật khẩu mới.</h6>
                            <input <?= $check == true ? "disabled" : "" ?> name="newPassword" type="password" id="new_password" placeholder="Nhập ít nhất 8 kí tự bao gồm chữ và số" onkeypress="clearE()">
                        </div>
                        <div class="mx-3">
                            <h6 class="pl-1 pt-3">Xác nhận lại mật khẩu mới.</h6>
                            <input <?= $check == true ? "disabled" : "" ?> name="re_newPassword" type="password" id="confirm_password" placeholder="Nhập ít nhất 8 kí tự bao gồm chữ và số" onkeypress="clearE()">
                        </div>
                        <p><?= $error ?></p>
                        <p class="ml-3 text-danger" id="error-confirm"></p>
                    </div>
                    <div class="text-right bg-light p-2">
                        <button class="btn btn-primary mr-2" type="submit" value="Tìm kiếm mật khẩu">Xác nhận</button>
                        <button type="button" onclick="window.location='<?= $root . "Account/Login" ?>';" class="btn btn-secondary mr-2">Quay về</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <!--footer-->
    <div class="footer">
    <div class="container text-center pt-1">
        <div>Copyright © 2020 Build by Chi Vi, Cam Phu, Quach Thinh, Thanh Tri</div>
    </div>
</div>
</body>

</html>