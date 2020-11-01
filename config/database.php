<?php

$hostname = 'localhost';
$username = 'awnishmmg';
$password = '';
$dbname='angulardb';


$con=mysqli_connect($hostname,$username,$password,$dbname);
if(!$con){

		echo 'Connection Error'.mysqli_error($con);
		exit;

}else{
	#echo 'Connection created'.mysqli_error($con);

}

 ?>