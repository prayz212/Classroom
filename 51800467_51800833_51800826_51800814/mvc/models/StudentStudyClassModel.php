<?php

class StudentStudyClassModel extends DB {

    //--------------------------------- STUDENT STUDY CLASS ---------------------------------------//
    public function deleteStudentById($student_id, $class_id)
    {
        $deleteStudent = "DELETE FROM `studentstudyclass` WHERE `studentstudyclass`.`id_student` = ? AND `studentstudyclass`.`id_class` = ?";
        $stm = $this->con->prepare($deleteStudent);
        $stm->bind_param('is', $student_id, $class_id);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }

    public function joinClass($student_id, $class_id)
    {
        $sql = "INSERT INTO `studentstudyclass`(id_student, id_class) VALUES (?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('is', $student_id, $class_id);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    public function deleteStudentByClass($class_id)
    {
        $deleteStudent = "DELETE FROM `studentstudyclass` WHERE `studentstudyclass`.`id_class` = ?";
        $stm = $this->con->prepare($deleteStudent);
        $stm->bind_param('s', $class_id);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }
    //--------------------------------- END STUDENT STUDY CLASS ---------------------------------------//

}
?>