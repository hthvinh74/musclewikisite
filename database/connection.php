<?php
    define('HOST', 'us-cdbr-east-06.cleardb.net');
    define('USER', 'b8f8f2f25c66e1');
    define('PASS','dce09ba4');
    define('DB_NAME', 'heroku_aea989f3edb4771');

    function create_connection(){
        $connect = new mysqli(HOST,USER,PASS,DB_NAME);

        if($connect->connect_error){
            die('Can not connect to server: '. $connect->connect_error);
        }

        return $connect;
    }
?>
