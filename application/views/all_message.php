<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>crm</title>

	
</head>
<body>

<div id="container">
	<h1>все сообщния</h1>
    <p>JSON</p>
    <?=$messages?>
    <br /><br /><br />


    <p>Send message</p>
    <?php echo form_open('../all_message/create') ?>

        <label for="fio">fio</label>
        <input type="input" name="fio" /><br />
    
    <label for="phone">phone</label>
        <input type="phone" name="phone" /><br />
    
    <label for="email">email</label>
        <input type="email" name="email" /><br />

        

       
        <input type="submit" name="submit" value="send" />

    </form>
</div>

</body>
</html>