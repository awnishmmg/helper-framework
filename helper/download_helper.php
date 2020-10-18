<?php
define('PROJECT_PATH',dirname(dirname(__FILE__)));
define('EXTENSION','helpers/extension/');

function ext_icons($filename){

	$extension_images = scandir(EXTENSION);
	//print_r($extension_images);
	unset($extension_images[0],$extension_images[1]);

	$extension_arr = explode('.',$filename);
	$extension = end($extension_arr);

	if(in_array($extension.'.png',$extension_images)){ //png.png

	$tag = "<img src='".EXTENSION.$extension.".png'"."/>";
		return $tag;

	}else{
		return " * $extension types icons not found";
	}
}


function start_download_from($resource=''){

	if($resource==''){
		echo '* Resource Must be Provided';
		exit;
	}
	$file = isset($_REQUEST['file'])?$_REQUEST['file']:null;	
	if(is_null($file)){
		header("location:".basename($_SERVER['SCRIPT_NAME']));
		exit;

	}else{

		$tobe_donwload=$resource.$file;
		force_download($tobe_donwload);
		exit;
		
	}

}

function force_download($file_path=''){

	//echo $file_path;
	if($file_path == ''){
		exit('* invalid file path');
	}

	//
	$parent_files = get_included_files();
	
	$match_files=[];

	foreach($parent_files as $index => $files){

		$match_files[]=basename($files,'.php');
	}

	$running_page = basename($_SERVER['PHP_SELF'],'.php');
	if($running_page == 'export_download' and in_array('export_download',$match_files)){

		$file = $file_path;
		
		if(file_exists($file)){
			header('Content-Description:File Transfer');
			header('Content-Type:application/octet-stream');
			header('Content-Disposition:attachment;filename="'.basename($file).'"');
			header('Expires:0');
			header('Cache-Control:must-revalidate');
			header('Pragma:public');
			header('Content-Length:'.filesize($file));
			readfile($file); #Full path
			exit;

		}else{

			echo '* file donot exist';
			exit;
		}

	}else{
		echo '* Downloading from Invalid Resource';
	}

}

?>