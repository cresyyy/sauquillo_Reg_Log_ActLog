<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View Shipments</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Belanosima:wght@400;600;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: "Inter";
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
			background: linear-gradient(135deg, #000000, #2E1A47);
		}

		/* Navigation Bar*/
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
			color: #03dac6;
			background-color: rgba(255, 255, 255, 0.1);
			border-radius: 5px;
		}

		/* Form and img */
		.main-content {
    	display: flex;
    	justify-content: space-between;
		width: 90%;
		max-width: 1200px;
		margin-top: 30px; 
		}

		/* Form Section */
		.form-section {
			width: 80%; 
			max-width: 500px;
		}

		.form-section p{
			color: #dcd6f7;
		}

		/* Styling inputs, date, and submit button */
		input[type="text"], input[type="date"] {
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

		/* Table */
		table {
			width: 100%;
			margin-top: 30px; 
			border-collapse: separate;
			border-spacing: 0;
			color: #e0e0e0;
			background-color: #1e1e1e;
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		}

		th, td {
			padding: 12px;
			text-align: center;
			border-bottom: 1px solid #3f3f3f;
		}

		th {
			background-color: #BB86FC;
			font-weight: 600;
			color: #000000;
			text-transform: uppercase;
			font-size: 14px;
		}

		tr:last-child td {
			border-bottom: none;
		}

		tr:hover {
			background-color: rgba(255, 255, 255, 0.05);
			transition: background-color 0.3s ease;
		}

		td {
			background-color: #252525;
			font-size: 14px;
		}

		td a {
			color: #03ADC5;
			text-decoration: none;
			transition: color 0.3s;
		}

		td a:hover {
			color: #FFD700;
		}

		td:first-child, th:first-child {
			border-top-left-radius: 8px;
		}

		td:last-child, th:last-child {
			border-top-right-radius: 8px;
		}

		/* Styling the image */
		.image-container {
			width: 50%; 
			display: flex;
			text-align: right; 
		}

		.image-container img {
			width: 1300px; 
			text-align: right;
			height: auto;
			max-width: 400px; 
		}

		/* Modal (pop up message)*/
		.modal {
			display: none; 
			position: fixed;
			z-index: 1000;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.5); 
			justify-content: center;
			align-items: center;
		}

		.modal-content {
			background-color: #fff;
			padding: 20px;
			border-radius: 8px;
			width: 90%;
			max-width: 400px;
			text-align: center;
			font-family: Arial, sans-serif;
			color: #BB86FC;
		}

		/* Close button styling in modal */
		.close {
			color: #aaa;
			font-size: 28px;
			font-weight: bold;
			position: absolute;
			top: 10px;
			right: 20px;
			cursor: pointer;
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

	<div id="messageModal" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeModal()">&times;</span>
				<h1 style="margin-bottom: 0px;"><?php echo $_SESSION['message']; ?></h1>
			</div>
		</div>

	<div class="main-content">
	<div class="form-section">
	<?php $getAllInfoByClientID = getAllInfoByClientID($_GET['clientID']); ?>
        <h1 style="color: #bb86fc;">Client Name: <?php echo $getAllInfoByClientID['clientName']; ?></h1>
        <p style="margin-bottom: 5px; font-size: 20px; color: #bb86fc;">Add New Shipment</p>
       
            <form action="core/handleForms.php?clientID=<?php echo $_GET['clientID']; ?>" method="POST">
                <p>
                    <label for="firstName">Shipment Weight</label> 
                    <input type="text" name="shipmentWeight">
                </p>
                <p>
                    <label for="firstName">Shipment Method</label> 
                    <input type="text" name="shipmentMethod">
                </p>
                <p>
                    <label for="firstName">Delivery Address</label> 
                    <input type="text" name="deliveryAddress">
                </p>
                <p>
                    <label for="firstName">Delivery Date</label> 
                    <input type="date" name="estimatedDeliveryDate">
                </p>
                <p>
                    <label for="firstName">Carrier</label> 
                    <input type="text" name="carrier">
                </p>
                <input type="submit" name="insertNewShipmentBtn">
            </form>
		</div>

        	<div class="image-container">
            	<img src="assets/shipment.png" alt="Shipment Photo">
        	</div>

    	</div>
	</div>
	
        <!-- Displaying the Shipment Table -->
        <table style="width:100%; margin-top: 50px;">
            <tr>
                <th>Shipment ID</th>
                <th>Shipment Weight</th>
                <th>Shipment Method</th>
                <th>Delivery Address</th>
                <th>Delivery Date</th>
                <th>Carrier</th>
                <th>Shipment Owner</th>
                <th>Shipment Date</th>
                <th>Action</th>
            </tr>

            <?php 
            // Fetching all shipments for the current client
            $getShipmentByClient = getShipmentByClient($pdo, $_GET['clientID']);
            
            // Check if the result is empty
            if (empty($getShipmentByClient)) {
                echo "<tr><td colspan='9'>No shipments found.</td></tr>";
            } else {
                foreach ($getShipmentByClient as $row) { ?>
                    <tr>
                        <td><?php echo $row['shipmentID']; ?></td>
                        <td><?php echo $row['shipmentWeight']; ?></td>
                        <td><?php echo $row['shipmentMethod']; ?></td>
                        <td><?php echo $row['deliveryAddress']; ?></td>
                        <td><?php echo $row['estimatedDeliveryDate']; ?></td>
                        <td><?php echo $row['carrier']; ?></td>
                        <td><?php echo $row['clientName']; ?></td>
                        <td><?php echo $row['dateAdded']; ?></td>
                        <td>
                            <a href="editShipment.php?shipmentID=<?php echo $row['shipmentID']; ?>&clientID=<?php echo $_GET['clientID']; ?>" style="margin-right:10px; color:#03ADC5">Edit</a>
                            <a href="deleteShipment.php?shipmentID=<?php echo $row['shipmentID']; ?>&clientID=<?php echo $_GET['clientID']; ?>" style="color:#B00020">Delete</a>
                        </td>
                    </tr>
                <?php } 
            } ?>
        </table>
  

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const message = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>";
			if (message) {
				document.getElementById("messageModal").style.display = "flex";
			}
		});

		// Close the modal
		function closeModal() {
			document.getElementById("messageModal").style.display = "none";
			<?php unset($_SESSION['message']); ?> 
		}

		// Close the modal when clicking outside of the modal content
		window.onclick = function(event) {
			const modal = document.getElementById("messageModal");
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>

</body>
</html>