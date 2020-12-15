<?php

if ($data["ListClass"] != false) {
    $isShow = true;
}

?>

<div class="row">
    <?php
    if (isset($isShow) && $isShow) {
        $n = $data["ListClass"]->num_rows;
        $i = 0;

        while ($n > 0)
        {
            $class = $data["ListClass"]->fetch_assoc();
            if ($_SESSION["permission"] != 2) {
                $teacher = $data["ListTeacher"]->fetch_assoc();
            } else {
                $teacher = $data["ListTeacher"];
            }
            if ((isset($data["Index"]) and $data["Index"][$i] == 1) or !isset($data["Index"])) {
            ?>
            <div class="pl-0 pr-3 card-div align-items-center d-flex justify-content-center col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div id="<?= $class["id"] ?>" class="my-card" onclick="window.location='../Classroom/Home/<?= $class["id"] ?>';">
                    <div class="my-card-header p-3 d-flex flex-column bg-dark">
                        <div class="header-top d-flex flex-row align-items-center">
                            <!--course name-->
                            <a href="#"><?= $class["classname"] ?></a>

                            <div class="dropdown-menu">
                                <button class="dropdown-item" data-toggle="modal" data-target="#editModal">Chỉnh sửa lớp học</button>
                                <button id="<?= $class["id"] ?>" class="delete-class dropdown-item" data-toggle="modal">Xóa lớp học</button>
                            </div>
                        </div>

                        <div class="header-bottom">
                            <!--teacher name-->
                            <div><?= $teacher['lastName'] . " " . $teacher['firstName'] ?></div>
                        </div>
                    </div>
                    <div class="my-card-body">
                        <img class="rounded-circle teacher-avatar" src="<?= $root . $teacher['avatar'] ?>">
                        <div class="body-content d-flex flex-column p-3">
                            <div class="body-content-title">
                                <h6><?= $class['subject'] ?></h6>
                            </div>

                            <div class="body-content-subtitle">
                                <h6><?= $class['time'] . " " . $class['day'] ?></h6>
                                <a><?= $class['room'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            }
            $n = $n - 1;
            $i = $i + 1;
        }
    } else { ?>
        <div class="d-flex justify-content-center">
            <img src="<?= $root . "public/imgs/not_found_class.png" ?>" alt="Do not have any post" style="width:50%;">
        </div>
    <?php
    }
    ?>
</div>