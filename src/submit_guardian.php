<?php
session_start();
include('config.php'); // Assuming this file contains your database credentials

// Assuming you have form fields with the names 'fname', 'mname', 'lname', 'relationship'
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$relationship = $_POST['relationship'];

try {
    // Connect to the database using PDO
    $conn = new PDO("sqlsrv:server = tcp:hergott.database.windows.net,1433; Database = Hergott", $DBUSER, $DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Begin the transaction
    $conn->beginTransaction();

    // Retrieve email from cookie
    if (isset($_COOKIE['email'])) {
        $logged_email = $_COOKIE['email'];
        echo "Email: " . $logged_email;

        // Check if the user exists
        $sql_check_user = "SELECT id FROM USERS WHERE email = ?";
        $stmt_check_user = $conn->prepare($sql_check_user);
        $stmt_check_user->execute([$logged_email]);
        $row_check_user = $stmt_check_user->fetch(PDO::FETCH_ASSOC);

        if ($row_check_user) {
            $user_id = $row_check_user['id'];
            echo "User ID: $user_id";

            // Try to UPDATE first, if it fails, INSERT
            $sql_update_guardian = "UPDATE GUARDIAN SET FirstName = ?, MiddleName = ?, LastName = ?, Relationship = ?, DeceasedID = ?, has_guardian = 'true' WHERE DeceasedID = ?";
            $params_update_guardian = array($fname, $mname, $lname, $relationship, $user_id, $user_id);
            $stmt_update_guardian = $conn->prepare($sql_update_guardian);
            $success = $stmt_update_guardian->execute($params_update_guardian);

            if ($success && $stmt_update_guardian->rowCount() > 0) {
                // Record updated successfully
                echo "Guardian information updated successfully.";
                $conn->commit();
            } else {
                // Record not found, try INSERT
                $sql_insert_guardian = "INSERT INTO GUARDIAN (FirstName, MiddleName, LastName, Relationship, DeceasedID, has_guardian) VALUES (?, ?, ?, ?, ?, 'true')";
                $params_insert_guardian = array($fname, $mname, $lname, $relationship, $user_id);
                $stmt_insert_guardian = $conn->prepare($sql_insert_guardian);
                $success = $stmt_insert_guardian->execute($params_insert_guardian);

                if ($success) {
                    echo "Guardian information inserted successfully.";
                    // If both queries were successful, commit the transaction
                    $conn->commit();
                    echo "Transaction committed.<br />";
                } else {
                    echo "Error inserting guardian information.";
                    // Otherwise, rollback the transaction
                    $conn->rollBack();
                    echo "Transaction rolled back.<br />";
                }
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Email cookie not set.";
    }
} catch (PDOException $e) {
    // Rollback the transaction on error
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}
