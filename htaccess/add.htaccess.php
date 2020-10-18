<?php


?>
<!DOCTYPE html>
<html>
<head>
	<title>::Add Rules to htaccess ::</title>
</head>
<body>
	<h3>Add The Code</h3>
	<hr/>

	<form method="post" action="<?php echo  basename($_SERVER['PHP_SELF']);?>?cmd=save">
	<textarea name="rules" rows='3' cols="145" style="resize: none;"></textarea>
	<input type="submit" name="submit" value="Add" />

	</form>
</body>
</html>