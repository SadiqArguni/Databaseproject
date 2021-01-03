<?php

    // if(!empty($_SESSION['BOLTZ_USERID']) && !empty($_SESSION['BOLTZ_TEACHERID'])) {

        require_once("Records.php");
        $records = new Records();

        $customerRecords = $records->getAllRecords("Customers");

        $name = array();
        $address = array();
        $city = array();
        $province = array();
        $postalCode = array();
        $email = array();

        if($customerRecords != null)
        foreach($customerRecords as $customers){
            array_push($name, $customers['name']);
            array_push($address, $customers['address']);
            array_push($city, $customers['city']);
            array_push($province, $customers['province']);
            array_push($postalCode, $customers['postalCode']);
            array_push($email, $customers['email']);
        }

        $username = $name[0];
    // }