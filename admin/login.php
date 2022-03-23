<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('includes/inputval.php');

if(isset($_POST['login']))
  {
    if ($_POST["verficationcode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')
    {
    echo "<script>alert('Incorrect captcha');</script>" ;
    }
    else{
    $adminuser=$_POST['username'];
    echo htmlspecialchars($adminuser, ENT_QUOTES, 'UTF-8');
    $password=$_POST['password'];
    $query=mysqli_query($con,"select ID, Password from tbladmin where  UserName='$adminuser' ");
    $row = mysqli_fetch_assoc($query);
    $hashpass = $row["Password"];
    $ret = $row["ID"];
    $verify=password_verify($password,$hashpass);
    if($verify){
      $_SESSION['pgasaid']=$ret;
      $cookie_name['pgasaid']=$ret;
      $cookie_value = $ret;
      setcookie($cookie_name, $cookie_value, time() + (3600), "/"); // 86400 = 1 day
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }}
  ?>
<!DOCTYPE html>
<head>
<title>Student Accomodation | Login </title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Sign In Now</h2>
		<form action="#" method="post" name="login">
			<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
			<input type="text" class="ggg" name="username" placeholder="User Name" required="true">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="true">
      <div class="form-group">
                      <input type="text"   name="verficationcode" maxlength="5" autocomplete="off" required  style="width: 200px;"  placeholder="Enter Captcha" autofocus />&nbsp;
                      <!--Cpatcha Image -->
                      <img src="captcha.php">
                      </div>
			<a href="forgot-password.php">Forgot Password?</a>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">

		</form>

</div>
</div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
