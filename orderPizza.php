<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		
		.mainContent{
		background-color: white;
		/*border-color: #910033;*/
		border: 5px solid  #910033;
		
		
	};
	</style>
	
	<title>Order Pizza | Project Lamp</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">

</head>
<body>
	<?php
		if(isset($_POST['email'])){
  			// $userEmail = $_POST['email'];
  			require_once "controller/common.php";
  			if(session_id() == '') {
			    session_start();
			}
  			$_SESSION['email'] = $_POST['email'];
  		}

		include 'navigationMenu.php';
	?>
	
	<div class="container text-blue">
		<div class="mainContent" id="mainContent">
			<h1 class="mt-50 col-12 ta-center" style="background-color: gray; color:white;">Order Pizza</h1>
			<form id="createPizzaForm" class="myForm" method="POST">
				
				<label for="doughTypes" class="mt-15 mb-10" for="doughTypes">Choose Pizza Type</label>
				<select class="dropdown" name="doughTypes" id="doughTypes">
					<option value="0" selected disabled>Select Pizza Type</option>
					<option value="Pan Pizza">Pan Pizza</option>
					<option value="Deep Dish Pizza">Deep Dish Pizza</option>
					<option value="Buffalo Pizza">Buffalo Pizza</option>
				</select>

				<label for="sauceTypes" class="mt-15" for="sauceTypes">Choose Sauce Type</label>
				<select class="dropdown" name="sauceTypes" id="sauceTypes">
					<option value="0" selected disabled>Select Sauce Type</option>
					<option value="Pesto Sauce">Pesto Sauce</option>
					<option value="White Garlic Sauce">White Garlic Sauce.</option>
					<option value="Garlic Ranch Sauce">Garlic Ranch Sauce</option>
				</select>

				<div class="mt-15 mb-10">
					<label for="toppings">Choose Toppings</label><br>  
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_1" onclick="return ValidateToppings();">Topping 1</label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_2" onclick="return ValidateToppings();">Topping 2</label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_3" onclick="return ValidateToppings();">Topping 3<br>  </label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_4" onclick="return ValidateToppings();">Topping 4</label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_5" onclick="return ValidateToppings();">Topping 5</label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_6" onclick="return ValidateToppings();">Topping 6<br>  </label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_7" onclick="return ValidateToppings();">Topping 7</label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_8" onclick="return ValidateToppings();">Topping 8</label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_9" onclick="return ValidateToppings();">Topping 9<br>  </label>
				    <label><input type="checkbox"  class="m-5 mt-10 mb-10"name="toppings" value="topping_10" onclick="return ValidateToppings();">Topping 10</label>
				</div> 

			    <label for="cheeseTypes" class="mt-15" for="cheeseTypes">Choose Cheese Type</label>
				<select class="dropdown" name="cheeseTypes" id="cheeseTypes">
					<option value="0" selected disabled>Select Cheese Type</option>
					<option value="cheeseType_1">Cheese Type 1</option>
					<option value="cheeseType_2">Cheese Type 2</option>
					<option value="cheeseType_3">Cheese Type 3</option>
				</select>

				<!-- FOR MULTIPLE ORDERS ONLY -->
				<input class="btn" type="button" name="btnMultipleOrder" id="btnMultipleOrder" value="Add another Pizza to Order" onclick="if(validateOrderInput()){addPizzaRecord();}">

				<!-- ask if user would like to add another pizza or complete their order -->
				<!-- IF USER EXISTS, USE THE SAME ADDRESS ELSE ASK FOR ADDRESS -->
				<input class="btn" type="button" name="btnCompleteOrder" id="btnCompleteOrder" value="Complete order" onclick="if(validateOrderInput()){toggleDialogVisibility('confirmDialog');}">
				
				

			</form>
		</div>
	</div>

	<!-- CONFIRMATION DIALOG BOX -->
	<div class="popup" id="confirmDialog" style="border: 5px solid  #910033; ">
		<p>Would you like to add another Pizza </p>
		<div>
			<input class="btn" type="button" name="btnYes" id="btnYes" value="Yes" onclick="toggleDialogVisibility('confirmDialog'); addPizzaRecord();">
			<input class="btn" type="button" name="btnNo" id="btnNo" value="Proceed to checkout" onclick="toggleDialogVisibility('confirmDialog'); toggleDialogVisibility('addressDialog'); addPizzaRecord();">
		</div>
	</div>

	<!-- DELIVERY DETAILS DIALOG BOX -->
	<div class="popup" id="addressDialog" style="border: 5px solid  #910033;">
		<!-- doughTypes, sauceTypes, toppings, cheeseTypes -->
		<!-- username, address, city, province, postalCode -->
		<input class="textField" type="text" name="username" id="username" placeholder="Please enter your name">
		<input class="textField" type="text" name="address" id="address" placeholder="Please enter delivery address">
		<input class="textField" type="text" name="city" id="city" placeholder="Please enter your city">
		<input class="textField" type="text" name="province" id="province" placeholder="Please enter your province">
		<input class="textField" type="text" name="postalCode" id="postalCode" placeholder="Please enter postal code">
		<input type="hidden" name="userEmail" id="userEmail" value='<?php echo $_SESSION["email"]; ?>'>
		<div>
			<!-- <input class="btn" type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="toggleDialogVisibility('addressDialog');"> -->
			<input class="btn" type="button" name="btnCompleteOrder" id="btnOrderSummary" value="Order Summary" onclick="if(validateAddressInput())addUserInformation(); //window.location = 'orderSummary.php';">
		</div>
	</div>
	<!-- Name, Address, City, Province, Postal Code -->

	<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>