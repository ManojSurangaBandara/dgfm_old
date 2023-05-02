<?php
@session_start(); 
if(!isset($_SESSION['log_year'])){
	$log_year=date('Y');
}
else{
	$log_year = $_SESSION['log_year'];
}
//$log_year	    =  date('Y');
$mydb1 			= $log_year.'dgfm';
//echo $mydb1;
//echo $_SESSION['log_year'];
//@session_start(); 


/* Database configuration */

define('DB_TYPE','mysql');

//define('DB_HOST','172.16.0.29');
//define('DB_HOST','220.247.214.182');
//define('DB_HOST','172.16.0.32');
//define('DB_HOST','localhost'); /*local developmet machine*/
// define('DB_HOST','172.16.60.12');/*php 5.5 testing server PNG*/
// define('DB_HOST','172.16.60.29'); /*php 8 testing server PNG*/
define('DB_HOST','172.16.0.250'); /*php 8 testing server AHQ*/

// define('DB_USER','dgfm');
// define('DB_PWD','dgfm@dgfm');
// define('DB_USER','user_dgfm');
// define('DB_PWD','l3g!0n');
// define('DB_USER','root'); /*localhost credentials*/
// define('DB_PWD','');
// define('DB_USER','dgfm'); /*php 8 development server credentials PNG*/
// define('DB_PWD','Dgfm@1234');
define('DB_USER','dgfm'); /*php 8 development server credentials AHQ*/
define('DB_PWD','dgfm@#567');

//define('DB_DB',$mydb1); /*uncomment when putting to live server*/
define('DB_DB', '2022dgfm'); /*for testing*/

?>
