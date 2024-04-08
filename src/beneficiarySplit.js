var id = 1;
var totalValue = 0;
function benSplit(name, relationship) {
  // Generate a unique ID

  var uniqueId = `splitID${id}`;
  id++;
  var uniqueIdName = Math.random().toString(36).substr(2, 9);
  var uniqueIdRelationship = Math.random().toString(36).substr(2, 9);
  var uniqueMinus = Math.random().toString(36).substr(2, 9);
  var uniquePlus = Math.random().toString(36).substr(2, 9);
  var uniqueDisplay = `display${id}`;
  var newFormDiv = $("<div></div>");

  newFormDiv.addClass("w-full").attr("id", uniqueId);
  newFormDiv.addClass(" m-1");
  newFormDiv.html(`
</head>

<!--words above calculator-->

<div
class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4 w-full px-3 py-2 bg-white rounded border border-black">
<div class="flex items-center justify-center sm:justify-start">
    <div class="h-24 px-3 py-2 bg-white flex items-center">
        <img src="../res/prof_pic.png" alt="Profile Picture" class="h-full w-full object-contain">
    </div>
    <div class="flex flex-col items-start justify-center ml-2">
        <div>
            <span class="text-lg md:text-xl lg:text-2xl">
                <label id="${uniqueIdName}"></label>
            </span>
        </div>
        <div>
            <span class="text-md md:text-lg lg:text-xl">
                <label id="${uniqueIdRelationship}"></label>
            </span>
        </div>
    </div>
</div>
<div class="flex items-start justify-center sm:justify-end">
    <!--Start of Mess-->

    <div class="flex justify-end items-center">
        <div class="ml-2">
            <div class="text-md md:text-md lg:text-lg text-center">
                Residue of Estate
            </div>
            <div
                class="text-sm md:text-sm lg:text-md text-center items-center justify-center italic">
                After Gifting
            </div>
            <!--calculator-->
            <div class="flex items-center mt-7">

                <!--minus button-->
                <button id="${uniqueMinus}"
                    class="bg-red-500 text-white font-bold px-6 py-4 border border-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 12H4" />
                    </svg>
                </button>

                <!--display percent make input!!!-->
                <span id="${uniqueDisplay}"
                    class="bg-white px-6 py-4 border border-black text-black font-bold inline-flex items-center justify-center">
                    0%
                </span>

                <!--plus button-->
                <button id="${uniquePlus}"
                    class="bg-green-500 text-white font-bold px-6 py-4 border border-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!--End of Mess-->
</div>
`);

  $("#beneficiaryListDiv").append(newFormDiv);

  $("#" + uniqueIdName).html(name);
  $("#" + uniqueIdRelationship).html(relationship);

  splitButtons(uniqueMinus, uniqueDisplay, uniquePlus, id);

  function splitButtons(minusBtnId, displayId, plusBtnId, amount) {
    const display = document.getElementById(displayId);
    const minusBtn = document.getElementById(minusBtnId);
    const plusBtn = document.getElementById(plusBtnId);
    var currentValue = 0;
    display.textContent = currentValue + "%";

    minusBtn.addEventListener("click", () => {
      if (currentValue > 0) {
        // Check if currentValue is greater than 0
        currentValue -= 1;
        totalValue -= 1;
        console.log(totalValue + currentValue);
        console.log("Total Value: " + totalValue);
        display.textContent = currentValue + "%";
      }
      if (totalValue == 100) {
        $("#confirmBtn").removeClass(
          "bg-gray-300 px-4 py-2 rounded-md cursor-not-allowed opacity-50"
        );
        $("#confirmBtn").removeAttr("disabled");
      } else {
        $("#confirmBtn").addClass(
          "bg-gray-300 px-4 py-2 rounded-md cursor-not-allowed opacity-50"
        );
        $("#confirmBtn").prop("disabled", true);
      }
    });

    plusBtn.addEventListener("click", () => {
      // Get the current total value
      if (totalValue < 100) {
        // Check if total + current value is less than 100
        currentValue += 1;
        totalValue += 1;
        console.log(totalValue + currentValue);
        console.log("Total Value: " + totalValue);
        display.textContent = currentValue + "%";
      } else {
        console.warn("Cannot add more, total would exceed 100%");
      }
      if (totalValue == 100) {
        $("#confirmBtn").removeClass(
          "bg-gray-300 px-4 py-2 rounded-md cursor-not-allowed opacity-50"
        );
        $("#confirmBtn").removeAttr("disabled");
      } else {
        $("#confirmBtn").addClass(
          "bg-gray-300 px-4 py-2 rounded-md cursor-not-allowed opacity-50"
        );
        $("#confirmBtn").prop("disabled", true);
      }
    });
  }
}
