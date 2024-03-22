<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Testamentary Wishes</title>
  <!-- Include Tailwind CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="bg-white font-sans">
  <div id="mySidenav" class="sidenav">

  </div>
  <!-- Container -->
  <div>
    <!-- Header -->
    <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex items-center justify-between px-4 z-10">
      <span id="menu-icon" style="font-size:30px; cursor:pointer;" onclick="openNav()">&#9776;</span>
      <div id="title" class="text-white font-bold text-shadow-md text-2xl sm:text-4xl md:text-4xl">
        Testamentary Wishes
      </div>
      <div></div>
    </div>
    <?php
    include('config.php');

    try {
      $conn = new PDO("sqlsrv:server = tcp:hergott.database.windows.net,1433; Database = Hergott", $DBUSER, $DBPASS);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      print("Error connecting to SQL Server.");
      die(print_r($e));
    }


    $connectionInfo = array("UID" => $DBUSER, "pwd" => $DBPASS, "Database" => "Hergott", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:hergott.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    $sql = "SELECT fullName, relationshipToDeceased FROM beneficiaryInfo";
    $params = array();
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
      echo "<div class='w-full max-w-screen-sm h-24 px-12 py-2 mt-12 rounded border border-black flex items-center'>";
      echo "<img src='../res/prof_pic.png' alt='Profile Picture' class='h-full object-contain'>";
      echo "<div class='ml-2'>";
      echo "<p class='text-lg md:text-xl mb-2 lg:text-2xl'>";
      echo $row['fullName'];
      echo "</p>";
      echo "<p class='text-md md:text-lg lg:text-xl'>";
      echo $row['relationshipToDeceased'];
      echo "</p>";
      echo "</div>";
      echo "</div>";
    }
    ?>


    <div class="footer w-full h-32 bg-white absolute bottom-0 inset-x-0 flex justify-center grid grid-cols-3 gap-4">

      <div class="flex items-center justify-center">
        <a href="beneficiary.html">
          <img src="../res/iconsHL/arrow_back.png" width="150px" height="100px">
        </a>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-1/4 flex items-center justify-center">

        </div>
        <div class="h-3/4 flex items-center justify-center"><img src="../res/iconsHL/dots.jpg"></div>
      </div>
      <div class="flex items-center justify-center">
        <a href="">
          <img src="../res/iconsHL/arrow_next.png" width="150px" height="100px">
        </a>
      </div>
    </div>

    <script>
      var entryDiv = $("<div>").addClass("w-full max-w-screen-sm h-24 px-12 py-2 mt-12 rounded border border-black flex items-center");
      var profilePicture = $("<img>").attr("src", "../res/prof_pic.png").attr("alt", "Profile Picture").addClass("h-full object-contain");
      var beneficiaryInfoDiv = $("<div>").addClass("ml-2");
      var fullName = $("<p>").text(entry.fullName).addClass("text-lg md:text-xl mb-2 lg:text-2xl");
      var relationship = $("<p>").text(entry.relationshipToDeceased).addClass("text-md md:text-lg lg:text-xl");
    </script>

</body>

</html>