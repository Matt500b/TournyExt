<?php
include_once '../../includes/process_login.php';
sec_session_start();

include "headers/header.php";
include "headers/navbar.php";
?>

<div class="wrapper">
    <?php echo $return_msg['message']; ?>
    
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
