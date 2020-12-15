<?php

$level = count(explode("/", filter_var(trim($_GET["url"], "/"))));
$root = "";

while ($level > 1) {
    $root = $root . "../";
    $level--;
}

?>

<div class="col-lg-3 col-md-12 shadow-lg p-3 mb-3 bg-info rounded h-100 text-white text-center">
    <div><img class="rounded-circle shadow p-1 my-3" src="<?= $root . $classDetail["avatar"] ?>" width="75px" height="75px"></div>
    <h5 class="mb-1"><?= $classDetail["lastName"] . " " . $classDetail["firstName"] ?></h5>
    <h6 class="mb-1">Email: <?= $classDetail["email"] ?></h6>
    <h6 class="mb-3">Số điện thoại: <?= $classDetail["phoneNumber"] ?></h6>
</div>

