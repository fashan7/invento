<?php 
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    include 'ControllerStock.php';
    $stock     = new stockfunctions();

    $return_arr = array();

    $categoryid = mysqli_real_escape_string($stock->bridge, $_GET['itemcatid']);

    $search = mysqli_real_escape_string($stock->bridge, $_GET['term']);

    $result = $stock->SearchbrandbyNameandid($search ,$categoryid);

    while($row = mysqli_fetch_array($result))
    {
        $row_array['value'] = $row[0];  
        $row_array['brandid'] = $row[1];
        array_push($return_arr, $row_array);
    }
    echo json_encode($return_arr);
?>


