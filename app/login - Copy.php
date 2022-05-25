<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>HR Admin</title>
  <link rel="stylesheet" href="asset/css/styleLogin.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <style>
  .error 
  {
    color: #ff0000;
  }
  </style>
</head>

<body>
  <div class="wrapper">
	<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <h1><i>Welcome</i></h1>		
		            <form class="form" method="post" action="checkLogin.php" name="validation" id="validation">
                        <input type="text" placeholder="Username" name="username" id="username" autocomplete="off">
                        <input type="password" placeholder="Password" name="password" id="password">
                        <input type="submit"  name="login" id="login" value="Login">
                    </form>
                </div>
                 <div class="col-lg-2"></div>
            </div>
        </div>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>
    <script src="asset/js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    <script>
   $(function() {
  $("form[name='validation']").validate({
    rules: {
      username: {
          required: true,
          remote: {
                url: "checkusername.php",
                type: "post"
            }
      },        
      password: {
        required: true,
        minlength: 5
      }
    },
    messages: {
      username: {
         required: "Please enter your Username",
         remote: "Username Does not Exist!"
      },
      password: {
        required: "Please provide a Password",
        minlength: "Your password must be at least 5 characters long"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    </script>

</body>
</html>
