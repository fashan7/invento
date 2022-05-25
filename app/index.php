<?php include 'header.php';?>
<?php include 'sidnav.php';
date_default_timezone_set('Asia/Colombo');
$date    = date('Y-m-d');
$month   = date('m');
$year    = date('Y');
$day     = date('d');
?>
<script type="text/javascript" src="salesChart.js"></script>
<script type="text/javascript" src="salesDayChart.js"></script>
      <div class="container-fluid mimin-wrapper">
             <div id="content">


                <div class="col-md-12" style="padding:20px;">
                                  <h3><center><strong>This Is Your Dashborad</strong></center></h3>
                    <div class="col-md-12 padding-0">
                        <div class="col-md-8 padding-0">
                            <div class="col-md-12 padding-0">
                                <div class="col-md-6">
                                    <div class="panel box-v1" style = "background-color:#c7c7c7">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Sales </h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <?php
                                          $sqlgetSalescomplete = $sales->getSalescomplete();
                                          $fetchgetSalescomplete = mysqli_fetch_array($sqlgetSalescomplete);
                                          ?>
                                        <h1>Rs <?=number_format($fetchgetSalescomplete[0])?></h1>
                                        <p>Total Sales</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel box-v1" style = "background-color:#a5e0a0">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Sales</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <?php
                                          $sqlgetSalesyear = $sales->getSalesyear();
                                          $fetchgetSalesyear = mysqli_fetch_array($sqlgetSalesyear);
                                          ?>
                                        <h1>Rs <?=number_format($fetchgetSalesyear[0])?></h1>
                                        <p>Total Sales For This Year</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="panel box-v1" style = "background-color:#a0dbe0">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Sales</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                          <?php
                                          $sqlgetdaySales = $sales->getdaySales();
                                          $fetchgetdaySales = mysqli_fetch_array($sqlgetdaySales);
                                          ?>
                                        <h1>Rs <?=number_format($fetchgetdaySales[0])?></h1>
                                        <p>Total Sales For Today</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="panel box-v1" style = "background-color:yellow">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Products</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="fa fa-registered text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                          <?php
                                            $sqlselectstockregbyitemandcat = $stock->selectstockreg();
                                            $countsqlselectstockregbyitemandcat = mysqli_num_rows($sqlselectstockregbyitemandcat);
                                            ?>
                                        <h1><?=$countsqlselectstockregbyitemandcat?></h1>
                                        <p>Total Number Of Stock</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="col-md-12 padding-0">
                              <div class="panel box-v3">

                                <div class="panel-body">
                                     <?php
                                            $sqlselectstockregbyitemandcat = $stock->selectstockreg();
                                            $countsqlselectstockregbyitemandcat = mysqli_num_rows($sqlselectstockregbyitemandcat);
                                            if($countsqlselectstockregbyitemandcat <= 0)
                                            {
                                            ?>
                                            <center><h2><strong>Sorry Could Not find any products</strong></h2></center>
                                            <?php
                                            }
                                            else
                                            {
                                            $i = 1;
                                            while($fetchselectstockregbyitemandcat = mysqli_fetch_array($sqlselectstockregbyitemandcat))
                                            {
                                                if($i < 4)
                                                {
                                            ?>

                                  <div class="media">
                                    <div class="media-left">
                                        <span class="icon-pie-chart icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                      <h5 class="media-heading"><?=$fetchselectstockregbyitemandcat['name']?> </h5>
                                        
                                            <?php
                                                $itemcode = $fetchselectstockregbyitemandcat['code'];
                                                $sqlselectstockqtybycode = $stock->selectstockqtybycode($itemcode);
                                                $fetchselectstockqtybycode = mysqli_fetch_array($sqlselectstockqtybycode);
                                                    
                                                    
                                                $quantity = $fetchselectstockqtybycode['quantity'];
                                                $avalablequantity = $fetchselectstockqtybycode['available_qty'];
                                                    
                                                $calculateqty = ($quantity - $avalablequantity)/$quantity * 100;
                                                $calculateqtytotal = 100 - $calculateqty;
                                                ?>
                                        
                                            <?php
                                                    
                                        if($calculateqtytotal <= '0') 
                                            {
                                                
                                               ?>
                                        <p>(Empty!)</p>
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php
                                            }
                                           else if($calculateqtytotal <= '25') 
                                            {
                                                
                                               ?>
                                        <p>(Runing Low)</p>
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php
                                            }
                                            else if ($calculateqtytotal <= '50')
                                            {
                                                
                                               ?>
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php  
                                            }
                                            else if ($calculateqtytotal <= '75')
                                            {
                                                
                                               ?>
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php  
                                            }
                                            else if ($calculateqtytotal <= '100')
                                            {
                                                
                                               ?>
                                            
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php  
                                            }
                                            ?>
                                          
                                              
                                          
                                        
                                    </div>
                                  </div>
                                     <?php
                                            $i++;
                                            }
                                            }
                                            }
                                            ?> 
                                    <center><button name="btn-update" class="btn ripple-infinite btn-round btn-info" data-toggle="modal" data-target="#myModal">View All</button></center>
                                      <div class="container">
                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Stock Tracker</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                                  $sqlselectstockregbyitemandcat = $stock->selectstockreg();
                                                                $countsqlselectstockregbyitemandcat = mysqli_num_rows($sqlselectstockregbyitemandcat);
                                                                if($countsqlselectstockregbyitemandcat <= 0)
                                                                {
                                                                ?>
                                                                <center><h2><strong>Sorry Could Not find any products</strong></h2></center>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                               
                                                                while($fetchselectstockregbyitemandcat = mysqli_fetch_array($sqlselectstockregbyitemandcat))
                                                                {
                                                                  
                                                                ?> 
                                                                <div class="media">
                                                                <div class="media-left">
                                                                    <span class="icon-pie-chart icons" style="font-size:2em;"></span>
                                                                </div>
                                                                   <div class="media-body">
                                      <h5 class="media-heading"><?=$fetchselectstockregbyitemandcat['name']?> </h5>
                                        
                                            <?php
                                                $itemcode = $fetchselectstockregbyitemandcat['code'];
                                                $sqlselectstockqtybycode = $stock->selectstockqtybycode($itemcode);
                                                $fetchselectstockqtybycode = mysqli_fetch_array($sqlselectstockqtybycode);
                                                    
                                                    
                                                $quantity = $fetchselectstockqtybycode['quantity'];
                                                $avalablequantity = $fetchselectstockqtybycode['available_qty'];
                                                    
                                                $calculateqty = ($quantity - $avalablequantity)/$quantity * 100;
                                                $calculateqtytotal = 100 - $calculateqty;
                                                ?>
                                        
                                            <?php
                                                    
                                            if($calculateqtytotal <= '0') 
                                            {
                                                
                                               ?>
                                        <p>(Empty!)</p>
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php
                                            }
                                           else if($calculateqtytotal <= '25') 
                                            {
                                                
                                               ?>
                                        <p>(Runing Low)</p>
                                            <div class="progress ">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php
                                            }
                                            else if ($calculateqtytotal <= '50')
                                            {
                                                
                                               ?>
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php  
                                            }
                                            else if ($calculateqtytotal <= '75')
                                            {
                                                
                                               ?>
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php  
                                            }
                                            else if ($calculateqtytotal <= '100')
                                            {
                                                
                                               ?>
                                            
                                            <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?=$calculateqtytotal?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$calculateqtytotal?>%;">
                                            <span class="sr-only"><?=$calculateqtytotal?>% Avalable</span>
                                            </div>
                                            </div>
                                                <?php  
                                            }
                                            ?>
                                          
                                              
                                          
                                        
                                    </div>
                                                              </div>
                                                               <?php
                                                                $i++;
                                                                
                                                                }
                                                                }
                                                                ?> 
                                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                              </div>
                            </div>

                        </div>
                    </div>
                    <?php  
                    $arrmonth     = array();
                    $arrmonth[0]  = 'January';
                    $arrmonth[1]  = 'February';
                    $arrmonth[2]  = 'March';
                    $arrmonth[3]  = 'April';
                    $arrmonth[4]  = 'May';
                    $arrmonth[5]  = 'June';
                    $arrmonth[6]  = 'July';
                    $arrmonth[7]  = 'August';
                    $arrmonth[8]  = 'September';
                    $arrmonth[9]  = 'October';
                    $arrmonth[10] = 'November';
                    $arrmonth[11] = 'December';
                    ?>
                    <div class="col-md-12">
                        <div class="panel">
                          <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                              <h4>Sales Chart For 
                                  <?php 
                                  for($i = 0; $i < 12; $i++)
                                  {
                                      if($month-1 == $i) 
                                          echo $arrmonth[$i]." ".$year;
                                  } 
                                  ?>                                      
                              </h4>
                            </div>
<!--
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-primary" style="margin-top:10px;">
                                  <input type="checkbox" name="onoffswitch3" class="onoffswitch-checkbox" id="myonoffswitch3" checked>
                                  <label class="onoffswitch-label" for="myonoffswitch3"></label>
                                </div>
                            </div>
-->
                          </div>
                          <div class="panel-body" style="padding-bottom:50px;">
                              <div id="canvas-holder1">
                                <canvas  id="mysaleschart" class="bar-chart"></canvas>

                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel">
                          <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                              <h4>Sales Chart For Today                                     
                              </h4>
                            </div>
<!--
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-primary" style="margin-top:10px;">
                                  <input type="checkbox" name="onoffswitch3" class="onoffswitch-checkbox" id="myonoffswitch3" checked>
                                  <label class="onoffswitch-label" for="myonoffswitch3"></label>
                                </div>
                            </div>
-->
                          </div>
                          <div class="panel-body" style="padding-bottom:50px;">
                              <div id="canvas-holder1">
                                <canvas  id="daysaleschart" class="bar-chartday"></canvas>
                              </div>
                          </div>
                        </div>
                    </div>
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      
                    <div class="col-md-6">
                      <div class="panel form-element-padding">  
                          <div class="panel-heading bg-white border-none">
                                  <h4>Stock Report</h4>
                                </div>
                          <div class="panel-body" style="padding-bottom:30px;">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Selling Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlselectstockregbyitemandcat = $stock->selectstockreg();
                                            $countsqlselectstockregbyitemandcat = mysqli_num_rows($sqlselectstockregbyitemandcat);
                                            if($countsqlselectstockregbyitemandcat <= 0)
                                            {
                                            ?>
                                            <center><h2><strong>Sorry Could Not find any products</strong></h2></center>
                                            <?php
                                            }
                                            else
                                            {
                                            $i = 1;
                                            while($fetchselectstockregbyitemandcat = mysqli_fetch_array($sqlselectstockregbyitemandcat))
                                            {
                                                if($i < 7)
                                                {
                                            ?>
                                            <tr>
                                            <td>
                                                <label><?=$i?></label>
                                            </td>
                                            <td>
                                                <label><?=$fetchselectstockregbyitemandcat['name']?></label>
                                            </td>
                                            <td>
                                                <?php
                                                $itemcode = $fetchselectstockregbyitemandcat['code'];
                                                $sqlselectstockqtybycode = $stock->selectstockqtybycode($itemcode);
                                                $fetchselectstockqtybycode = mysqli_fetch_array($sqlselectstockqtybycode);
                                                    
                                                    
                                                $quantity = $fetchselectstockqtybycode['quantity'];
                                                ?>
                                                <label><?=$quantity?></label>
                                            </td>
                                            <td>
                                                <label>Rs <?= number_format($fetchselectstockregbyitemandcat['sellingprice'],2)?> </label>
                                            </td>
                                            </tr> 
                                            <?php
                                            $i++;
                                            }
                                            }
                                            }
                                            ?>             
                                            </tbody>
                                        </table>
                                    </div>  
                              <a href = ""><center><button name="btn-update" class="btn ripple-infinite btn-round btn-info" data-toggle="modal" data-target="#myModal">View All</button></center></a>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="panel form-element-padding">  
                          <div class="panel-heading bg-white border-none">
                                  <h4>Sales Report</h4>
                                </div>
                          <div class="panel-body" style="padding-bottom:30px;">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Sold</th>
                                            <th scope="col">Earned</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlselectstockregbyitemandcat = $stock->selectstockreg();
                                            $countsqlselectstockregbyitemandcat = mysqli_num_rows($sqlselectstockregbyitemandcat);
                                            if($countsqlselectstockregbyitemandcat <= 0)
                                            {
                                            ?>
                                            <center><h2><strong>Sorry Could Not find any products</strong></h2></center>
                                            <?php
                                            }
                                            else
                                            {
                                            $i = 1;
                                            while($fetchselectstockregbyitemandcat = mysqli_fetch_array($sqlselectstockregbyitemandcat))
                                            {
                                                if($i < 7)
                                                {
                                            ?>
                                            <tr>
                                            <td>
                                                <label><?=$i?></label>
                                            </td>
                                            <td>
                                                <label><?=$fetchselectstockregbyitemandcat['name']?></label>
                                            </td>
                                            <td>
                                                <?php
                                                $itemcode = $fetchselectstockregbyitemandcat['code'];
                                                $sqlselectstockqtybycode = $stock->selectstockqtybycode($itemcode);
                                                $fetchselectstockqtybycode = mysqli_fetch_array($sqlselectstockqtybycode);
                                                    
                                                    
                                                $quantity = $fetchselectstockqtybycode['quantity'] - $fetchselectstockqtybycode['available_qty'];
                                                ?>
                                                <label><?=$quantity?></label>
                                            </td>
                                            <td>
                                                <?php
                                                $itemid = $fetchselectstockregbyitemandcat['id'];
                                                $sqlselectbillsum = $sales->selectbillsum($itemid);
                                                $fetchselectbillsum = mysqli_fetch_array($sqlselectbillsum);
                                                ?>
                                    
                                                <label>Rs <?= number_format($fetchselectbillsum[0],2)?> </label>
                                            </td>
                                            </tr> 
                                            <?php
                                            $i++;
                                            }
                                            }
                                            }
                                            ?>             
                                            </tbody>
                                        </table>
                                    </div>  
                              <a href = ""><center><button name="btn-update" class="btn ripple-infinite btn-round btn-info" data-toggle="modal" data-target="#myModal">View All</button></center></a>
                          </div>
                      </div>
                    </div>
                      
                    <div class="col-md-6">
                      <div class="panel form-element-padding">  
                          <div class="panel-heading bg-white border-none">
                                  <h4>Customer Report</h4>
                                </div>
                          <div class="panel-body" style="padding-bottom:30px;">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlselectcustomer = $customer->selectcustomer();
                                            $countselectcustomer = mysqli_num_rows($sqlselectcustomer);
                                            if($countselectcustomer <= 0)
                                            {
                                            ?>
                                            <center><h2><strong>Sorry Could Not find any products</strong></h2></center>
                                            <?php
                                            }
                                            else
                                            {
                                            $i = 1;
                                            while($fetchselectcustomer = mysqli_fetch_array($sqlselectcustomer))
                                            {
                                                if($i < 7)
                                                {
                                            ?>
                                            <tr>
                                            <td>
                                                <label><?=$i?></label>
                                            </td>
                                            <td>
                                                <label><?=$fetchselectcustomer['name']?></label>
                                            </td>
                                            <td>
                                                <label><?=$fetchselectcustomer['phone_no']?></label>
                                            </td>
                                            <td>
                                                <label><?= $fetchselectcustomer['email']?> </label>
                                            </td>
                                            </tr> 
                                            <?php
                                            $i++;
                                            }
                                            }
                                            }
                                            ?>             
                                            </tbody>
                                        </table>
                                    </div>  
                              <a href = ""><center><button name="btn-update" class="btn ripple-infinite btn-round btn-info" data-toggle="modal" data-target="#myModal">View All</button></center></a>
                          </div>
                      </div>
                    </div>
                      
                    <div class="col-md-6">
                      <div class="panel form-element-padding">  
                          <div class="panel-heading bg-white border-none">
                                  <h4>Supplier Report</h4>
                                </div>
                          <div class="panel-body" style="padding-bottom:30px;">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlselectsupplier= $customer->selectsupplier();
                                            $countselectsupplier= mysqli_num_rows($sqlselectsupplier);
                                            if($countselectsupplier <= 0)
                                            {
                                            ?>
                                            <center><h2><strong>Sorry Could Not find any products</strong></h2></center>
                                            <?php
                                            }
                                            else
                                            {
                                            $i = 1;
                                            while($fetchselectsupplier = mysqli_fetch_array($sqlselectsupplier))
                                            {
                                                if($i < 7)
                                                {
                                            ?>
                                            <tr>
                                            <td>
                                                <label><?=$i?></label>
                                            </td>
                                            <td>
                                                <label><?=$fetchselectsupplier['name']?></label>
                                            </td>
                                            <td>
                                                <label><?=$fetchselectsupplier['phone_no']?></label>
                                            </td>
                                            <td>
                                                <label><?=$fetchselectsupplier['email']?> </label>
                                            </td>
                                            </tr> 
                                            <?php
                                            $i++;
                                            }
                                            }
                                            }
                                            ?>             
                                            </tbody>
                                        </table>
                                    </div> 
                              <a href = ""><center><button name="btn-update" class="btn ripple-infinite btn-round btn-info" data-toggle="modal" data-target="#myModal">View All</button></center></a>
                          </div>
                          
                      </div>
                        
                    </div>
                      
                  </div>
              </div>


                </div>
      		  </div>

          <!-- end: content -->

    
          <!-- start: right menu -->
  
          <!-- end: right menu -->
          
      </div>

</body>
</html>
