<?php

    if(session_id() == '') {
        session_start();
    }
    if( !empty($_SESSION['email']) && !empty($_SESSION['currentUserOrderKey'])) {
        
        require_once("common.php");

        $email = $_SESSION['email'];
        $currentUserOrderKey = $_SESSION['currentUserOrderKey'];

        $preparedStatement = $conn->prepare('INSERT INTO Orders(date, email) VALUES(now(),?)');
        $preparedStatement->execute([$email]);
        echo "Effected: ". $preparedStatement->rowCount();

        $stm = $conn->prepare("SELECT orderID FROM Orders where email = '". $email ."'");
        $stm->execute();
        $orderIDs = $stm->fetchAll();
        
        $ORDER_ID = array();
        
        if($orderIDs != null){
            foreach($orderIDs as $value){
                array_push($ORDER_ID, $value['orderID']);
            }
        }

        $my_order = $ORDER_ID[0];


        $getPizzaRecords = $conn->prepare("SELECT pizzaID FROM Pizza where currentOrderKey = '". $currentUserOrderKey ."'");
        $getPizzaRecords->execute();
        $pizzaRecords = $getPizzaRecords->fetchAll();

        $pizzaID = array();
        
        if($pizzaRecords != null){
            foreach($pizzaRecords as $pizza){
                array_push($pizzaID, $pizza['pizzaID']);
            }
        }

        foreach ($pizzaID as $id) {
            $preparedStatement = $conn->prepare('INSERT INTO PizzaOrders(pizzaID, orderID) VALUES(?,?)');
            $preparedStatement->execute([$id, $my_order]);
        }

    }else{
        echo 'Error! Missing Order information.';
    }
