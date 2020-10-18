<?php

function load_model($table_name,$model_file){
	global $db;
	define($table_name,$db['prefix'].basename($model_file,'_model.php'),true);
}

?>