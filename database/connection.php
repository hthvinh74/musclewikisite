<?php
    define('HOST', '127.0.0.1');
    define('USER', 'root');
    define('PASS','');
    define('DB_NAME', 'musclewikison');

    function create_connection(){
        $connect = new mysqli(HOST,USER,PASS,DB_NAME);

        if($connect->connect_error){
            die('Can not connect to server: '. $connect->connect_error);
        }

        return $connect;
    }
?>