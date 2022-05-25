

<?php

$paytype = $_GET['paytype'];
if($paytype == 'card')
{
    ?>

        <div class = "col-md-3">
            <lable>Credit card Referance</lable>
                <input type="text" class="form-control android" name = "cardref" id = "cardref" autocomplete="off" style = "margin-top:10px;margin-bottom:10px;">
            <lable>Credit card Number</lable>
                <input type="text" class="form-control android" name = "cardno" id = "cardno" style = "margin-top:10px;margin-bottom:10px;">
        </div>
    
    <?php
    
}
?>
