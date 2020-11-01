<?php

$htaccess_page['edit'] = 'edit.htaccess.php';
$htaccess_page['add'] = 'add.htaccess.php';
$htaccess_page['save'] = 'save.htaccess.php';
$htaccess_page['update'] = 'update.htaccess.php';
$htaccess_page['delete'] = 'delete.htaccess.php';



if(isset($_GET['cmd'])){
	if(in_array($_GET['cmd'],array_keys($htaccess_page))){
		
		include $htaccess_page[$_GET['cmd']];

	}else{
			die('Error in caused in '.__FILE__);
	}
	
}

?>