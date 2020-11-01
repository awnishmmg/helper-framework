<?php
define('autoloading',TRUE,1);



$autoload['config']=array('database');

$autoload['library'] =array('query-builder','model-loader');

#Helpers Loaders

$autoload['helper'] =array('debugger','ajax','uri_segment','htaccess','json'); #_helper

$autoload['model'] = array('users'); #_model

$db['prefix'] = 'tbl_';

#All the modular projects projects

$modular['admin']='admin';
$modular['ajax']='ajax';

#Add the Code Snippet
$autoload['snippet']=array('code');


?>