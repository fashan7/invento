<?php 
session_start();
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    if(!$loguserid)
    {
	   header("Location:login.php");
    }

    include 'ControllerPage.php';
    include 'ControllerQuery.php';
    include 'ControllerStock.php';
    include 'ControllerCustomer.php';
    include 'ControllerUsers.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();

$password = $_REQUEST['password'];

$enctypepassword = base64_encode($password);
$result = $usersettings->selectuserbyid($loguserid);
$count = mysqli_num_rows($result);
$fetch = mysqli_fetch_array($result);

if ($fetch['password'] != $enctypepassword)
{
    echo  'false';
}
else
{
    echo  'true';
}

?>