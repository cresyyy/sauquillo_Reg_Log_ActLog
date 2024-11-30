<?php  

require_once 'dbConfig.php';

function getAllUsers($pdo) {
	$sql = "SELECT * FROM nurses 
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $applicationID) {
	$sql = "SELECT * from nurses WHERE applicationID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$applicationID]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForAUser($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM nurses WHERE 
			CONCAT(first_name,last_name,email,phone,
				resume_url,years_of_experience,qualifications,specialization,license_num,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertAnActivityLog($pdo, $operation, $applicationID, $first_name, $last_name, $email, $phone, $resume_url, $years_of_experience, $qualifications, $specialization, $license_num, $username) {

	$sql = "INSERT INTO activity_logs (operation, applicationID, first_name, last_name, email, phone, resume_url, years_of_experience, qualifications, specialization, license_num, username) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $applicationID, $first_name, $last_name, $email, $phone, $resume_url, $years_of_experience, $qualifications, $specialization, $license_num, $username]);

	if ($executeQuery) {
		return true;
	}

}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

function insertNewUser($pdo, $first_name, $last_name, $email, 
    $phone, $resume_url, $years_of_experience, $qualifications, $specialization, $license_num) {

    $currentUser = $_SESSION['username'];

    $sql = "INSERT INTO nurses 
            (
                first_name,
                last_name,
                email,
                phone,
                resume_url,
                years_of_experience,
                qualifications,
                specialization,
                license_num,
                added_by,
                last_updated_by
            )
            VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([
        $first_name, $last_name, $email, 
        $phone, $resume_url, $years_of_experience, 
        $qualifications, $specialization, $license_num,
        $currentUser, $currentUser 
    ]);

    if ($executeQuery) {

        $findInsertedItemSQL = "SELECT * FROM nurses ORDER BY date_added DESC LIMIT 1";
        $stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
        $stmtfindInsertedItemSQL->execute();
        $getApplicationID = $stmtfindInsertedItemSQL->fetch();

        $insertAnActivityLog = insertAnActivityLog($pdo, "INSERT", $getApplicationID['applicationID'], 
            $getApplicationID['first_name'], $getApplicationID['last_name'], $getApplicationID['email'], 
            $getApplicationID['phone'], $getApplicationID['resume_url'], 
            $getApplicationID['years_of_experience'], $getApplicationID['qualifications'], 
            $getApplicationID['specialization'], $getApplicationID['license_num'], $currentUser);

        if ($insertAnActivityLog) {
            $response = array(
                "status" => "200",
                "message" => "User and activity log added successfully!"
            );
        } else {
            $response = array(
                "status" => "400",
                "message" => "Failed to insert activity log."
            );
        }
    } else {
        $response = array(
            "status" => "400",
            "message" => "Failed to insert user data."
        );
    }

    return $response;
}




function editUser($pdo, $first_name, $last_name, $email, $phone, $resume_url, $years_of_experience, $qualifications, $specialization, $license_num, $applicationID) {
    $sql = "UPDATE nurses 
            SET first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone = :phone,
                resume_url = :resume_url,
                years_of_experience = :years_of_experience,
                qualifications = :qualifications,
                specialization = :specialization,
                license_num = :license_num,
                last_updated_by = :last_updated_by
            WHERE applicationID = :applicationID";

    $stmt = $pdo->prepare($sql);

    $executeQuery = $stmt->execute([
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':email' => $email,
        ':phone' => $phone,
        ':resume_url' => $resume_url,
        ':years_of_experience' => $years_of_experience,
        ':qualifications' => $qualifications,
        ':specialization' => $specialization,
        ':license_num' => $license_num,
        ':last_updated_by' => $_SESSION['username'], 
        ':applicationID' => $applicationID
    ]);

    if ($executeQuery) {

        $findInsertedItemSQL = "SELECT * FROM nurses WHERE applicationID = ?";
        $stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
        $stmtfindInsertedItemSQL->execute([$applicationID]);
        $getApplicationID = $stmtfindInsertedItemSQL->fetch();

        
        $insertAnActivityLog = insertAnActivityLog(
            $pdo, 
            "UPDATE", 
            $getApplicationID['applicationID'], 
            $getApplicationID['first_name'], 
            $getApplicationID['last_name'], 
            $getApplicationID['email'], 
            $getApplicationID['phone'], 
            $getApplicationID['resume_url'], 
            $getApplicationID['years_of_experience'], 
            $getApplicationID['qualifications'], 
            $getApplicationID['specialization'], 
            $getApplicationID['license_num'], 
            $_SESSION['username']
        );

        if ($insertAnActivityLog) {
            $response = array(
                "status" => "200",
                "message" => "Updated the branch and activity log successfully!"
            );
        } else {
            $response = array(
                "status" => "400",
                "message" => "Insertion of activity log failed!"
            );
        }
    } else {
        $response = array(
            "status" => "400",
            "message" => "An error has occurred with the query!"
        );
    }

    return $response;
}



function deleteUser($pdo, $applicationID) {
	$response = array();
	$sql = "SELECT * FROM nurses WHERE applicationID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$applicationID]);
	$getApplicationByID = $stmt->fetch();

	$insertAnActivityLog = insertAnActivityLog($pdo, "DELETE", $getApplicationByID['applicationID'], 
		$getApplicationByID['first_name'], $getApplicationByID['last_name'], $getApplicationByID['email'], $getApplicationByID['phone'], $getApplicationByID['resume_url'], $getApplicationByID['years_of_experience'], $getApplicationByID['qualifications'], $getApplicationByID['specialization'], $getApplicationByID['license_num'],  $_SESSION['username']);

	if ($insertAnActivityLog) {
		$deleteSql = "DELETE FROM nurses WHERE applicationID = ?";
		$deleteStmt = $pdo->prepare($deleteSql);
		$deleteQuery = $deleteStmt->execute([$applicationID]);

		if ($deleteQuery) {
			$response = array(
				"status" =>"200",
				"message"=>"Deleted the branch successfully!"
			);
		}
		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
	}
	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;
}



function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}


?>