<?php

$url = explode("/", filter_var(trim($_GET["url"], "/")));
$tagActive = $url[1];

if ($tagActive == "Detail") {
    $tagActive = "Home";
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="<?= $root ?>public/main.js"></script>

    <title>Lớp học</title>
    <link rel="stylesheet" href="<?= $root ?>public/style.css">
</head>
<body>

<?php

$classDetail = $data["ClassDetail"];

?>

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
                        <a href="<?= $root ?>Account/Logout" class="btn btn-outline-success text-truncate" role="button">Đăng xuất</a>
                </span>

                <?php
                if ($_SESSION["permission"] == 1 || $_SESSION["permission"] == 2) {
                ?>
                <button class="btn dropdown shadow-none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <a class="text-muted text-right w-50 justify-content-center"  href="#" role="button" data-toggle="tooltip" data-placement="bottom" title="Bấm vào để hiển thị tùy chọn">
                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24" class=" NMm5M">
                            <path d="M13.85 22.25h-3.7c-.74 0-1.36-.54-1.45-1.27l-.27-1.89c-.27-.14-.53-.29-.79-.46l-1.8.72c-.7.26-1.47-.03-1.81-.65L2.2 15.53c-.35-.66-.2-1.44.36-1.88l1.53-1.19c-.01-.15-.02-.3-.02-.46 0-.15.01-.31.02-.46l-1.52-1.19c-.59-.45-.74-1.26-.37-1.88l1.85-3.19c.34-.62 1.11-.9 1.79-.63l1.81.73c.26-.17.52-.32.78-.46l.27-1.91c.09-.7.71-1.25 1.44-1.25h3.7c.74 0 1.36.54 1.45 1.27l.27 1.89c.27.14.53.29.79.46l1.8-.72c.71-.26 1.48.03 1.82.65l1.84 3.18c.36.66.2 1.44-.36 1.88l-1.52 1.19c.01.15.02.3.02.46s-.01.31-.02.46l1.52 1.19c.56.45.72 1.23.37 1.86l-1.86 3.22c-.34.62-1.11.9-1.8.63l-1.8-.72c-.26.17-.52.32-.78.46l-.27 1.91c-.1.68-.72 1.22-1.46 1.22zm-3.23-2h2.76l.37-2.55.53-.22c.44-.18.88-.44 1.34-.78l.45-.34 2.38.96 1.38-2.4-2.03-1.58.07-.56c.03-.26.06-.51.06-.78s-.03-.53-.06-.78l-.07-.56 2.03-1.58-1.39-2.4-2.39.96-.45-.35c-.42-.32-.87-.58-1.33-.77l-.52-.22-.37-2.55h-2.76l-.37 2.55-.53.21c-.44.19-.88.44-1.34.79l-.45.33-2.38-.95-1.39 2.39 2.03 1.58-.07.56a7 7 0 0 0-.06.79c0 .26.02.53.06.78l.07.56-2.03 1.58 1.38 2.4 2.39-.96.45.35c.43.33.86.58 1.33.77l.53.22.38 2.55z"></path>
                            <circle cx="12" cy="12" r="3.5"></circle>
                        </svg>
                    </a>
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button class="btn dropdown-item" type="button" data-toggle="modal" data-target="#createClass">
                        <a href="#" class="text-dark text-decoration-none">Chỉnh sửa lớp học</a>
                    </button>
                    <button class="btn dropdown-item" type="button" data-toggle="modal" data-target="#deleteClass">
                        <a class="text-dark text-decoration-none">Xóa lớp học</a>
                    </button>
                </div>
                <?php } ?>


                <div class="text-right ml-2 px-3 d-none text-truncate d-md-block">
                    Xin chào, <?= $data["UserName"] ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Menu home/assign/list_student-->
<div>
    <div class="d-flex justify-content-center p-1 mt-2">
        <a href="<?= $root ."Classroom/Home/" . $classDetail["id"] ?>" class="btn btn-outline-primary btn-lg <?= strcasecmp($tagActive, "Home") == 0 ? "active" : "" ?> p-2" role="button" aria-pressed="true">Trang chủ</a>
        <a href="<?= $root . "Classroom/Assignment/" . $classDetail["id"] ?>" class="btn btn-outline-primary btn-lg p-2 ml-3 <?= strcasecmp($tagActive, "Assignment") == 0 ? "active" : "" ?>" role="button" aria-pressed="true">Bài tập</a>
        <a href="<?= $root . "Classroom/People/" . $classDetail["id"] ?>" class="btn btn-outline-primary btn-lg p-2 ml-3 <?= strcasecmp($tagActive, "People") == 0 ? "active" : "" ?>" role="button" aria-pressed="true">Mọi người</a>
    </div>
</div>

<!--body container-->
<div class="container mt-2 p-0 px-md-3 px-sm-3 px-1">
    <div alt="#" class="card bg text-white p-3">
        <h2><?= $classDetail["subject"] ?></h2>
        <h6 class="mb-1"> Phòng: <?= $classDetail["room"] ?></h6>
        <h6 class="mb-1"> Thời gian: <?= $classDetail["time"] . " " . $classDetail["day"] ?></h6>
        <?php
        if($_SESSION["permission"] !== 3) { ?>
            <h6 class="mb-1"> Mã lớp học: <?= $classDetail["id"] ?></h6>
        <?php
        }
        ?>

    </div>
</div>
<div class="container ">
    <div class="row mt-3 px-md-3 px-sm-3 px-1">
        <?php isset($data["TeacherProfile"]) ? require_once "./mvc/views/pages/TeacherProfile.php" : "" ?>
        <div class="col-lg-9 col-md-12 pl-lg-2 pr-lg-0 px-0 h-75">
            <?php isset($data["NewPostView"]) ? require_once "./mvc/views/pages/NewPost.php" : "" ?>
            <?php isset($data["PostView"]) ? require_once "./mvc/views/pages/Post.php" : "" ?>
            <?php isset($data["PostDetailView"]) ? require_once "./mvc/views/pages/PostDetail.php" : "" ?>
            
            <?php
            if (isset($data["NewAssignmentView"]) && ($_SESSION["permission"] == 1 || $_SESSION["permission"] == 2)) {
              require_once "./mvc/views/pages/NewAssignment.php";
            }
            ?>

            <?php isset($data["AssignmentView"]) ? require_once "./mvc/views/pages/Assignment.php" : "" ?>
        </div>
        <?php isset($data["ListMemberView"]) ? require_once "./mvc/views/pages/ListMember.php" : "" ?>
    </div>

    <!-- show alert -->
    <?php
    if (isset($_SESSION["changeInfoClass"])) {
        if ($_SESSION["changeInfoClass"] === "success") {
            $mess = "Đã lưu thay đổi";
            $isSuccess = true;
        } else if ($_SESSION["changeInfoClass"] === "fail") {
            $mess = "Chỉnh sửa thông tin thất bại";
            $isSuccess = false;
        }

        unset($_SESSION["changeInfoClass"]);
    }

    if (isset($isSuccess)) {
        ?>

        <div class="row d-flex justify-content-center">
            <div class="change-permission-alert alert <?= $isSuccess ? "alert-success" : "alert-danger" ?> w-25 text-center" role="alert"><?= $mess ?></div>
        </div>

        <?php
    }
    ?>
    <!-- end show alert -->
</div>

<!-----------------------------MODAL----------------------------->
<!--    Xóa lớp học -->
<div class="modal fade" id="deleteClass" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title my-2" id="deleteModalLabel">Xác nhận xóa</h3>
                <div id="makeSureText"></div>
                <div>Việc này sẽ xóa vĩnh viễn không thể khôi phục.</div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                <a id="sure" href="<?= $root . "Classroom/DeleteClass/" . $classDetail["id"] ?>" type="button" class="btn btn-primary">Chắc chắn</a>
            </div>
        </div>
    </div>
</div>

<!-- Chỉnh sửa lớp học -->
<div class="modal fade" id="createClass" tabindex="-1" role="dialog" aria-labelledby="createClassLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thông tin lớp học</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form onsubmit="return checkUpdateClass()" action="<?= $root . "Classroom/UpdateClass/" . $classDetail["id"] ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="classname" type="text" class="form-control" id="class-name-update" placeholder="Nhập tên lớp học" value="<?= $classDetail["classname"] ?>" onkeypress="clearError('error-classname')"></input>
                        <div id="error-classname" class="text-danger font-italic"><small></small></div>
                    </div>
                    <div class="form-group">
                        <input name="subject" type="text" class="form-control" id="class-id-update" placeholder="Nhập môn học" value="<?= $classDetail["subject"] ?>" onkeypress="clearError('error-classid')"></input>
                        <div id="error-classid" class="text-danger font-italic"><small></small></div>
                    </div>
                    <div class="form-group">
                        <input name="room" type="text" class="form-control" id="class-room-update" placeholder="Nhập phòng học" value="<?= $classDetail["room"] ?>" onkeypress="clearError('error-classroom')"></input>
                        <div id="error-classroom" class="text-danger font-italic"><small></small></div>
                    </div>
                    <div class="form-group">
                        <?php $day = explode(" ", $classDetail["day"]); ?>
                        <label for="daySelect">Chọn ngày học</label>
                        <select name="day" class="form-control">
                            <option <?= $day[1] === "2" ? "selected" : "" ?>>Thứ 2</option>
                            <option <?= $day[1] === "3" ? "selected" : "" ?>>Thứ 3</option>
                            <option <?= $day[1] === "4" ? "selected" : "" ?>>Thứ 4</option>
                            <option <?= $day[1] === "5" ? "selected" : "" ?>>Thứ 5</option>
                            <option <?= $day[1] === "6" ? "selected" : "" ?>>Thứ 6</option>
                            <option <?= $day[1] === "7" ? "selected" : "" ?>>Thứ 7</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="timeSelect">Chọn ca học</label>
                        <select name="time" class="form-control">
                            <option <?= $classDetail["time"] == "Ca 1" ? "selected" : "" ?>>Ca 1</option>
                            <option <?= $classDetail["time"] == "Ca 2" ? "selected" : "" ?>>Ca 2</option>
                            <option <?= $classDetail["time"] == "Ca 3" ? "selected" : "" ?>>Ca 3</option>
                            <option <?= $classDetail["time"] == "Ca 4" ? "selected" : "" ?>>Ca 4</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>       