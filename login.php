<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
	<style>
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

<body style="background-color: #06b2b6;">

	<section class="vh-100">
	  <div class="container py-5 h-100">
	    <div class="row d-flex justify-content-center align-items-center h-100">
	      <div class="col col-xl-12">
	        <div class="card" style="border-radius: 1rem;">
	          <div class="row g-0">
	            <div class="col-md-6 col-lg-5 d-none d-md-block">
	              <img src="assets/login.jpg"
	                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
	            </div>
	            <div class="col-md-6 col-lg-7 d-flex align-items-center">
	              <div class="card-body p-4 p-lg-5 text-black">

	                <form action="core/handleForms.php" method="POST">
	                
					<?php  
						if (isset($_SESSION['message']) && isset($_SESSION['status'])): ?>
   	 					<div id="popup-message" class="popup-overlay">
        					<div class="popup-content">
            		<?php
            			$messageColor = $_SESSION['status'] == "200" ? 'green' : 'red';
           	 			echo "<h4 style='color: $messageColor;'>{$_SESSION['message']}</h4>";
            			unset($_SESSION['message']);
            			unset($_SESSION['status']);
            			?>
        					</div>
    					</div>
					<?php endif; ?>

	                  <div class="d-flex align-items-center mb-3 pb-1">
	                    <img src="assets/logo.png" style="width: 60px;">
	                    <span class="h1 fw-bold mb-0" style="margin-left:10px;">LifeSpring General Hospital</span>
	                  </div>

	                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

	                  <div class="form-outline mb-4">
	                    <input type="text" id="username" name="username" class="form-control form-control-lg" required />
	                    <label class="form-label" for="username">Username</label>
	                  </div>

	                  <div class="form-outline mb-4">
	                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
	                    <label class="form-label" for="password">Password</label>
	                  </div>

	                  <div class="pt-1 mb-4">
	                    <button class="btn btn-dark btn-lg btn-block" type="submit" name="loginUserBtn" style="width: 100%;">Login</button>
	                  </div>

	                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php" style="color: #393f81;">Register here</a></p>
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
