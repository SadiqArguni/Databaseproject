<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	.mainContent{
		background-color: white;
		border: 5px solid  #910033;		
	};	
</style>
	<title>Welcome | Project Lamp</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body style="background-image: url(Backgrounds.jpg)">
	<?php ?>
	
	<div class="container absolute-center">
		<div class="mainContent" id="mainContent">
	
			<h1 class="col-12 ta-center mt-10 text-blue" style="background-color: gray; color: white;">Welcome to Pizza Delivery Service</h1>
			<p class="col-12 ta-center mt-10 lh-15 text-blue">We provide you an  Pizza Delivery Service. How this works is simple enter your email, create pizza with your delivery address verify the order and you are done. You will receive the pizza that you have made at your door steps. Enjoy Pizza and Remember Us!</p>

			<form class="myForm mt-20" action="orderPizza.php" id="beginForm" method="POST">
				<fieldset style="align-items: center; border-color: #910033;">
					 <legend >&nbsp Email Here Please &nbsp</legend>
				<label for="email" class="text-blue">&nbsp  Please enter your email to get started!</label>
				<input class="textField mt-10 text-blue" type="email" name="email" id="email" placeholder="example@gmail.com">
				<input class="btn" type="submit" name="begin" id="begin" value="Begin">
				</fieldset>
				</form>
		</div>
	</div>
</body>
</html>