<?php

if ($data["AssignmentList"] === false) { ?>
<div class="d-flex justify-content-center">
    <img src="<?= $root . "public/imgs/not_found.png" ?>" alt="Do not have any assignment" style="width:70%;">
</div>
<?php
} else {
    $show = false;
    while($row = $data["AssignmentList"]->fetch_assoc()) {
        if (((compareDate($row["deadline"]) === 1) and $_SESSION["permission"] === 3) or $_SESSION["permission"] == 2 or $_SESSION["permission"] == 1) {
        ?>
        <div class="col-lg-12 shadow p-2 mb-4 bg-light rounded">
            <div class="w-100 px-3 py-2">
                <div class="d-flex">
                    <img class="rounded-circle shadow" width="50px" height="50px" src="../../<?= $row["avatar"] ?>">
                    <div>
                        <h6 class="px-2"><?= $row["lastName"] . " " . $row["firstName"] ?></h6>
                        <div class="px-2 text-muted mt-0 card-text">Hạn nộp : <?= $row["deadline"] ?></div>
                    </div>
                    <div class="ml-auto mt-3 p-2 card-text">
                        <small class="text-muted">Ngày đăng: <?= $row["post_time"] ?></small>
                    </div>
                </div>
                <h5 class="text-left mt-1"> <?= $row["name"] ?></h5>
                <div class="text-left mt-1"><?= $row["content"] ?></div>

                <hr class="col-12 mx-0 my-2 px-0" width="100%">
                <a target="_blank" href="<?= $row["link_assignment"] ?>">Nộp bài của bạn tại đây</a>
            </div>
        </div>
    <?php
            $show = true;
        }
    }

    if (!$show) { ?>
        <div class="d-flex justify-content-center">
            <img src="<?= $root . "public/imgs/not_found.png" ?>" alt="Do not have any assignment" style="width:70%;">
        </div>
    <?php
    }
}

function compareDate($date) {
    //return 1 if deadline > now
    $arr = explode("/", filter_var(trim($date, "/")));

    $year = $arr[2];
    $month = $arr[1];
    $day = $arr[0];

    if ($year < date("Y")) {
        return 0;
    } else {
        if ($month < date("m")) {
            return 0;
        } else {
            if ($day < date("d")) {
                return 0;
            }
        }
    }

    return 1;
}
?>