<?php
include('config.php');
// PHP Data Objects(PDO)
$FullName = $_POST['fullBeneficiaryName'];
$relationshipToDeceased = $_POST['relationship'];
// $percentSplitOfEstate = $_POST['relationshipSplit'];
$financialGift = $_POST['amount'];
$giftName = $_POST['giftName'];
$giftDetails = $_POST['giftDetails'];
// $beneficiaryType = $_POST['beneficiaryType'];
//uuuuaaaaahhhhhh

try {
	$conn = new PDO("sqlsrv:server = tcp:hergott.database.windows.net,1433; Database = Hergott", $DBUSER, $DBPASS);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	print("Error connecting to SQL Server.");
	die(print_r($e));
}



// aaaauuhuhhug

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

/* Set up and execute query */
$sql1 = "INSERT INTO beneficiaryInfo (fullName, relationshipToDeceased, financialGift, giftName, giftDetails) 
		 VALUES (?, ?, ?, ?, ?)";
//BASIC ENCRYPTION COME BACK TO THIS.
$params1 = array($FullName, $relationshipToDeceased, $financialGift, $giftName, $giftDetails);
$stmt1 = sqlsrv_query($conn, $sql1, $params1);

/* If both queries were successful, commit the transaction. */
/* Otherwise, rollback the transaction. */
if ($stmt1) {
	echo "success";
	sqlsrv_commit($conn);
	
} else {
	echo "fail";
	sqlsrv_rollback($conn);
}
