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
  var newFormDiv = $('<div></div>');

  newFormDiv.addClass("w-full").attr('id', uniqueId);

  newFormDiv.html(`
</head>

<!--words above calculator-->
  <div class="border-2 border-black w-full h-40 relative">
    <div class="flex justify-end">
      <h1 class="text-xl mr-12 text-black separate-lines">Residue of estate <br>
      </div>

        <div class="flex mr-24 justify-end">
          <span class="text-sm stext-gray-600" style="font-style: italic;">After gifting</span>
      </div>


    <!--name and relationship outputs-->
    <div class="flex-grow w-full ml-24 mb-5 flex items-center">
      <label id="${uniqueIdName}">
    </div>
    
    <div class="flex items-center mt-5 ml-5 top-0 right-0 bottom-0" style="margin-top: -45px;">
      <img src="../res/prof_pic.png" alt="Profile Picture" class="object-contain" style="height: 70px; width: 70px;">
  </div>
  
    <div class="flex-grow w-full ml-24 mb-10flex items-center">
      <label id="${uniqueIdRelationship}">
    </div>


    <!--calculator-->
    <div class="flex items-center absolute mt-7 top-0 right-0 bottom-0">
      <div class="flex justify-end mr-5">

       <!--minus button-->
        <button id="${uniqueMinus}" class="bg-red-500 text-white font-bold px-6 py-4 border border-black">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
          </svg>
        </button>

        <!--display percent make input!!!-->
        <span id="${uniqueDisplay}" class="bg-white px-4 py-4 border border-black text-xl inline-flex"></span>
  
        <!--plus button-->
        <button id="${uniquePlus}" class="bg-green-500 text-white font-bold px-6 py-4 border border-black ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
        </button>
      </div>
    </div>
  </div>
  </div>
`);

  $('#beneficiaryListDiv').append(newFormDiv);

  $('#' + uniqueIdName).html(name);
  $('#' + uniqueIdRelationship).html(relationship);

  splitButtons(uniqueMinus, uniqueDisplay, uniquePlus, id);

  
  function splitButtons(minusBtnId, displayId, plusBtnId, amount) {
    const display = document.getElementById(displayId);
    const minusBtn = document.getElementById(minusBtnId);
    const plusBtn = document.getElementById(plusBtnId);
    var currentValue = 0;
    display.textContent = currentValue + "%";


    minusBtn.addEventListener('click', () => {
      if (currentValue > 0) { // Check if currentValue is greater than 0
        currentValue -= 1;
        totalValue -=1;
        console.log(totalValue + currentValue);
        console.log("Total Value: " + totalValue);
        display.textContent = currentValue + "%";
      }
    });

    plusBtn.addEventListener('click', () => {
       // Get the current total value
      if (totalValue < 100) { // Check if total + current value is less than 100
        currentValue += 1;
        totalValue +=1;
        console.log(totalValue + currentValue);
        console.log("Total Value: " + totalValue);
        display.textContent = currentValue + "%";
      } else {
        console.warn("Cannot add more, total would exceed 100%");
      }
    });
  }
  
  
}
