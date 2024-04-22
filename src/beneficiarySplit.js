var id = 1;
var totalValue = 0;
var amtben = 0;
var uniqueDisplay = "";
var $benIDIndex;
function benSplit(name, relationship) {
  // Generate a unique ID
  amtben++;
  var uniqueId = `splitID${id}`;
  id++;
  var uniqueIdName = Math.random().toString(36).substr(2, 9);
  var uniqueIdRelationship = Math.random().toString(36).substr(2, 9);
    uniqueDisplay = `display${id}`;
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
            <div class="flex items-center justify-end mt-7 border border-black">
                <!--display percent make input!!!-->
                <input id="${uniqueDisplay}"
                    class="bg-white px-6 py-4 w-full focus:outline-none  text-black font-bold" value="0" readonly>
                    <!--trash button-->
            <i class="fas fa-trash text-black text-lg pr-2 cursor-pointer" style="float: right;"></i>
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
  var firstSpan;
  var secondSpan;
  
  splitButtons(uniqueDisplay, id);
  newBeneficiary.push({ divID: uniqueId });
  function splitButtons(displayId) {
    const display = document.getElementById(displayId);
    var currentValue = 0;
    // display.value = 100/amtben + "%";
    $(document).ready(function () {
      newBeneficiary.forEach(beneficiary => {
        $benIDIndex = $("#" + beneficiary.divID + " input:first");
        $benIDIndex.val(100 / amtben + "%");
        console.log($benIDIndex.val());
        console.log("beneficiary.divID");
      });
    });
    //trash button

    var parentContainer = newFormDiv.find('.beneficiaryListDiv');
    parentContainer.append(newFormDiv);
    $(document).ready(function () {
    });
    var deleteIcon = newFormDiv.find('.fa-trash');
    deleteIcon.on('click', function () {
      var newFormDivId = newFormDiv.attr("id");
      firstSpanText = $("#" + newFormDivId + " span:first").text().trim();
      secondSpanText = $("#" + newFormDivId + " span:last").text().trim();
      console.log(firstSpanText);
      console.log(secondSpanText);
      newFormDiv.remove();
      amtben--;
      $(document).ready(function () {
        newBeneficiary.forEach(beneficiary => {
          $benIDIndex = $("#" + beneficiary.divID + " input:first");
          $benIDIndex.val(100 / amtben + "%");
          console.log("beneficiary.divID");
        });
      });
      if (amtben == 0) {
        $('#confirmBtn').addClass("hidden");
      }
      if (deletedOptions.length > 0) {
        deletedOptions.forEach(option => {
          var foundOption = option.name == firstSpanText && option.relation == secondSpanText;
          if (foundOption) {
            console.log("FOUND!");
            var optionAdding = $('<option></option>');
            optionAdding.text(option.name + " - " + option.relation);
            optionAdding.val(option.name);
            $('#beneficiaryList').append(optionAdding);
          }
          deletedOptions = deletedOptions.filter(option => option.name != firstSpanText && option.relation != secondSpanText);
          newBeneficiary = newBeneficiary.filter(beneficiary => beneficiary.divID != newFormDivId);
          beneficiaryArray = beneficiaryArray.filter(beneficiary => beneficiary.name != firstSpanText);
        });
      }
    });




    $(document).ready(function () {
      // Add event listener to the input field
      $(display).on("keyup", function (e) {
        console.log("Change value");
      }).on("focus", function () {
        $(this).parent().css("border", "2px solid #000");
      }).on("blur", function () {
        $(this).parent().css("border", "1px solid #000");
      });

    });
  }
}
