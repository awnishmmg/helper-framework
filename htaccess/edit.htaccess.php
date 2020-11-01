<?php

if($_REQUEST['cmd']){
	if($_SERVER['REQUEST_METHOD']=='GET'){
		if(isset($_REQUEST['line'])){

			$lines =  $_REQUEST['line'];
			$precode = pleasread($location);
			$codes = $precode[$lines];

			echo "<h2>Edit code</h2>";
			echo "<hr noshade size='4'/>";
			echo "<form action='".basename($_SERVER['PHP_SELF'])."?cmd=update&line=$lines' method='post'>";
			echo "<b> #rewrite rules : </b> <textarea name='rules' cols='130' style='resize:none;'>{$codes}</textarea>";
			echo "<br/><br/><br/><input type='submit' name='apply' value='Apply'/>";
			echo "</form>";


		}
	}
}

