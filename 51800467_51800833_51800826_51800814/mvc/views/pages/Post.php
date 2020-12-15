<?php

if ($data["PostList"] == null) { ?>
<div class="d-flex justify-content-center">
    <img src="<?= $root . "public/imgs/not_found.png" ?>" alt="Do not have any post" width = "70%">
</div>
<?php
} else {
?>
<div class="mb-5">
<?php
while($row = $data["PostList"]->fetch_assoc()) {
?>
    <div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
        <a href="../Detail/<?= $row["id_class"] . "/" . $row["id"] ?>" class="btn w-100 shadow-none">
            <div class="d-flex">
                <img class="rounded-circle shadow" width="50px" height="50px" src="../../<?= $row["avatar"] ?>">
                <h6 class="p-2"><?= $row["lastName"] . " " . $row["firstName"] ?></h6>
                <div class="ml-auto mt-3 p-2 card-text">
                    <small class="text-muted">Ngày đăng: <?= $row["post_time"] ?></small>
                </div>
            </div>
            <hr>
            <div class="text-left mt-1"><?= $row["content"] ?></div>
        </a>
    </div>
<?php
    }
?>
</div>
<?php
}
?>