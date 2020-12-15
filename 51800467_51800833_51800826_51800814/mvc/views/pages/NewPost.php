<?php

$level = count(explode("/", filter_var(trim($_GET["url"], "/"))));
$root = "";

while ($level > 1) {
    $root = $root . "../";
    $level--;
}

?>

<div class="col-lg-12 shadow p-1 mb-4 bg-light rounded card">
    <div class="card-body">
        <form onsubmit="return checkContentPost()" enctype="multipart/form-data" class="p-1" action="<?= $root . "Classroom/AddPost/" . $classDetail["id"] . "/" . $_SESSION["loggedIn"] ?>" method="POST">
            <div class="form-group">
                <textarea name="post_content" class="form-control" placeholder="Chia sẻ với lớp của bạn" value = "" id="new-post" rows="4" maxlength="2000" onkeypress="clearErrorMessage()"></textarea>
                <div id="error-mess" class="error-msg text-danger font-italic py-2"></div>
            </div>
            <div class="d-flex">
                <div class="custom-file w-50">
                    <input name="uploads[]" type="file" class="custom-file-input" id="customFile" multiple="multiple">
                    <label class="custom-file-label" for="customFile">Chọn file</label>
                </div>
                <span class="ml-auto">
                    <button class="btn btn-secondary text-dark" type="reset" role="button" aria-pressed="true">Hủy</button>
                    <button type="submit" class="btn btn-primary ml-2 " role="button" aria-pressed="true">Đăng</button>
                </span>
            </div>
        </form>
    </div>
</div>