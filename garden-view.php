<!-- Database -->
<?php
	include "sql/config.php";
	
	if (isset($_GET["id"])){

		// Declaration
		$id = $_GET["id"];

		// Get Data
		$sql = "SELECT * from plant WHERE id = '$id'";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$plantId		= $row["id"];
			$plantName      = $row["name"];
			$plantGenus     = $row["genus"];
			$plantSpecies	= $row["species"];
			$plantType		= $row["type"];
			$plantLocation	= $row["location"];
			$plantStatus	= $row["status"];
			$plantActivites	= $row["recent activities"];
		}
	}
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

	<title>MyGarden - MyPlants</title>

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
					<small>(version 1.0 - beta)</small>
				</div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">Main</li>
					<li class="sidebar-item active">
						<a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
						</a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="dashboard-analytics.php">Analytics</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="dashboard-forecast.php">Weather forecast</a></li>
							<li class="sidebar-item active"><a class="sidebar-link" href="dashboard-myplant.php">My Plant</a></li>
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
							My Plants > Overview
						</h1>
						<p class="header-subtitle">When the time come, harvest the resource.</p>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="card mx-center">
								<div class="card-body">
									<div class="card m-6 bg-light">
										<img src="img/plant/Durian 1.jpg" style="height: 450px; width: 350px;" class="img-fluid rounded mx-auto d-block pt-4" alt="...">
										<div class="card-header">
											<h5 class="card-title text-center"><?= $plantName?></h5>
										</div>
										<div class="card-body mx-auto" style="width: 40rem;">

											<div class="mb-3">
												<label class="form-label">Genus:</label>
												<input type="text" class="form-control" value="<?= $plantGenus?>" readonly>
												<div class="form-text">Genus is a taxonomic rank used in the biological classification of living.</div>
											</div>

											<div class="mb-3">
												<label class="form-label">Species:</label>
												<input type="text" class="form-control" value="<?= $plantSpecies?>" readonly>
												<div class="form-text">Plant species means a grouping of related organisms constituting a systematic unit, occupying a certain permanent and relatively constant place in nature.</div>
											</div>

											<div class="mb-3">
												<label class="form-label">Type:</label>
												<input type="text" class="form-control" value="<?= $plantType?>"readonly>
												<div class="form-text">Plant type. ex: tree, bush, etc.</div>
											</div>

											<div class="mb-3">
												<label class="form-label">Location:</label>
												<input type="text" class="form-control" value="<?= $plantLocation?>"readonly>
												<div class="form-text">Planting location in garden.</div>
											</div>

											<div class="mb-3">
												<label class="form-label">Status:</label>
												<input type="text" class="form-control" value="<?= $plantStatus?>"readonly>
												<div class="form-text">The healthy and current condition of the plant</div>
											</div>

											<div class="mb-3">
												<label class="form-label">Recent Activities:</label>
												<input type="text" class="form-control" value="<?= $plantActivites?>"readonly>
												<div class="form-text">Last event or recent update on plant</div>
											</div>

											<div class="mb-3 d-flex justify-content-center">
												<a href="garden-edit.php?update=<?= $id?>" class="btn m-2 btn-outline-primary">Update</a>
											</div>

										</div>
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
	<script>
		// Declaration
		// var buttonUpdate = document.getElementById("update");
				
		// document.getElementById("update").onclick = function() {

		// 	// Change Input Attr
		// 	document.getElementById("input").readOnly = false;

		// 	// Change button attribute
		// 	buttonUpdate.innerHTML = "Submit";
		// 	buttonUpdate.classList.remove("btn-outline-primary");
		// 	buttonUpdate.classList.add("btn-outline-success");
		// 	buttonUpdate.setAttribute("id", "submit");

		// 	// Block Form sumbit
		// 	buttonUpdate.preventDefault();
		// };

		// document.getElementById("submit").onclick = function() {

		// };
	</script>

</body>
</html>