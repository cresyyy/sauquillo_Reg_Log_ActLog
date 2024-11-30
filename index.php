
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
	<title>Nurses Management System</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}


		body {
			font-family: Arial, sans-serif;
			background-image: url('assets/bgphoto.jpg'); 
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
			background-repeat: no-repeat;
			color: #333; 
		}

		/* Navbar */
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
		.nav-right {
			display: flex;
			align-items: center;
		}


		.search-form {
			display: flex;
		}

		.search-input {
			padding: 15px 15px;
			border: 1px solid #ddd;
			outline: none;
		}

		.search-btn {
			padding: 15px 15px;
			background-color: #ef315d;
			color: #fff;
			border: none;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		.search-btn:hover {
			background-color: #06b2b6;
		}

		.nav-link, .logout-btn {
			color: #fff;
			text-decoration: none;
			margin-left: 15px;
			padding: 15px 15px;
			background-color: #06b2b5;
			transition: background-color 0.3s ease;
		}

		.nav-link:hover {
			background-color: #ef315d;
			color: #ffffff;
		}



		/* User Table */
		.user-table {
			width: 97%;
			margin: 50vh auto 0; 
			border-collapse: collapse;
			background-color: #fff;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}


		.user-table th, .user-table td {
			padding: 7px;
			text-align: center; 
			border-bottom: 1px solid #ddd;
		}

		.user-table th {
			background-color: #06b2b5;
			color: #fff;
			font-weight: bold;
		}

		.user-table td {
			color: #333;
		}

		.action-link {
			color: #007bff;
			text-decoration: none;
		}

		.action-link:hover {
			text-decoration: underline;
		}


		.popup-overlay {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.5);
			display: flex;
			align-items: center;
			justify-content: center;
			z-index: 9999;
		}

		.popup-content {
			background-color: white;
			padding: 20px;
			border-radius: 5px;
			text-align: center;
		}
</style>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

<nav class="navbar">
  <div class="nav-left">
    <a href="core/handleForms.php?logoutUserBtn=1" class="logout-btn">Logout</a> 
  </div>
  
  <div class="nav-right">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="search-form">
      <input type="text" name="searchInput" placeholder="Search here" class="search-input">
      <button type="submit" name="searchBtn" class="search-btn">Search</button>
    </form>
    <a href="insert.php" class="nav-link">Insert New Applicant</a>
    <a href="index.php" class="nav-link">Clear Search Query</a>
	<a href="activitylogs.php" class="nav-link">Activity Logs</a>
  </div>
</nav>


<?php if (isset($_SESSION['message'])): ?>
    <div id="popup-message" class="popup-overlay">
        <div class="popup-content">
            <h3 style="color: red;"><?php echo $_SESSION['message']; ?></h3>
        </div>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

	<div class="greeting" style="text-align: right; flex-direction:flex-end; margin-right:20px; width: 50%; float:right; padding: 55px;">
		<h1 style="text-align: right; flex-direction:flex-end; margin-right:20px; font-size: 56px;">Welcome, <?php echo $_SESSION['username']; ?>! Let’s continue working together to improve healthcare.</h1>
	</div>

	<table class="user-table">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Resume URL</th>
			<th>Experience Years</th>
			<th>Qualifications</th>
			<th>Specialization</th>
			<th>License Number</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>

		<?php
		if (!isset($_GET['searchBtn'])) {
			$getAllUsers = getAllUsers($pdo);
			foreach ($getAllUsers as $row) { ?>
				<tr>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><?php echo $row['resume_url']; ?></td>
					<td><?php echo $row['years_of_experience']; ?></td>
					<td><?php echo $row['qualifications']; ?></td>
					<td><?php echo $row['specialization']; ?></td>
					<td><?php echo $row['license_num']; ?></td>
					<td><?php echo $row['date_added']; ?></td>
					<td>
						<a href="edit.php?applicationID=<?php echo $row['applicationID']; ?>" class="action-link">Edit</a>
						<a href="delete.php?applicationID=<?php echo $row['applicationID']; ?>" class="action-link">Delete</a>
					</td>
				</tr>
			<?php }
		} else {
			$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
			foreach ($searchForAUser as $row) { ?>
				<tr>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><?php echo $row['resume_url']; ?></td>
					<td><?php echo $row['years_of_experience']; ?></td>
					<td><?php echo $row['qualifications']; ?></td>
					<td><?php echo $row['specialization']; ?></td>
					<td><?php echo $row['license_num']; ?></td>
					<td><?php echo $row['date_added']; ?></td>
					<td>
						<a href="edit.php?applicationID=<?php echo $row['applicationID']; ?>" class="action-link">Edit</a>
						<a href="delete.php?applicationID=<?php echo $row['applicationID']; ?>" class="action-link">Delete</a>
					</td>
				</tr>
			<?php }
		} ?>
	</table>

	<script>
    document.addEventListener('click', function(event) {
        const popup = document.getElementById('popup-message');
        if (popup && !popup.querySelector('.popup-content').contains(event.target)) {
            popup.style.display = 'none';
        }
    });
	</script>
	
</body>
</html>
