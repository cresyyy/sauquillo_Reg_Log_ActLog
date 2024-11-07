<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register - Swift Logistics</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Belanosima:wght@400;600;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: "Inter";
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
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

		/* Form and image */
		.container {
			display: flex;
			width: 100%;
			max-width: 1600px;
			align-items: center;
			justify-content: space-between;
		}

		/* Form section */
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

		/* Styling input, password, date, number and button */
		input[type="text"], input[type="password"],input[type="date"],input[type="number"] {
			width: 100%;
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

		/* Image styling */
		.pic {
			width: 100%; 
			text-align: right;
		}

		.pic img {
			width: 100%;
			height: auto;
			max-width: 900px; 
		}

		/* Modal (pop up message) */
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

		/* Close button styling */
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
			<li><a href="login.php">LOG IN</a></li>
		</ul>
	</nav>

	<div class="container">
    <div class="form-section">
        <h1>Register here!</h1>
        <p style="color: #B396E9; font-weight: 200; font-size: 28px;">Delivering Speed, Reliability, and Precision Every Mile.</p>
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </p>
            <p>
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" required>
            </p>
            <p>
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" required>
            </p>
            <p>
                <label for="age">Age</label>
                <input type="number" name="age" required min="1" max="120">
            </p>
            <p>
                <label for="birthday">Birthday</label>
                <input type="date" name="birthday" required>
            </p>
            <p>
                <label for="address">Address</label>
                <input type="text" name="address" required>
            </p>
            <p>
                <input type="submit" name="registerUserBtn" value="Register">
            </p>
            <p>Already have an account? You may login <a href="login.php">here</a></p>
        </form>

        <div id="messageModal" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeModal()">&times;</span>
				<h1 style="margin-bottom: 0px;"><?php echo $_SESSION['message']; ?></h1>
			</div>
		</div>
    </div>

    <div class="pic">
        <img src="assets/reg_pic.png" alt="Registration Image">
    </div>

</div>

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
