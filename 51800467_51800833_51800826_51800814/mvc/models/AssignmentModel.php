<?php 
class AssignmentModel extends DB {

    //--------------------------------- ASSIGNMENT ---------------------------------------//
    function getAllAssignment($id) {
        $sql = "SELECT `user`.`firstName`, `user`.`lastName`, `user`.`avatar`, 
                        `assignment`.`id`, `assignment`.`id_class`, `assignment`.`content`, 
                        `assignment`.`post_time`, `assignment`.`last_edt`, `assignment`.`deadline`,
                        `assignment`.`link_assignment`, `assignment`.`name`
                FROM `user`, `assignment` 
                WHERE `user`.`id` = `assignment`.`id_writter` and `assignment`.`id_class` = ?
                ORDER BY `assignment`.`id` DESC";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("s", $id);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();
        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function postAssignment($id_class, $id_writter, $post_time, $name, $content, $link_assignment, $last_edt, $deadline) {
        $sql = "INSERT INTO assignment(id_class, id_writter, post_time, name, content, link_assignment, last_edt, deadline) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("sissssss", $id_class, $id_writter, $post_time, $name, $content, $link_assignment, $last_edt, $deadline);
        if (!$stm->execute()) {
            return false;
        }
        
        return true;
    }
    
    public function deleteAssignmentByClass($class) {
        $sql = "DELETE FROM assignment WHERE `assignment`.`id_class` = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("s", $class);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }

    //--------------------------------- END ASSIGNMENT ---------------------------------------//
}
?>