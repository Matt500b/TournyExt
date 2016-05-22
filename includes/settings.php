<?php 
define("DEBUG", true);			// Toggle PHP error reporting on/off

define("HOST", "");  			// The host you want to connect to.
define("USER", "");    			// The database username. 
define("PASSWORD", "");    		// The database password. 
define("DATABASE", "");    		// The database name.

if(DEBUG) {
	error_reporting(-1);
}
else {
	error_reporting(0);
}