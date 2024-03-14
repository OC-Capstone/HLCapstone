<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <!-- Include Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">


    <div class="fixed top-0 left-0 w-full h-16 bg-red-500 flex justify-between items-center px-4">

        <div id="sidenav" class="hidden">
         <?php  include('navbar.php'); ?>
        </div>
        <button id="menu-toggle" onclick="toggleSidebar()" class="nav-icon text-white text-5xl">&#9776;</button>

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
                <img src="res/Vector.png" alt="logo" class="mx-auto"
                    style="max-width: 400px; width: 100%; max-height: 350px; height: 100%">
            </div>


            <div class="flex justify-center mb-2 relative">
                <ul class="mt-8 flex space-x-20 relative">




                    <li class="relative">
                        <a href="#" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Parting messages</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12 -mt-2">7</h1>

                    </li>



                    <li class="relative">
                        <a href="#" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Pet wishes</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12 -mt-2">1</h1>

                    </li>



                    <li class="relative">
                        <a href="#" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Funeral preferences</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12 -mt-2">5</h1>

                    </li>



                    <li class="relative">
                        <a href="#" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Testamentary wishes</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12 -mt-2">4</h1>

                    </li>



                    <li class="relative">
                        <a href="#" class="text-black-500 hover:text-blue-700 text-2xl"
                            style="font-family: 'Lato', sans-serif; white-space: nowrap;">Funeral preferences</a>
                        <h1 class="text-5xl absolute left-1/2 transform -translate-x-1/2 top-12-mt-2">3</h1>

                    </li>


                </ul>
            </div>
        </div>
    </div>
    <script src="navbar.js"></script>

</body>

</html>