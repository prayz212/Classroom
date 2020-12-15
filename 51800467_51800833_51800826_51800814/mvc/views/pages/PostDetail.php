<?php

$url = explode("/", filter_var(trim($_GET["url"], "/")));
$tagActive = $url[1];
$level = count($url);
$root = "";

while ($level > 1) {
    $root = $root . "../";
    $level--;
}

$postDetail = $data["PostDetail"];
$commentList = $data["CommentList"];
$LinksList = $data["LinksList"];

?>

<div class="container border rounded bg-light shadow mb-5">
    <div class="media pt-3 pl-3 pr-3">
        <div class="media-left">
            <img src="<?= $root . $postDetail["avatar"] ?>" class="rounded-circle ml-3" width="60px"">
        </div>
        <div class="media-body ml-3">
            <h4 class="media-heading"><?= $postDetail["lastName"] . " " . $postDetail["firstName"] ?></h4>
            <p class="blockquote-body">Ngày đăng: <?= $postDetail["post_time"] . " "  ?></p>
        </div>

        <?php
        if ($_SESSION["permission"] == 1 || $_SESSION["permission"] == 2 || $_SESSION["loggedIn"] == $postDetail["id_writter"]) { ?>
            <div class="media-right m-auto">
            <div class="media-right m-auto">
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tùy chọn
            </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" data-toggle="modal" data-target="#editModal">Chỉnh sửa</button>
                        <button id="<?= $classDetail["id"] . "/" . $postDetail["id"] ?>" class="delete-post dropdown-item" data-toggle="modal">Xóa bài viết</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

    </div>
    <p class="ml-5"><?= $postDetail["content"] ?></p>
    
    <?php
    if ($LinksList != null) {
        while ($row = $LinksList->fetch_assoc()) {
            $src = explode("/", filter_var(trim($row["file_src"], "/")));
            $len = count($src);
            $link = $src[$len-1];
            ?>
            <div class="media pt-1 pl-3 pr-3">
                <div class="media-body ml-3">
                    <img src="<?= $root ?>public/imgs/file.png" alt="file" width="20px" height="18px">
                    <a target="_blank" href="<?= $root . $row["file_src"] ?>" class="media-heading"><?= $link ?></a>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <hr>

    <?php
    if ($commentList != null) {
        while ($row = $commentList->fetch_assoc()) {
            ?>
            <div class="media pt-1 pl-3 pr-3">
                <div class="media-left">
                    <img src="<?= $root . $row["avatar"] ?>" class="rounded-circle ml-3" width="50px">
                </div>
                <div class="media-body ml-3">
                    <h6 class="media-heading"><?= $row["lastName"] . " " . $row["firstName"] ?></h6>
                    <p class="blockquote-heading"><?= $row["comment_time"] ?></p>
                    <p><?= $row["content"] ?></p>
                </div>

                <?php
                if ($_SESSION["loggedIn"] == $row["id_writter"] || $_SESSION["permission"] == 1 || $_SESSION["permission"] == 2) {
                ?>
                <div class="media-right m-auto">
                    <button id="<?= $classDetail["id"] . "/" . $postDetail["id"] . "/" . $row["id"] ?>" type="button" class="bg-light border-0 rounded delete-comment" data-toggle="modal">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-backspace" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6.603 2h7.08a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-7.08a1 1 0 0 1-.76-.35L1 8l4.844-5.65A1 1 0 0 1 6.603 2zm7.08-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zM5.829 5.146a.5.5 0 0 0 0 .708L7.976 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                        </svg>
                    </button>
                </div>
                <?php } ?>
            </div>
            <?php
        }

        echo "<hr>";
    }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="modal-title my-2" id="deleteModalLabel">Xác nhận xóa</h3>
                    <div id="makeSureText"></div>
                    <div>Việc này sẽ xóa vĩnh viễn không thể khôi phục.</div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                    <a id="sure" type="button" class="btn btn-primary">Chắc chắn</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form onsubmit="return checkDetailPost()" method="post" action="<?= $root . "Classroom/UpdatePost/" . $classDetail["id"] . "/" . $postDetail["id"] ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Chỉnh sửa bài viết</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="false">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <span id="<?= $postDetail["id"] ?>" hidden class="postId"></span>
                            <div class="form-group">
                                <label for="post-content" class="col-form-label">Nội dung bài viết:</label>
                                <textarea name="newContent" class="form-control" id="post-content" onkeypress="clearError('error-mess-newcontent')"><?= $postDetail["content"] ?> </textarea>
                                <div id="error-mess-newcontent" class="m-1 error-msg text-danger font-italic p-2"></div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "./mvc/views/pages/NewComment.php"?>
</div>


