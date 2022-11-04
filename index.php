<?php
require('includes/config.php');

// When the form submitted, check and create user session.
if (isset($_REQUEST['username'])) {
	
	//Check the submitted values using $_POST
	//echo "<pre>"; print_r($_POST); exit;
	
	    $username = stripslashes($_REQUEST['username']);    //Remove the backslash
        $username = mysqli_real_escape_string($con, $username); //Escape special characters in strings
        $password = stripslashes($_REQUEST['password']); //Remove the backslash
        $password = mysqli_real_escape_string($con, $password); //Escape special characters in strings
        
		// Check user is exist in the database
        $query    = "SELECT * FROM `tblusers` WHERE userEmail='$username' AND userPwd='" . md5($password) . "'";
		//check query using echo function
		//echo "SELECT * FROM `tblusers` WHERE userEmail='$username' AND userPwd='" . md5($password) . "'";exit;
		
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username; //Session is a way to store information (in variables) to be used across multiple pages.
			//check session values using $_SESSION function
			//echo "<pre>"; print_r($_SESSION); exit;
            
			// Redirect to another page
            header("Location: dashboard.php"); //The PHP header location makes it possible for you to redirect to another webpage of the same or different website.
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
}
?>

<!doctype html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <title>Login</title>
      <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
      <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
      <style>@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
         * {
         padding: 0;
         margin: 0;
         box-sizing: border-box;
         font-family: 'Poppins', sans-serif
         }
         body {
         height: 100vh;
         background: linear-gradient(to top, #c9c9ff 50%, #9090fa 90%) no-repeat
         }
         .container {
         margin: 50px auto
         }
         .panel-heading {
         text-align: center;
         margin-bottom: 10px
         }
         #forgot {
         min-width: 100px;
         margin-left: auto;
         text-decoration: none
         }
         a:hover {
         text-decoration: none
         }
         .form-inline label {
         padding-left: 10px;
         margin: 0;
         cursor: pointer
         }
         .btn.btn-primary {
         margin-top: 20px;
         border-radius: 15px
         }
         .panel {
         min-height: 380px;
         box-shadow: 20px 20px 80px rgb(218, 218, 218);
         border-radius: 12px
         }
         .input-field {
         border-radius: 5px;
         padding: 5px;
         display: flex;
         align-items: center;
         cursor: pointer;
         border: 1px solid #ddd;
         color: #4343ff
         }
         input[type='text'],
         input[type='password'] {
         border: none;
         outline: none;
         box-shadow: none;
         width: 100%
         }
         .fa-eye-slash.btn {
         border: none;
         outline: none;
         box-shadow: none
         }
         img {
         width: 40px;
         height: 40px;
         object-fit: cover;
         border-radius: 50%;
         position: relative
         }
         a[target='_blank'] {
         position: relative;
         transition: all 0.1s ease-in-out
         }
         .bordert {
         border-top: 1px solid #aaa;
         position: relative
         }
         .bordert:after {
         content: "or connect with";
         position: absolute;
         top: -13px;
         left: 33%;
         background-color: #fff;
         padding: 0px 8px
         }
         @media(max-width: 360px) {
         #forgot {
         margin-left: 0;
         padding-top: 10px
         }
         body {
         height: 100%
         }
         .container {
         margin: 30px 0
         }
         .bordert:after {
         left: 25%
         }
         }
      </style>
      <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
      <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
      <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
   </head>
   <body oncontextmenu='return false' class='snippet-body'>
      <div class="container">
         <div class="row">
            <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
               <div class="panel border bg-white">
                  <div class="panel-heading">
                     <h3 class="pt-3 font-weight-bold">Login</h3>
					 <?php if(isset($_GET['msg']) == "logout") { ?><p class="alert alert-success">Logged out Successfully.<a href="index.php" style="float:right">X</a></p>
					 <?php } ?>
                  </div>
                  <div class="panel-body p-3">
                     <form action="#" method="POST">
                        <div class="form-group py-2">
                           <div class="input-field"> <span class="far fa-user p-2"></span> <input name="username" type="text" placeholder="Email" required> </div>
                        </div>
                        <div class="form-group py-1 pb-2">
                           <div class="input-field"> <span class="fas fa-lock px-2"></span> <input type="password" name="password" placeholder="Enter your Password" required> <button class="btn bg-white text-muted"> </button> </div>
                        </div>
                        <div class="form-inline"> <input type="checkbox" name="remember" id="remember"> <label for="remember" class="text-muted">Remember me</label> <a href="#" id="forgot" class="font-weight-bold">Forgot password?</a> </div>
                        <input type="submit" value="Login" class="btn btn-primary btn-block mt-3"/>
                     </form>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
   </body>
</html>