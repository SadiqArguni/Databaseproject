<?php

    if( !empty($_POST["doughTypes"]) && !empty($_POST["sauceTypes"]) &&
        !empty($_POST["toppings"]) && !empty($_POST["cheeseTypes"]) &&
        !empty($_POST['currentOrderKey'])) {
        
        require_once("common.php");

        $dough = $_POST['doughTypes'];
        $sauce = $_POST['sauceTypes'];
        $cheese = $_POST['cheeseTypes'];
        $toppings = $_POST['toppings'];
        $currentOrderKey = $_POST['currentOrderKey'];

        // dough   sauce   cheese  toppings    currentOrderKey
        $preparedStatement = $conn->prepare('INSERT INTO Pizza(dough, sauce, cheese, toppings, currentOrderKey) VALUES(?,?,?,?,?)');
        $preparedStatement->execute([$dough, $sauce, $cheese, $toppings, $currentOrderKey]);
        echo "Effected: ". $preparedStatement->rowCount();

    }else{
        echo 'Error! Missing ingredients for pizza.';
    }
