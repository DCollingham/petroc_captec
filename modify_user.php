<?php
include_once 'header.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Admin");
?>
  <div class="container d-flex justify-content-center align-items-center test">

<div class="form-container ">
    <form action="includes/search_user.inc.php" method="post">
        <h3 class="login-text">Search for user</h3>

<?php
$message = getMessage();
echo $message
?>
    <form>
    <div class="form-group my-1 ">
            <input type="text" name="search_user_email" class="form-control" id="search_user_email" aria-describedby="emailHelp" placeholder="Search user email">
        </div>
        <div class="form-group my-1 ">
            <input type="text" name="user_id_read" class="form-control" id="user_id_read" disabled aria-describedby="emailHelp" placeholder="User ID">
        </div>

        <div class="form-group my-1 ">
            <input type="email" name="user_email_read" class="form-control" id="user_email_read" disabled aria-describedby="emailHelp" placeholder="User email">
        </div>
        <div class="form-group my-1 ">
            <input type="text" name="user_department_read" class="form-control" id="user_department_read" disabled aria-describedby="emailHelp" placeholder="Department">
        </div>

        <button type="submit" name="modify_user_submit" class="btn-login">Search</button>
        </div>    
    </form>

<?php
include_once 'footer.php'
?>