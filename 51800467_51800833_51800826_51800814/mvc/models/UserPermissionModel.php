<?php

class UserPermissionModel extends DB {

    //--------------------------------- PERMISSION ---------------------------------------//
    function changePermission($id_user, $permission) {
        $query = "UPDATE `userpermission` SET `permission_id`= ? WHERE `user_id` = ?";
        $stm = $this->con->prepare($query);
        $stm->bind_param('is', $permission, $id_user);
        $result = $stm->execute();

        if($result) {
            return $result;
        }
        die($stm->error);
    }

    function registerPermission($id_user) {
        $sql = "INSERT INTO userpermission(user_id, permission_id) VALUES (? ,3)";
        $stm = $this->con->prepare($sql);

        $stm->bind_param("i", $id_user);
        $result = $stm->execute();

        if($result) {
            return $result;
        }
        return false; 
    }

    //--------------------------------- END PERMISSION ---------------------------------------//
}
?>