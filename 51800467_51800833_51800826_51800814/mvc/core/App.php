<?php
class App{

    protected $controller="Home";
    protected $action="Error";
    protected $params=[];

    function __construct(){

        //MUST LOGIN FIRST
        //Check login session
        if (!isset($_SESSION['loggedIn'])) {
            require_once "./mvc/controllers/Account.php";
            $this->controller = "Account";
            $this->controller = new Account();

            if (isset($_GET["url"])) {
                $url = $this->UrlProcess();

                if (isset($url[1])) {
                    if (method_exists($this->controller, $url[1])) {
                        call_user_func_array([$this->controller, $url[1]], []);
                        exit();
                    }
                }
            }

            call_user_func_array([$this->controller, "Login"], []);
            exit();
        }

        $url = $this->UrlProcess();

        // Controller
        if (isset($url[0])) {
            if(file_exists("./mvc/controllers/".$url[0].".php")){
                $this->controller = $url[0];
                unset($url[0]);
            }
        }
        require_once "./mvc/controllers/". $this->controller .".php";
        $this->controller = new $this->controller;

        // Action
        if(isset($url[1])){
            if( method_exists( $this->controller , $url[1]) ){
                $this->action = $url[1];
            } else {
                require_once "./mvc/controllers/Home.php";
                call_user_func_array([new Home(), "Error"], $this->params );
                exit();
            }

            unset($url[1]);
        } else {
            require_once "./mvc/controllers/Home.php";
            call_user_func_array([new Home(), "Error"], $this->params );
            exit();
        }

        // Params
        $this->params = $url?array_values($url):[];
        call_user_func_array([$this->controller, $this->action], $this->params );

    }

    function UrlProcess(){
        if(isset($_GET["url"]) ){
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }

}
?>