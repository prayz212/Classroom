<?php
    $email = "";
    $error = "";
    
    if (isset($data["info-e"])) {
        $email = $data["info-e"];
    }
    
    if (isset($data["error-e"])) {        
        $error = $data["error-e"];
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
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="../public/style.css">
    
    <script src="../public/main.js"></script>
</head>

<body>

<div id="container">
    <!--content-->
    <div class="justify-content-center mx-auto col-md-6 col-12">
        <div class="py-4">
            <div class="text-center">
               <a href="../" data-toggle="tooltip" data-placement="bottom" title="Tạo mới hoặc tham gia lớp học"><img src="../public/imgs/logo-login.png" alt="Classroom" width="175px" height="100px"></a>
            </div>
            <form id="form-forgot-password" onsubmit="return checkInputFpw()" method="POST" action="./ForgotPassword" class="col-12">
                <div class="shadow rounded pt-3 mt-4 font-family-forgot-password">
                    <div class="mt-1 mr-3 px-3">
                        <h5 class="font-weight-bold">Tìm tài khoản của bạn</h5>
                    </div>
                    <hr>
                    <div class="p-2 mb-2">
                        <div class="w-50 mx-auto line-tel-forgot-password">
                            <h6 class="txt">Vui lòng nhập email để tìm kiếm tài khoản.</h6>
                            <input value="<?= $email ?>" type="email" id="email-forgotpw" name="email" placeholder="Email@mail.com" onkeypress="hideError(0)">
                            <p class="error-msg text-danger font-italic"><?= $error ?></p>
                        </div>
                    </div>
                    <div class="text-right bg-light p-2">
                        <button class="btn btn-primary mr-2" type="submit" value="Tìm kiếm mật khẩu">Xác nhận</button>
                        <button onclick="window.location='<?= $root . "Account/Login" ?>';" class="btn mr-3 bg-secondary" >Hủy</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!--footer-->
    <div class="footer">
        <div class="container text-center pt-1">
            <div>Copyright © 2020 Build by Chi Vi, Cam Phu, Quach Thinh, Thanh Tri</div>
        </div>
    </div>
</div>

</body>

</html>