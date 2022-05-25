<?php
    // Database
    include "sql/config.php";

    if(isset($_GET["id"])){

        $plantId = $_GET["id"];

        // Get Image Data
        $sql = "SELECT * from plant WHERE p_id = '$plantId'";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
			$plantImage		= $row["p_image"];

            // Query (Delete)
            $sql = "DELETE FROM plant WHERE id = '$plantId'";

            if(mysqli_query($connection, $sql)){
                echo "<script>alert('Data has been delete!');window.location='garden-listplant.php'</script>";
                // Delete Image
                if(file_exists($plantImage)){
                    unlink($plantImage);
                }
            }
        }
    }

    else{
        var_dump("ERROR - Unable to get data");
        exit();
    }
?>