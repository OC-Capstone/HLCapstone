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
    </div>
    <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex justify-between items-center px-4 z-10">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <h1 id="title" class="text-white text-4xl" style="font-family: 'Lato', sans-serif; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
            Testamentary Wishes</h1>
        <a href="#">
            <i class="fa-solid fa-trash text-white text-4xl"></i>
        </a>
    </div>

    <div class="ml-4 mr-4 items-center pt-20"> <!-- Adjusted with padding-top to push content below the top bar -->
        <div class="border-2 text-gray-700 rounded-lg p-4 max-w-5/6" style="height: calc(100vh - 14rem);">
            <!-- Content -->
            <div class="w-full  px-3 py-2 bg-white rounded border border-black flex-col justify-start items-center gap-3 inline-flex">
                <div class="w-full bg-green-200 justify-center gap-1.5 inline-flex">
                    <div class="text-black text-2xl font-normal font-['Inter'] leading-10">Primary Guardian</div>

                </div>
                <button class="self-stretch h-12 px-3 py-2 bg-white rounded border border-black justify-center items-center gap-3 inline-flex">
                    + Add Primary Guardian
                </button>
            </div>

            <!-- Content -->
            <div class="w-full px-3 py-2 bg-white rounded border border-black flex-col justify-start items-center gap-3 inline-flex mt-4">
                <div class="w-full bg-red-200 justify-center gap-1.5 inline-flex">
                    <div class="text-black text-2xl font-normal font-['Inter'] leading-10">Alternate Guardian</div>
                </div>
                <button class="self-stretch h-12 px-3 py-2 bg-white rounded border border-black justify-center items-center gap-3 inline-flex">
                    + Add Alternate Guardian
                </button>
            </div>


        </div>

    </div>


    <div class="fixed bottom-0  w-full h-32 flex justify-center grid grid-cols-3 gap-4">
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
                <div class="w-64 h-7 text-center text-zinc-600 text-xl font-semibold font-['Open Sans'] underline leading-relaxed italic">Select Primary Guardian</div>
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