<?php

try {	
	// Retrieve instance of the framework
	$f3=require('lib/fatfreelib_3_7/base.php');

	// Initialize CMS
	$f3->config('app/config/config.ini');

	// Define routes
	$f3->config('app/config/routes.ini');

	// Execute application
	$f3->run();

} catch (Throwable $t) {
    echo("Error : " .$t);
}
?>