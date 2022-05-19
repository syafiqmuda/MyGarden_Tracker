<?php
    // Database
    include "sql/config.php";

    var_dump("breakpoint - SQL");
    exit();

    // Query (Delete)
    $sql = "DELETE FROM facility WHERE id = '$id'";
    mysqli_query($connection, $sql);
    echo "<script>alert('Data has been delete!');window.location='pages-facilities.php'</script>";

    // Delete Image
    if(file_exists($plantImage)){
        unlink($plantImage);
    }
?>