<?php
include('config.php'); // Assuming this file contains your database credentials

// Connect using PDO
$conn = new PDO("sqlsrv:server = tcp:hergott.database.windows.net,1433; Database = Hergott", $DBUSER, $DBPASS);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
	// Retrieve email from cookie
	if (isset($_COOKIE['email'])) {
		$logged_email = $_COOKIE['email'];

		// Check if the user exists
		$sql_check_user = "SELECT id FROM USERS WHERE email = ?";
		$stmt_check_user = $conn->prepare($sql_check_user);
		$stmt_check_user->execute([$logged_email]);

		$row_check_user = $stmt_check_user->fetch(PDO::FETCH_ASSOC);

		if ($row_check_user) {
			$user_id = $row_check_user['id'];

			// Assuming you've sent the beneficiary data as a JSON string
			$beneficiaryData = json_decode(file_get_contents('php://input'), true);
			$beneficiaries = $beneficiaryData['beneficiaries'];

			if (empty($beneficiaries)) {
				echo "No beneficiaries found.";
				exit();
			}

			$conn->beginTransaction();

			foreach ($beneficiaries as $beneficiary) {
				// Parsing full name (same as before)
				$names = explode(' ', $beneficiary['name']);

				// Handle edge cases (empty string or single word)
				if (empty($beneficiary['name']) || count($names) === 1) {
					$firstName = $beneficiary['name'];
					$middleName = "";
					$lastName = "";
				} else {
					$firstName = $names[0];
					// Combine remaining words if middle name is not provided
					if (count($names) === 2) {
						$middleName = "";
						$lastName = $names[1];
					} else {
						$middleName = implode(' ', array_slice($names, 1, -1)); // Join all elements except first and last
						$lastName = $names[count($names) - 1];
					}
				}

				// Beneficiary Insert with prepared statement
				$sql = "INSERT INTO BENEFICIARY (user_id, firstname, middlename, lastname, financialGift) VALUES (?, ?, ?, ?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->execute([$user_id, $firstName, $middleName, $lastName, $beneficiary['financialGift']]);

				// Get inserted Beneficiary ID
				$insertedBeneficiaryId = $conn->lastInsertId(); // Assuming auto-incrementing ID

				// inserting relationship into BeneficiaryRelationship table
				$sql = "INSERT INTO BeneficiaryRelationship (beneficiary_id, relationshipToDeceased) VALUES (?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->execute([$insertedBeneficiaryId, $beneficiary['relationship']]);

				// Loop through the beneficiary's gifts and insert them (prepared statements)
				foreach ($beneficiary['gifts'] as $gift) {
					$sql = "INSERT INTO GIFT (beneficiary_id, name, giftDetails) VALUES (?, ?, ?)";
					$stmt = $conn->prepare($sql);
					$stmt->execute([$insertedBeneficiaryId, $gift['name'], $gift['details']]);
				}
			}

			$conn->commit();
			echo "Beneficiaries and gifts inserted successfully!";
		} else {
			echo "Error: User with email " . $logged_email . " not found.";
		}
	} else {
		echo "Error: User email not found in cookie.";
	}
} catch (PDOException $e) {
	$conn->rollBack();
	echo "Error: " . $e->getMessage();
} finally {
	// Ensure connection is closed (optional)
	$conn = null;
}
