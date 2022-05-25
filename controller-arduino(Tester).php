<?php
// Database Connection
include "sql/config.php";
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

	<title>MyGarden - Garden Tracker</title>

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
</head>

<div class="wrapper">
<nav id="sidebar" class="sidebar">
			<a class="sidebar-brand" href="index.html">
				<i class="align-middle me-2 fas fa-fw fa-leaf fa-1x"></i> <span class="align-middle">MyGarden Tracker</span>
			</a>
			<div class="sidebar-content">
				<div class="sidebar-user">
					<img src="img/avatars/user-2.png" class="img-fluid rounded-circle mb-2" />
					<div class="fw-bold">User</div>
					<small>(version 1.0 - beta)</small>
				</div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">Main</li>
					<li class="sidebar-item active">
						<a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
						</a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
							<li class="sidebar-item active"><a class="sidebar-link" href="dashboard-analytics.php">Analytics</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="dashboard-forecast.php">Weather forecast</a></li>
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
							<li class="sidebar-item"><a class="sidebar-link" href="controller-arduino1.php">Arduino 1</a></li>
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
							<a class="dropdown-item" href="#" style="color: red"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

		<main class="content">
			<div class="container-fluid">

				<div class="header">
					<h1 class="header-title">
							Arduino Controller
						</h1>
					<p class="header-subtitle">Here is the information on the selected arduino device that are installed at the selected plant and area to monitor the data about plant condition.</p>
				</div>

				<div class="row">
					<div class="col-md-6 d-flex">
						<div class="card flex-fill w-100">
							<div class="card-header">
								<div class="card-actions float-end">
								</div>
								<h5 class="card-title mb-0">Arduino Boolean Indicator</h5>
							</div>
							<table class="table table-striped my-0">
								<thead>
									<tr>
										<th>Controller</th>
										<th class="text-start">Status</th>
										<th class="text-start">Option</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Boolean 1</td>
										<td class="text-start">
											Available
										</td>
										<td class="text-start">
											<button id="051" class="btn btn-outline-success">ON</button>
											<button id="050" class="btn btn-outline-danger">OFF</button>
										</td>
									</tr>
									<tr>
										<td>Boolean 2</td>
										<td class="text-start">
											Available
										</td>
										<td class="text-start">
											<button id="061" class="btn btn-outline-success">ON</button>
											<button id="060" class="btn btn-outline-danger">OFF</button>
										</td>
									</tr>
									<tr>
										<td>Boolean 3</td>
										<td class="text-start">
											Available
										</td>
										<td class="text-start">
											<button id="071" class="btn btn-outline-success">ON</button>
											<button id="070" class="btn btn-outline-danger">OFF</button>
										</td>
									</tr>
									<tr>
										<td>Boolean 4</td>
										<td class="text-start">
											Available
										</td>
										<td class="text-start">
											<button id="081" class="btn btn-outline-success">ON</button>
											<button id="080" class="btn btn-outline-danger">OFF</button>
										</td>
									</tr>
									<tr>
										<td>Boolean 5</td>
										<td class="text-start">
											Available
										</td>
										<td class="text-start">
											<button id="091" class="btn btn-outline-success">ON</button>
											<button id="090" class="btn btn-outline-danger" >OFF</button>
										</td>
									</tr>
								</tbody>
							</table>
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

	<script>										//starting Javascript.      
		// $(document).ready(function(){
		//   $("button").click(function(){
		// 	var p = $(this).attr('id');   			//get this button id and store it inside the "p" variable.      
        //     pin: p                                  //a dictionary contains the button id to get sent to the web server.
			
		// 	$.get("http://192.168.1.105:80/", { pin: p });
		// 	  $.get("http://192.168.1.111:80/", { pin: p });
		// 	  $.get("http://192.168.1.117:80/", { pin: p });
		// 	  $.get("http://192.168.1.109:80/", { pin: p });
		// 	  $.get("http://192.168.1.118:80/", { pin: p });
			  
		// 	  //then send a get request to the web server"http://192.168.1.4:80/" (":80" means port number 80) with some data in a form of dictionary {pin: p} which is the butoon id. IMPORTANT NOTE: DON'T FORGET TO CHANGE THE IP ADDRESS WITH YOUR ESP8266 NEW IP ADDRESS.   
		//   });
		// });
    </script>
</body>
</html>