// Check Input, Loginpage
function checkInput() {
    let u = document.getElementById("username-login");
    let p = document.getElementById("password-login");
    let error = document.getElementById("error-mess");

    let username = u.value;
    let password = p.value;
    

    if (username.trim().length === 0) {
        error.innerHTML = "Bạn chưa nhập tên truy cập"
        u.focus();
        return false;
    }
    else if (password.trim().length === 0) {
        error.innerHTML = "Bạn chưa nhập mật khẩu"
        p.focus();
        return false;
    }

    error.innerHTML = "";
    return true;
}

function clearErrorMessage() {
    document.getElementById("error-mess").innerHTML = "";
}

$(document).ready(function(){

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
 
    $(".delete-comment").click(function () {
        let id = $(this).attr('id');
 
        $('#makeSureText').html("Bạn có chắn chắn xóa bình luận này không?")
        $('#deleteModal').modal('show');
 
        $('#sure').on('click', function () {
            window.location.replace("../../../Classroom/DeleteComment/" + id);
        });
    });
 
     $(".delete-post").click(function () {
         let id = $(this).attr('id');
 
         $('#makeSureText').html("Bạn có chắn chắn xóa bài viết này không?")
         $('#deleteModal').modal('show');
 
         $('#sure').on('click', function () {
             window.location.replace("../../../Classroom/DeletePost/" + id);
         });
     });

    $(".delete-student").click(function () {
        let id = $(this).attr('id');

        $('#deleteStudent').modal('show');

        $('#sure').on('click', function () {
            window.location.replace("../../Classroom/DeleteStudent/" + id);
        });
    });

    if ($(".change-permission-alert").length) {
        setTimeout(function () { $('.change-permission-alert').hide(); }, 5000);
    }

});

function displayError(message, i) {
    let error = document.getElementsByClassName('error-msg');
    error[i].style.display='';
    error[i].innerHTML = message;
}

function hideError(i) {
    let error = document.getElementsByClassName('error-msg');
    error[i].style.display = 'none';
}

//ForgotPasswordView
function checkInputFpw() {
    let emailBox = document.getElementById('email-forgotpw');
    let email = emailBox.value.trim();

    if(email.length === 0) {
        displayError('Email để trống', 0);
        emailBox.focus();
    }
    else {
        return true;
    }
    return false
}

function checkInputConfirm() {
    let pw = document.getElementById("new_password");
    let newpw = document.getElementById("confirm_password");
    let mess = document.getElementById("error-confirm");

    let password = pw.value.trim();
    let new_password = newpw.value.trim();

    if (password.length === 0) {
        pw.focus();
        mess.innerHTML = "Mật khẩu bỏ trống";
    } else if (password.length < 8 || password.length > 16) {
        pw.focus();
        mess.innerHTML = "Mật khẩu phải đảm bảo: độ dài 8-16 ký tự";
    } else if (password !== new_password) {
        newpw.focus();
        mess.innerHTML = "Mật khẩu không trùng khớp";
    }
    else {
        return true;
    }

    return false;
}

function clearE() {
    document.getElementById("error-confirm").innerHTML = "";
}

//RegisterView
function checkInputRegister() {
    let usernameBox = document.getElementById('username-register');
    let passwordBox = document.getElementById('password-register');
    let repasswordBox = document.getElementById('re-password-register');
    let firstnameBox = document.getElementById('firstname-register');
    let lastnameBox = document.getElementById('lastname-register');
    let emailBox = document.getElementById('email-register');
    let phoneBox = document.getElementById('phone-register');
    let birthdayBox = document.getElementById('birthday-register')

    let username = usernameBox.value.trim();
    let password = passwordBox.value;
    let repassword = repasswordBox.value;
    let firstname = firstnameBox.value.trim();
    let lastname = lastnameBox.value.trim();
    let email = emailBox.value.trim();
    let phone = phoneBox.value;
    let birthday = birthdayBox.value;

    if (username.length === 0) {
        displayError('Tên tài khoản để trống', 0);
        usernameBox.focus();

    } else if (usernameBox.value.length < 6 || usernameBox.value.length > 15) {
        displayError('Tên tài khoản phải có từ 6 - 15 ký tự', 0);
        usernameBox.focus();
    }
    else if (password.length === 0) {
        displayError('Mật khẩu bỏ trống', 1);
        passwordBox.focus();

    } else if (password.length < 8 || password.length > 16) {
        displayError('Mật khẩu phải đảm bảo: độ dài 8-16 ký tự', 1);
        passwordBox.focus();

    } else if (repassword !== password) {
        displayError('Mật khẩu không trùng khớp', 2);
        repasswordBox.focus();

    } else if (firstname.length === 0) {
        displayError('Họ người dùng bỏ trống', 3);
        firstnameBox.focus();

    } else if (lastname.length === 0) {
        displayError('Tên người dùng bỏ trống', 4);
        lastnameBox.focus();

    } else if (birthday === "") {
        displayError('Ngày tháng năm sinh để trống', 5);
        birthdayBox.focus();

    } else if (email.length === 0) {
        displayError('Email để trống', 6);
        emailBox.focus();

    } else if (phone.length === 0) {
        displayError('Số điện thoại bỏ trống', 7);
        phoneBox.focus();
    } else {
        return true;
    }
    return false;
}

//ClassView
//UpdateClassroom
function checkUpdateClass() {
    let classnameUpdateBox = document.getElementById('class-name-update');
    let classidUpdateBox = document.getElementById('class-id-update');
    let classroomUpdateBox = document.getElementById('class-room-update');

    let classNameUpdate = classnameUpdateBox.value.trim();
    let classIdUpdate = classidUpdateBox.value.trim();
    let classRoomUpdate = classroomUpdateBox.value.trim();

    if (classNameUpdate.length === 0) {
        document.getElementById('error-classname').innerHTML = "Tên lớp học không để rỗng";
        classnameUpdateBox.focus();
    } else if (classIdUpdate.length === 0) {
        document.getElementById('error-classid').innerHTML = "Tên môn học không để rỗng";
        classidUpdateBox.focus();
    } else if (classRoomUpdate.length === 0) {
        document.getElementById('error-classroom').innerHTML = "Phòng học không để rỗng";
        classroomUpdateBox.focus();
    } else {
        return true;
    }
    return false;
}

//HomeView
function checkCreateClass() {
    let classnameBox = document.getElementById('class-name');
    let classidBox = document.getElementById('class-id');
    let classroomBox = document.getElementById('class-room');

    let className = classnameBox.value.trim();
    let classId = classidBox.value.trim();
    let classRoom = classroomBox.value.trim();

    if (className.length === 0) {
        console.log("Vô");
        displayError("Tên lớp học không để rỗng", 0);
        classnameBox.focus();
    } else if (classId.length === 0) {
        displayError("Tên môn học không để rỗng", 1);
        classidBox.focus();
    } else if (classRoom.length === 0) {
        displayError("Phòng học không để rỗng", 2);
        classroomBox.focus();
    } else {
        return true;
    }
    return false;
}

function checkJoinClass() {
    let idClassBox = document.getElementById('id_class');
    let idClass = idClassBox.value.trim();

    if (idClass.length < 10) {
        displayError("Mã lớp học không được rỗng và phải có đủ 10 ký tự", 3);
        idClassBox.focus();
    } else {
        return true;
    }
    return false;
}

function checkPermission() {
    let username_permissionBox = document.getElementById('username_permission');
    let username_permission = username_permissionBox.value.trim();

    if (username_permission.length === 0) {
        displayError("Tên tài khoản phân quyền rỗng!", 4);
        username_permissionBox.focus();
    }
    else {
        return true;
    }
    return false;
}

//NewPost
function checkContentPost() {
    let newPostBox = document.getElementById('new-post');
    let newPost = newPostBox.value.trim();

    let error = document.getElementById("error-mess");

    if (newPost.length === 0) {
        error.innerHTML = "Nội dung bài đăng rỗng";
        newPostBox.focus();
        return false;
    }
    return true;
}

//NewAssignment
function checkContentAssignment() {
    let assignment_nameBox = document.getElementById('assignment_name');
    let newAssignmentBox = document.getElementById('newAssignment');
    let linkAssignmentBox = document.getElementById('linkAssignment');
    let deadlineBox = document.getElementById('deadline');

    let assignmentName = assignment_nameBox.value.trim();
    let newAssignment = newAssignmentBox.value.trim();
    let linkAssignment = linkAssignmentBox.value.trim();
    let deadline = deadlineBox.value;

    if (assignmentName.length === 0) {
        displayError("Tên bài tập rỗng", 0);
        assignment_nameBox.focus();
    }
    else if (newAssignment.length === 0) {
        displayError("Nội dung bài tập rỗng", 1);
        newAssignmentBox.focus();
    } else if (linkAssignment.length === 0) {
        displayError("Chưa nhập link nộp bài", 2);
        linkAssignmentBox.focus();
    } else if (deadline === "") {
        displayError("Hạn nộp bài trống", 3);
        deadlineBox.focus();
    } else return true;
    return false;
}

//NewComment
function checkNewComment() {
    // let commentBox = document.getElementById('comment');
    // let comment = commentBox.value.trim();

    // if (comment.length === 0) {
    //     message = "Bình luận rỗng";
    //     let error = document.getElementById('error-msg-cmt');
    //     error.style.display='';
    //     error.innerHTML = message;
    //     commentBox.focus();
    // }
    // else {
    //     return true;
    // }
    // return false;

    let commentBox = document.getElementById('comment');
    let comment = commentBox.value.trim();

    if (comment.length === 0) {
        document.getElementById('error-mess-comment').innerHTML = "Bình luận rỗng";
        commentBox.focus();
    }
    else {
        return true;
    }
    return false;
}

//DetailPost
function checkDetailPost() {
    let postContentBox = document.getElementById('post-content');
    let postContent = postContentBox.value.trim();

    if(postContent.length === 0) {
        document.getElementById('error-mess-newcontent').innerHTML = "Nội dung cập nhật không được rỗng";
        postContentBox.focus();
    }
    else return true;
    return false;
}

function clearError(id_error) {
    let error = document.getElementById(id_error);
    error.innerHTML = '';
}