<?php
include "../sql/config.php";

// Arduino id
$unitId	= 1;

// Query
$sql = "SELECT * from ESPtable2 WHERE id = '$unitId'";
$result = mysqli_query($con, $sql);

// Check and Fetch
if (mysqli_num_rows($result) > 0){
	$row = mysqli_fetch_assoc($result);

	$B1value = $row['SENT_BOOL_1'];
	$B2value = $row['SENT_BOOL_2'];
	$B3value = $row['SENT_BOOL_3'];
}

header("Refresh:5");
?>

<!DOCTYPE html>
<style>
	.disclaimer{
		display: none;
	}
</style>
<html>
    <head>
        <!-- CSS -->
        <link href="../css/modern.css" rel="stylesheet">
    </head>
    <body>
		<div class="container-fluid">
			<table class="table table-striped my-0">
				<thead>
					<tr>
						<th>Controller</th>
						<th class="text-start">Status</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>Indicator 1</td>
						<?php
						if($B1value == 1){
						?>
							<td class="text-start text-success">Active</td>
						<?php
						}
						else{
						?>
							<td class="text-start text-danger">Inactive</td>
						<?php
						}
						?>				
					</tr>
					<tr>
					<td>Indicator 2</td>
						<?php
						if($B2value == 1){
						?>
							<td class="text-start text-success">Active</td>
						<?php
						}
						else{
						?>
							<td class="text-start text-danger">Inactive</td>
						<?php
						}
						?>	
					</tr>
					<tr>
					<td>Indicator 3</td>
						<?php
						if($B3value == 1){
						?>
							<td class="text-start text-success">Active</td>
						<?php
						}
						else{
						?>
							<td class="text-start text-danger">Inactive</td>
						<?php
						}
						?>	
					</tr>
				</tbody>
			</table>
		</div>
    </body>
    <script src="../js/app.js"></script>
</html>