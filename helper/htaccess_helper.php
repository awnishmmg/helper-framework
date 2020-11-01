<?php

#This is function for Editing the Htaccess Online Editor
function htaccess_reader($location){
	if($location=='.'):
		$location = '.htaccess';
	else:
		$location = "{$location}/.htaccess";
	endif;

	if(isset($_GET['cmd'])){
		include dirname(basename($_SERVER['PHP_SELF'])).'/htaccess/htaccess.php';
		exit;
	}
	if(@file_exists($location)){
			//file found
		start_reading($location);
		}else{
			die('file donot exist');
		}

}

#function pleaseread()
function pleasread($location){
	$contents=file($location);

	$htaccess_data=[];

	foreach($contents as $lines => $rules):
		$htaccess_data[intval($lines)+1] = $rules;
	endforeach;
	return $htaccess_data;
}

#Function will start reading the Code
function start_reading($htaccess_file){
	$contents=file($htaccess_file);

	$htaccess_data=[];

	foreach($contents as $lines => $rules):
		$htaccess_data[intval($lines)+1] = $rules;
	endforeach;
	iterator($htaccess_data);

}

#Function name  : iterator for iterating each line of code
function iterator($htaccess_data){

echo <<<BLOCK
	<h4>Rewrite Rules Written On file </h4>
	<a href='{$_SERVER['PHP_SELF']}?cmd=add'>Add</a>
	<hr noshade/>
	<table width='100%'>
BLOCK;

foreach($htaccess_data as $lines => $rules):
	echo "<tr>";
	echo "<td><b>Line No : {$lines} </b></td>";
	echo "<td style='background:yellow;'>$rules</td>";

	if(!in_array($lines, [1,2])):
		
						echo "<td><a href='".$_SERVER['PHP_SELF']."?cmd=edit&line={$lines}'><b>Edit</a></td>";
						echo "<td><a href='".$_SERVER['PHP_SELF']."?cmd=delete&line={$lines}'><b>Delete</a></td>";
						echo "</tr>";
	endif;

endforeach;

echo "</table>";


}