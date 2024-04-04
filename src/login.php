<?php
include('config.php');

// PHP Data Objects(PDO) Sample Code:
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$altEmail = $_POST['altemail'];
$password = $_POST['password'];
try {
    $conn = new PDO("sqlsrv:server = tcp:hergott.database.windows.net,1433; Database = Hergott", $DBUSER, $DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => $DBUSER, "pwd" => $DBPASS, "Database" => "Hergott", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:hergott.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Fetch the hashed password from the database for comparison
$sql = "SELECT password FROM USERS WHERE email = ?";
$params = array($email);
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$hashedPasswordFromDb = $row['password'];

// Verify the password using password_verify
if (!password_verify($password, $hashedPasswordFromDb)) {
    echo 'false';
} else {
    echo "true";

    // Close the statement and connection (already done before)

    // Fetch last_login from the database
    $sql = "SELECT last_login, id FROM USERS WHERE email = ?";
    $params = array($email);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Handle SQL error
    }

    // Fetch the last_login value and handle potential errors
    $last_login = null;
    $user_id = null;
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $last_login = $row['last_login'];
        $user_id = $row['id'];
    }

    if ($last_login) {
        sqlsrv_commit($conn); // Commit transaction only if last_login retrieved

        $sql = "UPDATE USERS SET last_login = GETDATE() WHERE email = ?";
        $params = array($email);

        $updateStmt = sqlsrv_query($conn, $sql, $params);

        if ($updateStmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Handle update error
        } else {
            echo "Update successful!";
        }

        // Process and set cookies only if last_login is a DateTime object
        if ($last_login instanceof DateTime) {
            setcookie('last_login', $last_login->format('Y-m-d H:i:s'), time() + 3600, "/");
            setcookie('email', $email, time() + 3600, "/");
            setcookie('user_id', $user_id, time() + 3600, "/");

            echo '<br>' . $last_login->format('Y-m-d H:i:s') . '<br>';

            $now = new DateTime('now', new DateTimeZone('UTC'));
            $interval = $last_login->diff($now);

            echo $interval->format('%R%a days') . '<br>';
            echo $now->format('Y-m-d H:i:s');
        } else {
            echo "Failed to fetch last login!";
        }
    }

    // Redirect to dashboard.php even if last_login update fails (separation of concerns)
    header('Location: dashboard.php');
    exit();
}

// Close the statement and connection (already done within the successful login block)
// sqlsrv_free_stmt($stmt); // Not needed here (already closed in successful login block)
// sqlsrv_close($conn);  // Not needed here (already closed in successful login block)

?>