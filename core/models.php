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



function insertNewUser($pdo, $first_name, $last_name, $email, 
	$phone, $resume_url, $years_of_experience, $qualifications, $specialization, $license_num) {

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
                license_num
			)
			VALUES (?,?,?,?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$first_name, $last_name, $email, 
		$phone, $resume_url, $years_of_experience, 
		$qualifications, $specialization,$license_num,
	]);

	if ($executeQuery) {
		return true;
	}

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
                license_num = :license_num
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
        ':applicationID' => $applicationID
    ]);

    return $executeQuery;
}


function deleteUser($pdo, $applicationID) {
	$sql = "DELETE FROM nurses WHERE applicationID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$applicationID]);

	if ($executeQuery) {
		return true;
	}
	return false;
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