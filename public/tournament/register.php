<?php
include_once '../../includes/register.inc.php';
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

    <h1>Simple Registering Form</h1>

    <form action="" method="POST" class="reg_form" name="registration_form">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="••••••••••••" value="">
        <label for="confirmpwd">Repeat Password</label>
        <input type="password" name="confirmpwd" id="confirmpwd" placeholder="••••••••••••" value="" />
        <input type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email, this.form.password,this.form.confirmpwd);">
    </form>
</div>

<?php
include "headers/footer.php";
?>
