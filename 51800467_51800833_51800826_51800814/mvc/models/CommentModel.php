<?php

class CommentModel extends DB {

    //----------------------------------- COMMENT -------------------------------------//
    public function getAllComment($id_post)
    {
        $query = "SELECT `comment`.`id`, `comment`.`content`, `comment`.`comment_time`, `comment`.`id_writter`, `user`.`firstName`, `user`.`lastName`, `user`.`avatar` 
                  FROM `comment`, `user` 
                  WHERE `user`.`id` = `comment`.`id_writter` and `comment`.`id_post` = ?";
        $stm = $this->con->prepare($query);
        $stm->bind_param('s', $id_post);
        $stm->execute();
        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return null;
    }

    public function deleteCommentById($post, $comment)
    {
        //DELETE ALL COMMENT FIRST
        $query = "DELETE FROM `comment` WHERE `comment`.`id` = ? and `comment`.`id_post` = ?";
        $stm = $this->con->prepare($query);
        $stm->bind_param('ii', $comment, $post);
        $result = $stm->execute();

        if ($result) {
            return $result;
        }

        die($stm->error);
    }

    public function insertComment($post, $writer, $comment, $date)
    {
        $query = "INSERT INTO `comment` VALUES(Null, ?, ?, ?, ?)";
        $stm = $this->con->prepare($query);
        $stm->bind_param('iiss', $post, $writer, $comment, $date);
        $result = $stm->execute();

        if ($result) {
            return $result;
        }

        die($stm->error);
    }
    //--------------------------------- END COMMENT ---------------------------------------//

}
?>