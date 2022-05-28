<?php
include "sql/config.php";

// Arduino id
$unitId	= 1;

// Query
$sql = "SELECT * from ESPtable2 WHERE id = '$unitId'";
$result = mysqli_query($con, $sql);

// Check and Fetch
if (mysqli_num_rows($result) > 0){
	$row = mysqli_fetch_assoc($result);

	$B1 = $row['SENT_NUMBER_1']/1023 * 100;
	$B2 = $row['SENT_NUMBER_2']/1023 * 100;
	$B3 = $row['SENT_NUMBER_3']/1023 * 100;
	$B4 = $row['SENT_NUMBER_4']/1023 * 100;

	$B1value = round($B1, 0);
	$B2value = round($B2, 0);
	$B3value = round($B3, 0);
	$B4value = round($B4, 0);
}
header("Refresh:5");
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
						<th class="text-center">Value</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>Indicator 1</td>
						<td class="text-center">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?= $B1value?>%" aria-valuenow="<?= $B1value?>" aria-valuemin="0" aria-valuemax="500"></div>
							</div>
						</td>
						<?php
						if($B1value < 40){
						?>
							<td class="text-center text-success"><?= $B1value?> (Normal)</td>
						<?php
						}

						else if($B1value > 40 && $B1value < 70){
						?>
							<td class="text-center text-warning"><?= $B1value?> (Warning)</td>
						<?php
						}

						else{
						?>
							<td class="text-center text-danger"><?= $B1value?> (Danger)</td>
						<?php
						}
						?>
					</tr>
					<tr>
						<td>Indicator 2</td>
						<td class="text-center">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?= $B2value?>%" aria-valuenow="<?= $B2value?>" aria-valuemin="0" aria-valuemax="500"></div>
							</div>
						</td>
						<?php
						if($B2value < 40){
						?>
							<td class="text-center text-success"><?= $B2value?> (Normal)</td>
						<?php
						}

						else if($B2value > 40 && $B2value < 70){
						?>
							<td class="text-center text-warning"><?= $B2value?> (Warning)</td>
						<?php
						}

						else{
						?>
							<td class="text-center text-danger"><?= $B2value?> (Danger)</td>
						<?php
						}
						?>
					</tr>
					<tr>
						<td>Indicator 3</td>
						<td class="text-center">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?= $B3value?>%" aria-valuenow="<?= $B3value?>" aria-valuemin="0" aria-valuemax="500"></div>
							</div>
						</td>
						<?php
						if($B3value < 40){
						?>
							<td class="text-center text-success"><?= $B3value?> (Normal)</td>
						<?php
						}

						else if($B3value > 40 && $B3value < 70){
						?>
							<td class="text-center text-warning"><?= $B3value?> (Warning)</td>
						<?php
						}

						else{
						?>
							<td class="text-center text-danger"><?= $B3value?> (Danger)</td>
						<?php
						}
						?>
					</tr>
					<tr>
						<td>Indicator 4</td>
						<td class="text-center">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?= $B4value?>%" aria-valuenow="<?= $B4value?>" aria-valuemin="0" aria-valuemax="500"></div>
							</div>
						</td>
						<?php
						if($B4value < 40){
						?>
							<td class="text-center text-success"><?= $B4value?> (Normal)</td>
						<?php
						}

						else if($B4value > 40 && $B4value < 70){
						?>
							<td class="text-center text-warning"><?= $B4value?> (Warning)</td>
						<?php
						}

						else{
						?>
							<td class="text-center text-danger"><?= $B4value?> (Danger)</td>
						<?php
						}
						?>
					</tr>
				</tbody>
			</table>
		</div>
    </body>
    <script src="js/app.js"></script>
</html>