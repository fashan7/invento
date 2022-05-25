<?php include 'header.php';?>
      <!-- end: Header -->
<?php include 'sidnav.php';?>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
              <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft"><?= $_GET['pagename']?></h3>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 ">
                <div class="col-md-12 padding-0">
                    <?php
                    $sectionname = $_GET['pagename'];
                    $pagesection = $obj->getsubsection4($loguserid, $sectionname);
                    while($fetchsection = mysqli_fetch_array($pagesection))
                    {                                      
                    ?>
                  <div class="col-md-4">
                      <a href = "<?= $fetchsection[0];?>">
                  <div class="panel">
                    <div class="panel-heading lg-white ">
                      <center><h4><strong><i><?= $fetchsection[1];?></i></strong></h4></center>
                    </div>
                    <div class="panel-body">
                      <center>
                            <div class="sub-wheather" style= "margin-bottom:20px;">
                                <h1 style = "font-size:700%;color:#2196F3" class = "<?=$fetchsection[2];?>" ></h1>
                            </div>
                      </center>
                    </div>
                  </div>
                          </a>
                  </div>                 
                <?php }?>
                </div>
                </div>
              </div>
        </div>


  <!-- end: Javascript -->
  </body>
</html>