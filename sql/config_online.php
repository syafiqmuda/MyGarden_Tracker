<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost'); //DB Host
define('DB_USERNAME', 'id18175210_root');
define('DB_PASSWORD', 'G@rd3nTr@ck3r'); 
define('DB_NAME', 'id18175210_mygarden_tracker');
 
/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($con === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>