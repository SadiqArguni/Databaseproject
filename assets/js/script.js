var btnCompleteOrder = document.getElementById("btnCompleteOrder");
var confirmDialog = document.getElementById("confirmDialog");
var createPizzaForm = document.getElementById("createPizzaForm");
var mainContent = document.getElementById("mainContent");


//CreatePizza form variables
var doughTypes = document.getElementById("doughTypes");
var sauceTypes = document.getElementById("sauceTypes");
var toppings = document.getElementById("toppings");
var cheeseTypes = document.getElementById("cheeseTypes");

var numberOfCheckedItems = 0; 

//Delivery form variables
var username = document.getElementById("username");
var address = document.getElementById("address");
var city = document.getElementById("city");
var province = document.getElementById("province");
var postalCode = document.getElementById("postalCode");
var email = document.getElementById("userEmail");



function ValidateToppings()  {  
    var checkboxes = document.getElementsByName("toppings");  
    numberOfCheckedItems = 0;  
    for(var i = 0; i < checkboxes.length; i++)  
    {  
        if(checkboxes[i].checked)  
            numberOfCheckedItems++;  
    }  
    if(numberOfCheckedItems > 5)  
    {  
        alert("You can't select more than five toppings!");  
        return false;  
    }

}  


function toggleDialogVisibility(elemName){
    var dialogBox = document.getElementById(elemName);
    if(dialogBox.style.visibility == "visible"){
        dialogBox.style.visibility = "hidden";
        // mainContent.style.pointerEvents = "auto";
    }else{
        dialogBox.style.visibility = "visible";
        // mainContent.style.pointerEvents = "none";
    }
    
    // dialogBox.style.opacity = '1';
}

// .reset()

function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}


var currentUserOrderKey = makeid(10);
var toppingString = "";

// function createAnotherPizza(){
    
//     //print key for current user order
//     console.log("CurrentUser OrderKey: " + currentUserOrderKey);

//     console.log("Dough Type = " + doughTypes.value + "\n");
//     console.log("Sauce Type = " + sauceTypes.value + "\n");

//     //CHECK BOX VALUES
//     // var selectedToppings = [];
    

//     console.log("Topping Type = ");
//     for (var i = 0; i < checkboxes.length; i++) {
//       // selectedToppings.push(checkboxes[i].value);
//       console.log(checkboxes[i].value +" ");
//       // toppingString +=checkboxes[i].value +" ";
//     }
//     //CHECK BOX VALUES
    
//     console.log("\nCheese Type = " + cheeseTypes.value + "\n");

//     createPizzaForm.reset();
    
// }

// <!-- doughTypes, sauceTypes, toppings, cheeseTypes -->

function addPizzaRecord() {
    var request = new XMLHttpRequest();
    request.open("POST", "controller/addPizzaRecord.php");

    // Retrieving the form data
    var formData = new FormData();

    console.log("CurrentUser OrderKey: " + currentUserOrderKey);
    console.log("Dough Type = " + doughTypes.value);
    console.log("Sauce Type = " + sauceTypes.value);
    console.log("Cheese Type = " + cheeseTypes.value);

    formData.set("currentOrderKey", currentUserOrderKey);

    formData.set("doughTypes", doughTypes.value);
    formData.set("sauceTypes", sauceTypes.value);

    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
    for (var i = 0; i < checkboxes.length; i++) {
      toppingString +=checkboxes[i].value +" ";
    }
    console.log("Toppings: " + toppingString);
    formData.set("toppings", toppingString);
    formData.set("cheeseTypes", cheeseTypes.value);
    request.send(formData);

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log("Response from addPizza: " + response);
        }
    };
    createPizzaForm.reset();
    toppingString = "";
}

// username, address, city, province, postalCode
function addUserInformation() {
    var request = new XMLHttpRequest();
    request.open("POST", "controller/addUserInformation.php");

    // Retrieving the form data
    var formData = new FormData();

    console.log("Name = " + username.value);
    console.log("Address = " + address.value);
    console.log("City = " + city.value);
    console.log("Province = ", province.value);
    console.log("Postal Code: ", postalCode.value);
    console.log("Email: ", email.value);

    formData.set("name", username.value);
    formData.set("address", address.value);
    formData.set("city", city.value);
    formData.set("province", province.value);
    formData.set("postalCode", postalCode.value);
    formData.set("email", email.value);
    formData.set("currentUserOrderKey", currentUserOrderKey);

    request.send(formData);

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log("Response userinfo: " + response);
            window.location = 'orderSummary.php';
        }
    };
}

function placeOrder() {
    var request = new XMLHttpRequest();
    request.open("POST", "controller/placeOrder.php");

    // Retrieving the form data
    var formData = new FormData();

    formData.set("key_1", "KEY_1");

    request.send(formData);

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log("Order message: " + response);
            // window.location = 'orderSummary.php';
        }
    };
}



function validateOrderInput(){
    if(doughTypes.value == "0" || sauceTypes.value == "0" || cheeseTypes.value == "0" || numberOfCheckedItems == 0){
        alert("Please complete pizza order by adding all required ingredients above.");
        return false;
    }else{
        return true;
    }
}

function validateAddressInput(){
    if(username.value == "" || address.value == "" || city.value == "" || province.value == "" || postalCode.value == ""){
        alert("Please input delivery information to continue.");
        return false;
    }else{
        return true;
    }
}



// PREVIOUS ORDERS COLLAPSING EFFECT CODE
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
