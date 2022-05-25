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

    $arrmonth     = array();
    $arrmonth[0]  = 'January';
    $arrmonth[1]  = 'February';
    $arrmonth[2]  = 'March';
    $arrmonth[3]  = 'April';
    $arrmonth[4]  = 'May';
    $arrmonth[5]  = 'June';
    $arrmonth[6]  = 'July';
    $arrmonth[7]  = 'August';
    $arrmonth[8]  = 'September';
    $arrmonth[9]  = 'October';
    $arrmonth[10] = 'November';
    $arrmonth[11] = 'December';

    $data           = array();
    $result         = $sales->getSales();
    $count          = mysqli_num_rows($result);
    
    if($count > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $amount = $row[0];
            $date   = $row[1]; 
            $data[] = array($amount, $date);
        }
    }
    else
    {
        for($i = 0; $i < 12; $i++)
        {
            if($month-1 == $i) 
            {
                $amount = 0;
                $date   = $arrmonth[$i];
                $data[] = array($amount, $date);      
            }
        }
    }
  
//    foreach($result as $row)
//    {
//        $data[] = $row;
//    }
    
    echo json_encode($data);
?>