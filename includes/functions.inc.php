<?php
function emptyInputSignup($user_email, $pwd, $pwdRepeat)
{
    $result;
    if (empty($user_email) || empty($pwd) || empty($pwdRepeat)) $result = true;
    else
    {
        $result = false;
    }
    return $result;
};

function invalidEmail($user_email)
{
    $result;

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidPassword($pwd)
{
    $result;
    $pwdLength = strlen($pwd);
    if ($pwdLength < 6)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result;
    if ($pwd !== $pwdRepeat)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidDepartment($department)
{
    $result;
    if ($department == "noInput")
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}


function userExists($conn, $user_email)
{
    $result;
    $sql = "SELECT * FROM users WHERE email = ?;";
    //Prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);
    //Checks if sql statement executes & redirects to current page
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header('Location: '.$_SERVER['PHP_SELF']);;
        exit();
    }
    //Binds statement with user email
    mysqli_stmt_bind_param($stmt, "s", $user_email);
    mysqli_stmt_execute($stmt);

    //Assigns result to variable
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    my_sqli_stmt_close($stmt);
}

function getInstruction($conn, $part_number, $instruction_type)
{
    $result;
    $sql = "SELECT * FROM instruction WHERE part_number = ? AND instruction_type = ?;";
    //Prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);
    //Checks if sql statement executes & redirects to current page
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header('Location: '.$_SERVER['PHP_SELF']);;
        exit();
    }
    //Binds statement with user email
    mysqli_stmt_bind_param($stmt, "ss", $part_number, $instruction_type);
    mysqli_stmt_execute($stmt);

    //Assigns result to variable
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    my_sqli_stmt_close($stmt);
}

function createUser($conn, $user_email, $pwd, $pwdRepeat, $department)
{
    $sql = "INSERT INTO users (email, password, department) VALUES (?, ? ,?) ;";
    //Prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);
    //Checks if sql statement executes
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location:../add_user.php?error=sqlError");
        exit();
    }
    //Hashes the users password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    //Binds statement with user email
    mysqli_stmt_bind_param($stmt, "sss", $user_email, $hashedPwd, $department);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../add_user.php?error=none");
    exit();
}



function readUser($conn, $user_email){
    $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $numRows = $result->num_rows;
    if($numRows){
        $user = $result->fetch_assoc(); // fetch data  
    }else{
        $user = false;
    }
    return $user;
}

function getMessage(){
    $message = "";

    if(isset($_GET["error"])){

        if($_GET["error"] == "emptyInput"){
            $message = "Please fill in all fields";
        }
        else if($_GET["error"] == "invalidPassword"){
            $message = "Password requires at least 6 characters";
        }
        else if($_GET["error"] == "passwordMismatch"){
            $message = "Please make sure passwords match";
        }
        else if($_GET["error"] == "invalidDepartment"){
            $message = "Please select a valid department";
        }
        else if($_GET["error"] == "userExists"){
            $message = "This email already exists";
        }
        else if($_GET["error"] == "wrongLogin"){
            $message = "Incorrect login details";
        }
        else if($_GET["error"] == "selectDepartment"){
            $message = "Please select a department";
        }
        return $message;
    }
}

function emptyInputLogin($user_email, $pwd){
{
    $result;
    if (empty($user_email) || empty($pwd)) $result = true;
    else
    {
        $result = false;
    }
    return $result;
};
}

function loginUser($conn, $user_email, $pwd){
    $userExists = userExists($conn, $user_email);
    if($userExists === false){
        header("location:../index.php?error=wrongLogin");
        exit();
    }
    $pwdHashed = $userExists["password"];
    $checkedPwd = password_verify($pwd, $pwdHashed);
    //Redirect if wrong password
    if ($checkedPwd === false){
        header("location:../index.php?error=wrongLogin");
        exit();
    }
    else if ($checkedPwd === true){
        //Creates session and assigns session variables to user attributes
        session_start();
        $_SESSION["userid"] = $userExists["id"];
        $_SESSION["email"] = $userExists["email"];
        $_SESSION["department"] = $userExists["department"];
        header("location: ../welcome.php");
        exit();
    }
}

function privilegeLevel($Department) {
    if (!isset($_SESSION['userid'])){
        header("location: access_denied.php");
            exit();
    }
    if ($_SESSION['department'] != "$Department"){
            header("location: access_denied.php");
            exit();
            }           
    }

function drawNav(){
    if (isset($_SESSION['userid'])){
        if ($_SESSION['department'] == "Engineering"){
        echo 
            '<a class="nav-item nav-link" href="#">Requests</a>
            <a class="nav-item nav-link" href="instructions.php">Instructions</a>
             <a class="nav-item nav-link" href="add_user.php">Add User</a>
             <a class="nav-item nav-link" href="modify_user.php">Delete User</a>
             <a class="nav-item nav-link" href="includes/logout.inc.php">Logout</a>';
        } 
        if ($_SESSION['department'] == "Production"){
            echo 
                '<a class="nav-item nav-link" href="instructions.php">View Instructions</a>
                 <a class="nav-item nav-link" href="#">Request Update</a>
                 <a class="nav-item nav-link" href="#">New Instruction</a>
                 <a class="nav-item nav-link" href="includes/logout.inc.php">Logout</a>';
            } 
    }
}