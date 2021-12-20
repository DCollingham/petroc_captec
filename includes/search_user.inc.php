<?php
require_once 'functions.inc.php';
require_once 'config.inc.php';
privilegeLevel("Admin");
if(isset($_POST["modify_user_submit"])){
    $user_email = $_POST["search_user_email"];
    $userData = readUser($conn, $user_email);
    header("location: ..\modify_user.php");
}