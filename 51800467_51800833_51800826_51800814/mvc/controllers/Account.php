<?php
require_once "./mvc/core/Mail.php";

class Account extends Controller {
    function Login() {
        if (isset($_SESSION["loggedIn"])) {
            header("Location: ../Home/Listclass");
            exit();
        }

        if (!isset($_POST["username"]) && !isset($_POST["password"])) {
            $this->view("LoginView", []);
            exit();
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $stm = $this->model("UserModel");
        $data = $stm->login($username);

        if ($data !== false) {
            
            $res = $data->fetch_assoc();
            
            if (password_verify($password, $res['password'])) {

                $_SESSION["loggedIn"] = $res["id"];
                $_SESSION["permission"] = $res["permission_id"];

                header("Location: ../Home/Listclass");
                exit();
            }

            $this->view("LoginView", ["info" => $_POST,
                                      "error-login" => "Bạn nhập sai tài khoản hoặc mật khẩu"]);
            exit();
        }

        // header("Location: ./");
        $this->view("LoginView", ["info" => $_POST,
                                  "error-login" => "Bạn nhập sai tài khoản hoặc mật khẩu"]);
        exit();
    }

    //------------------------------------- Register -----------------------------------------//

    function Register() {

        if (isset($_SESSION["loggedIn"])) {
            header("Location: ../Home/Listclass");
            exit();
        }
        
        if (!isset($_POST["email"]) && !isset($_POST["password"])) {
            $this->view("RegisterView", []);
            exit();
        }
        $email = $_POST["email"];
        $stm = $this->model("UserModel");
        $permissionModel = $this->model("UserPermissionModel"); 

        $data = $stm->getUserEmail($email, $_POST["username"]);

        if ($data !== false) {

            $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            
            // insert vao co so du lieu
            $stm->registerUser($_POST["firstName"], $_POST["lastName"], 
                            $_POST["username"], "public/imgs/icon_default.png",
                            $hashed_password, $_POST["birthday"],
                            $email, $_POST["phone"]);

            $user = $stm->getTheLastUser();
            // if ($user !== false) {
            $id_user = $user->fetch_assoc();
            $permissionModel->registerPermission($id_user["id"]);
            // }
            
            $lastName = $_POST["lastName"];

            $title = "Đăng ký thành công";

            $content = "<p> Xin chào $lastName, </p>
                        <p> Chúc mừng bạn đã trở thành một thành viên của chúng tôi. </p>
                        <p><a href=\"http://localhost:8080/classroom\"> Click vào đây  </a> để đăng nhập. </p>";

            //Gui thong bao dang ky thanh cong

            $mail = new Mail();
            if ($mail->sendMail($email, $title, $content) == "false") {
                $this->view("RegisterView", ["info-re" => $_POST,
                                            "error-re" => "Không thể gửi email"]);
                exit();
            } 


            header("Location: ../");
            exit();
        }

        // header("Location: ../Account/Register");
        $this->view("RegisterView", ["info-re" => $_POST,
                                        "error-re" => "Email hoặc tên tài khoản đã tồn tại"]);
        exit();
    }
    //------------------------------------- Register -----------------------------------------//
    
    
    //------------------------------------- ResetPW -----------------------------------------//
    function ConfirmPassword() {
        if (isset($_POST["newPassword"]) && isset($_POST["re_newPassword"])) {
            $userModel = $this->model("userModel");
            $newPW = $_POST["newPassword"];
            
            $hashed_password = password_hash($newPW, PASSWORD_DEFAULT);

            if ($userModel->updatePassword($hashed_password, $_SESSION["email"]) === true) {
                header("Location: ../");
                unset($_SESSION["email"]);
                unset($_SESSION["ResetPass"]);
                
                exit();
            }
            $this->view("ConfirmPasswordView", ["info-confirm" => $_POST,
                                                "error-reset" => "Cập nhật thất bại"]);

            exit();

        }

        $this->view("ConfirmPasswordView", []);
        exit();
    }


    function ForgotPassword() {

        if (isset($_SESSION["loggedIn"])) {
            header("Location: ../Home/Listclass");
            exit();
        }

        if (isset($_SESSION["ResetPass"])) {
            $this->view("ForgotPasswordView", []);
            unset($_SESSION["ResetPass"]);

            exit();
        }
        if (!isset($_POST["email"])) {
            $this->view("ForgotPasswordView", []);

            exit();
        }

        $email = $_POST["email"];
        $userModel = $this->model("UserModel");
        $info = $userModel->getFirstName($email);

        if ($info !== false) {
            //Lay ten de gui mail
            $infoUser = $info->fetch_assoc();
            $firstName = $infoUser["firstName"];

            $title = 'Khôi phục mật khẩu';

            $content = "<p> Xin chào $firstName, </p>
                        <p> Chúng tôi nhận được yêu cầu đặt lại mật khẩu của bạn. </p>
                        <p><a href=\"http://localhost:8080/classroom/Account/ConfirmPassword\"> Click vào đây  </a> để thay đổi mật khẩu. </p>";

            //Gui link thay doi mat khau qua email

            $mail = new Mail();
            if ($mail->sendMail($email, $title, $content) == "false") {
                $this->view("ForgotPasswordView", ["info-e" => $email,
                                            "error-e" => "Không thể gửi email"]);
                exit();                     
            } 
            
            $_SESSION["ResetPass"] = time();
            $_SESSION["email"] = $email;
            $this->view("ForgotPasswordView", ["error-e" => "Kiểm tra email để thay đổi mật khẩu"]);

            exit();
        }

        // header("Location: ../Account/Register");
        $this->view("ForgotPasswordView", ["info-e" => $email,
                                            "error-e" => "Email không tồn tại"]);
        exit();
    }
    //------------------------------------- ResetPW -----------------------------------------//

    function Logout() {
        session_unset();
        session_destroy();

        header("Location: ../");
        exit();
    }

    
}

?>
