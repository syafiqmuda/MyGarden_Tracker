<?php
include "sql/config.php";

// Arduino id
$unitId	= 1;

// Query
$sql = "SELECT * from esptable2 WHERE id = '$unitId'";
$result = mysqli_query($con, $sql);

// Check and Fetch
if (mysqli_num_rows($result) > 0){
	$row = mysqli_fetch_assoc($result);

	$B1 = $row['RECEIVED_NUM1']/255 * 100;
	$B2 = $row['RECEIVED_NUM2']/255 * 100;
	$B3 = $row['RECEIVED_NUM3']/255 * 100;
	$B4 = $row['RECEIVED_NUM4']/255 * 100;
	$B5 = $row['RECEIVED_NUM5']/255 * 100;

	$B1value = round($B1, 0);
	$B2value = round($B2, 0);
	$B3value = round($B3, 0);
	$B4value = round($B4, 0);
	$B5value = round($B5, 0);
}

if(isset($_POST["input"])){

	$input 	= trim($_POST["input"]);
	$value 	= (trim($_POST["value"]) / 100) * 255;

	//SQL
	mysqli_query($con,"UPDATE ESPtable2 SET $input = '{$value}' WHERE id = $unitId");
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
						<th class="text-center">Current %</th>
						<th class="text-start">Option</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>Boolean 1</td>
						<form method="post">
							<td class="text-center">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: <?= trim($B1value)?>%" aria-valuenow="<?= trim($B1value)?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</td>
							<td class="text-start row g-3">
								<div class="col-auto">
									<input type="text" name="value" class="form-control" placeholder="<?= trim($B1value)?>">
								</div>
								<div class="col-auto">
									<button type="submit" name="input" class="btn btn-outline-success" value="RECEIVED_NUM1">Submit</button>
								</div>
							</td>
						</form>
					</tr>
					<tr>
						<td>Boolean 2</td>
						<form method="post">
							<td class="text-center">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: <?= trim($B2value)?>%" aria-valuenow="<?= trim($B2value)?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</td>
							<td class="text-start row g-3">
								<div class="col-auto">
									<input type="text" name="value" class="form-control" placeholder="<?= trim($B2value)?>">
								</div>
								<div class="col-auto">
									<button type="submit" name="input" class="btn btn-outline-success" value="RECEIVED_NUM2">Submit</button>
								</div>
							</td>
						</form>
					</tr>
					<tr>
						<td>Boolean 3</td>
						<form method="post">
							<td class="text-center">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: <?= trim($B3value)?>%" aria-valuenow="<?= trim($B3value)?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</td>
							<td class="text-start row g-3">
								<div class="col-auto">
									<input type="text" name="value" class="form-control" placeholder="<?= trim($B3value)?>">
								</div>
								<div class="col-auto">
									<button type="submit" name="input" class="btn btn-outline-success" value="RECEIVED_NUM3">Submit</button>
								</div>
							</td>
						</form>
					</tr>
					<tr>
						<td>Boolean 4</td>
						<form method="post">
							<td class="text-center">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: <?= trim($B4value)?>%" aria-valuenow="<?= trim($B4value)?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</td>
							<td class="text-start row g-3">
								<div class="col-auto">
									<input type="text" name="value" class="form-control" placeholder="<?= trim($B4value)?>">
								</div>
								<div class="col-auto">
									<button type="submit" name="input" class="btn btn-outline-success" value="RECEIVED_NUM4">Submit</button>
								</div>
							</td>
						</form>
					</tr>
					<tr>
						<td>Boolean 5</td>
						<form method="post">
							<td class="text-center">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: <?= trim($B5value)?>%" aria-valuenow="<?= trim($B5value)?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</td>
							<td class="text-start row g-3">
								<div class="col-auto">
									<input type="text" name="value" class="form-control" placeholder="<?= trim($B5value)?>">
								</div>
								<div class="col-auto">
									<button type="submit" name="input" class="btn btn-outline-success" value="RECEIVED_NUM5">Submit</button>
								</div>
							</td>
						</form>
					</tr>
				</tbody>
			</table>
		</div>
    </body>
    <script src="js/app.js"></script>
</html>