<?php
    // Database
    include "sql/config.php";

    var_dump("breakpoint - SQL");
    exit();

    if(isset($id)){

    }

    else{
        // Unable to delete
    }
    
    // Get Data
	$sql = "SELECT * from plant WHERE p_id = '$id'";
	$result = mysqli_query($connection, $sql);

    // Query (Delete)
    $sql = "DELETE FROM plant WHERE id = '$id'";
    mysqli_query($connection, $sql);
    echo "<script>alert('Data has been delete!');window.location='garden-listplant.php'</script>";

    // Delete Image
    if(file_exists($plantImage)){
        unlink($plantImage);
    }
?>