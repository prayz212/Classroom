<!---Add comment--->
<div class="media pl-3 pr-3 pb-3">
    <form class="form-inline w-100" onsubmit="return checkNewComment()" action="<?= $root . "Classroom/AddComment/" . $classDetail["id"] . "/" . $postDetail["id"] . "/" . $_SESSION["loggedIn"] ?>" method="post">
        <div class="input-group mb-2 mr-sm-2 w-100">
            <input id="comment" name="comment" type="text" class="form-control rounded-pill ml-3 mt-1 pl-3" placeholder="Bình luận về lớp học..." onkeypress="clearError('error-mess-comment')">
            <div class="input-group-text ml-3 bg-light border-0">
                <button type="submit" class="border-0 bg-light rounded">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div id="error-mess-comment" class="text-danger font-italic ml-4"></div>
    </form>
</div>
