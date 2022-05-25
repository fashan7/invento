<?php 
session_start();
include 'ControllerUsers.php';

$usersettings = new userfunctions();

$usertype = $_REQUEST['usertype'];

$result = $usersettings->selectusertypebyname($usertype);
$count = mysqli_num_rows($result);

if ($count > 0)
{
    echo  'false';
}
else
{
    echo 'true';
}

?>