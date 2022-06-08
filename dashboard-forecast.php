<?php
// Security check
include "sql/secure.php";
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive garden management system">
	<meta name="author" content="syafiqmuda">

	<title>MyGarden - Weather Forecast</title>

	<!-- CSS -->
	<link href="css/modern.css" rel="stylesheet">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-7"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push( arguments );
		}
		gtag( 'js', new Date() );

		gtag( 'config', 'UA-120946860-7' );
	</script>

	<!--API Weather Forecast-->
	<?php
	$url = "https://api.openweathermap.org/data/2.5/onecall?lat=6.1333&lon=102.2386&exclude=minutely,alerts&units=metric&appid=600f7531161e929501255b06aa5de5aa";
	$curl = curl_init( $url );
	curl_setopt( $curl, CURLOPT_URL, $url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

	$headers = array("Accept: application/json",);

	curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers );
	//for debug only!
	curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );

	$resp = curl_exec( $curl );
	curl_close( $curl );


	$decode = json_decode( $resp );

	//	declaration
	//	$date = date( 'jS F Y', time() - 14400 );
	//	$date = date( "d M Y", strtotime( "+0 day" ) );

	//	hourly Forcast
	for ( $x = 0; $x <= 24; $x++ ) {
		$temp[ $x ] = ( $decode->hourly[ $x ]->temp );
		$humid[ $x ] = ( $decode->hourly[ $x ]->humidity );
	}

	//	Daily Forecast
	//	for ( $y = 0; $y <= 7; $y++ ) {
	//		$description[$y] = ($decode->daily[ $y ]->weather[0]->description);
	//		$icon[$y] = ($decode->daily[ $y ]->weather[0]->icon);
	//	}
	?>
</head>

<body>
	<div class="splash active">
		<div class="splash-icon"></div>
	</div>

	<div class="wrapper">
	<nav id="sidebar" class="sidebar">
			<a class="sidebar-brand" href="index.html">
				<i class="align-middle me-2 fas fa-fw fa-leaf fa-1x"></i> <span class="align-middle">MyGarden Tracker</span>
			</a>
			<div class="sidebar-content">
				<div class="sidebar-user">
					<img src="img/avatars/user-2.png" class="img-fluid rounded-circle mb-2" />
					<div class="fw-bold"><?= $userlogin?></div>
					<small>(version 1.4 - beta)</small>
				</div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">Main</li>
					<li class="sidebar-item active">
						<a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
						</a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="dashboard-analytics.php">Analytics</a></li>
							<li class="sidebar-item active"><a class="sidebar-link" href="dashboard-forecast.php">Weather forecast</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="dashboard-myplant.php">My Plant</a></li>
						</ul>
					</li>

					<li class="sidebar-header">Garden</li>
					<li class="sidebar-item">
						<a data-bs-target="#garden" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-leaf"></i> <span class="align-middle">Plant Database</span>
						</a>
						<ul id="garden" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="garden-listplant">List of Plant</a></li>
						</ul>
					</li>

					<li class="sidebar-header">Elements</li>
					<li class="sidebar-item">
						<a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-microchip"></i> <span class="align-middle">Arduino Controller</span>
						</a>
						<ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="controller-arduino1.html">View All Control</a></li>
						</ul>
					</li>

					<li class="sidebar-header">Extras</li>
					<li class="sidebar-item">
						<a data-bs-target="#documentation" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-book"></i> <span class="align-middle">Documentation</span>
						</a>
						<ul id="documentation" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="#">Getting Started</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Plugins</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Changelog</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-theme">
				<a class="sidebar-toggle d-flex me-2">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="sql/logout.php" onclick="return confirm('Are you sure want to logout?')" style="color: red"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i>Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<main class="content">
				<div class="container-fluid">
					<div class="header">
						<h1 class="header-title">Weather Forcast</h1>
						<p class="header-subtitle">Prediction of what the atmosphere will be like in a particular place. The forecast is refresh based on the OpenWeather API, the result and accuracy may vary.</p>
					</div>
					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Raining</h5>
									<h6 class="card-subtitle text-muted">Prediction for the incoming rain</h6>
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Date</th>
											<th>Status</th>
											<th>Cloudiness</th>
										</tr>
									</thead>
									<tbody>
										<?php
											for ( $y = 0; $y <= 7; $y++ ) {
												$description[ $y ] = ( $decode->daily[ $y ]->weather[ 0 ]->description );
												$icon[ $y ] = ( $decode->daily[ $y ]->weather[ 0 ]->icon );
												$cloud[$y] = ( $decode->daily[ $y ]->clouds );
										?>
										<tr>
											<td>
												<?= $date = date( "d M Y", strtotime( "+$y day" ) ); ?>
											</td>
											<td>
												<img src="http://openweathermap.org/img/wn/<?=$icon[ $y ]?>@2x.png" width="48" height="48" class="rounded-circle me-2" alt="Avatar"> <?= $description[ $y ]?>
											</td>
											<td>
												<?= $cloud[$y] ?> %
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Temperature</h5>
									<h6 class="card-subtitle text-muted">Today temperature by hourly</h6>
								</div>
								<div class="card-body">
									<div class="chart">
										<div id="temperature-chart"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Humidity</h5>
									<h6 class="card-subtitle text-muted">a quantity representing the amount of water vapour in the atmosphere or in a gas.</h6>
								</div>
								<div class="card-body">
									<div class="chart">
										<div id="humidity-chart"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-start">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms of Service</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Contact</a>
								</li>
							</ul>
						</div>
						<div class="col-4 text-end">
							<p class="mb-0">
								&copy; 2021 - <a href="https://www.utem.edu.my/" class="text-muted">UTEM</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>

	</div>
	<script src="js/app.js"></script>

	<!--Chart-->
	<script>
		document.addEventListener( "DOMContentLoaded", function () {
			// Area chart
			var options = {
				chart: {
					height: 350,
					type: "area",
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					curve: "smooth"
				},
				series: [ {
					name: "Temperature C°",
					data: [ <?php foreach ($temp as $data) {echo "$data, "; } ?> ]
				} ],
				xaxis: {
					type: "string",
					categories: [ "00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00" ],
				},
				colors: [
					window.theme.primary,
					window.theme.tertiary,
					window.theme.warning,
					window.theme.danger,
					window.theme.info
				]
			}
			var chart = new ApexCharts(
				document.querySelector( "#temperature-chart" ),
				options
			);
			chart.render();
		} );

		document.addEventListener( "DOMContentLoaded", function () {
			// Area chart
			var options = {
				chart: {
					height: 350,
					type: "area",
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					curve: "smooth"
				},
				series: [ {
					name: "Humidity %",
					data: [ <?php foreach ($humid as $data) {echo "$data, "; } ?> ]
				} ],
				xaxis: {
					type: "string",
					categories: [ "00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "2:00", "21:00", "22:00", "23:00", "24:00" ],
				},
				colors: [
					window.theme.primary,
					window.theme.tertiary,
					window.theme.warning,
					window.theme.danger,
					window.theme.info
				]
			}
			var chart = new ApexCharts(
				document.querySelector( "#humidity-chart" ),
				options
			);
			chart.render();
		} );
	</script>
</body>
</html>