<?php
include "config.php";
session_start();

if (isset($_POST['bool'])){
	
	$unit_id 	= $_POST['id'];
	$value		= $_POST['value'];
	$column 	= $_POST['column'];
	
	// SQL Query
	$query = "UPDATE ESPtable2 SET $column = '{$value}' WHERE id=$unit_id";
	mysqli_query( $connection, $query );
	
	header( "Location: ../arduino-1.php" );
}
?>