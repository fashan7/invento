<?php 
session_start();
include 'ControllerUsers.php';

$usersettings = new userfunctions();

$branchname = $_REQUEST['branchname'];

$result = $usersettings->selectbranchbyname($branchname);
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