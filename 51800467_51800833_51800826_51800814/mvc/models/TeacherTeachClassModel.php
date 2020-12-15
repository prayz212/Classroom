<?php

class TeacherTeachClassModel extends DB {

    //--------------------------------- TEACHER TEACH CLASS ---------------------------------------//
    public function deleteTeacherByClass($class_id)
    {
        $deleteTeacher = "DELETE FROM `teacherteachclass` WHERE `teacherteachclass`.`id_class` = ?";
        $stm = $this->con->prepare($deleteTeacher);
        $stm->bind_param('s', $class_id);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }
    //--------------------------------- END TEACHER TEACH CLASS ---------------------------------------//

}
?>