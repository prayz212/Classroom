<?php
require_once "./mvc/core/Mail.php";

class  Home extends Controller{
    //Must have Error
    function Error() {
        $this->view("ErrorView", []);
    }

    function ListClass() {
        //Call model
        $classModel = $this->model("ClassModel");
        $userModel = $this->model("UserModel");
        $user = $userModel->getUserById($_SESSION["loggedIn"]);

        switch ($_SESSION["permission"]) {
            case 1:
                $class = $classModel->getAllClass();
                $teacher = $classModel->getAllTeacherForClassAD();

                $r = $user->fetch_assoc();
                $name = $r["firstName"];
                break;
            case 2:
                $class = $classModel->getAllClassForTeacher($_SESSION["loggedIn"]);
                $teacher = $user->fetch_assoc();

                $name = $teacher["firstName"];
                break;
            case 3:
                $class = $classModel->getAllClassForStudent($_SESSION["loggedIn"]);
                $teacher = $classModel->getAllTeacherForClass($_SESSION["loggedIn"]);

                $r = $user->fetch_assoc();
                $name = $r["firstName"];
                break;
            default:
                die("WRONG PERMISSION");
        }

        //Call view
        $this->view("HomeView", [
            "ListClassView" => "true",
            "ListClass" => $class,
            "ListTeacher" => $teacher,
            "FirstName" => $name
        ]);
    }

    //--------------------------------------------------- Thêm phần thông báo ---------------------------------------------------//
    function AddNewClass() {
        $classModel = $this->model("ClassModel");
        $userModel = $this->model("UserModel");

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPGRSTUVWXYZ';
        $id =  substr(str_shuffle($permitted_chars), 0, 10);
        $name = $_POST["classname"];
        $subject = $_POST["subject"];
        $room = $_POST["room"];
        $day = $_POST["day"];
        $time = $_POST["time"];

        $result = $classModel->insertClass($id, $name, $subject, $room, $day, $time, $_SESSION["loggedIn"]);
        $data = $userModel->getUserById($_SESSION["loggedIn"]);
        $dataClass = $classModel->getClassById($id);
        
        $class = $dataClass->fetch_assoc();
        $className = $class["classname"];
        $classDay =  $class["day"];
        $classTime = $class["time"];
        $classRoom = $class["room"];

        if ($info = $data->fetch_assoc()) {
            $firstname = $info["firstName"];
            $email = $info["email"];
        }

        $title = "Tạo lớp học thành công";

        $content = "<p> Xin chào $firstname, </p>
                    <p> Bạn vừa tạo lớp học mới: $className. </p>
                    <p> Đây là mã lớp học của bạn: $id. Bạn có thể dùng mã này để thêm sinh viên vào lớp học.</p>
                    <p> Lớp có ngày học $classDay và giờ học $classTime tại $classRoom. </p>";

        //Gui thong bao tham gia lop hoc thanh cong

        $mail = new Mail();
        $mail->sendMail($email, $title, $content);

        if (!$result) {
            echo "Add Class FAILED";
        }

        header("Location: ../Home/Listclass");

    }

    function StudentJoinClass() {
        $classModel = $this->model("ClassModel");
        $userModel = $this->model("UserModel");

        $id = $_SESSION["loggedIn"];
        $class = $_POST["id_class"];


        $check = $classModel->getClassById($class);
        if ($check != false) {
            $result = $classModel->studentJoinClass($id, $class);
            if ($result != false) {
                $data = $userModel->getUserById($id);

                $class = $check->fetch_assoc();
                $className = $class["classname"];
                $classDay =  $class["day"];
                $classTime = $class["time"];
                $classRoom = $class["room"];
        
                if ($info = $data->fetch_assoc()) {
                    $firstname = $info["firstName"];
                    $email = $info["email"];
                }
        
                $title = "Đăng ký lớp học thành công";
        
                $content = "<p> Xin chào $firstname, </p>
                            <p> Bạn vừa tham gia lớp học mới: $className. </p>
                            <p> Lớp có ngày học $classDay và giờ học $classTime tại $classRoom. </p>";
        
                //Gui thong bao tham gia lop hoc thanh cong
        
                $mail = new Mail();
                $mail->sendMail($email, $title, $content);
                

                $_SESSION["joinClass"] = "success";
                header("Location: ../Home/Listclass");
                exit();
            }
        }

        $_SESSION["joinClass"] = "fail";
        header("Location: ../Home/Listclass");
    }
    //--------------------------------------------------- Thêm phần thông báo ---------------------------------------------------//

    function ChangePermission() {
        $userModel = $this->model("UserModel");
        $userPermissionModel = $this->model("UserPermissionModel");

        $userName = $_POST["user_permission"];
        $tmp_permission = $_POST["permissions"];

        if($tmp_permission === "Admin") {
            $permission = 1;
        } elseif ($tmp_permission === "Giảng viên") {
            $permission = 2;
        } else $permission = 3;

        $checkUser = $userModel->getUserByUsername($userName);
        if ($checkUser !== false) {
            $user = $checkUser->fetch_assoc();
            $id = $user["id"];
            $result = $userPermissionModel->changePermission($id, $permission);

            if($result) {
                $_SESSION["changePermission"] = "success";
                header("Location: ../Home/Listclass");
                exit();
            } else {
                die("khong thay doi dc permission");
            }
        } else {
            $_SESSION["changePermission"] = "fail";
            header("Location: ../Home/Listclass");
        }
    }

    function SearchClass() {

        //Search process
        $search = $_POST["search_key"];

        if (empty(trim($search))) {
            $_SESSION["searchClass"] = "fail";
            header("Location: ../Home/Listclass");
            exit();
        }

        $search_ind = [];
        $result = $this->getClass();
        $class = $result["class"];

        while ($item = $class->fetch_assoc()) {
            if ((strpos($item["classname"], $search) !== false) or (strpos($item["subject"], $search) !== false) or ($item["room"] == $search) == 1) {
                array_push($search_ind, 1);
            } else {
                array_push($search_ind, 0);
            }
        }

        $data = $this->getClass();
        $classlist = $data["class"];
        $teacher = $data["teacher"];
        $name = $data["name"];

        //Call view
        if (in_array(1, $search_ind)) {        //Tim duoc lop
            $this->view("HomeView", [
                "ListClassView" => "true",
                "ListClass" => $classlist,
                "ListTeacher" => $teacher,
                "FirstName" => $name,
                "Index" => $search_ind
            ]);
        } else {
            //Khong tim duoc lop
            $this->view("HomeView", [
                "ListClassView" => "true",
                "ListClass" => false,
                "FirstName" => $name
            ]);
        }
    }

    function getClass() {
        $classModel = $this->model("ClassModel");
        $userModel = $this->model("UserModel");
        $user = $userModel->getUserById($_SESSION["loggedIn"]);

        switch ($_SESSION["permission"]) {
            case 1:
                $class = $classModel->getAllClass();
                $teacher = $classModel->getAllTeacherForClassAD();

                $r = $user->fetch_assoc();
                $name = $r["firstName"];
                break;
            case 2:
                $class = $classModel->getAllClassForTeacher($_SESSION["loggedIn"]);
                $teacher = $user->fetch_assoc();

                $name = $teacher["firstName"];
                break;
            case 3:
                $class = $classModel->getAllClassForStudent($_SESSION["loggedIn"]);
                $teacher = $classModel->getAllTeacherForClass($_SESSION["loggedIn"]);

                $r = $user->fetch_assoc();
                $name = $r["firstName"];
                break;
            default:
                die("WRONG PERMISSION");
        }

        return ["class" => $class, "teacher" => $teacher, "name" => $name];
    }
}
?>