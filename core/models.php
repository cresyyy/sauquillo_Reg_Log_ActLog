<?php  

require_once 'dbConfig.php';

//Register User
function insertNewUser($pdo, $username, $password, $firstName, $lastName, $age, $birthday, $address) {
    $checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
    $checkUserSqlStmt = $pdo->prepare($checkUserSql);
    $checkUserSqlStmt->execute([$username]);

    if ($checkUserSqlStmt->rowCount() == 0) {
        // Adjust the SQL to include additional fields
        $sql = "INSERT INTO user_passwords (username, password, firstName, lastName, age, birthday, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$username, $password, $firstName, $lastName, $age, $birthday, $address]);

        if ($executeQuery) {
            $_SESSION['message'] = "User entry successfully inserted!";
            return true;
        } else {
            $_SESSION['message'] = "An error occurred from the query";
        }
    } else {
        $_SESSION['message'] = "Registration failed: User already registered.";
    }
}

// Log in user
function loginUser($pdo, $username, $inputPassword) { 
    $sql = "SELECT * FROM user_passwords WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 1) {
        $userInfoRow = $stmt->fetch();
        $usernameFromDB = $userInfoRow['username']; 
        $hashedPasswordFromDB = $userInfoRow['password']; // This is the hashed password

        // To compare the entered password with the hashed password, use password_verify.
        if (password_verify($inputPassword, $hashedPasswordFromDB)) {
            // Login is successful
            $_SESSION['username'] = $usernameFromDB;
            $_SESSION['message'] = "You’ve logged in successfully. Welcome aboard!";
            return true;
        } else {
            // Password is incorrect
            $_SESSION['message'] = "User exists, but the password does not match.";
            return false;
        }
    } else {
        // Username doesn't exist in the database
        $_SESSION['message'] = "We couldn't find a user with that username. Please register first.";
        return false;
    }
}


function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}


// Inserting client
function insertClient($pdo, $clientName, $contactPerson, $email, 
	$phone, $storeAddress) {

	$sql = "INSERT INTO Clients (clientName, contactPerson, email, 
		phone, storeAddress) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$clientName, $contactPerson, $email, 
	$phone, $storeAddress]);

	if ($executeQuery) {
		return true;
	}
}


// Updating client
function updateClient($pdo, $clientName, $contactPerson, $email, 
	$phone, $storeAddress, $clientID) {

	$sql = "UPDATE Clients
				SET clientName = ?,
					contactPerson = ?,
					email = ?,
					phone = ?, 
					storeAddress = ?
				WHERE clientID = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$clientName, $contactPerson, $email, 
	$phone, $storeAddress, $clientID]);
	
	if ($executeQuery) {
		return true;
	}

}

//Deleting client
function deleteClient($pdo, $clientID) {
	$deleteShipment = "DELETE FROM Shipments WHERE clientID = ?";
	$deleteStmt = $pdo->prepare($deleteShipment);
	$executeDeleteQuery = $deleteStmt->execute([$clientID]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM Clients WHERE clientID = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$clientID]);

		if ($executeQuery) {
			return true;
		}

	}
	
}


function getAllClients($pdo) {
	$sql = "SELECT * FROM Clients";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getClientByID($pdo, $clientID) {
	$sql = "SELECT * FROM Clients WHERE clientID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$clientID]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}


// Getting shipment by the client
function getShipmentByClient($pdo, $clientID) {
	
	$sql = "SELECT 
				Shipments.shipmentID AS shipmentID,
				Shipments.shipmentWeight AS shipmentWeight,
				Shipments.shipmentMethod AS shipmentMethod,
				Shipments.deliveryAddress AS deliveryAddress,
				Shipments.estimatedDeliveryDate AS estimatedDeliveryDate,
				Shipments.carrier AS carrier,
				Shipments.dateAdded AS dateAdded,
				Clients.clientName AS clientName
			FROM Shipments
			JOIN Clients ON Shipments.clientID = Clients.clientID
			WHERE Shipments.clientID = ? 
			GROUP BY Shipments.shipmentID ASC;
			";

$stmt = $pdo->prepare($sql);
$executeQuery = $stmt->execute([$clientID]);
if ($executeQuery) {
	return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}
return [];
}

// Inserting shipment
function insertShipment($pdo, $shipmentWeight, $shipmentMethod, $deliveryAddress, $estimatedDeliveryDate, $carrier, $clientID) {
	$sql = "INSERT INTO Shipments (shipmentWeight, shipmentMethod, deliveryAddress, estimatedDeliveryDate, carrier, clientID) VALUES (?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$shipmentWeight, $shipmentMethod, $deliveryAddress, $estimatedDeliveryDate, $carrier, $clientID]);
	if ($executeQuery) {
		return true;
	}

}

function getShipmentByID($pdo, $shipmentID) {
	$sql = "SELECT 
				Shipments.shipmentID AS shipmentID,
				Shipments.shipmentWeight AS shipmentWeight,
				Shipments.shipmentMethod AS shipmentMethod,
				Shipments.deliveryAddress AS deliveryAddress,
				Shipments.estimatedDeliveryDate AS estimatedDeliveryDate,
				Shipments.carrier AS carrier,
				Shipments.dateAdded AS dateAdded,
				Clients.clientName AS clientName
			FROM Shipments
			JOIN Clients ON Shipments.clientID = Clients.clientID
			WHERE Shipments.shipmentID  = ? 
			GROUP BY Shipments.shipmentWeight";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$shipmentID]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

// Updating shipment
function updateShipment($pdo, $shipmentWeight, $shipmentMethod, $deliveryAddress, $estimatedDeliveryDate, $carrier, $shipmentID) {
	$sql = "UPDATE Shipments
			SET shipmentWeight = ?,
				shipmentMethod = ?,
				deliveryAddress = ?,
				estimatedDeliveryDate = ?,
				carrier = ?
			WHERE shipmentID = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$shipmentWeight, $shipmentMethod, $deliveryAddress, $estimatedDeliveryDate, $carrier, $shipmentID]);

	if ($executeQuery) {
		return true;
	}
}

// Deleting shipment
function deleteShipment($pdo, $shipmentID) {
	$sql = "DELETE FROM Shipments WHERE shipmentID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$shipmentID]);
	if ($executeQuery) {
		return true;
	}
}


function getAllInfoByClientID($clientID) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE clientID = :clientID");
    $stmt->execute(['clientID' => $clientID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>