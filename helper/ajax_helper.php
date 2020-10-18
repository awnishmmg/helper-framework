<?php


function parseobject(){
	$object = [];
	foreach($_REQUEST as $key => $values){
		$object[$key]=$values;
	}
	return $object;
}


?>