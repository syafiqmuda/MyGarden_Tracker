<!-- Database -->
<?php
	include "sql/config.php";
	
	if (isset($_GET["update"])){

		// Declaration
		$id = $_GET["update"];

		// Query
		$sql = "SELECT * from plant WHERE p_id = '$id'";
		$result = mysqli_query($connection, $sql);

		// Check and Fetch
		if (mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);

			$plantId		= $row["p_id"];
			$plantName      = $row["p_name"];
			$plantGenus     = $row["p_genus"];
			$plantSpecies	= $row["p_species"];
			$plantType		= $row["p_type"];
			$plantLocation	= $row["p_location"];
			$plantStatus	= $row["p_status"];
			$plantImage		= $row["p_image"];
			$plantActivites	= $row["p_recent"];
		}
	}

	else{
		var_dump("Oppss somthing just happen, but it seem it error 404");
		exit();
	}

	if (isset($_POST["submit"])){

		//Trim
        $plantId		= trim($plantId);
        $plantName		= trim($_POST["name"]);
        $plantGenus		= trim($_POST["genus"]);
        $plantSpecies	= trim($_POST["species"]);
        $plantType		= trim($_POST["type"]);
        $plantLocation	= trim($_POST["location"]);
        $plantStatus	= trim($_POST["status"]);
		$plantRecent	= trim($_POST["recent"]);
        
        //get image upload
        $target_dir     = "img/plant/";
        $target_file    = $target_dir.basename( $_FILES["imageUpload"]["name"] );
        $imageFileType  = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		if(!$_FILES['imageUpload']['size'] == 0 || !$_FILES['imageUpload']['error'] == 4){

			//check if file already exist
			if (file_exists($target_file) ){
				echo "<script>alert('Sorry, the file already exist!!');window.location.href='garden-edit.php?id=$id'</script>";
			}
	
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				echo "<script>alert('Sorry, wrong file format');window.location.href='garden-edit.php?id=$id'</script>";
			}

			// Update dir
			$directory = $target_dir.htmlspecialchars( basename( $_FILES["imageUpload"]["name"]));
		}

		else{
			// Keep old dir
			$directory = $plantImage;
		}

		//Query
        $sql = "UPDATE plant SET p_name=?, p_genus=?, p_species=?, p_type=?, p_location=?, p_status=?, p_image=?, p_recent=? WHERE p_id=?";
        $stmt = mysqli_prepare($connection, $sql);

        //Bind 
        mysqli_stmt_bind_param($stmt, "ssssssssi", $plantName, $plantGenus, $plantSpecies, $plantType, $plantLocation, $plantStatus, $directory, $plantRecent, $plantId);

        //execute + image upload
        if (mysqli_stmt_execute ($stmt)){

			// if everything is ok, upload file
			move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file);
			
			// alert
            echo "<script>alert('Successfully add new facility');window.location.href='garden-view.php?id=$id'</script>";
        }

        else {
            echo "<script>alert('Sorry, database problem ');window.location.href='garden-view.php?id=$id'</script>";
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
										<img src="<?= $plantImage?>" style="height: 450px; width: 350px;" class="img-fluid rounded mx-auto d-block pt-4" alt="...">
										<div class="card-header">
											<h5 class="card-title text-center"><?= $plantName?></h5>
										</div>
										<div class="card-body mx-auto" style="width: 40rem;">
											<form method="post" enctype="multipart/form-data">
												<div class="mb-3">
													<label class="form-label">Name:</label>
													<input name="name" type="text" class="form-control" value="<?= $plantName?>">
													<div class="form-text">Name for the plant.</div>
												</div>

												<div class="mb-3">
													<label class="form-label">Genus:</label>
													<input name="genus" type="text" class="form-control" value="<?= $plantGenus?>">
													<div class="form-text">Genus is a taxonomic rank used in the biological classification of living.</div>
												</div>
	
												<div class="mb-3">
													<label class="form-label">Species:</label>
													<input name="species" type="text" class="form-control" value="<?= $plantSpecies?>">
													<div class="form-text">Plant species means a grouping of related organisms constituting a systematic unit, occupying a certain permanent and relatively constant place in nature.</div>
												</div>
	
												<div class="mb-3">
													<label class="form-label">Type:</label>
													<input name="type" type="text" class="form-control" value="<?= $plantType?>">
													<div class="form-text">Plant type. ex: tree, bush, etc.</div>
												</div>
	
												<div class="mb-3">
													<label class="form-label">Location:</label>
													<input name="location" type="text" class="form-control" value="<?= $plantLocation?>">
													<div class="form-text">Planting location in garden.</div>
												</div>
	
												<div class="mb-3">
													<label class="form-label">Status:</label>
													<input name="status" type="text" class="form-control" value="<?= $plantStatus?>">
													<div class="form-text">The healthy and current condition of the plant</div>
												</div>
	
												<div class="mb-3">
													<label class="form-label">Recent Activities:</label>
													<input name="recent" type="text" class="form-control" value="<?= $plantActivites?>">
													<div class="form-text">Last event or recent update on plant</div>
												</div>

												
												<div class="mb-3">
													<div class="input-group">
														<label class="form-label w-100">Image:</label>
														<input class="form-control" type="file" name="imageUpload">
														<button class="btn btn-pill btn-outline-danger" name="clear">Clear</button>
													</div>	
													<small class="form-text d-block text-muted">Upload new image to change.</small>
												</div>

												<div class="mb-3 d-flex justify-content-center">
													<a class="btn btn-outline-danger m-1" href="garden-view.php?id=<?= $id?>">Back</a>
													<button class="btn btn-outline-success m-1" type="submit" name="submit">Save</button>
												</div>
											</form>
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
		// Clear Image
		$(document).ready(function() {
			$("input[name=clear]").on("click", function() {     
				$("input[name=imageUpload]").val("");
			});
		});
	</script>
</body>
</html>