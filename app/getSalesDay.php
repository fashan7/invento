<?php
    include 'ControllerPage.php';
    include 'ControllerQuery.php';
    include 'ControllerStock.php';
    include 'ControllerCustomer.php';
    include 'ControllerUsers.php';
    include 'ControllerInventory.php';
    include 'ControllerSales.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();
    $inventory      = new inventoryfunction();
    $sales          = new salesFunction();
    
    date_default_timezone_set('Asia/Colombo');
    $month          = date('m');
    $fulldate       = date('Y-m-d');

    $data           = array();
    $result         = $sales->getdaySales();
    $count          = mysqli_num_rows($result);
    
    if($count > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $amount = $row[0];
            $date   = $row[1]; 
            $invoice= $row[2];
            $data[] = array($amount, $date, $invoice);
        }
    }
    else
    {
        $amount = 0;
        $date   = $fulldate;
        $invoice= '0000';
        $data[] = array($amount, $date, $invoice);   
    }

    
    echo json_encode($data);
?>