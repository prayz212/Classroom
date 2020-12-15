<?php

$level = count(explode("/", filter_var(trim($_GET["url"], "/"))));
$root = "";

while ($level > 1) {
    $root = $root . "../";
    $level--;
}

$listStudent =  $data["StudentList"];

if ($listStudent != false) {
    $numOfStudent = $listStudent->num_rows;
    $isFetch = true;
}

?>

<body>
<div class="w-100 d-flex justify-content-center">
    <div class="col-lg-10 p-1 mb-4 rounded">
        <div class="container">
            <div class="main mx-auto">
<!--                Teacher -->
                <div class="mt-5 w-100 mx-auto">
                    <div class="d-flex person-line ml-3">
                        <h2 class="text-primary">Giảng viên</h2>
                    </div>
                    <hr class="hr-line text-primary bg-primary m-0 mt-1 ">
                    <div class="person py-1">
                        <div class="media">
                            <span class="p-2 ml-3"><img class="rounded-circle shadow " src="<?= $root . $classDetail["avatar"] ?>" width="32px" height="32px"></span>
                            <span class="p-2 ml-2"><?= $classDetail["lastName"] . " " . $classDetail["firstName"] ?></span>
                        </div>
                    </div>
                </div>

<!--                Student-->
                <div class="mt-5 w-100 mx-auto">
                    <div class="d-flex person-line ml-3">
                        <h2 class="text-primary">Bạn học</h2>
                        <div class="line-count-member ml-auto text-primary pt-2 pr-1 "><?= isset($numOfStudent) ? $numOfStudent : "0" ?> sinh viên</div>

                        <!-- Icon add -->
                        <?php
                        if ($_SESSION["permission"] == 1 || $_SESSION["permission"] == 2) {
                        ?>
                        <div>
                            <button class="btn shadow-none" type="button" data-toggle="modal" data-target="#addStudent">
                                <a class="text-muted text-right" role="button" data-toggle="tooltip" data-placement="bottom" title="Bấm để thêm sinh viên">
                                    <svg width="1.5em " height="1.5em " viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z "/>
                                    </svg>
                                </a>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    <hr class="hr-line text-primary bg-primary m-0 mt-1 ">

                    <?php
                    if (isset($isFetch) && $isFetch == true) {
                        $n = $data["StudentList"]->num_rows;
                        while($n > 0) {
                            $row = $data["StudentList"]->fetch_assoc();
                            $n--;
                    ?>
                    <div class="person py-1">
                        <div class="media">
                            <span class="p-2 ml-3">
                                <img class="rounded-circle shadow " src="<?= $root . $row["avatar"] ?>" width="32px" height="32px">
                            </span>
                            <span class="p-2 ml-2"><?= $row["lastName"] . " " . $row["firstName"] ?></span>

                            <?php
                            if ($_SESSION["permission"] == 1 || $_SESSION["permission"] == 2) {
                            ?>
                            <div id="<?= $classDetail["id"] . "/" . $row["id"] ?>" class="media-right ml-auto mt-2 pt-1 mr-3 delete-student">
                                <a role="button" class="text-muted" data-abc="true">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-backspace" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6.603 2h7.08a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-7.08a1 1 0 0 1-.76-.35L1 8l4.844-5.65A1 1 0 0 1 6.603 2zm7.08-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zM5.829 5.146a.5.5 0 0 0 0 .708L7.976 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                                    </svg>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                        }
                    } else { ?>
                        <p class="text-muted p-3">Lớp học này chưa có sinh viên này, hãy nhấn nút cộng để thêm sinh viên mới.</p>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!--    show alert-->
            <?php

            if (isset($_SESSION["addStudent"])) {
                if ($_SESSION["addStudent"] === "fail") {
                    $mess = "Không tồn tại sinh viên này, vui lòng kiểm tra lại.";
                    $isSuccess = false;
                }
                else if ($_SESSION["addStudent"] === "success") {
                    $mess = "Đã thêm thành công.";
                    $isSuccess = true;

                }

                unset($_SESSION["addStudent"]);
            }
            ?>

        </div>
    </div>
</div>

<!-- Add member -->
<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="addStudentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sinh viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= $root . "Classroom/AddStudent/" . $classDetail["id"] ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="student_username" type="text" class="form-control" id="class-name" placeholder="Nhập mã sinh viên"></input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Thêm sinh viên</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete member -->
<div class="modal fade" id="deleteStudent" tabindex="-1" role="dialog" aria-labelledby="deleteStudentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa sinh viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Sinh viên bị xóa sẽ vĩnh viễn, bạn có chắc chắn muốn xóa?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                <button id="sure" type="button" class="btn btn-primary" data-dismiss="modal">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>