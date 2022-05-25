<style>
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}
table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}
table tr {
  background: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}
table th,
table td {
  padding: .625em;
  text-align: center;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
@media screen and (max-width: 600px) {
  table {
    border: 0;
  }
  table caption {
    font-size: 1.3em;
  }
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  table td:before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  table td:last-child {
    border-bottom: 0;
  }
}
</style>  
<table id="myTable" class=" table order-list">
    <caption>Payment Table</caption>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Payment Date</th>
            <th scope="col">Payment Amount</th>            
        </tr>
    </thead>
    <tbody>
        <?php 
        //$downpayment        = $_POST['downpayment'];
        $paymentduration    = $_POST['paymentduration'];
        $subtotal           = $_POST['subtotal'];
        $nextpaymentdate    = $_POST['nextpaymentdate'];
        //$sumamount          = $subtotal - $downpayment;
        
        date_default_timezone_set('Asia/Colombo');
        $nowdate           = date('Y-m-d');
        
        $j = 1;
        for($i = 1; $i <= $paymentduration; $i++)
        {
            $payamount = $subtotal / $paymentduration;
            if($i == 1)
            {
               ?>
                <tr>
                    <td data-label="#"><?=$i?></td>
                    <td data-label="Payment Date"><?=$nextpaymentdate?></td>
                    <td data-label="Payment Amount"><?=number_format($payamount,2)?></td>
                </tr>
                <?php  
            }
            else
            {
                $minus = $j-1;
                $incrementdate = date('Y-m-d', strtotime('+'.$minus.' month', strtotime($nextpaymentdate)));
                ?>
                <tr>
                    <td data-label="#"><?=$i?></td>
                    <td data-label="Payment Date"><?=$incrementdate?></td>
                    <td data-label="Payment Amount"><?=number_format($payamount,2)?></td>
                </tr>
                <?php
            }
            $j++;
        } 
        ?>
    </tbody>
</table>