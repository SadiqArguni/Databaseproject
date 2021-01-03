<!DOCTYPE html>
<html>
<head>
	
	</style>
  <link rel="stylesheet" type="text/css" href="assets/css/navigation-styles.css">
  <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body style="background-image: url(Backgrounds.jpg)">
  <div class="navmenu" >

  	<?php 
  		if(session_id() == '') {
			    session_start();
		}
  		if(!empty($_SESSION['email'])){
  			require_once "controller/common.php";
  			
  			$userEmail = $_SESSION['email'];
			
			$getUsers = $conn->prepare("SELECT * FROM Customers where email = '". $userEmail ."'");
			$getUsers->execute();
			$users = $getUsers->fetchAll();

			$name = array();
	        $address = array();
	        $city = array();
	        $province = array();
	        $postalCode = array();
	        $email = array();

	        if($users != null){
	        	foreach($users as $user){
		            array_push($name, $user['name']);
		            array_push($address, $user['address']);
		            array_push($city, $user['city']);
		            array_push($province, $user['province']);
		            array_push($postalCode, $user['postalCode']);
		            array_push($email, $user['email']);
		        }
		        $username = $name[0];	
		        ?>
		        <a><?php  echo "Hi! " .$username; ?></a>
		        <?php
	        }   
  		}
  	?>

  	<!-- If the user already exists, display their name in the navigation menu after they've entered their email. -->
    
    <a href="orderPizza.php">Order Pizza</a>
    <a href="userInformation.php">User Information</a>
    <a href="previousOrders.php">Previous Orders</a>
    <button onclick="myFunction()">Log Out</button>
    <script>
	function myFunction(){
 	 location.replace("index.php")
	}
	</script>
  </div>

</body>
</html>