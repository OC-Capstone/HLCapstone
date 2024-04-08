<?php
session_start();

// Check if the user has selected "no" or "yes"
if (isset($_GET['selected_no'])) {
  $_SESSION['selected_radio'] = $_GET['selected_no'];
} elseif (isset($_GET['selected_yes'])) {
  $_SESSION['selected_radio'] = $_GET['selected_yes'];
}

// Check if the user has navigated back from the Beneficiary Page
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'BeneficiaryPage.php') !== false) {

  // User navigated back from Beneficiary Page
  if ($_SESSION['selected_radio'] == 'gettingStarted.php') {
    // Redirect to Getting Started Page only if the referer is not the gettingStarted page
    if (strpos($_SERVER['HTTP_REFERER'], 'gettingStarted.php') === false) {
      header("Location: gettingStarted.php");
      exit();
    }
  } else {
    // Redirect to Guardian Page
    header("Location: guardian.php");
    exit();
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Testamentary Wishes</title>
  <!-- Include Tailwind CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(e) {
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == "false") {
            console.log(this.responseText);
            window.location.href = "login.html";
          } else {
            console.log(this.responseText);
          }
        }
      };
      xhttp.open("POST", "checkCookie.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send();
    });
  </script>
  <script>
    // Create an empty object to store beneficiary data
    var beneficiaries = {};

    // Add a new beneficiary to the object
    function createBeneficiaryObject() {
      var beneficiaryId = $('.beneficiary:last()').data('id'); // Get ID from latest beneficiary
      return {
        id: beneficiaryId, // Store ID in the object
        name: $("#beneficiaryName").val(),
        relationship: $("#relationship").val(),
        financialGift: $("#amount").val(),
        gifts: []
      };
    }

    // Add a gift to a specific beneficiary
    function addGift(beneficiaryIndex) {
      var gift = {
        name: $("#giftName").val(),
        details: $("#giftDetails").val()
      };
      beneficiaries[beneficiaryIndex].gifts.push(gift);
    }
  </script>
  <script>
    $(document).ready(function(e) {

      $("form").submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        var beneficiaries = []; // Empty array to hold beneficiary objects

        // Loop through beneficiary sections in the form
        $(".beneficiary").each(function() {
          var beneficiaryId = $(this).data('id'); // Get unique ID from HTML
          var name = $(this).find("#fullBeneficiaryName").val();
          var relationship = $(this).find("#relationship").val();
          var financialGift = $(this).find("#amount").val();


          var gifts = []; // Empty array to hold gift objects

          // Loop through gift sections within the beneficiary section
          $(this).find(".gift").each(function() {
            var giftName = $(this).find("#giftName").val();
            var giftDetails = $(this).find("#giftDetails").val();

            gifts.push({
              name: giftName,
              details: giftDetails
            });
          });

          beneficiaries.push({
            id: beneficiaryId,
            name: name,
            relationship: relationship,
            financialGift: financialGift,
            gifts: gifts
          });
        });

        // Prepare data to send (beneficiaries object)
        var data = {
          beneficiaries: beneficiaries
        };

        // Prepare data to send (beneficiaries object)
        e.preventDefault(); // Prevent default form submission

        $.ajax({
          url: 'Beneficiary.php', // Replace with your PHP file path
          type: 'POST',
          data: JSON.stringify(data), // Convert object to JSON string
          contentType: 'application/json', // Set content type
          success: function(response) {
            console.log(response); // Handle response from PHP script
            // You can also display a success message or redirect the page here
            alert(response);
          },
          error: function(error) {
            console.error(error); // Handle errors during submission
          }
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $(".close").click(function() {
        $('#popup').addClass('hidden');
      });
    });
  </script>
</head>


<body class="bg-white font-sans">
  <div id="mySidenav" class="sidenav">
  </div>
  <!-- Container -->
  <div>
    <!-- Header -->
    <div class="fixed top-0 left-0 w-full h-16 bg-red-600 flex items-center justify-between px-4 z-10">
      <span id="menu-icon" style="font-size:30px; cursor:pointer;" onclick="openNav()">&#9776;</span>
      <div id="title" class="text-white font-bold text-shadow-md text-2xl sm:text-4xl md:text-4xl">
        Testamentary Wishes
      </div>
      <div></div>
    </div>

    <div class="mx-4 items-center mt-20 h-full">
      <div id="main_div">
        <form id="beneficiaryForm">
          <div class="w-full px-3 py-2 bg-white flex flex-col justify-center items-center ">
            <div class="w-full rounded flex justify-center">

            </div>

            <!--important button-->

            <button type="button" id="addGuardianButton" class=" self-stretch h-12 mt-1 px-3 mb-12 py-2 bg-white rounded-none border border-black flex justify-center items-center gap-3">
              + Add New Gift beneficiary
            </button>
          </div>

          <!-- submit button for, idek anymore -->
          <button type="submit" id="submitBTN" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mx-auto block mb-2">
            Submit
          </button>
        </form>


        <div class="relative ">
          <div class="footer w-full h-32 bg-white relative inset-x-0 flex justify-center grid grid-cols-3 gap-4">

            <div class="flex items-center justify-center">

              <a href="<?php echo $_SESSION['selected_radio']; ?>">
                <script>
                  console.log("<?php echo $selected_radio; ?>");
                </script>
                <img src="../res/iconsHL/arrow_back.png" width="150px" height="100px">
              </a>
            </div>
            <div class="flex flex-col items-center">
              <div class="h-1/4 flex items-center justify-center">

              </div>
              <div class="h-3/4 flex items-center justify-center"><img src="../res/iconsHL/dots.jpg"></div>
            </div>
            <div class="flex items-center justify-center">
              <a href="beneficiarySplit.html">
                <img src="../res/iconsHL/arrow_next.png" width="150px" height="100px">
              </a>
            </div>
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
  </script>




  <script>
    document.getElementById('addGuardianButton').addEventListener('click', function() {
      var uniqueId = Math.random().toString(36).substr(2, 9);
      var newFormDiv = document.createElement('div');
      newFormDiv.classList.add('beneficiary', 'w-full', 'px-3', 'py-2', 'bg-white', 'rounded', 'border', 'border-black', 'flex-col', 'gap-3', 'mt-4', 'mb-12', 'top-10', 'relative');
      newFormDiv.setAttribute('data-id', uniqueId);
      newFormDiv.innerHTML = `
    
        <i class="fas fa-trash text-black text-lg absolute top-0 right-0 mr-3 mt-3 cursor-pointer"></i> 

        <div class=" flex w-full items-center">
            <div class=" w-full  h-24 px-3 py-2  bg-white flex items-center">
                <img src="../res/prof_pic.png" alt="Profile Picture" class="h-full object-contain">
                <div class="ml-2">
                    <div class="flex items-center">
                                             <!--thing-->
                        <input type="text" id="fullBeneficiaryName" placeholder="Full Name" class="w-full text-lg md:text-xl ml-6 mb-2 lg:text-2xl border-b-2 border-gray-400 focus:outline-none focus:border-blue-500">
                        <!-- <button><i class="fas fa-edit"></i></button> -->
                    </div>
                    <div>                    <!--thing-->
                        <input type="text" id="relationship" placeholder="Relationship" class="w-fulltext-md md:text-lg  ml-6 lg:text-xl border-b-2 border-gray-400 focus:outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- "Specific Gifts" -->
        <div class="w-full bg-red-600 rounded justify-start items-center pl-1 gap-1.5 inline-flex mb-1">
            <img class=" w-5 h-5" src="../res/iconsHL/dashboard.png">
            <div class="text-white text-lg font-extrabold leading-10">Specific Gifts</div>
        </div>

        <!-- Financial Gifts -->
        <div class="w-full h-full px-3 py-2 bg-white rounded border border-black justify-start items-center gap-3 inline-flex  mb-1"> 
            <img class="w-5 h-5 items-start" src="../res/iconsHL/cash.png">
            <div class="grow shrink basis-0 text-stone-950 text-base font-normal leading-normal w-full">
                Financial Gifts:</div>
            <div class="w-full pl-4 pr-2 py-1 bg-white rounded justify-end items-end flex">
                <div class="flex-col justify-end items-end inline-flex">
                        <div class="relative border-2 rounded border-zinc-600">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-gray-500">$</span>
                                              <!--thing-->
                            <input type="number" id="amount" name="amount" min="0" max="9999999" step="500" value="0" class="pl-8">
                        </div>
                </div>
            </div>
        </div>

        <!-- Gift Details #1 -->
        <div class="gift w-full min-h-[min-height] px-3 py-2 bg-white rounded border border-black justify-start items-start gap-3 inline-flex flex-wrap mb-1 giftDetails">
            <img class="w-5 h-5" src="../res/iconsHL/gift.png">
            <div class="flex-grow w-full">
                <p class="text-gray-700 font-sm w-full">Gift:</p>
                                    <!--thing-->
                <input type="text" id="giftName" placeholder="Gift Name" class="w-1/2 text-md md:text-lg  ml-6 mb-6 lg:text-xl border-b-2 border-gray-400 focus:outline-none focus:border-blue-500">
                <p class="text-gray-700 font-sm w-full">Details:</p>
                <textarea id="giftDetails" placeholder="Gift Details" class="resize-y w-1/2 text-md md:text-lg ml-6 lg:text-xl border-b-2 border-gray-400 focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <div class="flex-col justify-end items-end inline-flex flex-shrink-0">
                    <div class="relative">
                        <!-- <i class="fas fa-edit"></i> -->
                    </div>
            </div>
        </div>
        <button type="button" class="self-stretch h-12 w-full mt-4 py-2 bg-white rounded-none border border-black flex justify-center items-center gap-3 addGiftButton">+ Add New Gift</button> <!--Do Not touch! you'll break everything-->
    </div>`;

      var parentElement = this.parentElement;
      parentElement.insertBefore(newFormDiv, this);

      var deleteIcon = newFormDiv.querySelector('.fa-trash');
      deleteIcon.addEventListener('click', function() {
        parentElement.removeChild(newFormDiv);
      });

      var addGiftButton = newFormDiv.querySelector('.addGiftButton');
      addGiftButton.addEventListener('click', function() {
        var newGiftDiv = document.createElement('div');
        newGiftDiv.classList.add('gift', 'w-full', 'h-full', 'px-3', 'py-2', 'bg-white', 'rounded', 'border', 'border-black', 'justify-start', 'items-start', 'gap-3', 'inline-flex', 'mb-1', 'relative');
        newGiftDiv.innerHTML = `
          
            <i class="fas fa-trash text-black text-lg absolute top-0 right-0 mr-1 cursor-pointer"></i> <!-- Delete icon positioned top right -->
            <img class="w-5 h-5" src="../res/iconsHL/gift.png">
            <div class="flex-grow w-full">
                <p class="text-gray-700 font-sm w-full">Gift:</p>
                <input type="text" id="giftName" placeholder="Gift Name" class="w-1/2 text-md md:text-lg  ml-6 mb-6 lg:text-xl border-b-2 border-gray-400 focus:outline-none focus:border-blue-500">
                <p class="text-gray-700 font-sm w-full">Details:</p>
                <textarea id="giftDetails" placeholder="Gift Details" class="resize-y w-1/2 text-md md:text-lg ml-6 lg:text-xl border-b-2 border-gray-400 focus:outline-none focus:border-blue-500"></textarea>
            </div>`;
        var parentContainer = newFormDiv.querySelector('.giftDetails');
        parentContainer.appendChild(newGiftDiv);

        var deleteIcon = newGiftDiv.querySelector('.fa-trash');
        deleteIcon.addEventListener('click', function() {
          parentContainer.removeChild(newGiftDiv);
        });
      });
    });
  </script>

</body>

</html>