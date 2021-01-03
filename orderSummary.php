<!DOCTYPE html>
<html>
<head>
	
	<title style="border: 5px solid  #910033;">Order Summary | Project Lamp</title>
</head>
<body>

	<!-- INCLUDING NAVIGATION MENU FILE -->
	<?php include 'navigationMenu.php';?>

	<?php 

		if(session_id() == '') {
	        session_start();
	    }
  		if(!empty($_SESSION['email']) && !empty($_SESSION['currentUserOrderKey'])){
  			// $userEmail = $_POST['email'];
  			require_once "controller/common.php";
  			
  			$userEmail = $_SESSION['email'];
  			$currentUserOrderKey = $_SESSION['currentUserOrderKey'];
			
			$getPizzaRecords = $conn->prepare("SELECT * FROM Pizza where currentOrderKey = '". $currentUserOrderKey ."'");
			$getPizzaRecords->execute();
			$pizzaRecords = $getPizzaRecords->fetchAll();

			$dough = array();
	        $sauce = array();
	        $cheese = array();
	        $toppings = array();
	        
	        if($pizzaRecords != null){
	        	foreach($pizzaRecords as $pizza){
		            array_push($dough, $pizza['dough']);
		            array_push($sauce, $pizza['sauce']);
		            array_push($cheese, $pizza['cheese']);
		            array_push($toppings, $pizza['toppings']);
		        }
	        } 
?>

	
	<div class="container text-blue" style="background-color: white" >
		<div class="mainContent justify-content-center align-items-center" id="mainContent">
			<p class="col-12 ta-center mt-10 lh-15 text-blue">
				<?php echo $_SESSION['email']; ?> ordered:<br> 
				<?php

				for ($i=0; $i < sizeof($dough); $i++) { 
					echo "Pizza#".($i+1).": Dough type:". $dough[$i]. ", Sauce type:".$sauce[$i]. ", Cheese type:".$cheese[$i]. ", Toppings:".$toppings[$i];
					?>
					<br><br>
					
		<?php }?>
				
				<?php
				        $getCustomerRecord = $conn->prepare("SELECT * FROM Customers where email = '". $userEmail ."'");
						$getCustomerRecord->execute();
						$customerRecord = $getCustomerRecord->fetchAll();

						// name address city province postalCode email
						$name = array();
				        $address = array();
				        $city = array();
				        $province = array();
				        $postalCode = array();
				        $email = array();

				        if($customerRecord != null){
				        	foreach($customerRecord as $user){
					            array_push($name, $user['name']);
					            array_push($address, $user['address']);
					            array_push($city, $user['city']);
					            array_push($province, $user['province']);
					            array_push($postalCode, $user['postalCode']);
					            array_push($email, $user['email']);
					        }
				        }   
			  		}
			  	?>
					Pizza will be ready in 40 minutes and will be delivered to Address: <?php
					echo $address[0].", City: ".$city[0].", Province: ".$province[0].", PostalCode: ".$postalCode[0].", Customer: ".$name[0];
					?>.
			</p>

			<div>
				<!-- <input class="btn" type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="toggleDialogVisibility('summaryDialog');"> -->
				<input class="btn" type="button" name="btnCompleteOrder" id="btnCompleteOrder" value="Place Order" onclick="toggleDialogVisibility('thanksDialog'); placeOrder();">
			</div>

			<!-- THANK YOU DIALOG BOX -->
			<div class="popup" id="thanksDialog" style="background-color: white; border: 5px solid #910033;">
				<p class="col-12 ta-center mt-10 lh-15 text-blue">Thank you for placing order on Project Lamp, You order is on its way to you!</p>
				<div>
					<input class="btn" type="button" name="btnCompleteOrder" id="btnCompleteOrder" value="Dismiss!" onclick="window.location='index.php';">
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="assets/js/script.js"></script>

</body>
</html>