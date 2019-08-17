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
	<h1>все вакансии</h1>
    <p>JSON</p>
    <?=$works?>
    <br /><br /><br />
<?php if(isset($errors)) print_r($errors); ?> 
    <p>delete work where id =</p>
    <?php echo form_open('../all_work/delete') ?>

        <label for="id">id</label>
        <input type="input" name="id" /><br />

       
        <input type="submit" name="submit" value="delete" />

    </form>
<br /><br /><br /><br />
    <p>Create article</p>
    <?php echo form_open('../all_work/create') ?>

        <label for="title">title</label>
        <input type="input" name="title" /><br />

        

       
        <input type="submit" name="submit" value="create" />

    </form>
</div>

</body>
</html>