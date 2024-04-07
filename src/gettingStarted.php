<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testamentary Wishes</title>
    <!-- Include Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white">




    <!-- Container -->
    <div>
        <!-- Header -->
        <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex justify-between items-center px-4 z-1">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <div id="title" class="text-white font-lato font-bold text-shadow-md text-2xl sm:text-4xl md:text-4xl">Testamentary Wishes</div>
            <a href="#"><i class="fa-solid fa-trash text-white text-4xl"></i></a>
        </div>

        <!-- header -->
        <div class="w-full flex p-2 justify-center">
            <div class="text-4xl font-bold dark:text-white mt-24">Getting started</div>
        </div>

        <!---question 1-->
        <div class="w-full flex p-2 justify-center">
            <div class="bg-white flex-col flex justify-center mt-24 p-6 w-5/8 border-4 border-gray-200 rounded-lg">

                <form class="text-center" id="myForm1">

                    <div class="mb-4">
                        <label>Do you have children you would like to setup guardianship arrangements for? </label>
                    </div>

                    <div class="bg-white flex justify-center items-start mt-12">
                        <form class="text-center" id="myForm1">
                        <label for="bordered-radio-2" class="flex items-center ps-4 border ml-3 border-gray-200 rounded dark:border-gray-700">
                                <input id="bordered-radio-2" type="radio" value="" name="bordered-radio" class="w-4 h-4 ml-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onclick="checkRadio()">
                                <label for="bordered-radio-2" class="w-full py-4 ms-2 text-sm ml-5 mr-5 font-medium text-gray-900 dark:text-gray-300">No</label>
                            </label>

                            <label for="bordered-radio-1" class="flex items-center ps-4 border ml-3 border-gray-200 rounded dark:border-gray-700">
                                <input id="bordered-radio-1" type="radio" value="" name="bordered-radio" class="w-4 h-4 ml-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onclick="checkRadio()">
                                <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm ml-5 mr-5 font-medium text-gray-900 dark:text-gray-300">Yes</label>
                            </label>
                        </form>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer w-full h-32 bg-white">
            <div class="fixed bottom-0 inset-x-0 w-full h-32 flex justify-center grid grid-cols-3 gap-4 bg-white">
                <!-- Column One -->
                <div class="flex items-center justify-center">
                    <a href="dashboard.php"><img src="../res/iconsHL/arrow_back.png" width="150px" height="100px"></a>
                </div>
                <!-- Column Two -->
                <div class=" flex flex-col">
                    <!-- Row One -->
                    <div class="h-1/4 flex items-center justify-center">
                        <div class="w-64 h-7 text-center text-zinc-600 sm:text-lg md:text-xl font-semibold italic"></div>
                    </div>
                    <!-- Row Two -->
                    <div class="h-3/4 flex items-center justify-center" style="background-image: url('../res/iconsHL/step1.png'); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>
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
    </div>

    <script>
    function checkRadio() {
        var radioButtons1 = document.getElementsByName("bordered-radio-1");
        var radioButtons2 = document.getElementsByName("bordered-radio-2");
        var nextButton = document.getElementById("nextButton");
        var selected1 = false;
        var selected2 = false;

        // Check which radio button is selected for the first group
        for (var i = 0; i < radioButtons1.length; i++) {
            if (radioButtons1[i].checked) {
                selected1 = true;
                break;
            }
        }

        // Enable or disable the next button based on selection in both groups
        if (selected1 && selected2) {
            // Determine the next page based on radio button selections
            if (radioButtons1[0].checked) {
                nextButton.parentElement.href = "guardian.php";
            } else if (radioButtons1[1].checked) {
                nextButton.parentElement.href = "beneficiary.html";
            }
            nextButton.disabled = false;
        } else {
            nextButton.disabled = true;
        }
    }
</script>x
</body>
</html>