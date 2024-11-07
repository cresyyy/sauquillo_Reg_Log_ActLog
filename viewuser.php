<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Details</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: "Inter", sans-serif;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			background: linear-gradient(135deg, #000000, #2E1A47);
			color: #e0e0e0;
		}

		/* Navigation Bar */
		nav {
			width: 100%;
			height: 8%;
			position: fixed;
			top: 0;
			left: 0;
			z-index: 1000;
		}

		nav ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: flex-end;
		}

		nav ul li {
			margin: 25px 15px;
		}

		nav ul li a {
			color: white;
			padding: 14px 20px;
			text-decoration: none;
			font-weight: 300;
			transition: color 0.3s ease, background-color 0.3s ease;
		}

		nav ul li a:hover {
			color: #03dac6;
			background-color: rgba(255, 255, 255, 0.1);
			border-radius: 5px;
		}

		/* Styling the form*/
		.container {
			width: 90%;
			max-width: 600px;
			padding: 30px;
			border-radius: 8px;
			background: rgba(255, 255, 255, 0.05);
			text-align: center;
			margin-top: 10px;
		}

		h1 {
			color: #b396e9;
			margin: 10px 0;
			font-size: 24px;
		}

	</style>
</head>
<body>
	<nav>
		<ul>
			<li><a href="index.php">HOME</a></li>
			<li><a href="core/handleForms.php?logoutAUser=1">LOG OUT</a></li>
		</ul>
	</nav>
	<div class="container">
		<?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
		<h1>Username: <?php echo $getUserByID['username']; ?></h1>
		<h1>First Name: <?php echo $getUserByID['firstName']; ?></h1>
		<h1>Last Name: <?php echo $getUserByID['lastName']; ?></h1>
		<h1>Age: <?php echo $getUserByID['age']; ?></h1>
		<h1>Birthday: <?php echo $getUserByID['birthday']; ?></h1>
		<h1>Address: <?php echo $getUserByID['address']; ?></h1>
		<h1>Date Joined: <?php echo $getUserByID['date_added']; ?></h1>
	</div>
</body>
</html>
