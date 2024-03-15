<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <!-- Include Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 10;
  background-color: #fff;
  overflow-x: hidden;
  transition: 0.5s;
  /* padding-top: 60px; */
}

.sidenav a {
  /* padding: 8px 8px 8px 32px; */
  text-decoration: none;
  font-size: 25px;
  /* color: #818181; */
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>

<body>
    <div id="mySidenav" class="sidenav">
	<?php
	include("navbar.html");
	?>
</div>    
    <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex justify-between items-center px-4">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

        <h1 id="title" class="text-white text-4xl"
            style="font-family: 'Lato', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
            Secure Document Vault</h1>


        <a href="#">
            <i class="fas fa-sign-out-alt text-white text-4xl"></i>
        </a>
    </div>



    <div class="flex flex-col justify-center items-center h-screen">
        <div class="" style="max-width: 400px; width: 100%;">
            <div class="text-center mt-1 mb-12">
                <h1 id="welcomeMessage" class="text-6xl mb-6" style="font-family: 'Lato', sans-serif;">Vault drawers
                </h1>

                <p id="lastUpdated" class="text-3xl mt-4 mb-12" style="font-family: 'Lato', sans-serif;">Last Updated:
                </p>
                <img src="../res/Vector.png" alt="logo" class="mx-auto"
                    style="max-width: 400px; width: 100%; max-height: 350px; height: 100%">
            </div>


            <div class="flex justify-center mb-2 relative">
                <ul class="mt-8 flex space-x-20 relative">




                    <li class="relative">
                        <a href="messages.html" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Parting messages</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12 -mt-2">7</h1>

                    </li>



                    <li class="relative">
                        <a href="pets.html" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Pet wishes</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12 -mt-2">&#10003;</h1>

                    </li>



                    <li class="relative">
                        <a href="assets.html" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Asset Inventory</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12 -mt-2">&#10003;</h1>

                    </li>



                    <li class="relative">
                        <a href="wishes.html" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Testamentary wishes</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12 -mt-2">&#10003;</h1>

                    </li>



                    <li class="relative">
                        <a href="funeral.html" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Funeral preferences</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12-mt-2">&#10003;</h1>

                    </li>


                </ul>
            </div>
        </div>
    </div>


    <script>
function openNav() {
  document.getElementById("mySidenav").style.width = "400px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
   
</body>

</html>