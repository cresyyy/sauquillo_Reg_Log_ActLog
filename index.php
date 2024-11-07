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
	<title>Swift Logistics</title>
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
            background: linear-gradient(100deg, #000000, #2E1A47);
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

        /* Styling form */
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

        /* Users List and Image styling*/
        .userlist {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 800px; 
            margin: 0 auto;
        }

        .users-list {
            width: 35%; 
            background-color: rgba(255,255,255,0.05);
            padding: 15px;
            border-radius: 8px;
            color: #e0e0e0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .users-list h3 {
            margin: 0 0 10px 0;
            color: #03DAC6;
        }

        .users-list ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
        }

        .users-list ul li {
            margin: 8px 0;
            padding-left: 15px;
        }

        .users-list ul li a {
            color: #dcd6f7;
            text-decoration: none;
            font-weight: normal;
        }

        .users-list ul li a:hover {
            text-decoration: underline;
            color: #BB86FC;
        }

        /* Styling inputs and submit button*/
        input[type="text"] {
            width: 90%;
            height: 25px;
            padding: 9px;
            border: none;
            border-radius: 4px;
            background-color: #ffffff;
            color: #000000;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Submit Button */
        input[type="submit"] {
            background-color: #03ADC5;
            color: #ffffff;
            border: none;
            width: 94%;
            height: 45px;
            padding: 10px 15px;
            margin-top: 35px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #018da0;
        }

        h1{
            color: #B396E9;
        }

        p{
            color:#dcd6f7;
        }

        /* edit and delete button */
        .editAndDelete {
            display: flex;
            justify-content: flex-end;
            gap: 50px; 
            margin-top: 10px;
        }

        .editAndDelete a {
            text-decoration: none;
            color: #b396e9;
            font-weight: bold;
            transition: color 0.3s;
        }

        .editAndDelete a:hover {
            color: #c5a6f0;
        }

        /* Styling Image */
        .pic {
            width: 100%;
            position: absolute;
            text-align: right; 
        }

        .pic img {
            width: 80%;
            height: auto;
            max-width: 900px;
        }

        .users-list {
            margin-top: 300px;
            padding-top: 70px;
            margin-left: 150px;
            width: 65%;
            text-align: center;
            height: 30vh;
        }

        /* Styling Table */
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
			<li><a href="core/handleForms.php?logoutAUser=1">LOGOUT</a></li>
		</ul>
	</nav>

	<div id="messageModal" class="modal">
		<div class="modal-content">
			<span class="close" onclick="closeModal()">&times;</span>
			<h1><?php echo $_SESSION['message']; ?></h1>
		</div>
	</div>

	<div class="main-content">
    <div class="form-section">
	<?php if (isset($_SESSION['username'])) { ?>
		<h1>Hello, <?php echo $_SESSION['username']; ?>! Ready to get started?</h1>
	<?php } else { echo "<h1>No user logged in</h1>";}?>
        <p style="font-size: 28px; font-weight: 200; color:#B396E9;">Welcome To Swift Logistics Management System!</p>

        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="firstName">Client Name</label> 
                <input type="text" name="clientName">
            </p>
            <p>
                <label for="firstName">Contact Person</label> 
                <input type="text" name="contactPerson">
            </p>
            <p>
                <label for="firstName">Email</label> 
                <input type="text" name="email">
            </p>
            <p>
                <label for="firstName">Phone</label> 
                <input type="text" name="phone">
            </p>
            <p>
                <label for="firstName">Store Address</label> 
                <input type="text" name="storeAddress">
                <input type="submit" name="insertClientBtn">
            </p>
        </form>

    </div>

	<div class="userlist">
        <div class="pic"> 
            <img src="assets/index_pic.png" alt="Login Image">
        </div>

        <div class="users-list">
            <h3>Users List</h3>
            <ul>
                <?php $getAllUsers = getAllUsers($pdo); ?>
                <?php foreach ($getAllUsers as $row) { ?>
                    <li>
                        <a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

    <?php $getAllClients = getAllClients($pdo); ?>
    <table style="width:100%; margin-top: 50px;">
        <tr>
            <th>Client Name</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Store Address</th>
            <th>Date Registered</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($getAllClients as $row) { ?>
            <tr>
                <td><?php echo $row['clientName']; ?></td>
                <td><?php echo $row['contactPerson']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['storeAddress']; ?></td>
                <td><?php echo $row['registrationDate']; ?></td>
                <td>
                    <a href="viewShipments.php?clientID=<?php echo $row['clientID']; ?>" style="padding-right:18px; color: #F7E07E;">View Shipments</a>
                    <a href="editClient.php?clientID=<?php echo $row['clientID']; ?>" style="padding-right:18px; color:#03ADC5;">Edit</a>
                    <a href="deleteClient.php?clientID=<?php echo $row['clientID']; ?>" style="color:#B00020;">Delete</a>
                </td>
            </tr>
        <?php } ?>
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
