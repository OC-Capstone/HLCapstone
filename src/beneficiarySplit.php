<?php
include('config.php'); // Include your database configuration file
if (!isset($_COOKIE['email'])) {
    header("Location: login.html");
    exit();
}

try {
    // Connect to the database using PDO
    $conn = new PDO("sqlsrv:server = tcp:hergott.database.windows.net,1433; Database = Hergott", $DBUSER, $DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve email from cookie
    if (isset($_COOKIE['email'])) {
        $logged_email = $_COOKIE['email'];
        //echo "Email: " . $logged_email;

        // Check if the user exists
        $sql_check_user = "SELECT id FROM USERS WHERE email = ?";
        $stmt_check_user = $conn->prepare($sql_check_user);
        $stmt_check_user->execute([$logged_email]);
        $row_check_user = $stmt_check_user->fetch(PDO::FETCH_ASSOC);

        if ($row_check_user) {
            $user_id = $row_check_user['id'];

            // Fetch beneficiary data for the user
            $sql_fetch_beneficiary = "SELECT b.firstname, br.relationshipToDeceased FROM Beneficiary b, BeneficiaryRelationship br, Users u WHERE b.id = br.beneficiary_id AND u.id = b.user_id AND u.id = ?";
            $stmt_fetch_beneficiary = $conn->prepare($sql_fetch_beneficiary);
            $stmt_fetch_beneficiary->execute([$user_id]);


            // Initialize an empty array to hold the results
            $data = array();

            // Loop through each row of the result set
            while ($row = $stmt_fetch_beneficiary->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row; // Append each row to the $data array
            }
            $json_data = json_encode($data);

            echo $json_data;
        } else {
            echo "User not found.";
        }
    } else {
        echo "Email cookie not set.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
