<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li>
                <div class="left-bg"></div>
            </li>
            <li class="time">
                <h1 class="animated fadeInLeft">21:00</h1>
                <p class="animated fadeInRight">Sat,October 1st 2029</p>
            </li>
            <li class="active ripple">
                <a href = "index.php">
                    <span class="fa-home fa"></span> Dashboard 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
            </li>
            
                <?php
                $resPage = $obj->selectPageSide($loguserid);
                while($rowPage = mysqli_fetch_array($resPage))
                {
                    if($rowPage[0] == 'Stock Related')
                    {
                        $icon = 'fa-diamond fa';
                        $navName = 'Stock Related';
                    }
                    else if($rowPage[0] == 'Sales Related')
                    {
                        $icon = 'fa-area-chart fa';
                        $navName = 'Sales Related';
                    }
                    else if($rowPage[0] == 'Inventory')
                    {
                        $icon = 'fa fa-balance-scale';
                        $navName = 'Inventory';
                    }
                    else if($rowPage[0] == 'Reports')
                    {
                        $icon = 'fa fa-calendar';
                        $navName = 'Reports';
                    }
                    else if($rowPage[0] == 'Customer Related')
                    {
                        $icon = 'fa fa-user';
                        $navName = 'Customer Related';
                    }
                    else if($rowPage[0] == 'User Settings')
                    {
                        $icon = 'fa fa-gear';
                        $navName = 'User Settings';
                    }
                    
                    $select_enable_hedding = $obj->enablePriviledge($loguserid, $navName);            	
					$result_enable_hedding = mysqli_num_rows($select_enable_hedding);
                    
                    if ($result_enable_hedding >= 1) 
				    {
				    ?>
                    <li class="ripple">
                        <a href = "openpage.php?pagename=<?= $navName?>" >
                            <span class="<?=$icon?>"></span><?=$navName?>
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                        </a>
                    </li>
				    <?php
					}
					else {}
                }
                ?>
                
        </ul>
    </div>
</div>
<div id="mimin-mobile" class="reverse">
    <div class="mimin-mobile-menu-list">
        <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
            <ul class="nav nav-list">
                <li class="active ripple">
                    <a  href = "index.php">
                        <span class="fa-home fa"></span>Dashboard 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                </li>
                <?php
                $resPages = $obj->selectPageSide($loguserid);
                while($rowPage = mysqli_fetch_array($resPages))
                {
                    if($rowPage[0] == 'Stock Related')
                    {
                        $icon = 'fa-diamond fa';
                        $navName = 'Stock Related';
                    }
                    else if($rowPage[0] == 'Sales Related')
                    {
                        $icon = 'fa-area-chart fa';
                        $navName = 'Sales Related';
                    }
                    else if($rowPage[0] == 'Inventory')
                    {
                        $icon = 'fa fa-balance-scale';
                        $navName = 'Inventory';
                    }
                     else if($rowPage[0] == 'Reports')
                    {
                        $icon = 'fa fa-calendar';
                        $navName = 'Reports';
                    }
                    else if($rowPage[0] == 'Customer Related')
                    {
                        $icon = 'fa fa-user';
                        $navName = 'Customer Related';
                    }
                    else if($rowPage[0] == 'User Settings')
                    {
                        $icon = 'fa fa-gear';
                        $navName = 'User Settings';
                    }
                    
                    $select_enable_hedding = $obj->enablePriviledge($loguserid, $navName);            	
					$result_enable_hedding = mysqli_num_rows($select_enable_hedding);
                    
                    if ($result_enable_hedding >= 1) 
				    {
				    ?>
                    <li class="ripple">
                        <a href = "openpage.php?pagename=<?= $navName?>" >
                            <span class="<?=$icon?>"></span><?=$navName?>
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                        </a>
                    </li>
				    <?php
					}
					else {}
                }
                ?>
            </ul>
        </div>
    </div>       
</div>
<button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
    <span class="fa fa-bars"></span>
</button>

 <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery.ui.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
   
    
    <!-- plugins -->
    <script src="asset/js/plugins/moment.min.js"></script>
    <script src="asset/js/plugins/fullcalendar.min.js"></script>
    <script src="asset/js/plugins/jquery.nicescroll.js"></script>
    <script src="asset/js/plugins/jquery.vmap.min.js"></script>
    <script src="asset/js/plugins/maps/jquery.vmap.world.js"></script>
    <script src="asset/js/plugins/jquery.vmap.sampledata.js"></script>
    <script src="asset/js/plugins/chart.min.js"></script>


    <script src="asset/js/plugins/jquery.knob.js"></script>
    <script src="asset/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="asset/js/plugins/bootstrap-material-datetimepicker.js"></script>
    <script src="asset/js/plugins/jquery.nicescroll.js"></script>
    <script src="asset/js/plugins/jquery.mask.min.js"></script>
    <script src="asset/js/plugins/select2.full.min.js"></script>
    <script src="asset/js/plugins/nouislider.min.js"></script>
    <script src="asset/js/plugins/jquery.validate.min.js"></script>
    <!-- custom -->
     <script src="asset/js/main.js"></script>
     <script type="text/javascript">
  $(document).ready(function(){

    $("#signupForm").validate({
      errorElement: "em",
      errorPlacement: function(error, element) {
        $(element.parent("div").addClass("form-animate-error"));
        error.appendTo(element.parent("div"));
      },
      success: function(label) {
        $(label.parent("div").removeClass("form-animate-error"));
      },
      rules: {
        validate_firstname: "required",
        validate_lastname: "required",
        validate_username: {
          required: true,
          minlength: 2
        },
        validate_password: {
          required: true,
          minlength: 5
        },
        validate_confirm_password: {
          required: true,
          minlength: 5,
          equalTo: "#validate_password"
        },
        validate_email: {
          required: true,
          email: true
        },
        validate_agree: "required"
      },
      messages: {
        validate_firstname: "Please enter your firstname",
        validate_lastname: "Please enter your lastname",
        validate_username: {
          required: "Please enter a username",
          minlength: "Your username must consist of at least 2 characters"
        },
        validate_password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        validate_confirm_password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long",
          equalTo: "Please enter the same password as above"
        },
        validate_email: "Please enter a valid email address",
        validate_agree: "Please accept our policy"
      }
    });

    // propose username by combining first- and lastname
    $("#username").focus(function() {
      var firstname = $("#firstname").val();
      var lastname = $("#lastname").val();
      if (firstname && lastname && !this.value) {
        this.value = firstname + "." + lastname;
      }
    });


    $('.mask-date').mask('00/00/0000');
    $('.mask-time').mask('00:00:00');
    $('.mask-date_time').mask('00/00/0000 00:00:00');
    $('.mask-cep').mask('00000-000');
    $('.mask-phone').mask('0000-0000');
    $('.mask-phone_with_ddd').mask('(00) 0000-0000');
    $('.mask-phone_us').mask('(000) 000-0000');
    $('.mask-mixed').mask('AAA 000-S0S');
    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
    $('.mask-money').mask('000.000.000.000.000,00', {reverse: true});
    $('.mask-money2').mask("#.##0,00", {reverse: true});
    $('.mask-ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
      translation: {
        'Z': {
          pattern: /[0-9]/, optional: true
        }
      }
    });
    $('.mask-ip_address').mask('099.099.099.099');
    $('.mask-percent').mask('##0,00%', {reverse: true});
    $('.mask-clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.mask-placeholder').mask("00/00/0000", {placeholder: "MM/DD/YYYY"});
    $('.mask-fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/, 
          fallback: '/'
        }, 
        placeholder: "MM/DD/YYYY"
      }
    });
    $('.mask-selectonfocus').mask("00/00/0000", {selectOnFocus: true});

    var options =  {onKeyPress: function(cep, e, field, options){
      var masks = ['00000-000', '0-00-00-00'];
      mask = (cep.length>7) ? masks[1] : masks[0];
      $('.mask-crazy_cep').mask(mask, options);
    }};

    $('.mask-crazy_cep').mask('00000-000', options);


    var options2 =  { 
      onComplete: function(cep) {
        alert('CEP Completed!:' + cep);
      },
      onKeyPress: function(cep, event, currentField, options){
        console.log('An key was pressed!:', cep, ' event: ', event, 
          'currentField: ', currentField, ' options: ', options);
      },
      onChange: function(cep){
        console.log('cep changed! ', cep);
      },
      onInvalid: function(val, e, f, invalid, options){
        var error = invalid[0];
        console.log ("Digit: ", error.v, " is invalid for the position: ", error.p, ". We expect something like: ", error.e);
      }
    };

    $('.mask-cep_with_callback').mask('00000-000', options2);

    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
    };

    $('.mask-sp_celphones').mask(SPMaskBehavior, spOptions);






    $(".select2-A").select2({
      placeholder: "Select a state",
      allowClear: true
    });

    $(".select2-B").select2({
      tags: true
    });

    $("#range1").ionRangeSlider({
      type: "double",
      grid: true,
      min: -1000,
      max: 1000,
      from: -500,
      to: 500
    });

    $('.dateAnimate').bootstrapMaterialDatePicker({ weekStart : 0, time: false,animation:true});
    $('.date').bootstrapMaterialDatePicker({ weekStart : 0, time: false});
    $('.time').bootstrapMaterialDatePicker({ date: false,format:'HH:mm',animation:true});
    $('.datetime').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm',animation:true});
    $('.date-fr').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', lang : 'fr', weekStart : 1, cancelText : 'ANNULER'});
    $('.min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });


    $(".dial").knob({
      height:80
    });

    $('.dial1').trigger(
     'configure',
     {
       "min":10,
       "width":80,
       "max":80,
       "fgColor":"#FF6656",
       "skin":"tron"
     }
     );

    $('.dial2').trigger(
     'configure',
     {

       "width":80,
       "fgColor":"#FF6656",
       "skin":"tron",
       "cursor":true
     }
     );

    $('.dial3').trigger(
     'configure',
     {

       "width":80,
       "fgColor":"#27C24C",
     }
     );
  });
</script>