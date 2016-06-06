<?php echo $return_msg['message']; ?>

<h1>Simple Login Form</h1>

<form action="" method="POST" class="reg_form" name="login_form">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="••••••••••••" value="">

    <input type="hidden" name="type" id="type" value="login">
    <input type="button" value="Login" onclick="formhash(this.form, this.form.password);">
</form>

<p>If you don't have a login, please <a href='?view=register'>register</a></p>
<p><a href='?view=passwords&action=forgot_password'>Forgot password? (Not implemented yet)</a></p>
