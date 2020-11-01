<?php
define('autoloading',TRUE,1);

$autoload['define']=array('lang','error');
$autoload['config']=array('database','define');

$autoload['library'] =array('query-builder.class','model-loader.class');

#Helpers Loaders

$autoload['helper'] =array('debugger','ajax','uri_segment','htaccess','json'); #_helper

$autoload['model'] = array('users'); #_model

$db['prefix'] = 'tbl_';

#All the modular projects projects

$modular['admin']='admin';
$modular['ajax']='ajax';

#Add the Code Snippet
#$autoload['snippet']=array('code');


?>