<?php

if($_REQUEST['cmd']){
	if($_SERVER['REQUEST_METHOD']==='GET'){
		if(isset($_REQUEST['line'])){

			$lines =  $_REQUEST['line'];
			$rules = $_REQUEST['rules'];
			$precode = pleasread($location);
			unset($precode[$lines]);

					//Write the Save Code Logic
			$fp=fopen("$location",'w');
			foreach($precode as $line => $rules){
				fwrite($fp,$rules);
			}
			fclose($fp);
			header("location:".basename($_SERVER['PHP_SELF'])."");



		}
	}
}

