<?php
session_start();
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
        echo "Email: " . $logged_email;
            $user_id = $_COOKIE['user_id'];
            echo "User ID: $user_id";

            // Check if has_guardian is filled for the user
            $sql_check_guardian = "SELECT has_guardian FROM GUARDIAN WHERE user_id = ?";
            $stmt_check_guardian = $conn->prepare($sql_check_guardian);
            $stmt_check_guardian->execute([$user_id]);
            $row_check_guardian = $stmt_check_guardian->fetch(PDO::FETCH_ASSOC);
            if($row_check_guardian && $row_check_guardian['has_guardian'] && isset($_GET['selected_yes'])){
                header("Location: guardian.php?selected_yes=guardian.php");
                exit();
            }
            if ($row_check_guardian && $row_check_guardian['has_guardian']) {

                header("Location: guardian.php");
                exit();
            }else{
                header("Location: create_guardian.php");
                exit();
            }

    } else {
        echo "Email cookie not set.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
