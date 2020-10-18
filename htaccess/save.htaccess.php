<?php

if($_GET['cmd']){
	if($_SERVER['REQUEST_METHOD']==='POST'){
		if(isset($_POST['submit'])){
			$rules =  $_POST['rules'];
			//echo $rules;
			$precode=pleasread($location);
			$precode[] = $rules;
			// file_put_contents($location,print_r($precode,true));
			$fp=fopen("$location",'w');
			foreach($precode as $line => $rules){
				fwrite($fp,$rules."\n");
			}
			fclose($fp);
			header("location:".basename($_SERVER['PHP_SELF'])."");

		}
	}
}


?>