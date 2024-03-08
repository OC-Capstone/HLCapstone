<?php
include('config.php');

// PHP Data Objects(PDO) Sample Code:
$fname = $_POST['Fname'];
$mname = $_POST['Mname'];
$lname = $_POST['Lname'];
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

/* Begin the transaction. */
if (sqlsrv_begin_transaction($conn) === false) {
    die(print_r(sqlsrv_errors(), true));
}

/* check if user exists */
$sql = "SELECT email, password, last_login
        FROM USERS WHERE email = ? AND password = ?";
$params = array($email, SHA1($password));
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
/* ^ idk what SQLSRV_CURSOR_KEYSET does lol */
$userExists = sqlsrv_query($conn, $sql, $params, $options);
$row_count = sqlsrv_num_rows($userExists);

/* If the number of rows that match the query is 0, then the user does not exist */
if ($row_count == 0) {
    echo "User does not exist!";
} else {
    echo "Logged in successfully!";
    echo "<br> <a href='fetch_lastlogin.php'>Temp Link to Test Last Login</a>";

    // Fetch last_login from the database
    $sql = "SELECT last_login FROM USERS WHERE email = ?";
    $params = array($email);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Handle SQL error
    }

// Fetch the last_login value
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $last_login = $row['last_login'];
        if ($last_login instanceof DateTime) {
            // Set cookies with retrieved values
            setcookie('last_login', $last_login->format('Y-m-d H:i:s'), time() + 3600, "/");
            setcookie('email', $email, time() + 3600, "/");
        } else {
            echo "Failed to fetch last login!";
        }   
    }
}
?>
