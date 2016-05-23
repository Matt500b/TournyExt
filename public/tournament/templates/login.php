<?php
include_once '../../includes/process_login.php';

?>

<div class="wrapper">

    <?php
    if (!empty($err_msg)) {
        echo '<div class="error">' . $err_msg . '</div>';
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

