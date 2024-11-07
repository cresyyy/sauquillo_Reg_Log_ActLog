<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Client</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Belanosima:wght@400;600;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
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
			justify-content: right;
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
			color:#03dac6;
			background-color: rgba(255, 255, 255, 0.1); 
			border-radius: 5px;
		}

		/* Form and Image */
		.container {
			display: flex;
			width: 80%;
			max-width: 1100px;
			justify-content: space-between;
			padding: 20px;
			border-radius: 8px;
			margin-top: 10px; 
		}

		/* Form section styling */
		.form-section {
			width: 40%; 
		}

		.form-section h1 {
			margin-top: 0;
			color: #b396e9; 
		}

		form {
			display: flex;
			flex-direction: column;
		}

		form p {
			margin: 10px 0;
			color: #dcd6f7;
		}

		/* Styling input and button */
		input[type="text"] {
			width: 96%;
			padding: 8px;
			border: 1px solid #555;
			border-radius: 4px;
			background-color: #1a1a1a; 
			color: #e0e0e0; 
			font-size: 14px;
			margin-top: 5px;
		}

		input[type="submit"] {
			background-color: #03ADC5; 
			color: #ffffff;
			border: none;
			width: 100%;
			padding: 10px 15px;
			margin-top: 15px;
			border-radius: 4px;
			font-size: 16px;
			cursor: pointer;
			transition: background-color 0.3s;
		}

		input[type="submit"]:hover {
			background-color: #018da0; 
		}

		/* Styling Image */
		.pic {
			width: 45%; 
			text-align: right;
		}

		.pic img {
			width: 100%; 
			height: auto;
			max-width: 400px; 
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

	<?php $getClientByID = getClientByID($pdo, $_GET['clientID']); ?>
	<div class="container">
		<div class="form-section">
			<h1>Update User Information</h1>
			<form action="core/handleForms.php?clientID=<?php echo $_GET['clientID']; ?>" method="POST">
			<p>
					<label for="clientName">Client Name</label> 
					<input type="text" name="clientName" value="<?php echo $getClientByID['clientName']; ?>">
				</p>
				<p>
					<label for="contactPerson">Contact Person</label> 
					<input type="text" name="contactPerson" value="<?php echo $getClientByID['contactPerson']; ?>">
				</p>
				<p>
					<label for="email">Email</label> 
					<input type="text" name="email" value="<?php echo $getClientByID['email']; ?>">
				</p>
				<p>
					<label for="phone">Phone</label> 
					<input type="text" name="phone" value="<?php echo $getClientByID['phone']; ?>">
				</p>
				<p>
					<label for="storeAddress">Store Address</label> 
					<input type="text" name="storeAddress" value="<?php echo $getClientByID['storeAddress']; ?>">
				</p>
				<input type="submit" name="editClientBtn" value="Update">
			</form>
		</div>

		<div class="pic">
			<img src="assets/updateUser.png" alt="Update User Photo"> 
		</div>

	</div>

</body>
</html>
