<?php 
session_start();
include 'ControllerStock.php';

$stock = new stockfunctions();

$itemcode = $_REQUEST['itemcode'];

$result = $stock->selectstockregcheck($itemcode);
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