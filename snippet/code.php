<?php

$URI=basename($_SERVER['REQUEST_URI']);
$dir = basename(dirname(__DIR__));

if($URI==$dir):
    header("Content-Type:text/html");
    require_once dirname(__DIR__).'/main.html';
else:
    $request=basename(dirname($_SERVER['PHP_SELF']));
    if($request=='ajax'):
    else:
        header("location:".$_SERVER['PHP_SELF']) or die('die');
    endif;
endif;





