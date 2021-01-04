<!DOCTYPE html>
<html>
<head>
	<title>Previous Orders | Project Lamp</title>
</head>

	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">

<body>
	<!-- INCLUDING NAVIGATION MENU FILE -->
	<?php include 'navigationMenu.php';

		$userEmail = $_SESSION['email'];
		$currentUserOrderKey = $_SESSION['currentUserOrderKey'];


		$getOrderDetails = $conn->prepare("SELECT * FROM Orders where email = '". $userEmail ."'");
        $getOrderDetails->execute();
        $orderDetails = $getOrderDetails->fetchAll();
        
        $ORDER_DATE = array();
        
        if($orderDetails != null){
            foreach($orderDetails as $detail){
                array_push($ORDER_DATE, $detail['date']);
            }
        }

		
		$getPreviousOrderRecords = $conn->prepare("SELECT * FROM Orders o INNER JOIN PizzaOrders po on o.orderID = po.orderID INNER JOIN Pizza p on p.pizzaID = po.pizzaID where o.email = '". $userEmail ."'");
		$getPreviousOrderRecords->execute();
		$previousOrder = $getPreviousOrderRecords->fetchAll();

		$date = array();
		$dough = array();
        $sauce = array();
        $cheese = array();
        $toppings = array();
        
        if($previousOrder != null){
        	foreach($previousOrder as $order){
        		array_push($date, $order['date']);
	            array_push($dough, $order['dough']);
	            array_push($sauce, $order['sauce']);
	            array_push($cheese, $order['cheese']);
	            array_push($toppings, $order['toppings']);
	        }
        } 

	?>
	
	<!-- Create a web page that displays previously created orders for that user (determined by email) and allow them to view and re-order any previous order. -->

	<div class="container text-blue" >
		<div class="mainContent" id="mainContent" >

			<p class="mt-20" ">Order History:</p>

			<?php if($previousOrder != null)for ($i=0; $i < sizeof($ORDER_DATE); $i++) { ?>

				<button type="button" class="mt-10 collapsible" style="background-color: gray"><?php echo "Order#" . ($i+1) . " Date: " . $ORDER_DATE[$i] ?></button>
				<div class="content d-flex flex-column align-items-center" style="border: 5px solid  #910033;">
				  <p class="mt-10 ta-center lh-15">
				  	<?php
				  		echo "Pizza type: ". $dough[$i]. "<br>Sauce type: ".$sauce[$i]. "<br>Cheese type: ".$cheese[$i]. "<br>Toppings: ".$toppings[$i] . "<br><br>Delivered to Address: ". $address[0]."<br>City: ".$city[0]."<br>Province: ".$province[0]."<br>PostalCode: ".$postalCode[0];
				  	?>
				  		
				  	</p>
				  <input class="btn mt-10" type="button" name="reOrder" value="Order Again" onclick="toggleDialogVisibility('thanksDialog');">
				</div>
			<?php }?>
		</div>
	</div>

	<!-- THANK YOU DIALOG BOX -->
	<div class="popup" id="thanksDialog" style="border: 5px solid  #910033 border: 5px solid  #910033;">
		<p class="col-12 ta-center mt-10 lh-15 text-blue">Thank you for placing order on Project Lamp, You order is on its way to you!</p>
		<div>
			<input class="btn" type="button" name="btnCompleteOrder" id="btnCompleteOrder" value="Dismiss!" onclick="toggleDialogVisibility('thanksDialog');">
		</div>
	</div>

	<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>