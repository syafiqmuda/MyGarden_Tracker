<?php
include "sql/config.php";

$unitId	= 1;

// Query
$sql = "SELECT * from ESPtable2 WHERE id = '$unitId'";
$result = mysqli_query($con, $sql);

// Check and Fetch
if (mysqli_num_rows($result) > 0){
	$row = mysqli_fetch_assoc($result);

	$B1value = $row['RECEIVED_BOOL1'];
	$B2value = $row['RECEIVED_BOOL2'];
	$B3value = $row['RECEIVED_BOOL3'];
	$B4value = $row['RECEIVED_BOOL4'];
	$B5value = $row['RECEIVED_BOOL5'];
}

if(isset($_POST["value"])){

	$button = trim($_POST["button"]);
	$value 	= trim($_POST["value"]);

	//SQL
	mysqli_query($con,"UPDATE ESPtable2 SET $button = '{$value}' WHERE id = $unitId");
	header("Refresh:0");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- CSS -->
        <link href="css/modern.css" rel="stylesheet">
    </head>
    <body>
		<div class="container-fluid">
			<table class="table table-striped my-0">
				<thead>
					<tr>
						<th>Controller</th>
						<th class="text-start">Option</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Boolean 1</td>
						<td class="text-start">
							<form method="post">
								<input type="hidden" name="button" value="RECEIVED_BOOL1">
								<?php
									if($B1value == 0){
								?>
									<button type="submit" name="value" class="btn btn-outline-success" value="1">ON</button>
								<?php
									}
									else{
								?>
									<button type="submit" name="value" class="btn btn-outline-danger" value="0">OFF</button>
								<?php		
									}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td>Boolean 2</td>
						<td class="text-start">
							<form method="post">
								<input type="hidden" name="button" value="RECEIVED_BOOL2">
								<?php
									if($B2value == 0){
								?>
									<button type="submit" name="value" class="btn btn-outline-success" value="1">ON</button>
								<?php
									}
									else{
								?>
									<button type="submit" name="value" class="btn btn-outline-danger" value="0">OFF</button>
								<?php		
									}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td>Boolean 3</td>
						<td class="text-start">
							<form method="post">
								<input type="hidden" name="button" value="RECEIVED_BOOL3">
								<?php
									if($B3value == 0){
								?>
									<button type="submit" name="value" class="btn btn-outline-success" value="1">ON</button>
								<?php
									}
									else{
								?>
									<button type="submit" name="value" class="btn btn-outline-danger" value="0">OFF</button>
								<?php		
									}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td>Boolean 4</td>
						<td class="text-start">
							<form method="post">
								<input type="hidden" name="button" value="RECEIVED_BOOL4">
								<?php
									if($B4value == 0){
								?>
									<button type="submit" name="value" class="btn btn-outline-success" value="1">ON</button>
								<?php
									}
									else{
								?>
									<button type="submit" name="value" class="btn btn-outline-danger" value="0">OFF</button>
								<?php		
									}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td>Boolean 5</td>
						<td class="text-start">
							<form method="post">
								<input type="hidden" name="button" value="RECEIVED_BOOL5">
								<?php
									if($B5value == 0){
								?>
									<button type="submit" name="value" class="btn btn-outline-success" value="1">ON </button>
								<?php
									}
									else{
								?>
									<button type="submit" name="value" class="btn btn-outline-danger" value="0">OFF</button>
								<?php		
									}
								?>
							</form>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
    </body>
    <script src="js/app.js"></script>
</html>