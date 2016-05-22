<?php
include_once '../../includes/register.inc.php';
?>

<div class="wrapper">

    <?php
        if (!empty($err_msg)) {
            echo '<div class="error">' . $err_msg . '</div>';
        }
    ?>

    <h1>Simple Registering Form</h1>

    <form action="" method="POST" name="Registration_form">

        <input type="text" name="username" id="username" placeholder="Username" value="" />
        <input type="email" name="email" id="email" placeholder="Email" value="" />
        <input type="password" name="password" id="password" placeholder="Password" value="" />
        <input type="password" name="confirmpwd" id="confirmpwd" placeholder="Password Again" value="" />
        <input type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email, this.form.password,this.form.confirmpwd);">

    </form>
</div>

