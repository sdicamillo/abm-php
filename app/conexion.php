<?php

    $servidor= "localhost";
    $username= "root";
    $password= "";
    $db= "db_movimientos";

    try{
        $conexion= mysqli_connect($servidor, $username, $password, $db);
    } catch (Exception $e){
        echo $e;
    }


?>