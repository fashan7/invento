$('document').ready(function()
{
    /* validation Cname CCode Cperson telno fax email address  */
    $("#customerreg").validate({
        rules:
        {
            Cname: {
                required: true
            },
            CCode: {
                required: true,
                minlength: 4,
                maxlength: 8
            },
            Cperson: {
                minlength: 3
            },
            telno: {
                required: true,
                number: true
            },
            fax: {
                number: true
            },
            email: {
                email: true
            },
            address: {
                required: true,
                minlength: 7
            },
        },
        messages:
        {
            Cname: "Enter a Valid Name",
            CCode:{
                required: "Provide a Code",
                minlength: "Code Needs To Be Minimum of 4 Characters",
                maxlength: "Code Needs To Be Maximum of 8 Characters"
            },
            Cperson: "Enter a Valid Contact Name",
            telno:{
                required: "Provide Contact No",
                number: "Provide in Numeric Values"
            },
            email: "Provide a valid email address",
            address:{
                required: "Provide Address",
                minlength: "Address Needs To Be Minimum of 7 Characters"
            }
        },
        submitHandler: submitForm
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
        var data = $("#customerreg").serialize();

        $.ajax({

            type : 'POST',
            url  : 'customerregsub.php',
            data : data,
            beforeSend: function()
            {
                $("#error").fadeOut();
                $("#save").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success :  function(data)
            {
                if(data==1){

                    $("#error").fadeIn(1000, function(){


                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry Could Not Register the Customer Details !</div>');

                        $("#save").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Register Customer');

                    });

                }
                else if(data=="registered")
                {

                    $("#save").html('Signing Up');
                    setTimeout('$(".Customer").fadeOut(500, function(){ $(".formcustomer").load("successcustomer.php"); }); ',5000);

                }
                else{

                    $("#error").fadeIn(1000, function(){

                        $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

                        $("#save").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Register Customer');

                    });

                }
            }
        });
        return false;
    }
    /* form submit */

});