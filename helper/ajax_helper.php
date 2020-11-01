<?php

//when data is submitted using post

function parseobject(){
	$object = [];
	foreach($_REQUEST as $key => $values){
		$object[$key]=$values;
	}
	return $object;
}


//when data is submitted using json response
function parsejson(){
	$jsondata = json_decode(file_get_contents("php://input"),true);
	return $jsondata;
}



?>