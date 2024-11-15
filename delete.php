<?php 
require_once 'core/models.php';
require_once 'core/dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Applicant Confirmation</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body{
			background-color: #f0f0f0;
		}
		.navbar {
			display: flex;
			justify-content: space-between; 
			align-items: center;
			padding: 15px 20px;
			color: #fff;
		}

		.nav-left{
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
		.card {
			background-color: #ffffff;
			border: solid 1px #d9d9d9 ;
			border-radius: 10px;
		}

		.deleteBtn input[type="submit"] {
			background-color: #ef315d;
			border: none;
			padding: 10px 20px;
			color: #fff;
			font-weight: bold;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		.deleteBtn input[type="submit"]:hover {
			background-color: #06b2b6;
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


<section class="vh-90 d-flex align-items-center">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-6">
				<div class="card p-4">
					<h1 class="text-center text-danger mb-4">Are you sure you want to delete this applicant?</h1>
					<?php 
						$getUserByID = getUserByID($pdo, $_GET['applicationID']); 
					?>
					<p><strong>First Name:</strong> <?php echo htmlspecialchars($getUserByID['first_name']); ?></p>
					<p><strong>Last Name:</strong> <?php echo htmlspecialchars($getUserByID['last_name']); ?></p>
					<p><strong>Email:</strong> <?php echo htmlspecialchars($getUserByID['email']); ?></p>
					<p><strong>Phone:</strong> <?php echo htmlspecialchars($getUserByID['phone']); ?></p>
					<p><strong>Resume URL:</strong> <?php echo htmlspecialchars($getUserByID['resume_url']); ?></p>
					<p><strong>Years of Experience:</strong> <?php echo htmlspecialchars($getUserByID['years_of_experience']); ?></p>
					<p><strong>Qualifications:</strong> <?php echo htmlspecialchars($getUserByID['qualifications']); ?></p>
					<p><strong>Specialization:</strong> <?php echo htmlspecialchars($getUserByID['specialization']); ?></p>
					<p><strong>License Number:</strong> <?php echo htmlspecialchars($getUserByID['license_num']); ?></p>

					<div class="deleteBtn text-center mt-4">
						<form action="core/handleForms.php?applicationID=<?php echo $_GET['applicationID']; ?>" method="POST">
							<input type="submit" name="deleteUserBtn" value="Delete">
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
