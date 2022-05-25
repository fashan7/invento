<?php 
session_start();
include 'ControllerStock.php';

$stock = new stockfunctions();

$cat = $_REQUEST['stock_cat'];

$result = $stock->selectstockcatbyname($cat);
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