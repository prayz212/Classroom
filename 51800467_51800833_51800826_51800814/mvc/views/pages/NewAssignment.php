<div class="col-lg-12 shadow p-1 mb-4 bg-light rounded card">
    <div class="card-body">
        <form class="p-1" onsubmit="return checkContentAssignment()" method="POST" action="<?= $root . "Classroom/PostAssignment/" . $classDetail["id"] . "/" . $_SESSION["loggedIn"] ?>" >
            <div class="col-12 p-0 pb-3">
                <input type="text" id="assignment_name" name="assignment_name" placeholder="Tên bài tập" onkeypress="hideError(0)">
                <span class="error-msg text-danger font-italic"></span>
            </div>
            
            <div class="form-group">
                <textarea id="newAssignment" name="assigment_content" class="form-control" value='' placeholder="Chia sẻ với lớp của bạn" rows="3"maxlength="2000" onkeypress="hideError(1)"></textarea>
                <span class="error-msg text-danger font-italic"></span>
            </div>

            <div class="d-flex p-0">
                <div class="col-9 p-0">
                    <input type="text" id="linkAssignment" name="link_assignment" placeholder="Link nộp bài" onkeypress="hideError(2)">
                    <span class="error-msg text-danger font-italic"></span>
                </div>
                
                <span class="col-3 pl-3 pr-0">
                    <input type="date" id="deadline" name="deadline" min='2020-11-15' max='2100-12-31' onclick="hideError(3)">
                    <span class="error-msg text-danger font-italic"></span>
                </span>
            </div>
        
            <div class="flex-row-reverse d-flex mt-3">
                <button type="submit" class="btn btn-primary ml-2 " role="button" aria-pressed="true">Đăng</button>
                <button type="reset" class="btn btn-secondary text-dark" role="button" aria-pressed="true">Hủy</button>
            </div>
        </form>
    </div>
</div>