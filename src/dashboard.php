<?php
if (!isset($_COOKIE['email'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <!-- Include Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="sidenav.css" rel="stylesheet">
</head>
<style>
    .dot {
        height: 75px;
        width: 75px;
        border-radius: 50%;
        display: inline-block;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .dot h1 {
        font-size: 2rem;
        color: white;
    }
</style>

<body>
    <div class="grid grid-cols-1 gap-4">
        <div id="mySidenav" class="sidenav z-50">
            <?php include("navbar.html"); ?>
        </div>
        <img src="../res/LoginPagebg.png" alt="bg" class="bg-gray-900 absolute inset-0 z-0 w-full h-full object-cover">
        <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex justify-between items-center px-1 z-30">
            <div class="flex items-center gap-2 cursor:pointer">
                <span style="font-size:30px; cursor:pointer" class="text-white" onclick="openNav()">&#9776;</span>
                <h1 class="text-white text-4xl hidden md:block">Navigation</h1>
            </div>
            <div id="title" class="text-white font-lato font-bold text-shadow-md text-2xl sm:text-4xl md:text-4xl" style="font-family: 'Lato', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                Secure Document Vault
            </div>

            <a href="logout.php">
                <div class="flex items-center gap-2">
                    <h1 class="text-white text-4xl hidden md:block">Logout</h1>
                    <button style="font-size:30px;" class="text-white"><i class='fas fa-sign-out-alt'></i></button>
                </div>

            </a>
        </div>
    </div>
    <div class="relative">
        <div class="flex flex-col justify-center items-center h-screen p-5">
            <div class="" style="max-width: 400px; width: 100%;">
                <div class="text-center mt-1 mb-12">
                    <h1 id="welcomeMessage" class="text-center md:text-6xl text-3xl md:mb-5 drop-shadow-2xl" style="font-family: 'Lato', sans-serif; ">Vault drawers
                    </h1>

                    <p id="lastUpdated" class="text-center md:text-3xl text-1xl mt-4 mb-5 text-gray-800" style="font-family: 'Lato', sans-serif;">Last Updated: Oct 25, 2021
                    </p>
                    <p id="lastUpdated" class="text-center md:text-3xl text-1xl mt-4 mb-5 text-gray-800" style="font-family: 'Lato', sans-serif;">Last Login:
                        <?php
                        if (isset($_COOKIE['last_login'])) {
                            $last_login = DateTime::createFromFormat('Y-m-d H:i:s', $_COOKIE['last_login']);
                            if ($last_login instanceof DateTime) {
                                $now = new DateTime('now', new DateTimeZone('UTC')); // Current date and time in UTC
                                $now = DateTime::createFromFormat('Y-m-d H:i:s', $now->format('Y-m-d H:i:s'));
                                $interval = $last_login->diff($now); // Difference between dates
                                if ($interval->y > 0) {
                                    if ($interval->y == 1) {
                                        echo $interval->y . " year ago";
                                    } else {
                                        echo $interval->y . " years ago";
                                    }
                                } else if ($interval->m > 0) {
                                    if ($interval->m == 1) {
                                        echo $interval->m . " month ago";
                                    } else {
                                        echo $interval->m . " months ago";
                                    }
                                } else if ($interval->days > 0) {
                                    if ($interval->days == 1) {
                                        echo $interval->days . " day ago";
                                    } else {
                                        echo $interval->days . " days ago";
                                    }
                                } elseif ($interval->h > 0) {
                                    if ($interval->h == 1) {
                                        echo $interval->h . " hour ago";
                                    } else {
                                        echo $interval->h . " hours ago";
                                    }
                                } else if ($interval->i > 0) {
                                    if ($interval->i == 1) {
                                        echo $interval->i . " minute ago";
                                    } else {
                                        echo $interval->i . " minutes ago";
                                    }
                                } else {
                                    echo $interval->s . " seconds ago";
                                }
                            } else {
                                echo "Failed to parse last login date!";
                            }
                        } else {
                            echo "No last login information found.";
                        }
                        ?>
                    </p>
                    <!-- <canvas id="testamentaryAssetChart" width="400" height="400"></canvas> -->
                    <img src="../res/vector.png" alt="vault picture" class="w-90 h-45">
                </div>

                <div class="grid grid-cols-3">

                    <div class="text-white m-auto md:text-2xl text-1xl text-center">
                        <h1>Parting Messages</h1>
                    </div>
                    <div class="text-white m-auto md:text-2xl text-1xl text-center">
                        <h1>Pet <br> Wishes</h1>
                    </div>
                    <div class="text-white m-auto md:text-2xl text-1xl text-center">
                        <h1>Funeral Preferences</h1>
                    </div>
                    <div class="dot m-auto" style="background-color: rgb(50, 150, 45);">
                        <h1>8</h1>
                    </div>
                    <!-- display: flex;
                        justify-content: center;
                        align-items: center; -->

                    <div class="dot m-auto" style="background-color: rgb(50, 150, 45);">
                        <h1>&#10003;</h1>
                    </div>

                    <div class="dot m-auto bg-red-700">
                        <h1>&#10005;</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function openNav() {
            var sideNav = document.getElementById("mySidenav");

            // Function to check if the user is on a mobile device
            function isMobileDevice() {
                return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
            }

            // Check if the user is on a mobile device
            if (isMobileDevice()) {
                // Execute this code if the user is on a mobile device
                // For example, you can set a different width for mobile devices
                sideNav.style.width = "100%"; // Set width to 200px for mobile devices
            } else {
                // Execute this code if the user is not on a mobile device
                // For example, you can set the width to 400px as in your original code
                sideNav.style.width = "400px"; // Set width to 400px for non-mobile devices
            }
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

</body>

</html>