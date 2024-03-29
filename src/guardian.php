<!DOCTYPE html>
<html lang="en">
<?php
include('config.php'); // Include your database configuration file
if (!isset($_COOKIE['email'])) {
    header("Location: login.html");
    exit();
}
// Initialize variables to store guardian data
$guardian_first_name = "";
$guardian_middle_name = "";
$guardian_last_name = "";
$guardian_relationship = "";

try {
    // Connect to the database using PDO
    $conn = new PDO("sqlsrv:server = tcp:hergott.database.windows.net,1433; Database = Hergott", $DBUSER, $DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve email from cookie
    if (isset($_COOKIE['email'])) {
        $logged_email = $_COOKIE['email'];
        //echo "Email: " . $logged_email;

        // Check if the user exists
        $sql_check_user = "SELECT id FROM USERS WHERE email = ?";
        $stmt_check_user = $conn->prepare($sql_check_user);
        $stmt_check_user->execute([$logged_email]);
        $row_check_user = $stmt_check_user->fetch(PDO::FETCH_ASSOC);

        if ($row_check_user) {
            $user_id = $row_check_user['id'];
            //echo "User ID: $user_id";

            // Fetch guardian data for the user
            $sql_fetch_guardian = "SELECT * FROM GUARDIAN WHERE user_id = ?";
            $stmt_fetch_guardian = $conn->prepare($sql_fetch_guardian);
            $stmt_fetch_guardian->execute([$user_id]);
            $guardian_data = $stmt_fetch_guardian->fetch(PDO::FETCH_ASSOC);

            if ($guardian_data) {
                //echo "Guardian data for User ID $user_id:<br>";
                // Assign guardian data to variables
                $guardian_first_name = $guardian_data['firstname'];
                $guardian_middle_name = $guardian_data['middlename'];
                $guardian_last_name = $guardian_data['lastname'];
                $guardian_relationship = $guardian_data['relationshipToDeceased'];
            } else {
                //echo "No guardian data found for User ID $user_id.";
            }
        } else {
            //echo "User not found.";
        }
    } else {
        //echo "Email cookie not set.";
    }
} catch (PDOException $e) {
    //echo "Error: " . $e->getMessage();
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
    <style>
        body {
            font-family: "Lato", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
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

        <!--  Body -->
        <div class="mx-4 items-center mt-20 h-full"><!-- Adjusted with padding-top to push content below the top bar -->
            <div class="border-2 text-gray-700 rounded-lg p-4 max-w-5/6" style="min-height: calc(100vh - 16rem)">
                <!-- Content - Guardian Name w/ Edit Icon -->
                <div class="w-full px-3 py-2 bg-white rounded border border-black flex-col justify-start items-center gap-3 inline-flex mt-4">
                    <div class="w-full bg-green-200  rounded justify-center gap-1.5 inline-flex">
                        <div class="text-black text-2xl font-normal font-['Inter'] leading-10">Guardian</div>
                    </div>
                    <div class="flex items-center">
                        <div class="h-24 px-3 py-2 bg-white flex items-center">
                            <img src="../res/prof_pic.png" alt="Profile Picture" class="h-full w-full object-contain">
                        </div>
                        <div class="ml-2">
                            <div>
                                <span class="text-lg md:text-xl lg:text-2xl">
                                    <?php echo $guardian_first_name . " " . $guardian_middle_name . " " . $guardian_last_name; ?>
                                </span>&nbsp <button id="addGuardianButton"><i class="fas fa-edit"></i></button>
                            </div>
                            <div>
                                <span class="text-md md:text-lg lg:text-xl"><?php echo $guardian_relationship;?></span>
                            </div>
                        </div>
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

                </div>

                
                

            </div>

            <!-- Footer -->
            <div class="footer w-full h-32 bg-white "> <!-- Adjusted footer class -->
                <div class="fixed bottom-0  inset-x-0 w-full h-32 flex justify-center grid grid-cols-3 gap-4 bg-white">
                    <!-- Column One -->
                    <div class="flex items-center justify-center">
                        <a href="#">
                            <img src="../res/iconsHL/arrow_back.png" width="150px" height="100px">
                        </a>
                    </div>

                    <!-- Column Two -->
                    <div class=" flex flex-col">
                        <!-- Row One -->
                        <div class="h-1/4 flex items-center justify-center">
                            <div class="w-64 h-7 text-center text-zinc-600 sm:text-lg md:text-xl font-semibold font-['Open Sans'] underline leading-relaxed italic">Select Primary Guardian</div>
                        </div>
                        <!-- Row Two -->
                        <div class="h-3/4 flex items-center justify-center" style="background-image: url('../res/iconsHL/step1.png'); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>
                    </div>
                    <!-- Column Three -->
                    <div class="flex items-center justify-center">
                        <a href="Beneficiary.html">
                            <img src="../res/iconsHL/arrow_next.png" width="150px" height="100px">
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <<script>
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
                            alert('Successfully edited Guardian!')
                            console.log(res)
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    
</body>

</html>