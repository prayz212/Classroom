<?php 

class FileModel extends DB {

    //--------------------------------- FILE ---------------------------------------//
    public function addFile($post, $file) {
        $sql = "INSERT INTO file(id_post, file_src) VALUES(?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("is", $post, $file);
        $result = $stm->execute();

        if ($result) {
            return true;
        }
        
        die($stm->error);
    }

    public function deleteFileByClass($class) {
        $sql = "DELETE FROM file WHERE `file`.`id_post` IN (SELECT `post`.`id` FROM `post` WHERE `post`.`id_class` = ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param("s", $class);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        die($stm->error);
    }
    //--------------------------------- END FILE ---------------------------------------//

}
?>