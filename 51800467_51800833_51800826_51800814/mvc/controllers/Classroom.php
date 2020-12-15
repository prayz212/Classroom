<?php
class Classroom extends Controller{

    function Detail($class, $post)
    {
        //Call model
        $classModel = $this->model("ClassModel");
        $postModel = $this->model("PostModel");
        $commentModel = $this->model("CommentModel");
        $userModel = $this->model("UserModel");
        $user = $userModel->getUserById($_SESSION["loggedIn"]);

        $data = $classModel->getClassById($class);
        $data1 = $postModel->getPostById($class, $post);
        $comment = $commentModel->getAllComment($post);
        $links = $postModel->getAllLinks($post);
        
        if ($data == false || $data1 == false) {
            header("Location: ../../Error"); 
        }

        $class = $data->fetch_assoc();
        $post = $data1->fetch_assoc();

        $r = $user->fetch_assoc();
        $name = $r["firstName"];

        //Call view
        $this->view("ClassView", [
            "PostDetailView" => "PostDetail",
            "TeacherProfile" => "Profile",
            "PostDetail" => $post,
            "ClassDetail" => $class,
            "CommentList" => $comment,
            "UserName" => $name,
            "LinksList" => $links
        ]);
    }

    //Must have Home
    function Home($id) {
        //Call model
        $classModel = $this->model("ClassModel");
        $postModel = $this->model("PostModel");
        $userModel = $this->model("UserModel");
        $user = $userModel->getUserById($_SESSION["loggedIn"]);

        $post = $postModel->getAllPost($id);

        $data = $classModel->getClassById($id);

        if ($user == false || $data == false) {
            header("Location: ../Error");
            exit();
        }
        $class = $data->fetch_assoc();

        $r = $user->fetch_assoc();
        $name = $r["firstName"];

        //Call view
        $this->view("ClassView", [
            "NewPostView" => "NewPost",
            "TeacherProfile" => "Profile",
            "PostView" => "Post",
            "ClassDetail" => $class,
            "PostList" => $post,
            "UserName" => $name
        ]);
    }

    function Assignment($id) {
        //Call model
        $assignmentModel = $this->model("AssignmentModel");
        $classModel = $this->model("ClassModel");
        $userModel = $this->model("UserModel");

        $user = $userModel->getUserById($_SESSION["loggedIn"]);
        
        $assignment = $assignmentModel->getAllAssignment($id);
        $data = $classModel->getClassById($id);

        if ($data == false) {
            header("Location: ../Error");
            exit();
        }
        
        $class = $data->fetch_assoc();
        $r = $user->fetch_assoc();
        $name = $r["firstName"];


       //Call view
       $this->view("ClassView", [
           "NewAssignmentView" => "NewAssignment",
           "TeacherProfile" => "Profile",
           "AssignmentView" => "Assignment",
           "UserName" => $name,
           "ClassDetail" => $class,
           "AssignmentList" => $assignment
       ]); 
    }

    function People($id) {
        //Call model
        $userModel = $this->model("UserModel");
        $classModel = $this->model("ClassModel");

        $data = $classModel->getClassById($id);
        if ($data == false) {
            header("Location: ../Error");
            exit();
        }

        $class = $data->fetch_assoc();
        $user = $userModel->getUserById($_SESSION["loggedIn"]);
        $student = $userModel->getAllStudent($id);


        $r = $user->fetch_assoc();
        $name = $r["firstName"];

        //Call view
        $this->view("ClassView", [
            "ListMemberView" => "ListMember",
            "ClassDetail" => $class,
            "StudentList" => $student,
            "UserName" => $name
        ]);
    }

    function DeletePost($class, $post) {
        //Call model
        $postModel = $this->model("PostModel");
        $result = $postModel->deletePostById($class, $post);

        if (!$result) {
            echo "Delete Post FAILED";
        }

        header("Location: ../../Home/$class");
    }

    function UpdatePost($class, $post) {
        //Call model
        $str = $_POST["newContent"];
        $postModel = $this->model("PostModel");

        $date = date("d/m/Y");
        $result = $postModel->updatePostById($class, $post, $str, $date);

        if (!$result) {
            echo "Update Post FAILED";
        }

        header("Location: ../../Detail/$class/$post");
    }

    function DeleteComment($class, $post, $comment) {
        //Call model
        $commentModel = $this->model("CommentModel");
        $result = $commentModel->deleteCommentById($post, $comment);

        if (!$result) {
            echo "Delete Comment FAILED";
        }

        header("Location: ../../../Detail/$class/$post");
    }

    function DeleteStudent($class, $student) {
        //Call model
        $studentStudyClassModel = $this->model("StudentStudyClassModel");
        $postModel = $this->model("PostModel");

        $result1 = $studentStudyClassModel->deleteStudentById($student, $class);
        $result2 = $postModel->deletePostByUserId($student);

        if (!$result1 || !$result2) {
            die("Delete Student FAILED");
        }

        header("Location: ../../People/$class");
    }

    function AddComment($class, $post, $writer) {
        $str = $_POST["comment"];
        $date = date("d/m/Y");

        //Call model
        $commentModel = $this->model("CommentModel");
        $result = $commentModel->insertComment($post, $writer, $str, $date);

        if (!$result) {
            echo "Add Comment FAILED";
        }

        header("Location: ../../../Detail/$class/$post");
    }

    function AddStudent($class) {
        $username = $_POST["student_username"];

        //Call model
        $userModel = $this->model("UserModel");
        $studentStudyClassModel = $this->model("StudentStudyClassModel");

        $student = $userModel->getUserByUsername($username);

        if ($student != false) {
            $data = $student->fetch_assoc();
            $result = $studentStudyClassModel->joinClass($data["id"], $class);

            if (!$result) {
                header("Location: ../../Home/Error");
                exit();
            }
            
            $_SESSION["addStudent"] = "success";
            header("Location: ../People/$class");
            exit();
        }

        $_SESSION["addStudent"] = "fail";
        header("Location: ../People/$class");
        exit();

    }

    function DeleteClass($class) {
        //Call model
        $studentStudyClassModel = $this->model("StudentStudyClassModel");
        $teacherTeachClassModel = $this->model("TeacherTeachClassModel");
        $fileModel = $this->model("FileModel");
        $assignmentModel = $this->model("AssignmentModel");
        $postModel = $this->model("PostModel");
        $classModel = $this->model("ClassModel");


        $result1 = $studentStudyClassModel->deleteStudentByClass($class);
        $result2 = $teacherTeachClassModel->deleteTeacherByClass($class);
        $result3 = $fileModel->deleteFileByClass($class);
        $result4 = $assignmentModel->deleteAssignmentByClass($class);
        $result5 = $postModel->deletePostByClass($class);
        $result6 = $classModel->deleteClassById($class);

        if (!$result1 || !$result2 || !$result3 || !$result4 || !$result5 || !$result6) {
            $_SESSION["deleteClass"] = "fail";
            header("Location: ../../Home/Listclass");
            exit();
        }

        $_SESSION["deleteClass"] = "success";
        header("Location: ../../Home/Listclass");
    }

    function UpdateClass($class) {
        $classname = $_POST["classname"];
        $subject = $_POST["subject"];
        $room = $_POST["room"];
        $day = $_POST["day"];
        $time = $_POST["time"];

        //Call model
        $classModel = $this->model("ClassModel");
        $result = $classModel->updateClassById($class, $classname, $subject, $room, $day, $time);

        if ($result) {
            $_SESSION["changeInfoClass"] = "success";
            header("Location: ../Home/$class");
            exit();
        }

        $_SESSION["changeInfoClass"] = "fail";
        header("Location: ../Home/$class");
    }

    //----------------------------------------- Assginment -----------------------------------------//

    function PostAssignment($class, $writter) {
        //Call model
        $assignmentModel = $this->model("AssignmentModel");

        $now = date('d/m/Y');

        $newDeadline = date("d/m/Y", strtotime($_POST["deadline"]));

        $postAssignment = $assignmentModel->postAssignment($class, $writter, $now, $_POST["assignment_name"], 
                                                        $_POST["assigment_content"], $_POST["link_assignment"], 
                                                        "00-00-0000", $newDeadline);

        header("Location: ../../Assignment/$class");
    }
    
    //----------------------------------------- Assginment -----------------------------------------//

    //----------------------------------------- Post -----------------------------------------//
    function AddPost($class, $writter) {
        //Call model
        $postModel = $this->model("PostModel");
        $fileModel = $this->model("FileModel");

        $now = date('d/m/Y');

        $postModel->addPost($class, $writter, $_POST["post_content"], $now, "00-00-0000");

        // Lay id cua post moi them vao
        $lastPost = $postModel->getTheLastPost();
        $lastId = $lastPost->fetch_assoc();
        $id = $lastId["id"];

        $files = array_filter($_FILES['uploads']['name']);
        $total = count($_FILES["uploads"]["name"]);

        for( $i=0 ; $i < $total ; $i++ ) {

            // Get the temp file path
            $tmpFilePath = $_FILES['uploads']['tmp_name'][$i];
        
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                //Setup our new file path
                $newFilePath = "./public/uploads/" . $_FILES['uploads']['name'][$i];
            
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
            
                    //Handle other code here
                    $fileModel->addFile($id, $newFilePath);
                }
            }
        }

        header("Location: ../../Home/$class");
    }

    //----------------------------------------- Post -----------------------------------------//

}
?>