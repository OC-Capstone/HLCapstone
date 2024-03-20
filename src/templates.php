<!DOCTYPE html>
<html lang="en">

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
        <div class="mx-4 items-center mt-20 h-full"> <!-- Adjusted with padding-top to push content below the top bar -->
            <div class="border-2 text-gray-700 rounded-lg p-4 max-w-5/6" style="min-height: calc(100vh - 14rem)">
                <!-- Content -->
                <div class="w-full  px-3 py-2 bg-white rounded border border-black flex-col justify-start items-center gap-3 inline-flex">
                    <div class="w-full bg-green-200 justify-center  rounded gap-1.5 inline-flex">
                        <div class="text-black text-2xl font-normal font-['Inter'] leading-10">Primary Guardian</div>

                    </div>
                    <button class="self-stretch h-12 px-3 py-2 bg-white rounded border border-black justify-center items-center gap-3 inline-flex">
                        + Add Primary Guardian
                    </button>
                </div>

                <!-- Content - Guardian Name w/ Edit Icon -->
                <div class="w-full px-3 py-2 bg-white rounded border border-black flex-col justify-start items-center gap-3 inline-flex mt-4">
                    <div class="w-full bg-green-200  rounded justify-center gap-1.5 inline-flex">
                        <div class="text-black text-2xl font-normal font-['Inter'] leading-10">Primary Guardian</div>
                    </div>
                    <div class="flex items-center">
                        <div class="h-24 px-3 py-2 bg-white flex items-center">
                            <img src="../res/prof_pic.png" alt="Profile Picture" class="h-full w-full object-contain">
                        </div>
                        <div class="ml-2">
                            <div>
                                <span class="text-lg md:text-xl lg:text-2xl">Gisele Marie-Louise LaFleche</span>&nbsp <button><i class="fas fa-edit"></i></button>
                            </div>
                            <div>
                                <span class="text-md md:text-lg lg:text-xl">Step-Daughter</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content - Gifts - Gisele Marie-Louise LaFleche-->
                <div class="w-full px-3 py-2 bg-white rounded border border-black flex-col gap-3 inline-flex mt-4">
                    <div class="flex items-center">
                        <div class="h-24 px-3 py-2 bg-white flex items-center">
                            <img src="../res/prof_pic.png" alt="Profile Picture" class="h-full w-full object-contain">
                        </div>
                        <div class="ml-2">
                            <div>
                                <!-- Name and Edit Button -->
                                <span class="text-lg md:text-xl lg:text-2xl">Gisele Marie-Louise LaFleche</span>&nbsp <button><i class="fas fa-edit"></i></button>
                            </div>
                            <div>
                                <span class="text-md md:text-lg lg:text-xl">Step-Daughter</span>
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
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-gray-500">$</span>
                                        <input type="number" id="amount" name="amount" min="0" max="9999999" step="1000" value="75000" class="pl-8"> <!-- Adjusted classes -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Gift Details #1 -->
                    <div class="w-full h-full px-3 py-2 bg-white rounded border border-black justify-start items-start gap-3 inline-flex">
                        <img class="w-5 h-5" src="../res/iconsHL/gift.png">

                        <div class="flex-grow w-full">
                            <p class="text-gray-700 font-sm w-full">Gift:</p>
                            <p class="text-gray-500 text-sm w-full">Speed Boat</p>
                            <p class="text-gray-700 font-sm w-full">Details:</p>
                            <p class="text-gray-500 text-sm w-full">2018 Malibu Wakesetter and the boat trailer</p>
                        </div>

                        <div class="flex-col justify-end items-end inline-flex flex-shrink-0">
                            <form>
                                <div class="relative">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Gift Details #2 -->
                    <div class="w-full h-full px-3 py-2 bg-white rounded border border-black justify-start items-start gap-3 inline-flex">
                        <img class="w-5 h-5" src="../res/iconsHL/gift.png">

                        <div class="flex-grow w-full">
                            <p class="text-gray-700 font-sm">Gift:</p>
                            <p class="text-gray-500 text-sm">Tools</p>
                            <p class="text-gray-700 font-sm">Details:</p>
                            <p class="text-gray-500 text-sm">- All tools in garage <br />- All tools in shed<br />- Including the riding lawnmower</p>
                        </div>

                        <div class="flex-col justify-end items-end inline-flex flex-shrink-0">
                            <form>
                                <div class="relative">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- Content - Gifts - John Smith-->
                <div class="w-full px-3 py-2 bg-white rounded border border-black flex-col gap-3 inline-flex mt-4">
                    <div class="flex items-center">
                        <div class="h-24 px-3 py-2 bg-white flex items-center">
                            <img src="../res/iconsHL/johnsmith.png" alt="Profile Picture" class="h-full w-full object-contain">
                        </div>
                        <div class="ml-2">
                            <div>
                                <!-- Name and Edit Button -->
                                <span class="text-lg md:text-xl lg:text-2xl">John Smith</span>&nbsp <button><i class="fas fa-edit"></i></button>
                            </div>
                            <div>
                                <span class="text-md md:text-lg lg:text-xl">Son</span>
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
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-gray-500">$</span>
                                        <input type="number" id="amount" name="amount" min="0" max="9999999" step="1000" value="75000" class="pl-8"> <!-- Adjusted classes -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Gift Details #1 --->
                    <div class="w-full h-full px-3 py-2 bg-white rounded border border-black justify-start items-start gap-3 inline-flex">
                        <img class="w-5 h-5" src="../res/iconsHL/gift.png">

                        <div class="flex-grow w-full">
                            <p class="text-gray-700 font-sm w-full">Gift:</p>
                            <p class="text-gray-500 text-sm w-full">Gift Name</p>
                            <p class="text-gray-700 font-sm w-full">Details:</p>
                            <p class="text-gray-500 text-sm w-full">Description</p>
                        </div>

                        <div class="flex-col justify-end items-end inline-flex flex-shrink-0">
                            <form>
                                <div class="relative">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Gift Details #2 -->
                    <div class="w-full h-full px-3 py-2 bg-white rounded border border-black justify-start items-start gap-3 inline-flex">
                        <img class="w-5 h-5" src="../res/iconsHL/gift.png">

                        <div class="flex-grow w-full">
                            <p class="text-gray-700 font-sm">Gift:</p>
                            <p class="text-gray-500 text-sm">Gift Name</p>
                            <p class="text-gray-700 font-sm">Details:</p>
                            <p class="text-gray-500 text-sm">Description</p>
                        </div>

                        <div class="flex-col justify-end items-end inline-flex flex-shrink-0">
                            <form>
                                <div class="relative">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>


                <!-- Add New Beneficiary Button -->
                <button class="w-full px-3 py-2 bg-white rounded border border-black flex-col justify-start items-center gap-3 inline-flex mt-4">
                    + Add New Gift Beneficiary
                </button>


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
                            <div class="h-3/4 flex items-center justify-center"><img src="../res/iconsHL/dots.jpg"></div>
                        </div>
                        <!-- Column Three -->
                        <div class="flex items-center justify-center">
                            <a href="#">
                                <img src="../res/iconsHL/arrow_next.png" width="150px" height="100px">
                            </a>
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
            </script>

</body>

</html>