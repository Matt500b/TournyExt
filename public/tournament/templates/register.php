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

    <form action="" method="POST" class="reg_form" name="Registration_form">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" value="">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" value="">
      <label for="">Repeat Password</label>
      <input type="password" name="password" id="passwordconfirm"  value="">
      <input type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email, this.form.password,this.form.passwordconfirm);" <="" form="">
    </form>
</div>

