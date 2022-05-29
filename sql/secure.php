<?php
    session_start();

    if ( empty($_SESSION[ 'User' ])) {
        header( "location: sql/logout.php" );
    } 
    
    else{
        $userlogin  = $_SESSION[ 'User' ];
    }
?>