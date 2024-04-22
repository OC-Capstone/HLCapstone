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
        $user_id = $_COOKIE['id'];
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

            // Fetch beneficiary data for the user
            $sql_fetch_beneficiary = "SELECT b.percentsplit, b.financialGift, b.id, b.firstname, b.lastname, b.middlename, br.relationshipToDeceased FROM Beneficiary b, BeneficiaryRelationship br, Users u WHERE b.id = br.beneficiary_id AND u.id = b.user_id AND u.id = ?";
            $stmt_fetch_beneficiary = $conn->prepare($sql_fetch_beneficiary);
            $stmt_fetch_beneficiary->execute([$user_id]);


            // Initialize an empty array to hold the results
            $data = array();

            // Loop through each row of the result set
            while ($row = $stmt_fetch_beneficiary->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row; // Append each row to the $data array
            }

            foreach ($data as $row) {
                $benid = $row['id'];
                $benfirstname = $row['firstname'];
                $benmiddlename = $row['middlename'];
                $benlastname = $row['lastname'];
                $benrelationshipToDeceased = $row['relationshipToDeceased'];
                $benfinancialgift = $row['financialGift'];
                $bensplit = $row['percentsplit'];
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

        .blur {
            filter: blur(5px);
            /* Apply blur effect to the background */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            /* other styles... */
        }
    </style>
</head>

<body class="bg-white">
    <div id="mySidenav" class="sidenav">
        <?php
        include("navbar.html");
        ?>
    </div>

    <!-- Container -->
    <div class="flex flex-col h-screen">
        <!-- Header -->
        <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex justify-between items-center px-4 z-1">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <div id="title" class="text-white font-lato font-bold text-shadow-md text-2xl sm:text-4xl md:text-4xl" style="font-family: 'Lato', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                Testamentary Wishes
            </div>
            <a href="#">
                
            </a>
        </div>

        <!--  Body -->
        <div class="mx-4 items-center mt-20 h-full"> <!-- Adjusted with padding-top to push content below the top bar -->
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
                            </div>
                            <div>
                                <span class="text-md md:text-lg lg:text-xl"><?php echo $guardian_relationship; ?></span>
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

                <!-- Content - Gifts -->
                <?php foreach ($data as $beneficiary) : ?>
                    <div class="w-full px-3 py-2 bg-white rounded border border-black flex-col gap-3 inline-flex mt-4">
                    <div class="w-full bg-green-200  rounded justify-center gap-1.5 inline-flex">
                        <div class="text-black text-2xl font-normal font-['Inter'] leading-10">Gift Beneficiary</div>
                    </div>
                        <!-- Beneficiary Information -->
                        <div class="flex items-center">
                            <div class="h-24 px-3 py-2 bg-white flex items-center">
                                <img src="../res/prof_pic.png" alt="Profile Picture" class="h-full w-full object-contain">
                            </div>
                            <div class="ml-2">
                                <div>
                                    <!-- Name and Edit Button -->
                                    <span class="text-lg md:text-xl lg:text-2xl"><?php echo $beneficiary['firstname'] . " " . $beneficiary['middlename'] . " " . $beneficiary['lastname']; ?></span>&nbsp
                                </div>
                                <div>
                                    <span class="text-md md:text-lg lg:text-xl"><?php echo $beneficiary['relationshipToDeceased']; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- "Specific Gifts" -->
                        <div class="w-full bg-red-600 rounded justify-start items-center pl-1 gap-1.5 inline-flex">
                            <img class="w-5 h-5" src="../res/iconsHL/dashboard.png">
                            <div class="text-white text-lg font-extrabold font-['Inter'] leading-10">Specific Gifts</div>
                        </div>

                        <!-- Financial Gifts -->
                        <div class="w-full h-full px-3 py-2 bg-white rounded border border-black justify-start items-center gap-3 inline-flex">
                            <img class="w-5 h-5 items-start" src="../res/iconsHL/cash.png">
                            <div class="grow shrink basis-0 text-stone-950 text-base font-normal font-['Inter'] leading-normal w-full">Financial Gifts:</div>
                            <div class="w-full pl-4 pr-2 py-1 bg-white rounded justify-end items-end flex"> <!-- Updated classes -->
                                <div class="flex-col justify-end items-end inline-flex">
                                    <form>
                                        <div class="relative border-2 rounded border-zinc-600">
                                            <div class="text-gray-500 pl-2 pr-2 "><?php echo "$" . number_format($beneficiary['financialGift'], 2); ?></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Gift Details -->
                        <?php
                        // Query to fetch gift details for the current beneficiary
                        $sql_fetch_gifts = "SELECT g.name, g.giftDetails FROM Beneficiary b, Gift g, Users u WHERE u.id = b.user_id AND b.id = g.beneficiary_id AND b.id = ?";
                        $stmt_fetch_gifts = $conn->prepare($sql_fetch_gifts);
                        $stmt_fetch_gifts->execute([$beneficiary['id']]);
                        ?>

                        <?php while ($gift = $stmt_fetch_gifts->fetch(PDO::FETCH_ASSOC)) : ?>
                            <div class="w-full h-full px-3 py-2 bg-white rounded border border-black justify-start items-start gap-3 inline-flex">
                                <img class="w-5 h-5" src="../res/iconsHL/gift.png">

                                <div class="flex-grow w-full">
                                    <p class="text-gray-700 font-sm w-full">Gift: <?php echo $gift['name']; ?></p>
                                    <p class="text-gray-500 text-sm w-full">Details: <?php echo $gift['giftDetails']; ?></p>
                                </div>

                                <div class="flex-col justify-end items-end inline-flex flex-shrink-0">
                                    <form>
                                        <div class="relative">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($data as $beneficiary) : ?>
                    <?php if ($beneficiary['percentsplit'] > 0) : ?>
                    <!-- Percent Split -->
                    <div class="w-full px-3 py-2 bg-white rounded border border-black grid grid-cols-2 gap-3 mt-4">
                        <!-- Beneficiary Information -->
                        <div class="col-span-2 bg-green-200 rounded flex justify-center gap-1.5">
                            <div class="text-black text-2xl font-normal font-['Inter'] leading-10">Beneficiary</div>
                        </div>
                        <div class="flex items-center">
                            <div class="h-24 px-3 py-2 bg-white flex items-center">
                                <img src="../res/prof_pic.png" alt="Profile Picture" class="h-full w-full object-contain">
                            </div>
                            <div class="ml-2">
                                <div>
                                    <span class="text-lg md:text-xl lg:text-2xl">
                                        <?php echo $beneficiary['firstname'] . " " . $beneficiary['middlename'] . " " . $beneficiary['lastname']; ?>
                                    </span>
                                </div>
                                <div>
                                    <span class="text-md md:text-lg lg:text-xl"><?php echo $beneficiary['relationshipToDeceased']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-center">
                            <div class="ml-2">
                                <div class="text-md md:text-md lg:text-lg text-center">
                                    Residue of Estate
                                </div>
                                <div class="text-sm md:text-sm lg:text-md text-center items-center justify-center italic">
                                    After Gifting
                                </div>
                                <div class="font-bold text-md md:text-lg lg:text-xl bg-yellow-200 text-center bg-opacity-10 rounded shadow border border-black border-opacity-0 justify-center items-center  py-2 px-4">
                                    <?php echo round($beneficiary['percentsplit']) . '%'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>


            </div>
            <div class="sticky footer w-full h-32 bg-white flex"> <!-- Adjusted footer class -->
                <div class=" bottom-0  inset-x-0 w-full h-32 flex justify-center grid grid-cols-3 gap-4 bg-white">
                    <div class="flex items-center justify-center">

                        <a href="BeneficiarySplit.html">

                            <img src="../res/iconsHL/arrow_back.png" width="150px" height="100px">
                        </a>
                    </div>

                    <div class="flex flex-col">

                        <div class="h-3/4 flex items-center justify-center" style="background-image: url('../res/iconsHL/step5.png'); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>
                    </div>
                    <div class="flex items-center justify-center">
                        <a id='nextbtn'>
                            <img src="../res/iconsHL/arrow_next.png"width="150px" height="100px">
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div id="popup" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="sm:w-full lg:w-1/2 px-6 pt-10 pb-8 bg-white rounded-3xl shadow flex-col justify-start items-center gap-14 inline-flex">
            <div class="text-zinc-900 w-5/6 text-2xl md:text-2xl md:text-2xl xl:text-4xl font-extrabold font-['Poppins'] text-center">
                Confirm Testamentary Wishes?
            </div>
            <div class="text-zinc-900 w-5/6 text-md md:text-xl md:text-xl xl:text-2xl font-normal font-['Poppins'] leading-normal text-center">Are you sure you
                want to finalize and submit your digital will? Once submitted, your testamentary wishes will be legally
                binding.
            </div>
            <button onclick="location.href='summary_final.php'" class="w-5/6 h-16 px-4 py-3 bg-gray-800 rounded-xl justify-center items-center gap-2.5 inline-flex">
                <div class="text-white text-md md:text-xl md:text-xl xl:text-2xl font-bold font-['Inter']">I agree</div>
            </button>
            <button id="close-popup" class="w-5/6 h-16 px-4 py-3 bg-gray-100 rounded-xl border-4 border-zinc-500 justify-center items-center gap-2.5 inline-flex object-contain">
                <div class="text-center text-gray-700 text-md md:text-xl md:text-xl xl:text-2xl font-bold font-['Inter']">Cancel</div>
            </button>
        </div>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "400px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        document.getElementById('nextbtn').addEventListener('click', function() {
            document.getElementById('popup').classList.remove('hidden');
        });

        document.getElementById('close-popup').addEventListener('click', function() {
            document.getElementById('popup').classList.add('hidden');
        });
    </script>

</body>


</html>