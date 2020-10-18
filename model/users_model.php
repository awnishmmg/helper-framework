<?php
load_model('TABLE',__FILE__);

function create_user($formdata){

		if(insertat(TABLE,$formdata)){
			return true;
		}else{
			return false;
		}
}

function valid_user($email,$password){

		if(doexist(TABLE,[
			'email'=>['=',$email],
			'password'=>['=',$password],

		])){

			return true;

		}else{

			return false;
		}
}

?>