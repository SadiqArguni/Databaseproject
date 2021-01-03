<?php

    // name address city province postalCode email currentUserOrderKey
    if( !empty($_POST["name"]) && !empty($_POST["address"]) &&
        !empty($_POST["city"]) && !empty($_POST["province"]) &&
        !empty($_POST['postalCode']) && !empty($_POST['email']) &&
        !empty($_POST['currentUserOrderKey'])) {
        
        require_once("common.php");

        $username = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $postalCode = $_POST['postalCode'];
        $email = $_POST['email'];

        ///////////
        $getUsers = $conn->prepare("SELECT * FROM Customers where email = '". $email ."'");
        $getUsers->execute();
        $users = $getUsers->fetchAll();

        if($users == null){
            $preparedStatement = $conn->prepare('INSERT INTO Customers(name, address, city, province, postalCode, email) VALUES(?,?,?,?,?,?)');
            $preparedStatement->execute([$username, $address, $city, $province, $postalCode, $email]);
            echo "Effected: ". $preparedStatement->rowCount();
        }else{
            echo "email already exists!";
        }
        ///////////
        if(session_id() == '') {
            session_start();
        }
        $_SESSION['currentUserOrderKey'] = $_POST['currentUserOrderKey'];
        $_SESSION['email'] = $email;

        

    }else{
        echo $_POST['name'];
        echo $_POST['address'];
        echo $_POST['city'];
        echo $_POST['province'];
        echo $_POST['postalCode'];
        echo $_POST['email'];
        echo 'Error! Missing delivery information.';
    }
