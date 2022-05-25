<?php 
session_start();
include 'ControllerQuery.php';

$object = new sqlfunctions();

$username = $_REQUEST['username'];

$result = $object->validatedusename($username);
$count = mysqli_num_rows($result);

if ($count > 0)
{
    echo  'false';
}
else
{
    echo  'true';
}

?>