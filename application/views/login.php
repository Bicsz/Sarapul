<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>

	
</head>
<body>

<div id="container">
	<h1>Login</h1>

	
    <?php if(isset($signIn_error)) echo $signIn_error;?>
    <?php echo validation_errors(); ?>

    <?php echo form_open('../login/user_login_process') ?>

        <label for="title">login</label>
        <input type="input" name="login" /><br />

        <label for="text">password</label>
         <input type="input" name="password" /><br />

        <input type="submit" name="submit" value="signin" />

    </form>

	
</div>

</body>
</html>