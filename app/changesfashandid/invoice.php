<?php 
    include 'header.php';
    include 'sidnav.php';
    date_default_timezone_set('Asia/Colombo');
    $date                  = date('Y-m-d');

    $maxinvoiceIdResult = $sales->maxInvoiceNo();
    $rowmaxinvoiceId    = mysqli_fetch_array($maxinvoiceIdResult);

    if($rowmaxinvoiceId[0] == '')
    {
        $invoiceno = '0001';
    }
    else
    {
        $incrementorder = $rowmaxinvoiceId[0] + 1;
        $invoiceno = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
    }
?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    
$(document).ready(function(){
    $("#salesorderno").change(function(){
        var salesorderno = $("#salesorderno").val();        
        $.post("getSalesOrdertoInvoice.php", {
			salesorderno:salesorderno,
		},			
		function(data,status) {
			$("#getsalesorderdetails").empty();			
			$("#getsalesorderdetails").append(data);
		});
    });
});
</script>
<div class="container-fluid mimin-wrapper">
    <div id="content">
        <div class="panel box-shadow-none content-header">
            <div class="panel-body">
                <div class="col-md-12">
                    <h3 class="animated fadeInLeft">Invoice</h3>
                    <p class="animated fadeInDown">
                      Sales Related <span class="fa-angle-right fa"></span> Invoice
                    </p>
                </div>
            </div>
        </div>
        <form class="form" id="invoiceform" name="invoiceform" action="invoicesub.php" method="post" enctype="multipart/form-data">
        <div class="form-element">
            <div class="col-md-12 padding-0"> 
                <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="panel form-element-padding">
                            <div class="panel-body" style="padding-bottom:30px;">
                                <div class = "col-md-12">
                                    <div class="col-md-4"> 
                                        <label>Order No</label>
                                        <br><br>                                  
                                        <select class="form-control" style = "width:100%:" name="salesorderno" id="salesorderno">
                                            <option value="">-- Please Select --</option>
                                            <?php
                                            $resultSalesOrder = $sales->getAllSalesOrder();
                                            while($rowSalesOrder = mysqli_fetch_array($resultSalesOrder))
                                            {
                                                ?>
                                                <option value="<?=$rowSalesOrder['orderno']?>"><?=$rowSalesOrder['orderno']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-right" style="padding-bottom:15px;">Invoice No</label>
                                        <input type="text" class="form-control android" name="invoiceno" id="invoiceno" value="<?=$invoiceno?>" readonly>
                                    </div>                       
                                    <div class="col-md-4"> 
                                        <label style = "margin-bottom:20px;">Invoice Date</label>
                                        <input type="text" class="form-text mask-placeholder form-control android" placeholder="MM/DD/YYYY" value="<?=$date?>" name="invoicedate" id="invoicedate">
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                    <div id="getsalesorderdetails"></div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
  </body>
</html>.
