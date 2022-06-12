<?php
include "../sql/config.php";
// include "../sql/arduinoData.php";

//Arduino ID
$unitId = 1;

if(isset($_POST["button"])){

	$button = trim($_POST["button"]);
	$value 	= trim($_POST["Bvalue"]);

	//SQL
	mysqli_query($con,"UPDATE ESPtable2 SET $button = '{$value}' WHERE id = $unitId");
	header("Refresh:0");
}

if(isset($_POST["pump"])){

	$input 	= trim($_POST["pump"]);
	$value 	= (trim($_POST["Pvalue"]) / 100) * 255;

	var_dump();
	exit();

	//SQL
	mysqli_query($con,"UPDATE ESPtable2 SET $input = '{$value}' WHERE id = $unitId");
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
			$sql = "SELECT * from plantdata WHERE pd_arduinoId = '$unitId'";
			$result = mysqli_query($con, $sql);

			// Unique
			$button = 'RECEIVED_BOOL1';

			// Check and Fetch
			if (mysqli_num_rows($result) > 0){
				

				while($row = mysqli_fetch_assoc($result)){
					$pd_id			= $row['pd_id'];
					$pd_plantId 	= $row['pd_plantId'];
					$pd_plantNo		= $row['pd_plantNo'];
					$pd_ardId		= $row['pd_arduinoId'];
					$pd_name		= $row['pd_name'];
					$humid 			= $row['pd_humidity']/255 * 100;
					$water 			= $row['pd_waterlevel']/255 * 100;
					$temp 			= $row['pd_temperature']/255 * 100;
					$pump 			= $row['pd_pump']/1023 * 100;
					$pd_switch 		= $row['pd_switch'];

					$pd_pump		= round($pump, 0);
					$pd_humidity 	= round($humid, 0);
					$pd_water 		= round($water, 0);
					$pd_temp 		= round($temp, 0);
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
									<form method="post">
										<div class="progress">
											<div class="progress-bar" role="progressbar" style="width: <?= $pd_pump?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="row mt-3">
											<div class="col-auto">
												<input type="text" name="Pvalue" class="form-control" placeholder="<?= $pd_pump?>">
											</div>
											<div class="col-auto">
												<button type="submit" name="pump" class="btn btn-outline-success">Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Light Switch</h5>
									<form method="post">
										<?php
										if($pd_switch == 0){
											echo "<input type='hidden' name='Bvalue' value='1'>";
											echo "<h6 class='card-subtitle mb-2 text-muted'>Currently: Inactive</h6>";
											echo "<button type='submit' name='button' value='$button'  class='btn btn-primary'>On</button>";
										}

										else{
											echo "<input type='hidden' name='Bvalue' value='0'>";
											echo "<h6 class='card-subtitle mb-2 text-muted'>Currently: Active</h6>";
											echo "<button type='submit' name='button' value='$button' class='btn btn-danger'>Off</button>";
										}
										?>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>		
			<?php
					$button++;
				}
			}
			?>	
		</div>
    </body>
    <script src="../js/app.js"></script>
</html>