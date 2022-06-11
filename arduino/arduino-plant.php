<?php
include "../sql/config.php";

if(isset($_POST["value"])){

	$button = trim($_POST["button"]);
	$value 	= trim($_POST["value"]);

	//SQL
	mysqli_query($con,"UPDATE ESPtable2 SET $button = '{$value}' WHERE id = $unitId");
	header("Refresh:0");
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
		<div class="container-fluid p-3">
			<?php
			// Query
			$sql = "SELECT * from plantdata WHERE pd_arduinoId = '1'";
			$result = mysqli_query($con, $sql);

			// Check and Fetch
			if (mysqli_num_rows($result) > 0){

				while($row = mysqli_fetch_assoc($result)){
					$pd_id			= $row['pd_id'];
					$pd_plantId 	= $row['pd_plantId'];
					$pd_ardId		= $row['pd_arduinoId'];
					$pd_name		= $row['pd_name'];
					$pd_humidity 	= $row['pd_humidity'];
					$pd_water 		= $row['pd_waterlevel'];
					$pd_temp 		= $row['pd_temperature'];
					$pd_pump 		= $row['pd_pump'];
					$pd_switch 		= $row['pd_switch'];
			?>
			<div class="card mb-5">
				<div class="card-header">
					<h5 class="card-title text-center"><?= $pd_name?></h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Humidity</h5>
									<p class="card-text"><?= $pd_humidity?>%</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">WaterLevel</h5>
									<p class="card-text"><?= $pd_water?>%</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Temperature</h5>
									<p class="card-text"><?= $pd_temp?>%</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Water Pump Speed %</h5>
									<div class="progress">
										<div class="progress-bar" role="progressbar" style="width: <?= $pd_pump?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="row mt-3">
										<div class="col-auto">
											<input type="text" name="value" class="form-control" placeholder="<?= $pd_pump?>">
										</div>
										<div class="col-auto">
											<button type="submit" name="input" class="btn btn-outline-success">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Light Switch</h5>
									<?php
									if($pd_switch == 0){
										echo "<h6 class='card-subtitle mb-2 text-muted'>Currently: Inactive</h6>";
										echo "<a href='#' class='btn btn-primary'>On</a>";
									}

									else{
										echo "<h6 class='card-subtitle mb-2 text-muted'>Currently: Active</h6>";
										echo "<a href='#' class='btn btn-danger'>Off</a>";
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>		
			<?php
				}
			}
			?>	
		</div>
    </body>
    <script src="../js/app.js"></script>
</html>