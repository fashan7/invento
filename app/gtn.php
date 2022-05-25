<?php include 'header.php';?>
      <!-- end: Header -->
<?php include 'sidnav.php';?>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Good Transfer Note (GTN)</h3>
                        <p class="animated fadeInDown">
                          Inventory <span class="fa-angle-right fa"></span> Good Transfer Note (GTN)
                        </p>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                    <div class="col-md-12">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Good Transfer Note Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                              <div class="col-md-3" style = "margin-bottom:20px;">
                                <label style = "margin-bottom:20px;">Warehouse Code</label>
                              <input type="text" class="form-control android" >
                            </div>                       
                            <div class="col-md-3" style = "margin-bottom:20px;"> 
                              <label style = "margin-bottom:20px;">GRN Date</label>
                              <input type="text" class="form-text mask-placeholder form-control android" placeholder="MM/DD/YYYY"  required>
                            </div>
                            <div class="col-md-3" style = "margin-bottom:20px;"> 
                              <label style = "margin-bottom:20px;">Purchase No</label>
                               <select class="form-control " style="margin-bottom:20px;">
                                    <option>option one</option>
                                    <option>option two</option>
                                    <option>option three</option>
                                    <option>option four</option>
                                </select>
                            </div> 
                             <div class="col-md-3" style = "margin-bottom:20px;"> 
                              <label style = "margin-bottom:20px;">Purchase No</label>
                               <select class="form-control " style="margin-bottom:20px;">
                                    <option>option one</option>
                                    <option>option two</option>
                                    <option>option three</option>
                                    <option>option four</option>
                                </select>
                            </div>
                          </div> 
                      </div>
                    </div>
                  </div>
              </div>
                
                   <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      
                    <div class="col-md-12">
                      <div class="panel form-element-padding">                                     
                          
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-3" style = "margin-bottom:20px;"> 
                              <label>Item Name</label>
                              <br>
                                <select class="select2-B" class="form-control" style = "width:100%:">
                                    <option>Alaska</option>
                                    <option>Hawaii</option>
                                    <option>California</option>
                                    <option>Nevada</option>
                                    <option>Oregon</option>
                                    <option>Washington</option>
                                </select>
                          </div>
                          <div class="col-md-3 form-animate-text" style = "margin-bottom:20px;"> 
                              <label>Sell Price</label>
                              <input type="text" class="form-control">
                          </div> 
                          <div class="col-md-3 form-animate-text" style = "margin-bottom:20px;"> 
                              <label>Sell Price</label>
                              <input type="text" class="form-control">
                          </div> 
                               <div class="col-md-1"    style="margin-top:22px;">
                                   <button class="btn ripple-infinite btn-round btn-danger">
                                    <div>
                                      <span>Remove</span>
                                    </div>
                                  </button>
                              </div>
                             <div class = "row">
                              <div class="col-md-12"    style="margin-top:22px;">
                                   <button class="btn ripple-infinite btn-round btn-success">
                                    <div>
                                      <span>Add Row</span>
                                    </div>
                                  </button>
                              </div>
                                 </div>
                             
                             
                          </div>                     
                      </div>
                    </div>
                         <div class="panel-body">
                             <div class="col-md-9"></div>
                          <div class="col-md-3">
                              <button style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-primary">
                                <div class="flip">
                                  <div class="side">
                                    Submit <span class="fa fa-check"></span>
                                  </div>
                                  <div class="side back">
                                    are you sure?
                                  </div>
                                </div>
                                <span class="icon"></span>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>



        
      <!-- start: Mobile -->

       <!-- end: Mobile -->

    <!-- start: Javascript -->
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
  <!-- end: Javascript -->
  </body>
</html>.
