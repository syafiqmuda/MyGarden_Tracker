<?php
include "config.php";
session_start();

if (isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// SQL Query
	$query = "select * FROM user where username = '$username' && password = '$password'";
	$result = mysqli_query( $con, $query );
	$resultcheck = mysqli_num_rows( $result );
	
	if ( $resultcheck > 0 ) {
		$row = mysqli_fetch_assoc( $result );

		// Retrieve individual field value
		$_SESSION[ 'loginname' ] = $row[ "username" ];

		header( "Location: ../dashboard-analytics.php" );
	}
	
	else{
		echo "<script>alert('Please enter correct username and password!');window.location.href='../index.html'</script>";
	}
}
	
?>
