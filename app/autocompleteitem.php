<?php 
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    include 'ControllerStock.php';
    $stock     = new stockfunctions();

    $return_arr = array();
    $search = mysqli_real_escape_string($stock->bridge, $_GET['term']);

    $result = $stock->SearchItembyName($search);

    while($row = mysqli_fetch_array($result))
    {
        $row_array['value'] = $row[0];  
        $row_array['itemcode'] = $row[1];
        $row_array['sellprice'] = $row[4];
        $row_array['unitprice'] = $row[3];
        $row_array['hidquan'] = $row[2];
        array_push($return_arr, $row_array);
    }
    echo json_encode($return_arr);
?>