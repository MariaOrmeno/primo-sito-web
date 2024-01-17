<?php

/*Connessione DB */
function db(){
    $host = "127.0.0.1";
    $user_name = "root";
    $user_password = "";
    $db_name = "alce_db";

    try{
        $connessione = new PDO("mysql:host=$host;dbname=$db_name", $user_name, $user_password);
        /*echo ('è andata a buon fine');*/
    }
    catch(PDOException $error){
        print_r ("Error!: " . $error->getMessage() . "<br/>");
        die();
    }
    return $connessione;}
?>