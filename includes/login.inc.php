<?php
if (isset($_POST["submit"])){
    $username = $_POST["email"];
    $pwd = $_POST["password"];

    require_once'config.inc.php';
    require_once'functions.inc.php';

    //If username or password field is empty
    if(emptyInputLogin($username, $pwd) !== false){
        header("location:../index.php?error=emptyInput");
        exit();
    }

    loginUser($conn, $username, $pwd);
}
else {
    header("location: ../index.php");
    exit();
}