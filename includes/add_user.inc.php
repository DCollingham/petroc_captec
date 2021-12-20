<?php
if(isset($_POST["add_user_submit"])){

    $user_email = $_POST["user_email"];
    $pwd = $_POST["user_pwd"];
    $pwdRepeat = $_POST["user_pwd_repeat"];
    $department = $_POST["department"];
    require_once 'config.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($user_email, $pwd, $pwdRepeat) !== false){
        header("location:../add_user.php?error=emptyInput");
        exit();
    }

    if(invalidEmail($user_email) !== false){
        header("location:../add_user.php?error=invalidEmail");
        exit();
    }

    if(invalidPassword($pwd) !== false){
        header("location:../add_user.php?error=invalidPassword");
        exit();
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location:../add_user.php?error=passwordMismatch");
        exit();
    }

    if(userExists($conn, $user_email) !== false){
        header("location:../add_user.php?error=userExists");
        exit();
    }
    if(invalidDepartment($department) !== false){
        header("location:../add_user.php?error=selectDepartment");
        exit();
    }

    createUser($conn, $user_email, $pwd, $pwdRepeat, $department);

} 
else {
    header("location:../add_user.php");
}