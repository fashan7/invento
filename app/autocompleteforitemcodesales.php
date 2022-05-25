<?php 
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    include 'ControllerStock.php';
	include 'ControllerInventory.php';

    $stock     = new stockfunctions();
	$inventory      = new inventoryfunction();

    $return_arr = array();
    $search = mysqli_real_escape_string($stock->bridge, $_GET['term']);

    $result = $stock->SearchItembyName($search);

    while($row = mysqli_fetch_array($result))
    {
		$itemcode = $row[1];
		$resultstock = $inventory->getQuantitybyItemCode($itemcode); //getting available stocks on stock_master
		$countstock = mysqli_fetch_array($resultstock);
		
        $row_array['value'] = $row[1];  
        $row_array['itemname'] = $row[0];
        $row_array['sellprice'] = $row[4];
		$row_array['hidsellprice'] = $row[4];
		$row_array['showquan'] = $countstock[0];
		$row_array['hidquan'] = $countstock[0];
		
        array_push($return_arr, $row_array);
    }
    echo json_encode($return_arr); 
?>