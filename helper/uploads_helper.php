<?php

$file_errors = [];


function do_upload($file_name,$allow_extension,$allowed_size){

	global $file_errors;

		$files=$_FILES[$file_name];

		// echo '<pre>';
		// print_r($files);

		$FILE_NAME =  $files['name'];
		$TYPE = $files['type'];
		$TMP_NAME = $files['tmp_name'];
		$ERROR = $files['error'];
		$SIZE = $files['size'];

		$allowed_these_extension_arr=explode('|',$allow_extension);
		#print_r($allowed_these_extension_arr);


		$EXTENSION_arr= explode('.',$FILE_NAME);

		$EXTENSION = end($EXTENSION_arr);



		if(in_array($EXTENSION,$allowed_these_extension_arr)){

			//Calculation
			$size_mb=((intval($SIZE)/1024)/1024);
			$size_mb3=sprintf("%.3f",$size_mb);
			if($size_mb3>$allowed_size){

				$file_errors[]=" ! max $allowed_size mb only allowed ";
			}else{

				$GLOBALS['new_file']=$FILE_NAME;	
				$GLOBALS['old_file']=$TMP_NAME;

			}
		}else{
			
			$file_errors[]=' ! Invalid extension';
		}

}

function if_anyerror(){

		global $file_errors;
		if(count($file_errors)>0){

				// foreach ($file_errors as $index => $error) {
				// 	echo "<span style='color:red;'>$error</span>";
				// 	break;
				// }
				return true;
		}
		return false;

}

function show_error(){
	global $file_errors;
		if(count($file_errors)>0){

				foreach ($file_errors as $index => $error) {
					echo "<span style='color:red;'>$error</span>";
					break;
				}
		}
}


function get_unique_name($folder_name,$file_name){


	$extension_arr = explode('.',$file_name);
	$extension = end($extension_arr);


	$PROJECT_FOLDER = dirname(dirname(__FILE__));

	$path = $PROJECT_FOLDER.'/'.$folder_name.'/'.$file_name;
	//echo $path;

	if(file_exists($path)){
		
		date_default_timezone_set('Asia/Kolkata');
		$new_file_name = $file_name.date('Y-m-d').date('h-i-s');
        if(rename($path,$PROJECT_FOLDER.'/'.$folder_name.'/'.$new_file_name.'.'.$extension)){

        	return $new_file_name.'.'.$extension;
        }else{
        	echo 'error';
        }
        
	}else{
		return $file_name;
	}

}


function save_at($path){
	global $file_errors;

		$new_location = $path.'\\'.$GLOBALS['new_file'];
		//echo $new_location;

		$old_location = $GLOBALS['old_file'];
		//echo $old_location;


		$DOCUMENT_ROOT=dirname(dirname(__FILE__));

		$upload_location = $DOCUMENT_ROOT.'\\'.$new_location;
		if(move_uploaded_file($old_location,$upload_location)){

	return get_unique_name($path,$GLOBALS['new_file']);

		}else{
			$file_errors[]='file not uploaded';
		}
}


function input_file($file_name){

		$input = "<input type='file' name='$file_name' required>";
		echo $input;
}

function allow_file_upload(){

	echo "enctype='multipart/form-data'";
}


?>