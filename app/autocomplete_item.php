<?php

    session_start();
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    include 'ControllerQuery.php';
    $obj     = new sqlfunctions();
    
   


if(isset($_POST['search']))
{
    $search = mysqli_real_escape_string($this->bridge, $_POST['search']);

    $result = $obj->test($search);

 $response = array();
    while($row = mysql_fetch_array($result))
    {
        $response[] = array("value"=>$row['code'],"label"=>$row['code']);
    }

 echo json_encode($response);
}

exit;
?>
