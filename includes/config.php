<?php

@session_start(); 

if($_SESSION['log_year']==null){
	
	$log_year=date('Y');
}
else{
$log_year	    = $_SESSION['log_year'];

}


//$log_year	    =  date('Y');

$mydb1 			= $log_year.'dgfm';

//echo $mydb1;

//echo $_SESSION['log_year'];



//@session_start(); 

/* Database configuration */

define('DB_HOST','localhost');

//define('DB_HOST','172.16.0.29');
//define('DB_HOST','220.247.214.182');
//define('DB_HOST','172.16.0.32');

//define('DB_USER','dgfm');
//define('DB_PWD','dgfm@dgfm');

//define('DB_USER','user_dgfm');
//define('DB_PWD','l3g!0n');

define('DB_USER','root');
define('DB_PWD','');

define('DB_DB',$mydb1);
define('DB_TYPE','mysql');

?>
