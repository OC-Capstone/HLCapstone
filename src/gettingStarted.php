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
    <div id="mySidenav" class="sidenav">
        <?php include("navbar.html"); ?>
    </div>
    <!-- Container -->
    <div>
        <!-- Header -->
        <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex justify-between items-center px-4 z-1">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <div id="title" class="text-white font-lato font-bold text-shadow-md text-2xl sm:text-4xl md:text-4xl">Getting started</div>
            <a href="#"><i class="fa-solid fa-trash text-white text-4xl"></i></a>
        </div>


        <div class="bg-white flex justify-center items-start mt-20">
            <form class="text-center" id="myForm1">
                <div class="mb-4">
                    <input type="radio" name="kids?" value="kids?" id="kidsRadio"> 
                    <label for="kids?" class="inline-block">Do you have kids?</label>
                </div>
            </form>
        </div>
        
        <div class="bg-white flex justify-center items-start">
            <form class="text-center" id="myForm2">
                <div class="mb-4">
                    <label>Would you prefer your estate split between primary and alternate beneficiaries? Or percent split?</label>
                </div>
                <div class="mb-2">
                    <input type="radio" name="estateSplit" value="estateSplit"> 
                    <label for="estateSplit" class="inline-block">Estate split between primary and alternate beneficiaries</label>
                </div>
                <div class="mb-2">
                    <input type="radio" name="percentSplit" value="percentSplit"> 
                    <label for="percentSplit" class="inline-block">Percent split of estate</label>
                </div>
            </form>
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
                        <div class="w-64 h-7 text-center text-zinc-600 sm:text-lg md:text-xl font-semibold italic">Placeholder Text</div>
                    </div>
                    <!-- Row Two -->
                    <div class="h-3/4 flex items-center justify-center" style="background-image: url('../res/iconsHL/step1.png'); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>
                </div>
                <!-- Column Three -->
                <div class="flex items-center justify-center">
                    <a href="#" id="nextButton"><img src="../res/iconsHL/arrow_next.png" width="150px" height="100px"></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('nextButton').addEventListener('click', function() {
            if (document.getElementById('kidsRadio').checked) {
                window.location.href = 'create_guardian.php';
            } else {
                window.location.href = 'Beneficiary.html';
            }
        });
   

document.getElementById('nextButton').addEventListener('click', function() {
    if (document.getElementById('kidsRadio').checked) {
        window.location.href = 'create_guardian.php';
    } else if (document.querySelector('input[name="estateSplit"]:checked')) {
        window.location.href = 'primaryAltSequence.php';
    } else if (document.querySelector('input[name="percentSplit"]:checked')) {
        window.location.href = 'beneficiarySplit.php';
    } else {
        window.location.href = 'Beneficiary.html';
    }
});

// Disable the percentSplit radio button when the estateSplit radio button is checked
document.querySelectorAll('input[name="estateSplit"]').forEach(function(radio) {
    radio.addEventListener('click', function() {
        document.querySelectorAll('input[name="percentSplit"]').forEach(function(percentRadio) {
            percentRadio.disabled = this.checked;
        }, this);
    });
});

// Disable the estateSplit radio button when the percentSplit radio button is checked
document.querySelectorAll('input[name="percentSplit"]').forEach(function(radio) {
    radio.addEventListener('click', function() {
        document.querySelectorAll('input[name="estateSplit"]').forEach(function(estateRadio) {
            estateRadio.disabled = this.checked;
        }, this);
    });
});

document.getElementById('nextButton').addEventListener('click', function() {
    var kidsChecked = document.getElementById('kidsRadio').checked;
    var estateSplitChecked = document.querySelector('input[name="estateSplit"]:checked');
    var percentSplitChecked = document.querySelector('input[name="percentSplit"]:checked');
    
    if (kidsChecked && (estateSplitChecked || percentSplitChecked)) {
        if (estateSplitChecked) {
            window.location.href = 'primaryAltSequence.php';
        } else {
            window.location.href = 'beneficiarySplit.php';
        }
    } else {
        alert("Please select at least one option for 'Do you have kids?' and either 'Estate split between primary and alternate beneficiaries' or 'Percent split of estate'.");
    }
});

</script>
</body>
</html>
