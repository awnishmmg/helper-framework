<?php

// donot modify the file

foreach($define as $names => $constants):
	
	foreach($constants as $index => $value):

		define("CONST_".strtoupper(basename(basename($names),'.php'))."_".strtoupper($index),$value,true);

	endforeach;

endforeach;