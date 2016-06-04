<?php echo $return_msg['message']; ?>

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

    <input type="hidden" name="type" id="type" value="register">
    <input type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email, this.form.password,this.form.confirmpwd);">
</form>

