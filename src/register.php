<?php
include('config.php');
// PHP Data Objects(PDO) Sample Code:
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$altEmail = $_POST['altemail'];
$password = $_POST['password'];
$verifypassword = $_POST['verifypassword'];

if ($password != $verifypassword) {
	echo "Passwords do not match";
	exit();
}

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
$sql = "SELECT email 
		FROM USERS WHERE email = ?";
$params = array($email);
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
/* ^ idk what SQLSRV_CURSOR_KEYSET does lol */
$userExists = sqlsrv_query($conn, $sql, $params, $options);
$row_count = sqlsrv_num_rows($userExists);

/* If the number of rows that match the query is 0, then the user does not exist */
if ($row_count == 0) {

	/* Set up and execute query */
	$sql1 = "INSERT INTO USERS (firstName, lastName, middleName, email, altEmail, password) 
		 VALUES (?, ?, ?, ?, ?, ?)";
	//BASIC ENCRYPTION COME BACK TO THIS.
	$params1 = array($fname, $lname, $mname, $email, $altEmail, SHA1($password));
	echo $fname . " " . $lname . " " . $mname . " " . $email . " " . $altEmail . " " . SHA1($password);
	$stmt1 = sqlsrv_query($conn, $sql1, $params1);

	/* If both queries were successful, commit the transaction. */
	/* Otherwise, rollback the transaction. */
	if ($stmt1) {
		sqlsrv_commit($conn);
		echo "Transaction committed.<br />";
	} else {
		sqlsrv_rollback($conn);
		echo "Transaction rolled back.<br />";
	}

	$sql = "UPDATE USERS SET last_login = GETDATE() WHERE email = ?";
	$params = array($email);
	$stmt = sqlsrv_query($conn, $sql, $params);

	// Back to login page on register success.
	header("Location: login.html");
	exit();
} else {
	echo "User exists";
}

?>