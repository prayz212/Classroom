<?php

class PostModel extends DB {

    //--------------------------------- POST ---------------------------------------//
    public function getAllPost($id)
    {
        $query = "SELECT `user`.`firstName`, `user`.`lastName`, `user`.`avatar`, `post`.`id`, `post`.`id_class`, `post`.`content`, `post`.`post_time`, `post`.`last_edt` 
                  FROM `user`, `post` 
                  WHERE `user`.`id` = `post`.`id_writter` and `post`.`id_class` = ?
                  ORDER BY `post`.`id` DESC";
        $stm = $this->con->prepare($query);
        $stm->bind_param('s', $id);
        $stm->execute();
        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return null;
    }

    public function getPostById($class, $post)
    {
        $query = "SELECT `user`.`firstName`, `user`.`lastName`, `user`.`avatar`, `post`.`id_writter`, `post`.`id`, `post`.`id_class`, `post`.`content`, `post`.`post_time`, `post`.`last_edt`
                  FROM `user`, `post` 
                  WHERE `user`.`id` = `post`.`id_writter` and `post`.`id_class` = ? and `post`.`id` = ?";
        $stm = $this->con->prepare($query);
        $stm->bind_param('si', $class, $post);
        $stm->execute();
        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    public function getTheLastPost() {
        $sql = "SELECT id FROM post ORDER BY id DESC LIMIT 1";

        $stm = $this->con->prepare($sql);
        $result = $stm->execute();

        if (!$result) {
            return false;
        }

        return $stm->get_result();
    }

    public function getAllLinks($post) {
        $sql = "SELECT `file`.`file_src` FROM `file` WHERE `file`.`id_post` = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("i", $post);

        if ($stm->execute()) {
            return $stm->get_result();
        }
        
        return false;
    }

    public function addPost($class, $writter, $content, $post_time, $last_edt) {
        $sql = "INSERT INTO post(id_class, id_writter, content, post_time, last_edt) 
                VALUES(?, ?, ?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("sisss", $class, $writter, $content, $post_time, $last_edt);
        if ($stm->execute()) {
            return true;
        }
        
        return false;
    }

    public function deletePostById($class, $post)
    {
        //DELETE ALL COMMENT FIRST
        $deleteComment = "DELETE FROM `comment` WHERE `comment`.`id_post` = ?";
        $stm = $this->con->prepare($deleteComment);
        $stm->bind_param('i', $post);
        $stm->execute();

        //AFTER DELETE COMMENT WILL ALLOW DELETE POST
        $deletePost = "DELETE FROM `post` WHERE `post`.`id_class` = ? and `post`.`id` = ?";
        $stm = $this->con->prepare($deletePost);
        $stm->bind_param('si', $class, $post);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }

    public function deletePostByClass($class)
    {
        //DELETE ALL COMMENT FIRST
        $deleteComment = "DELETE FROM `comment` WHERE `comment`.`id_post` 
                          IN (SELECT `post`.`id` FROM `post` WHERE `post`.`id_class` = ?)";
        $stm = $this->con->prepare($deleteComment);
        $stm->bind_param('s', $class);
        $stm->execute();

        //AFTER DELETE COMMENT WILL ALLOW DELETE POST
        $deletePost = "DELETE FROM `post` WHERE `post`.`id_class` = ?";
        $stm = $this->con->prepare($deletePost);
        $stm->bind_param('s', $class);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }

    public function deletePostByUserId($user)
    {
        //DELETE ALL COMMENT FIRST
        $deleteComment = "DELETE FROM `comment` WHERE `comment`.`id_writter` = ?";
        $stm = $this->con->prepare($deleteComment);
        $stm->bind_param('i', $user);
        $stm->execute();

        //AFTER DELETE COMMENT WILL ALLOW DELETE POST
        $deletePost = "DELETE FROM `post` WHERE `post`.`id_writter` = ?";
        $stm = $this->con->prepare($deletePost);
        $stm->bind_param('i', $user);
        $result = $stm->execute();

        if ($result) {
            return $result;
        }

        die($stm->error);
    }

    public function updatePostById($class, $post, $content)
    {
        //AFTER DELETE COMMENT WILL ALLOW DELETE POST
        $updatePost = "UPDATE `post` SET `post`.`content` = ? WHERE `post`.`id_class` = ? and `post`.`id` = ?";
        $stm = $this->con->prepare($updatePost);
        $stm->bind_param('ssi', $content, $class, $post);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }
    //--------------------------------- END POST ---------------------------------------//

}
?>