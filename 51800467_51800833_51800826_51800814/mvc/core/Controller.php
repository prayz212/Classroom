<?php
class Controller{

    public function model($modelName){
        if (file_exists("./mvc/models/".$modelName.".php")) {
            require_once "./mvc/models/".$modelName.".php";
            return new $modelName;
        } else {
            echo "require model failed!";
        }
    }

    public function view($viewName, $data=[]){
        if (file_exists("./mvc/views/".$viewName.".php")) {
            require_once "./mvc/views/".$viewName.".php";
        } else {
            echo "require view failed!";
        }
    }

}
?>