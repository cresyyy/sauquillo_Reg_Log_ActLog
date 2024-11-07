<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

// Register
if (isset($_POST['registerUserBtn'])) {
    // Getting data from the form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];

    // To check if required fields are filled
    if (!empty($username) && !empty($password) && !empty($firstName) && !empty($lastName) && !empty($age) && !empty($birthday) && !empty($address)) {
        $insertQuery = insertNewUser($pdo, $username, $password, $firstName, $lastName, $age, $birthday, $address);
        
        // Redirect if query was successful
        if ($insertQuery) {
            header("Location: ../login.php");
        } else {
            header("Location: ../register.php");
        }
    } else {
        $_SESSION['message'] = "Please ensure that the registration input forms are not blank!";
        header("Location: ../register.php");
    }
}


//Log in
if (isset($_POST['loginUserBtn'])) {
    // Getting data from the form
    $username = $_POST['username'];
    $inputPassword = $_POST['password']; 

    if (!empty($username) && !empty($inputPassword)) {
        $loginSuccessful = loginUser($pdo, $username, $inputPassword);
    
        if ($loginSuccessful) {
            header("Location: ../index.php");
        } else {
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['message'] = "Please ensure that the login input forms are not blank!";
        header("Location: ../login.php");
    }
}

// Log out
if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}


// Insert new client
if(isset($_POST['insertClientBtn'])) {
    // Getting data from the form
    $clientName = $_POST['clientName'];
    $contactPerson = $_POST['contactPerson'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
	$storeAddress = $_POST['storeAddress'];
    $createdBy = $_SESSION['username'];

    try {
        // Insert new client into the database
        $stmt = $pdo->prepare("INSERT INTO Clients (clientName, contactPerson, email, phone, storeAddress, createdBy)
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$clientName, $contactPerson, $email, $phone, $storeAddress, $createdBy]);
        $_SESSION['message'] = "New client has been successfully added!";
    } catch(PDOException $e) {
        $_SESSION['message'] = "Error while adding a client: " . $e->getMessage();
    }

    header("Location: ../index.php");
    exit();
}


// Update a client
if (isset($_POST['editClientBtn'])) {
    // Getting data from the form
    $clientID = $_GET['clientID'];
    $clientName = $_POST['clientName'];
    $contactPerson = $_POST['contactPerson'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $storeAddress = $_POST['storeAddress'];
    $lastUpdated = $_SESSION['username']; 
    $updatedAt = date("Y-m-d H:i:s");

    try {
        // Update a client into the database
        $stmt = $pdo->prepare("UPDATE Clients 
                               SET clientName = ?, 
                               contactPerson = ?, 
                               email = ?, 
                               phone = ?, 
                               storeAddress = ?, 
                               lastUpdated = ?, 
                               updatedAt = ? 
                               WHERE clientID = ?");
        $stmt->execute([$clientName, $contactPerson, $email, $phone, $storeAddress, $lastUpdated, $updatedAt, $clientID]);
        $_SESSION['message'] = "The client was successfully updated!";
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error updating client: " . $e->getMessage();
    }

    header("Location: ../index.php");
    exit();
}


// Delete Client
if (isset($_POST['deleteClientBtn'])) {
	$query = deleteClient($pdo, $_GET['clientID']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}


// Insert new shipment
if (isset($_POST['insertNewShipmentBtn'])) {
    // Getting data from the form
    $clientID = $_GET['clientID'];
    $shipmentWeight = $_POST['shipmentWeight'];
    $shipmentMethod = $_POST['shipmentMethod'];
    $deliveryAddress = $_POST['deliveryAddress'];
    $estimatedDeliveryDate = $_POST['estimatedDeliveryDate'];
    $carrier = $_POST['carrier'];
    $createdBy = $_SESSION['username'];

    try {
        // Insert new shipment into the database
        $stmt = $pdo->prepare("INSERT INTO Shipments (clientID, 
                                                    shipmentWeight, 
                                                    shipmentMethod, 
                                                    deliveryAddress, 
                                                    estimatedDeliveryDate, 
                                                    carrier, 
                                                    createdBy)
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$clientID, $shipmentWeight, $shipmentMethod, $deliveryAddress, $estimatedDeliveryDate, $carrier, $createdBy]);
        $_SESSION['message'] = "Shipment entry successfully added!";
    } catch(PDOException $e) {
        $_SESSION['message'] = "Error adding shipment: " . $e->getMessage();
    }

 
    header("Location: ../viewShipments.php?clientID=" . $clientID);
    exit();
}


// Update a shipment
if(isset($_POST['editShipmentBtn'])) {
    $shipmentID = $_GET['shipmentID'];
    $shipmentWeight = $_POST['shipmentWeight'];
    $shipmentMethod = $_POST['shipmentMethod'];
    $deliveryAddress = $_POST['deliveryAddress'];
    $estimatedDeliveryDate = $_POST['estimatedDeliveryDate'];
    $carrier = $_POST['carrier'];
    $lastUpdated = $_SESSION['username']; 
    $updatedAt = date("Y-m-d H:i:s");

    try {
        // Update a shipment into the database
        $stmt = $pdo->prepare("UPDATE Shipments 
                            SET shipmentWeight = ?, 
                            shipmentMethod = ?, 
                            deliveryAddress = ?, 
                            estimatedDeliveryDate = ?, 
                            carrier = ?, 
                            lastUpdated = ?, 
                            updatedAt = ? 
                            WHERE shipmentID = ?");
        $stmt->execute([$shipmentWeight, $shipmentMethod, $deliveryAddress, $estimatedDeliveryDate, $carrier, $lastUpdated, $updatedAt, $shipmentID]);
        $_SESSION['message'] = "Shipment updated successfully!";
    } catch(PDOException $e) {
        $_SESSION['message'] = "Error updating shipment: " . $e->getMessage();
    }

    header("Location: ../viewShipments.php?clientID=" .$_GET['clientID']);
    exit();
}


// Delete Shipment
if (isset($_POST['deleteShipmentBtn'])) {
	$query = deleteShipment($pdo, $_GET['shipmentID']);

	if ($query) {
		header("Location: ../viewShipments.php?clientID=" .$_GET['clientID']);
	}
	else {
		echo "Deletion failed";
	}
}


?>