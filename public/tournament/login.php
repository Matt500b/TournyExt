<?php
include_once '../../includes/process_login.php';
sec_session_start();

include "headers/header.php";
include "headers/navbar.php";
?>

<div class="wrapper">

    <?php
    if (!empty($err_msg)) {
        echo '<div class="error_msg">' . $err_msg . '</div>';
    }
    else if (!empty($success_msg)) {
        echo '<div class="success_msg">' . $success_msg . '</div>';
    }
    ?>

    <h1>Simple Login Form</h1>

    <form action="" method="POST" class="reg_form" name="login_form">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="••••••••••••" value="">
        <input type="button" value="Login" onclick="formhash(this.form, this.form.password);">
    </form>

    <p>If you don't have a login, please <a href='register.php'>register</a></p>
    <p><a href='#'>Forgot password? (Not implemented yet)</a></p>
</div>

<?php
include "headers/footer.php";
?>
