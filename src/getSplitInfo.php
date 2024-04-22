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
                // Beneficiary Insert with prepared statement
                $sql = "UPDATE BENEFICIARY SET percentSplit = 0 WHERE user_id = ?";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$user_id]);
            }

            $conn->commit();
            
            $conn->beginTransaction();
            foreach ($beneficiaries as $beneficiary) {
                $name = $beneficiary["name"];
                $relationship = $beneficiary["relationship"];
                $split = $beneficiary["split"];
                // Beneficiary Insert with prepared statement
                $sql = "UPDATE b
                        SET b.percentSplit = ?
                        FROM beneficiary b
                        INNER JOIN beneficiaryRelationship br ON b.id = br.beneficiary_id
                        INNER JOIN users u ON b.user_id = ?
                        WHERE b.firstname = ? AND br.relationshipToDeceased = ?";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$split, $user_id, $name, $relationship]);
            }

            $conn->commit();
            echo "successfully added percentSplit!";
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
