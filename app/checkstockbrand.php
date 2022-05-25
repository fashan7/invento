<?php 
session_start();
include 'ControllerStock.php';

$stock = new stockfunctions();

$brandcode = $_REQUEST['brandcode'];

$result = $stock->selectstockbrandbyname($brandcode);
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