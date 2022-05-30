<?php
	include "sql/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive garden management system">
	<meta name="author" content="syafiqmuda">

	<title>MyGarden - Plant List</title>

	<!-- CSS -->
	<link href="css/modern.css" rel="stylesheet">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-7"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-120946860-7');
	</script>
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
					<div class="fw-bold">User</div>
					<small>(version 1.4 - beta)</small>
				</div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">Main</li>
					<li class="sidebar-item">
						<a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
						</a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="dashboard-analytics.php">Analytics</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="dashboard-forecast.php">Weather forecast</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="dashboard-myplant.php">My Plant</a></li>
						</ul>
					</li>

					<li class="sidebar-header">Garden</li>
					<li class="sidebar-item active">
						<a data-bs-target="#garden" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-leaf"></i> <span class="align-middle">Plant Database</span>
						</a>
						<ul id="garden" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item active"><a class="sidebar-link" href="garden-listplant.php">List of Plant</a></li>
						</ul>
					</li>

					<li class="sidebar-header">Elements</li>
					<li class="sidebar-item">
						<a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-microchip"></i> <span class="align-middle">Arduino Controller</span>
						</a>
						<ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="controller-arduino1.html">Arduino 1</a></li>
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
								<a class="dropdown-item" href="index.html" onclick="return confirm('Are you sure want to logout?')" style="color: red"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i>Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			
			<main class="content">
				<div class="container-fluid">

					<div class="header">
						<h1 class="header-title">
							Plant Database
						</h1>
						<p class="header-subtitle">List of all available plant.</p>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Plant table</h5>
									<h6 class="card-subtitle text-muted">View all the available plant in the garden.</h6>
								</div>

								<!-- Table Start -->
								<div class="card-body">
									<button class="btn btn-success mb-3">Add New Plant</button>
									<table id="datatables" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>Name</th>
												<th>Type</th>
												<th>Location</th>
												<th>Status</th>
												<th>Recent Activities</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											// SQL
											$sql = "SELECT * from plant";
											$result = mysqli_query($con, $sql);

											if (mysqli_num_rows($result) > 0){
												while($row = mysqli_fetch_assoc($result)){
													$plantId		= $row["p_id"];
													$plantName      = $row["p_name"];
													$plantGenus     = $row["p_genus"];
													$plantSpecies	= $row["p_species"];
													$plantType		= $row["p_type"];
													$plantLocation	= $row["p_location"];
													$plantStatus	= $row["p_status"];
													$plantImage		= strtolower($row["p_image"]);
													$plantActivites	= $row["p_recent"];
											?>
													<tr>
														<td><?= $plantName?></td>
														<td><?= $plantType?></td>
														<td><?= $plantLocation?></td>
														<td><?= $plantStatus?></td>
														<td><?= $plantActivites?></td>
														<td><a class="btn btn-outline-danger" onclick="return confirm('Are you sure want to delete this data?')" href="garden-delete.php?id=<?= $plantId?>">Delete</a></td>
													</tr>
											<?php
												}
											}
											?>
										</tbody>
									</table>
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
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables (JS)
			// var datatablesButtons = $("#datatables").DataTable({
			// 	responsive: true,
			// 	fixedHeader: true,
			// 	lengthChange: !1,
			// 	buttons: ["copy"]
			// });
			// datatablesButtons.buttons().container().appendTo("#datatables_wrapper .col-md-6:eq(0)");

			// Datatables (JQuery)
			$("#datatables").DataTable({
				fixedHeader: true,
				pageLength: 25,
			});
		});
	</script>
</body>
</html>