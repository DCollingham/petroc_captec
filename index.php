<?php
include_once 'header.php'
?>

    <div class="container d-flex justify-content-center align-items-center test">
        <div class="form-container ">
            <form action="includes/login.inc.php" method="post">
                <h3 class="login-text">Please login</h3>

<?php
    require_once 'includes\functions.inc.php';
    $message = getMessage();
    echo $message
?>
                <div class="form-group my-1 ">
                    <input type="email" name="email" class="form-control" id="login_email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group ">
                    <input type="password" name="password" class="form-control" id="login_password" placeholder="Password">
                    <button type="submit" name="submit" class="btn-login">Login</button>
                </div>
            </form>
        </div>
    </div>

<?php
include_once 'footer.php'
?>
