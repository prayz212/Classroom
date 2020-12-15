<?php

class ClassModel extends DB {

    //--------------------------------- CLASS ---------------------------------------//
    public function getAllClass()
    {
        $query = "SELECT `class`.`id`, `class`.`day`, `class`.`classname`, `class`.`subject`, `class`.`time`, `class`.`room` 
                  FROM `class`, `teacherteachclass` 
                  WHERE `class`.`id` = `teacherteachclass`.`id_class`";
        $stm = $this->con->prepare($query);
        $stm->execute();
        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }
        return false;
    }

    function getAllTeacherForClassAD() {
        $query_teacher = "SELECT * FROM `user`, `teacherteachclass` 
                          WHERE `user`.`id` = `teacherteachclass`.`id_teacher` and `teacherteachclass`.`id_class` 
                          IN (SELECT `class`.`id` FROM `class`)";

        //SELECT ALL TEACHER OF CLASS
        $stm1 = $this->con->prepare($query_teacher);
        $stm1->execute();
        $result = $stm1->get_result();

        if($result->num_rows > 0) {
            return $result;
        }
        return false;
    }

    function getAllClassForStudent($id) {
        $query_class = "SELECT `class`.`id`, `class`.`classname`, `class`.`day`, `class`.`subject`, `class`.`time`, `class`.`room` 
                        FROM `class` WHERE `class`.`id` 
                        IN (SELECT `studentstudyclass`.`id_class` FROM `studentstudyclass` WHERE `studentstudyclass`.`id_student` = ?)";

        //SELECT ALL CLASS
        $stm1 = $this->con->prepare($query_class);
        $stm1->bind_param('i', $id);
        $stm1->execute();
        $result = $stm1->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }
        return false;
    }

    function getAllTeacherForClass($id) {
        $query_teacher = "SELECT `user`.`id`, `user`.`firstName`, `user`.`lastName`, `user`.`avatar`, `user`.`email`, `user`.`phoneNumber` 
                          FROM `teacherteachclass`, `user` WHERE `teacherteachclass`.`id_teacher` = `user`.`id` and `teacherteachclass`.`id_class` 
                          IN (SELECT `studentstudyclass`.`id_class` FROM `studentstudyclass` WHERE `studentstudyclass`.`id_student` = ?)";

        //SELECT ALL TEACHER OF CLASS
        $stm1 = $this->con->prepare($query_teacher);
        $stm1->bind_param('i', $id);
        $stm1->execute();
        $result = $stm1->get_result();

        if($result->num_rows > 0) {
            return $result;
        }
    }

    function getAllClassForTeacher($id) {
        $query_teacher = "SELECT * FROM `class`, `teacherteachclass` 
                          WHERE `class`.`id` = `teacherteachclass`.`id_class` and `teacherteachclass`.`id_teacher` = ?";

        //SELECT ALL TEACHER OF CLASS
        $stm1 = $this->con->prepare($query_teacher);
        $stm1->bind_param('i', $id);
        $stm1->execute();
        $result = $stm1->get_result();

        if($result->num_rows > 0) {
            return $result;
        }
    }

    public function getClassById($id) {
        $query = "SELECT `class`.`id`, `class`.`classname`, `class`.`day`, `user`.`firstName`, `user`.`lastName`, `user`.`email`, `user`.`avatar`, `user`.`phoneNumber`, subject, room, time, day 
                  FROM `class`, `user`, `teacherteachclass` 
                  WHERE `teacherteachclass`.`id_class` = `class`.`id` and `teacherteachclass`.`id_teacher` = `user`.`id` and `class`.`id` = ?";
        $stm = $this->con->prepare($query);
        $stm->bind_param('s', $id);
        $stm->execute();
        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }
        return false;
    }

    public function insertClass($id, $name, $subject, $room, $day, $time, $id_teacher) {
        $query1 = "INSERT INTO `class` VALUES(?, ?, ?, ?, ?, ?)";
        $query2 = "INSERT INTO `teacherteachclass` VALUES(?, ?)";

        $stm = $this->con->prepare($query1);
        $stm->bind_param('ssssss', $id, $name, $subject, $time, $day, $room);
        $result = $stm->execute();

        if (!$result) {
            die($stm->error);
        }

        $stm = $this->con->prepare($query2);
        $stm->bind_param('is', $id_teacher, $id);
        $result = $stm->execute();

        if ($result) {
            return $result;
        }

        die($stm->error);
    }

    public function studentJoinClass($id_student, $id_class) {
        $query = "INSERT INTO `studentstudyclass` VALUES(?, ?)";

        $stm = $this->con->prepare($query);
        $stm->bind_param('is', $id_student, $id_class);
        $result = $stm->execute();

        if ($result) {
            return $result;
        }
        return false;
    }

    public function deleteClassById($class) {
        $sql = "DELETE FROM class WHERE `class`.`id` = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("s", $class);
        $result = $stm->execute();

        if ($result) {
            return true;
        }
        die($stm->error);
    }

    public function updateClassById($class, $classname, $subject, $room, $day, $time)
    {
        $updateClass = "UPDATE `class` SET `class`.`classname` = ?, `class`.`subject` = ?, `class`.`room` = ?, `class`.`day` = ?, `class`.`time` = ? 
                        WHERE `class`.`id` = ?";
        $stm = $this->con->prepare($updateClass);
        $stm->bind_param('ssssss', $classname, $subject, $room, $day, $time, $class);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }

    function getClassByName($name) {
        $pagram = "%" .$name . "%";
        $query_class = "SELECT `class`.`id`, `class`.`classname`, `class`.`subject`, `class`.`time`, `class`.`day`, `class`.`room`, `user`.`avatar`, `user`.`firstName`, `user`.`lastName`
                        FROM `user`, `class`, `teacherteachclass` 
                        WHERE `user`.`id` = `teacherteachclass`.`id_teacher` and `class`.`id` = `teacherteachclass`.`id_class` 
                              and `teacherteachclass`.`id_class` IN (SELECT `class`.`id` FROM `class` WHERE `class`.`classname` LIKE ?)";

        $stm1 = $this->con->prepare($query_class);
        $stm1->bind_param('s', $pagram);
        $stm1->execute();
        $result = $stm1->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }
        return false;
    }
    //--------------------------------- END CLASS ---------------------------------------//

}
?>