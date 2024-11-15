<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Applicant</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

	<style>
		body {
			background-color: #f0f0f0;
		}
		.navbar {
			display: flex;
			justify-content: space-between; 
			align-items: center;
			padding: 15px 20px;
			color: #fff;
		}
		.nav-left {
			display: flex;
			align-items: center;
		}
		.logout-btn {
			color: #fff;
			text-decoration: none;
			margin-left: 15px;
			padding: 15px 15px;
			background-color: #06b2b5;
			transition: background-color 0.3s ease;
		}
		.logout-btn:hover {
			background-color: #ef315d;
			color: #ffffff;
		}
	</style>

</head>
<body>
	<nav class="navbar">
		<div class="nav-left">
			<a href="core/handleForms.php?logoutUserBtn=1" class="logout-btn">Logout</a> 
			<a href="index.php" class="logout-btn">Home</a>
		</div>
	</nav>
	<section class="vh-100">
		<div class="container py-1 h-90">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col col-xl-12">
					<div class="card" style="border-radius: 1rem;">
						<div class="row g-0">
							<div class="col-md-12 d-flex align-items-center">
								<div class="card-body p-4 p-lg-5 text-black">
									<form action="core/handleForms.php?applicationID=<?php echo $_GET['applicationID']; ?>" method="POST">
										<?php $getUserByID = getUserByID($pdo, $_GET['applicationID']); ?>
										<div class="d-flex align-items-center mb-3 pb-1">
											<i class="fas fa-user-plus fa-2x me-3" style="color: #06b2b6;"></i>
											<span class="h1 fw-bold mb-0">Edit the Applicant</span>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-outline mb-4">
													<label class="form-label" for="first_name">First Name</label>
													<input type="text" name="first_name" value="<?php echo htmlspecialchars($getUserByID['first_name']); ?>" class="form-control form-control-lg" />
												</div>
												<div class="form-outline mb-4">
													<label class="form-label" for="last_name">Last Name</label>
													<input type="text" name="last_name" value="<?php echo htmlspecialchars($getUserByID['last_name']); ?>" class="form-control form-control-lg" />
												</div>
												<div class="form-outline mb-4">
													<label class="form-label" for="email">Email</label>
													<input type="text" name="email" value="<?php echo htmlspecialchars($getUserByID['email']); ?>" class="form-control form-control-lg" />
												</div>
												<div class="form-outline mb-3">
													<label class="form-label" for="phone">Phone</label>
													<input type="text" name="phone" value="<?php echo htmlspecialchars($getUserByID['phone']); ?>" class="form-control form-control-lg" />
												</div>
												<div class="form-outline mb-3">
													<label class="form-label" for="resume_url">Resume URL</label>
													<input type="text" name="resume_url" value="<?php echo htmlspecialchars($getUserByID['resume_url']); ?>" class="form-control form-control-lg" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-outline mb-4">
													<label class="form-label" for="years_of_experience">Years of Experience</label>
													<input type="text" name="years_of_experience" value="<?php echo htmlspecialchars($getUserByID['years_of_experience']); ?>" class="form-control form-control-lg" />
												</div>
												<div class="form-outline mb-4">
													<label class="form-label" for="qualifications">Qualifications</label>
													<input type="text" name="qualifications" value="<?php echo htmlspecialchars($getUserByID['qualifications']); ?>" class="form-control form-control-lg" />
												</div>
												<div class="form-outline mb-4">
													<label class="form-label" for="specialization">Specialization</label>
													<input type="text" name="specialization" value="<?php echo htmlspecialchars($getUserByID['specialization']); ?>" class="form-control form-control-lg" />
												</div>
												<div class="form-outline mb-4">
													<label class="form-label" for="license_num">License Number</label>
													<input type="text" name="license_num" value="<?php echo htmlspecialchars($getUserByID['license_num']); ?>" class="form-control form-control-lg" />
												</div>
												<div class="pt-4 mt-4">
													<input type="submit" value="Save Changes" name="editUserBtn" class="btn btn-dark btn-lg btn-block" style="width:49%; background-color: #06b2b6; border:none;" />
													<button type="button" onclick="window.location.href='index.php';" class="btn btn-dark btn-lg btn-block" style="width:49%; background-color: #ef315d; border:none;">Cancel Changes</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
