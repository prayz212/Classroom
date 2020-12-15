<?php

class DB{

    public $con;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "classroom";

    function  __construct()
    {
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $this->con->set_charset('UTF8');
        if ($this->con->connect_error) {
            die("Loi ket noi: " . $this->con->connect_error);
        }
    }
}

?>