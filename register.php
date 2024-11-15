<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #d85271;">

	<section class="vh-100">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col col-xl-12">
					<div class="card" style="border-radius: 1rem;">
						<div class="row g-0">
							<div class="col-md-6 col-lg-5 d-none d-md-block">
								<img src="assets/login.jpg" alt="register form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
							</div>
							<div class="col-md-6 col-lg-7 d-flex align-items-center">
								<div class="card-body p-4 p-lg-5 text-black">
									<form action="core/handleForms.php" method="POST">

										<?php  
										if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
											$messageColor = $_SESSION['status'] == "200" ? 'green' : 'red';
											echo "<h4 style='color: $messageColor;'>{$_SESSION['message']}</h4>";
										}
										unset($_SESSION['message']);
										unset($_SESSION['status']);
										?>

										<div class="d-flex align-items-center mb-3 pb-1">
											<i class="fas fa-user-plus fa-2x me-3" style="color: #06b2b6;"></i>
											<span class="h1 fw-bold mb-0">Register</span>
										</div>

										<h5 class="fw-normal mb-1 pb-1" style="letter-spacing: 1px;">Create your account</h5>

										<div class="form-outline mb-2">
											<input type="text" id="username" name="username" class="form-control form-control-lg" required />
											<label class="form-label" for="username">Username</label>
										</div>

										<div class="form-outline mb-2">
											<input type="text" id="first_name" name="first_name" class="form-control form-control-lg" required />
											<label class="form-label" for="first_name">First Name</label>
										</div>

										<div class="form-outline mb-2">
											<input type="text" id="last_name" name="last_name" class="form-control form-control-lg" required />
											<label class="form-label" for="last_name">Last Name</label>
										</div>

										<div class="form-outline mb-2">
											<input type="password" id="password" name="password" class="form-control form-control-lg" required />
											<label class="form-label" for="password">Password</label>
										</div>

										<div class="form-outline mb-2">
											<input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg" required />
											<label class="form-label" for="confirm_password">Confirm Password</label>
										</div>

										<div class="pt-1 mb-2">
											<button class="btn btn-dark btn-lg btn-block" type="submit" name="insertNewUserBtn" style="width:100%;">Register</button>
										</div>

										<p class="mb-0 pb-lg-2" style="color: #393f81;">Already have an account? <a href="login.php" style="color: #393f81;">Login here</a></p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

