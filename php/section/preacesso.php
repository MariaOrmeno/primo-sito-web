<?php session_start();
include ("./function.php");

    if(isset($_SESSION['name'])){

        if($_SESSION['type'] == 0){ /*CLIENTE */
            header('Location: ./../home.php');
        }
        if($_SESSION['type'] == 1){/*ADMIN */
            header('location:../admin/home_admin.php');
        }
    }
    else{
        header('Location: login.php');
    }
?>