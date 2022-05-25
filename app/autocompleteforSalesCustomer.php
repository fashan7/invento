<?php 
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    include 'ControllerCustomer.php';
    $customer       = new customerfunctions();

    $return_arr = array();
    $search = mysqli_real_escape_string($customer->bridge, $_GET['term']);

    $result = $customer->SearchcustomerbyName($search);

    while($row = mysqli_fetch_array($result))
    {
        $row_array['value']         = $row[0];
        $row_array['customerid']    = $row[1];
        $row_array['customercode']  = $row[4];
        $row_array['phone']         = $row[3];
        $row_array['address']       = $row[2];
        array_push($return_arr, $row_array);
    }
    echo json_encode($return_arr);
?>