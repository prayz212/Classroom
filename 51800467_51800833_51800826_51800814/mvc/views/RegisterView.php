<?php        
    $username = "";
    $password = "";
    $re_password = "";
    $firstname = "";
    $lastname = "";
    $birthday = "";
    $email = "";
    $phone = "";
    $error = "";
    
    if (isset($data["info-re"])) {

        $username = $data["info-re"]["username"];
        $password = $data["info-re"]["password"];
        $re_password = $data["info-re"]["re_password"];
        $firstname = $data["info-re"]["firstName"];
        $lastname = $data["info-re"]["lastName"];
        $birthday = $data["info-re"]["birthday"];
        $email = $data["info-re"]["email"];
        $phone = $data["info-re"]["phone"];
    }
    
    if (isset($data["error-re"])) {        
        $error = $data["error-re"];
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
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../public/style.css">
    <script src="../public/main.js"></script>
</head>

<body>
<div id="container">
    <!--header-->
    <div class="header-register">
        <div class="text-center d-block pt-3">
            <a href="../" data-toggle="tooltip" data-placement="bottom" title="Bấm để trở về trang chủ"><img src="../public/imgs/logo-login.png" alt="Classroom" width="175px" height="100px"></a>
        </div>
        <!--content-->
        <div class="content shadow-lg rounded">
            <h2 class="text-center my-3">Đăng ký</h2>
            <form id="form-register" onsubmit="return checkInputRegister()" method="POST" action="././Register">
                <div>
                    <p id="error-mess" class="error-mess"><?= $error ?></p>
                    <div id="line-username" class="line">
                        <input value="<?= $username ?>" id="username-register" type="text" placeholder="Tên truy cập" pattern="[A-Za-z0-9_\.]{0,15}" name="username" onkeypress="hideError(0)">
                        <div class="error-msg text-danger font-italic"><small></small></div>
                    </div>
                    <div id="line-password" class="line">
                        <input value="<?= $password ?>" id="password-register" type="password" placeholder="Mật khẩu" name="password" onkeypress="hideError(1)">
                        <div class="error-msg text-danger font-italic"><small></small></div>
                    </div>
                    <div id="line-re-password" class="line">
                        <input value="<?= $re_password ?>" id="re-password-register" type="password" placeholder="Nhập lại mật khẩu" name="re_password" onkeypress="hideError(2)">
                        <div class="error-msg text-danger font-italic"><small></small></div>
                    </div>
                    <div id="line-firstname" class="line">
                        <input value="<?= $firstname ?>" id="firstname-register" type="text" placeholder="Họ người dùng" name="firstName" onkeypress="hideError(3)">
                        <div class="error-msg text-danger font-italic"><small></small></div>
                    </div>

                    <div id="line-lastname" class="line">
                        <input value="<?= $lastname ?>" id="lastname-register" type="text" placeholder="Tên người dùng" name="lastName" onkeypress="hideError(4)">
                        <div class="error-msg text-danger font-italic"><small></small></div>
                    </div>

                    <div id="line-birthday" class="line">
                        <input value="<?= $birthday ?>" id="birthday-register" type="date" name="birthday" min="1900-1-1" max="2020-12-31" name="birthday" onchange="hideError(5)">
                        <div class="error-msg text-danger font-italic"><small></small></div>
                    </div>

                    <div id="line-email" class="line">
                        <input value="<?= $email ?>" id="email-register" type="email" placeholder="Email" name="email" onkeypress="hideError(6)">
                        <div class="reminder"><small>Bạn cần sử dụng email này trong trường hợp đặt lại mật khẩu</small></div>
                        <div class="error-msg text-danger font-italic"><small></small></div>
                    </div>
                    <div id="line-phonenumber" class="line">
                        <input value="<?= $phone ?>" type="tel" id="phone-register" name="phone" placeholder="Số điện thoại" pattern="[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" maxlength="12" title="Gồm 10 số" onkeypress="hideError(7)">
                        <div class="reminder"><small>Bạn cần sử dụng số điện thoại này trong trường hợp đặt lại mật khẩu</small></div>

                        <div class="error-msg text-danger font-italic"><small></small></div>
                    </div>
                    <div>
                        <button class="btn btn-register" type="submit" value="Đăng ký ngay">Đăng ký ngay</button>
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