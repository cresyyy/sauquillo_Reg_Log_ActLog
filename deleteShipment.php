<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Shipment</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Belanosima:wght@400;600;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: "Inter", sans-serif;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			margin: 0 18%;
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

		/* Form and image */
		.container {
			display: flex;
			flex-direction: column;
			width: 70%;
			justify-content: space-between;
			margin-top: 10px;
			background: rgba(255, 255, 255, 0.05);
			padding: 20px;
			border-radius: 8px;
			color: #e0e0e0;
		}

		/* Styling input */
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
			float: right;
		}
		input[type="submit"]:hover {
			background-color: #018da0;
		}

		/* delete button */
		.deleteBtn {
			display: flex;
			justify-content: flex-end;
		}

		/* Styling Image */
		.pic {
			width: 35%;
			text-align: right;
		}
		.pic img {
			width: 100%;
			height: auto;
			max-width: 900px;
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
	<div class="delete_form">
		<h1 style="color: #BB86FC; font-weight: 500;">Are you sure you wish to permanently delete this shipment?</h1>
		<?php $getShipmentByID = getShipmentByID($pdo, $_GET['shipmentID']); ?>
		
		<div class="container" style="height: 500px;">
			<p>Shipment Weight: <?php echo $getShipmentByID['shipmentWeight'] ?></p>
			<p>Shipment Method: <?php echo $getShipmentByID['shipmentMethod'] ?></p>
			<p>Delivery Address: <?php echo $getShipmentByID['deliveryAddress'] ?></p>
			<p>Estimated Delivery Date: <?php echo $getShipmentByID['estimatedDeliveryDate'] ?></p>
			<p>Carrier: <?php echo $getShipmentByID['carrier'] ?></p>
			<p>Client Name: <?php echo $getShipmentByID['clientName'] ?></p>
			<p>Shipment Date: <?php echo $getShipmentByID['dateAdded'] ?></p>

			<div class="deleteBtn">
				<form class="delete" action="core/handleForms.php?shipmentID=<?php echo $_GET['shipmentID']; ?>&clientID=<?php echo $_GET['clientID']; ?>" method="POST">
					<input type="submit" name="deleteShipmentBtn" value="Delete">
				</form>			
			</div>	
		</div>
	</div>

	<div class="pic">
		<img src="assets/deleteShipment.png" alt="Shipment Photo">
	</div>
	
</body>
</html>
