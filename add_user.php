<?php
include_once 'header.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Engineering");
?>
  <div class="container d-flex justify-content-center align-items-center test">

<div class="form-container ">
    <form action="includes/add_user.inc.php" method="post">
        <h3 class="login-text">Add User</h3>

<?php
$message = getMessage();
echo $message
?>
    <form>
        <div class="form-group my-1 ">
            <input type="email" name="user_email" class="form-control" id="add_user_email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <input type="password" name="user_pwd" class="form-control" id="add_user_pwd" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" name="user_pwd_repeat" class="form-control" id="add_user_pwd_repeat" placeholder="Repeat password">
        </div>
        <div class="form-group">
        <select class="form-control" name="department" id="add_user_department"> 
            <option value="noInput">Choose Department</option>
            <option value="Admin">Admin</option>
            <option value="Engineering">Engineering</option>
            <option value="Quality Control">Quality Control</option>
            <option value="Production">Production</option>
        </select>
        <button type="submit" name="add_user_submit" class="btn-login">Add User</button>
        </div>    
    </form>





<?php
include_once 'footer.php'
?>