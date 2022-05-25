<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <script src='https://npmcdn.com/particlesjs@2.1.0/dist/particles.min.js'></script>
  <link rel="stylesheet" media="screen" href="asset/css/styleParticles.css">
  <!-- end: Css -->
	
  <link rel="shortcut icon" href="asset/img/logomi.png">
  <link rel="stylesheet" href="asset/css/styleLogin.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<style>
  .error 
  {
    color: #ff0000;
  }
  </style>
    
    <body id="particles-js" class="dashboard form-signin-wrapper" >
      <div class="container">
        <form class="form form-signin" method="post" action="checkLogin.php" name="validation" id="validation" style = "border:solid;background-color:#2196f3">
          <div class="periodic-login">
              <div class="panel-body text-center">
                  <h5 class="atomic-symbol">HR</h5>
                  <p class="element-name">Sign In</p>

                  <i class="icons icon-arrow-down"></i>
                  <label style="margin-top:40px !important;">Username</label>
                  <div class="form-group form-animate-text" >
                    <input type="text" class="form-text"  name="username" id="username" required autocomplete="off">
                    
                  </div>
                  <i class="icons icon-arrow-down"></i>
                  <label style="margin-top:40px !important;">Password</label>
                  <div class="form-group form-animate-text" >
                    <input type="password" class="form-text" name="password" id="password" required>
                    
                  </div>

                  
              </div>
                
          </div>
            <input type="submit"  name="login" id="login"  value="SignIn"/>
        </form>
      </div>
              
    
    <script src="asset/js/particles.js"></script>
    <script src="asset/js/app.js"></script>
    <script src="asset/js/lib/stats.js"></script>
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
     <!-- end: Javascript -->
   </body>
   </html>