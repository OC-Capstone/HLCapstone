<!DOCTYPE html>
<html lang="en">

<?php
    if (!isset($_COOKIE['email'])) {
        header("Location: login.html");
        exit();
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testamentary Wishes</title>
    <!-- Include Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="sidenav.css" rel="stylesheet">
    <style>
        body {
            font-family: "Lato", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        ::placeholder {
            text-align: center;
        }
    </style>
</head>

<body class="bg-white">
    <div id="mySidenav" class="sidenav">
        <?php
        include("navbar.html");
        ?>
    </div class="">
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

        <div class="mx-4 items-center mt-20 h-full">
            <div id="main_div" class="border-2 text-gray-700 rounded-lg p-4 max-w-5/6" style="min-height: calc(100vh - 14rem)">

                <div class="w-full px-3 py-2 bg-white rounded border border-black flex-col justify-center items-center gap-3 inline-flex">
                    <div class="w-full bg-green-200 justify-center rounded gap-1.5 inline-flex">
                        <div class="text-black text-2xl font-normal font-['Inter'] leading-10">Guardian</div>
                    </div>
                    <button id="addGuardianButton" class="self-stretch h-12 px-3 py-2 bg-white rounded border border-black justify-center items-center gap-3 inline-flex">
                        + Add Guardian
                    </button>


                    <!-- Hidden Form -->
                    <div id="guardianForm" class="hidden w-full px-3 py-2 bg-white rounded flex-col justify-center items-center gap-3 hidden">
                        <form id="guardianFormSubmit">
                            <input type="text" name="fname" id="fname" placeholder="First Name" class="w-full mb-2 border border-gray-300 rounded px-3 py-2 text-center" required>
                            <input type="text" name="mname" id="mname" placeholder="Middle Name" class="w-full mb-2 border border-gray-300 rounded px-3 py-2 text-center" required>
                            <input type="text" name="lname" id="lname" placeholder="Last Name" class="w-full mb-2 border border-gray-300 rounded px-3 py-2 text-center" required>
                            <input type="text" name="relationship" id="relationship" placeholder="Relationship to You" class="w-full mb-2 border border-gray-300 rounded px-3 py-2 text-center" required>
                            <button type="submit" class="text-black bg-green-200 w-full self-stretch h-12 px-3 py-2 bg-white rounded border border-black justify-center items-center gap-3 inline-flex text-center">
                                Save Guardian
                            </button>
                        </form>
                    </div>
                    <!-- End of Hidden Form -->
                </div>


                <div class="footer w-full h-32 bg-white ">
                    <div class="fixed bottom-0 inset-x-0 w-full h-32 flex justify-center grid grid-cols-3 gap-4 bg-white">
                        <div class="flex items-center justify-center">
                            <a href="dashboard.php">
                                <img src="../res/iconsHL/arrow_back.png" width="150px" height="100px">
                            </a>
                        </div>

                        <div class="flex flex-col">
                            <div class="h-1/4 flex items-center justify-center">
                                <div class="w-64 h-7 text-center text-zinc-600 sm:text-lg md:text-xl font-semibold font-['Open Sans'] underline leading-relaxed italic">Select Guardian</div>
                            </div>
                            <div class="h-3/4 flex items-center justify-center" style="background-image: url('../res/iconsHL/step1.png'); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>
                        </div>
                        <div class="flex items-center justify-center">
                            <a href="">
                                <img src="../res/iconsHL/arrow_grey_right.png" alt="Must have guardian filled to continue" width="150px" height="100px">
                            </a>
                        </div>
                    </div>
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

            const addGuardianButton = document.getElementById('addGuardianButton');
            const guardianFormFind = document.getElementById('guardianForm');

            addGuardianButton.addEventListener('click', () => {
                guardianFormFind.classList.toggle('hidden');
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#guardianFormSubmit').submit(function(e) { // Changed 'guardianForm' to '#guardianFormSubmit'
                    e.preventDefault();
                    var values = $(this).serialize();
                    $.ajax({
                        url: "submit_guardian.php",
                        type: "post",
                        data: values,
                        success: function(res) {
                            alert('Successfully added Guardian!')
                            console.log(res)
                            window.location.href = "guardian.php";
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>

        <?php

        ?>

</body>

</html>