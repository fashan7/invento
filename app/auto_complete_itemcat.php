<?php 
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    include 'ControllerStock.php';
    $stock     = new stockfunctions();

    $return_arr = array();

    //$category = mysqli_real_escape_string($stock->bridge, $_GET['itemcats']);
    $search = mysqli_real_escape_string($stock->bridge, $_GET['term']);

    $result = $stock->SearchcatbyName($search);

    while($row = mysqli_fetch_array($result))
    {
        $row_array['value'] = $row[0];  
        $row_array['catid'] = $row[1];
        array_push($return_arr, $row_array);
    }
    echo json_encode($return_arr);
?>


