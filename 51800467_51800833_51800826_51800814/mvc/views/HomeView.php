<?php
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

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $root . "public/style.css" ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="<?= $root . "public/main.js" ?>"></script>

    <title>Lớp học</title>
</head>
<body>
    <!--header-->
    <div class="header my-header mt-4">
        <div class="d-flex flex-row px-4">
            <div class="mr-auto col-md-5">
                <div class="icon d-flex flex-row">
                    <!--logo and banner-->
                    <a href="<?= $root . "Home/Listclass" ?>" class="text-decoration-none banner ml-2 d-flex flex-row align-items-start">
                        <img src="<?= $root . "public/imgs/logo.png" ?>" class="logo-img">
                        <span class="classroom ml-1 logo-text text-truncate d-none d-sm-block">Lớp học</span>
                    </a>
                </div>
            </div>

            <div class="col-md-5">
                <div class="d-flex flex-row-reverse align-items-center">
                    <!--icon user-->
                    <span class="text-right ml-2">
                        <a href="<?= $root . "Account/Logout" ?>" class="btn btn-outline-success text-truncate" role="button">Đăng xuất</a>
                    </span>
                    <div class="media-left dropdown mx-2">
                        <button class="btn dropdown shadow-none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <a class="text-muted text-right w-50 justify-content-center"  href="#" role="button" data-toggle="tooltip" data-placement="bottom" title="Bấm để thêm lớp học mới">
                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </a>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php

                            if ($_SESSION["permission"] == 1 || $_SESSION["permission"] == 2) {
                                ?>
                            <button class="btn dropdown-item" type="button" data-toggle="modal" data-target="#createClass">
                                <a href="#" class="text-dark text-decoration-none">Tạo mới lớp học</a>
                            </button>
                            <?php
                            }

                            if ($_SESSION["permission"] == 3 || $_SESSION["permission"] == 1) { ?>
                            <button class="btn dropdown-item" type="button" data-toggle="modal" data-target="#joinClass">
                                <a href="#" class="text-dark text-decoration-none">Tham gia lớp học</a>
                            </button>
                            <?php
                            }
                            ?>

                            <!--Nút phân quyền-->
                            <?php if($_SESSION["permission"] == 1) {
                                ?>
                            <button class="btn dropdown-item" type="button" data-toggle="modal" data-target="#decentralization">
                                <a href="#" class="text-dark text-decoration-none">Phân quyền</a>
                            </button>
                            <?php }?>
                        </div>
                </div>
                <div class="media-left d-none text-truncate d-md-block">
                    Xin chào, <?= $data["FirstName"] ?>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!--body container-->
    <!-- Search bar -->
    <?php
    if ($_SESSION["permission"] == 1 or $_SESSION["permission"] == 2) {
    ?>
    <div class="search-container col-5 col-md-6 m-auto">
        <form action="<?= $root . "Home/SearchClass" ?>" method="POST" class="form-inline d-flex justify-content-center md-form form-sm active-pink-2 mt-2" accept-charset="utf-8">
            <input id="search_key" class="pr-lg-0 shadow-none col-md-9 col-7 text-center form-control form-control-sm border-top-0 border-left-0  border-right-0 text-truncate" type="text" name="search_key" placeholder="Tìm kiếm lớp học"
                aria-label="Search" accept-charset="utf-8">
            <button type="submit" class="pl-lg-0 btn col-md-2 col-2"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>
    <?php
    }
    ?>

    <div class="container-fluid m-2">
        <?php isset($data["ListClassView"]) ? require_once "./mvc/views/pages/ListClass.php" : "" ?>

        <!--    show alert-->
        <?php
        if (isset($_SESSION["changePermission"])) {
            if ($_SESSION["changePermission"] === "success") {
                $mess = "Đã phân quyền thành công";
                $isSuccess = true;
            } else if ($_SESSION["changePermission"] === "fail") {
                $mess = "Phân quyền thất bại";
                $isSuccess = false;
            }

            unset($_SESSION["changePermission"]);
        }

        if (isset($_SESSION["deleteClass"])) {
            if ($_SESSION["deleteClass"] === "success") {
                $mess = "Xóa lớp thành công";
                $isSuccess = true;
            } else if ($_SESSION["deleteClass"] === "fail") {
                $mess = "Xóa lớp thất bại";
                $isSuccess = false;
            }

            unset($_SESSION["deleteClass"]);
        }

        if (isset($_SESSION["joinClass"])) {
            if ($_SESSION["joinClass"] === "success") {
                $mess = "Đã tham gia lớp học";
                $isSuccess = true;
            } else if ($_SESSION["joinClass"] === "fail") {
                $mess = "Không tìm thấy lớp học";
                $isSuccess = false;
            }

            unset($_SESSION["joinClass"]);
        }

        if (isset($_SESSION["searchClass"])) {
            if ($_SESSION["searchClass"] === "fail") {
                $mess = "Từ khoá tìm kiếm rỗng";
                $isSuccess = false;
            }

            unset($_SESSION["searchClass"]);
        }

        if (isset($isSuccess)) {
        ?>

        <div class="row d-flex justify-content-center">
            <div class="change-permission-alert alert <?= $isSuccess ? "alert-success" : "alert-danger" ?> w-25 text-center" role="alert"><?= $mess ?></div>
        </div>

        <?php
        }
        ?>
    </div>


<!------------------MODAL-------------------->

<!-- Tạo mới lớp học -->
<div class="modal fade" id="createClass" tabindex="-1" role="dialog" aria-labelledby="createClassLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tạo mới lớp học</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form onsubmit="return checkCreateClass()" action="<?= $root . "Home/AddNewClass" ?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <input name="classname" type="text" class="form-control" id="class-name" placeholder="Nhập tên lớp học" onkeypress="hideError(0)"></input>
                    <span class="error-msg text-danger font-italic"><small></small></span>
                </div>
                <div class="form-group">
                    <input name="subject" type="text" class="form-control" id="class-id" placeholder="Nhập môn học" onkeypress="hideError(1)"></input>
                    <span class="error-msg text-danger font-italic"><small></small></span>
                </div>
                <div class="form-group">
                    <input name="room" type="text" class="form-control" id="class-room" placeholder="Nhập phòng học" onkeypress="hideError(2)"></input>
                    <span class="error-msg text-danger font-italic"><small></small></span>
                </div>
                <div class="form-group">
                    <label for="daySelect">Chọn ngày học</label>
                    <select name="day" class="form-control">
                        <option>Thứ 2</option>
                        <option>Thứ 3</option>
                        <option>Thứ 4</option>
                        <option>Thứ 5</option>
                        <option>Thứ 6</option>
                        <option>Thứ 7</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="timeSelect">Chọn ca học</label>
                    <select name="time" class="form-control">
                        <option>Ca 1</option>
                        <option>Ca 2</option>
                        <option>Ca 3</option>
                        <option>Ca 4</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                <button type="submit" class="btn btn-primary">Tạo lớp học</button>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Tham gia lớp học -->
<div class="modal fade" id="joinClass" tabindex="-1" role="dialog" aria-labelledby="joinClassLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tham gia lớp học</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form onsubmit="return checkJoinClass()" action="<?= $root . "Home/StudentJoinClass" ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="id_class" class="form-control" id="id_class" placeholder="Vui lòng nhập mã lớp" onkeypress="hideError(3)"></input>
                        <span class="error-msg text-danger font-italic"><small></small></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Tham gia</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Phân quyền (Trí) -->
<div class="modal fade" id="decentralization" tabindex="-1" role="dialog" aria-labelledby="createDecentralizationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Phân quyền</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="return checkPermission()" action="<?= $root . "Home/ChangePermission" ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="username_permission" name="user_permission" placeholder="Nhập tài khoản người dùng" onkeypress="hideError(4)"></input>
                            <span class="error-msg text-danger font-italic"><small></small></span>
                        </div>
                        <!--Chọn quyền người dùng-->
                        <div class="form-group">
                            <label for="permissionsChoices">Chọn quyền</label>
                            <select name="permissions"class="form-control">
                                <option>Sinh viên</option>
                                <option>Giảng viên</option>
                                <option>Admin</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>