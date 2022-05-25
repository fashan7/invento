$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			password: {
                required: true,
			},
			username: {
                required: true,
            },
	   },
       messages:
	   {
            password:{
                      required: ""
                     },
            username: "",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'checkLogin.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
			},
			success :  function(response)
			   {						
					if(response=="ok"){
									
						$("#login").html('<img src="asset/gify/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
						setTimeout(' window.location.href = "index.php"; ',4000);
					}
					else{
									
						$("#error").fadeIn(1000, function(){						
				$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
				$("#login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});