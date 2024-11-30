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
    <title>Activity Logs</title>
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
        
        .logout-btn {
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

        /* Activity Logs Table */
        .activityLog {
            width: 97%;
			margin: 10vh auto 0; 
			border-collapse: collapse;
			background-color: #fff;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .activityLog th, .activityLog td {
            padding: 7px;
			text-align: center; 
            border-bottom: 1px solid #ddd;
        }

        .activityLog th {
            background-color: #ef315d;
			color: #fff;
			font-weight: bold;
            border-bottom: none;
        }

        .activityLog td {
            color: #333;
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
</head>
    <body>

        <nav class="navbar">
            <div class="nav-left">
                <a href="core/handleForms.php?logoutUserBtn=1" class="logout-btn">Logout</a>
                <a href="index.php" class="logout-btn">Home</a>
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

        <h1 style="text-align: center;">Activity Logs</h1>
       
            <table class="activityLog">
            
                    <tr>
                        <th>Activity Log ID</th>
                        <th>Operation</th>
                        <th>Application ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Resume URL</th>
                        <th>Years of Experience</th>
                        <th>Qualifications</th>
                        <th>Specialization</th>
                        <th>License Number</th>
                        <th>Username</th>
                        <th>Date Added</th>
                    </tr>
               
                    <?php $getAllActivityLogs = getAllActivityLogs($pdo); ?>
                    <?php foreach ($getAllActivityLogs as $row) { ?>
                    <tr>
                        <td><?php echo $row['activity_log_id']; ?></td>
                        <td><?php echo $row['operation']; ?></td>
                        <td><?php echo $row['applicationID']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['resume_url']; ?></td>
                        <td><?php echo $row['years_of_experience']; ?></td>
                        <td><?php echo $row['qualifications']; ?></td>
                        <td><?php echo $row['specialization']; ?></td>
                        <td><?php echo $row['license_num']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['date_added']; ?></td>
                    </tr>
                    <?php } ?>
                
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
