<?php
include 'config.php';


$suffix_arr = array('helper','model');
$include_path = [];

if(autoloading==true){


		foreach ($autoload as $folder => $file) {

			foreach($file as $index => $filename){
				if(in_array($folder, $suffix_arr)){

					$include_path[]=$folder.'/'.$filename.'_'.$folder.'.php';
				}else{

					$include_path[]=$folder.'/'.$filename.'.php';
			}

			}
			
		}
	
		// print_r($include_path);
		// exit;

		$url=explode('/',$_SERVER['PHP_SELF']);

		$role_folders=$url[count($url)-2];

		if(in_array($role_folders,$modular)){

			$Basepath = '../';
		}else{
			$Basepath='';
		}

		foreach($include_path as $folder_name => $file_name){
				include $Basepath.$file_name;
		}

}




?>