<?php
class userModel extends DB{

    //--------------------------------- USER ---------------------------------------//
    function login($userName) {
        $sql = "SELECT `user`.`id`, `user`.`userName`, `user`.`password`, `userpermission`.`permission_id` 
                FROM `user`, `userpermission` WHERE `user`.`id` = `userpermission`.`user_id` and `user`.`userName` = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $userName);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();
    
        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function getUserById($id) {
        $sql = "SELECT * FROM user WHERE id=?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('i', $id);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function getUserByUsername($username) {
        $sql = "SELECT * FROM user WHERE userName=?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $username);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function registerUser($firstName, $lastName, $userName, $avatar, $password, $birthday, $email, $phoneNumber) {
        $sql = "INSERT INTO user(firstName, lastName, userName, avatar, password, birthday, email, phoneNumber) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('ssssssss', $lastName, $firstName, 
                                     $userName, $avatar, 
                                     $password, $birthday, 
                                     $email, $phoneNumber);

        if (!$stm->execute()) {
            return false;
        }
    }

    function getAllStudent($class) {
        $sql = "SELECT `user`.`id`, `user`.`firstName`, `user`.`lastName`, `user`.`avatar` FROM `user` 
                WHERE `user`.`id` IN (SELECT `studentstudyclass`.`id_student` FROM `studentstudyclass` WHERE `studentstudyclass`.`id_class` = ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $class);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function deleteUserById($user) {
        $delete = "DELETE FROM `user` WHERE `user`.`id` = ?";
        $stm = $this->con->prepare($delete);
        $stm->bind_param('i', $user);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }
    //--------------------------------- END USER ---------------------------------------//

    //------------------------------------- Reset Password -----------------------------------------//
    function getUserEmail($email, $userName) {
        $sql = "SELECT email, userName FROM user WHERE email=? OR userName=?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('ss', $email, $userName);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            // email ton tai
            return false;
        }

        // email khong ton tai
        return true;
    }

    function getFirstName($info) {
        $sql = "SELECT firstName FROM `user` WHERE email=?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("s", $info);

        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();
        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function updatePassword($newPassword, $email) {
        $sql = "UPDATE `user` SET password=? WHERE email=?";
        $stm = $this->con->prepare($sql);
        $stm->bind_param("ss", $newPassword, $email);

        if ($stm->execute()) {
            return true;
        }

        return false;
    }
    //------------------------------------- Reset Password -----------------------------------------//


    //------------------------------------- Register User -----------------------------------------//
    function getTheLastUser() {
        $sql = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
        $stm = $this->con->prepare($sql);

        if ($stm->execute()) {
            return $stm->get_result();
        }

        return false;
    }
    //------------------------------------- Register User -----------------------------------------//

    
}
?>