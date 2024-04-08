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
  <link href="sidenav.css" rel="stylesheet">
</head>

<body class="bg-white font-sans">
  <div id="mySidenav" class="sidenav">
    <?php
    include("navbar.html");
    ?>
  </div class="">

  </div>
  <!-- Container -->
  <div>
    <!-- Header -->
    <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex justify-between items-center px-4 z-1">
      <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
      <div id="title" class="text-white font-lato font-bold text-shadow-md text-2xl sm:text-4xl md:text-4xl" style="font-family: 'Lato', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
        Testamentary Wishes
      </div>
      <a href="#">
        <i class="fa-solid fa-trash text-white text-4xl"></i>
      </a>
    </div>
    <div class="flex justify-center mt-24">
      <h1>primary/alternate sequence page</h1>
    </div>

    <!-- Hidden Form -->
    <div id="guardianForm" class="hidden w-full px-3 py-2 bg-white rounded flex-col justify-center items-center gap-3">
      <form id="guardianFormSubmit">
        <input type="text" name="fname" id="fname" placeholder="First Name" class="w-full mb-2 border border-gray-300 rounded px-3 py-2 text-center" required value="<?php echo $guardian_first_name; ?>">
        <input type="text" name="mname" id="mname" placeholder="Middle Name" class="w-full mb-2 border border-gray-300 rounded px-3 py-2 text-center" value="<?php echo $guardian_middle_name; ?>">
        <input type="text" name="lname" id="lname" placeholder="Last Name" class="w-full mb-2 border border-gray-300 rounded px-3 py-2 text-center" required value="<?php echo $guardian_last_name; ?>">
        <input type="text" name="relationship" id="relationship" placeholder="Relationship to You" class="w-full mb-2 border border-gray-300 rounded px-3 py-2 text-center" required value="<?php echo $guardian_relationship; ?>">
        <button type="submit" class="text-black bg-green-200 w-full self-stretch h-12 px-3 py-2 bg-white rounded border border-black justify-center items-center gap-3 inline-flex text-center">
          Save Guardian
        </button>
      </form>
    </div>
    <!-- End of Hidden Form -->


    <!--footer-->
    <div class="footer w-full h-32 bg-white">
      <div class="fixed bottom-0 inset-x-0 w-full h-32 flex justify-center grid grid-cols-3 gap-4 bg-white">
        <!-- Column One -->
        <div class="flex items-center justify-center">
          <a href="questionPage.php"><img src="../res/iconsHL/arrow_back.png" width="150px" height="100px"></a>
        </div>
        <!-- Column Two -->
        <div class=" flex flex-col">
          <!-- Row One -->
          <div class="h-1/4 flex items-center justify-center">
            <div class="w-64 h-7 text-center text-zinc-600 sm:text-lg md:text-xl font-semibold italic"></div>
          </div>
          <!-- Row Two -->
          <div class="h-3/4 flex items-center justify-center" style="background-image: url('../res/iconsHL/step4.png'); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>
        </div>
        <!-- Column Three -->
        <div class="flex items-center justify-center">
          <a id="nextLink" href="">
            <button id="nextButton" class="focus:outline-none">
              <img src="../res/iconsHL/arrow_next.png" width="150px" height="100px">
            </button>
          </a>
        </div>
      </div>
    </div>
</body>

<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "400px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  const addGuardianButton = document.getElementById('addGuardianButton');
  const guardianFormFind = document.getElementById('guardianForm');

  addGuardianButton.addEventListener('click', () => {
    guardianFormFind.classList.toggle('hidden');
  });
</script>