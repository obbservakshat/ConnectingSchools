<?php
 session_start();
?>

<!DOCTYPE html>
<!-- saved from url=(0069)file:///media/dhairya/F/Connecting%20Schools/Templates/web/login.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Connecting Schools A Modern Platform for Modern Schools</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="keywords" content="Collective Forms Widget Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="./css/style1.css" rel="stylesheet" type="text/css" media="all">
<link href="file://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,300italic,600italic,700" rel="stylesheet" type="text/css">
</head>
<?php
   $m = new MongoClient();
   $db = $m->connectingschools;
   //echo "Database mydb selected";
   $school = $db->createCollection("School");
   $student = $db->createCollection("Student");
   $supervisor = $db->createCollection("Supervisor");

?>

<?php
	$_SESSION["uname"] = " " ;
	$_SESSION["pass"] = " " ;
	$student_error = "";
	$school_error = "";
	$login_error="";
	if(isset($_POST["SignupSchool"]))
	{
		$already_exist_school =$school->findOne(array("User Name" => $_POST["UserName"]));
		$already_exist_student =$student->findOne(array("User Name" => $_POST["UserName"]));
		if($_POST["Password"]!=$_POST["ConfirmPassword"])
		{
				$school_error = "Passwords do not match.";
		}
		else{

				if($already_exist_school || $already_exist_student)
				{
							$school_error= "Username already exists.";
				}
				else{
					$document = array(
					"Name" => $_POST["Name"] ,
					"User Name" => $_POST["UserName"],
					"Address" => $_POST["Address"],
					"Affiliation Code" => $_POST["AffiliationCode"],
					"Password" => $_POST["Password"],
					"Email" => $_POST["Email"]
					);
					$school->insert($document);
					header("Location:../index.php");
				}
		}
	}
	if(isset($_POST["SignupStudent"]))
	{
		$already_exist_school =$school->findOne(array("User Name" => $_POST["UserName"]));
		$already_exist_student =$student->findOne(array("User Name" => $_POST["UserName"]));
		if($_POST["Password"]!=$_POST["ConfirmPassword"])
		{
				$student_error= "Passwords do not match.";
		}
		else{

				if($already_exist_school || $already_exist_student)
				{
					$student_error  = "Username already exists.";
				}
				else{
					$document = array(
					"Name" => $_POST["Name"] ,
					"User Name" => $_POST["UserName"],
					"Roll Number" => $_POST["RollNumber"],
					"Email" => $_POST["Email"],
					"Password" => $_POST["Password"],
					"School Name" => $_POST["SchoolName"]
					);
					$student->insert($document);

					header("Location:../index.php");
				}
		}
	}
	if(isset($_POST["Login"]))
	{
		$verify_school = $school->findOne(array("User Name" => $_POST["UserName"], "Password" => $_POST["Password"]));
		$verify_student = $student->findOne(array("User Name" => $_POST["UserName"], "Password" => $_POST["Password"]));
		$verify_supervisor = $supervisor->findOne(array("UserName" => $_POST["UserName"], "Password" => $_POST["Password"]));

		if($verify_supervisor)
		{
			$_SESSION["uname"] = $_POST["UserName"];
			header("Location:../admin/admin.php");
		}
		else{
				if($verify_school || $verify_student)
				{


					$_SESSION["uname"] = $_POST["UserName"];
					$_SESSION["pass"] = $_POST["Password"];
					header("Location:../post user login/post user login.php");
				}
			else{
					$login_error = "Invalid Credentials.";
				}
			}
	}
?>
<body>
	<div class="main">
		<h1>Login and Sign up</h1>
		<div class="wthree_top_forms">
			<div class="agile-info_w3ls hvr-buzz-out">
				<h3>Register School</h3>
				<div class="agile-info_w3ls_grid">
					<form action="login.php" method="post">
						<input type="text" name="Name" placeholder="Name" required=" ">
						<input type="text" name="UserName" placeholder="User Name" required=" " style="
    margin-top: 21px;
    margin-bottom: 21px;
">
						<input type="text" name="AffiliationCode" placeholder="Affiliation Code" required=" ">
						<input type="text" name="Address" placeholder="Address" required=" " style="
    margin-top: 21px;
    margin-bottom: 21px;
">
						<input type="password" name="Password" placeholder="Password" required=" ">
						<input type="password" name="ConfirmPassword" placeholder="Confirm Password" required=" " style="
    margin-top: 21px;
">
						<input type="email" name="Email" placeholder="Email" required=" ">
						<div class="check">
							<label>
									<p><?=$school_error?></p>
								</label>
						</div>
						<input type="submit" value="Sign Up" name="SignupSchool">
					</form>
					<h5>Already a member? <a href="file:///media/dhairya/F/Connecting%20Schools/Templates/web/login.html#">Sign In</a></h5>
				</div>
			</div>
			<div class="agile-info_w3ls agile-info_w3ls_sub hvr-buzz-out">
				<h3>Login</h3>
				<div class="agile-info_w3ls_grid second">
					<form action="login.php" method="post">
						<input type="text" name="UserName" placeholder="User Name" required=" " style="
    margin-top: 60px;
">
						<input type="password" name="Password" placeholder="Password" required=" " style="
    margin-top: 40px;
    margin-bottom: 21px;
">
						<input type="submit" value="Sign In" name = "Login">
						<div class="check">
						<label>
									<p><?=$login_error?></p>
								</label>
						</div>
					</form>
					<!--<h4 style="margin-top: 30px;">Continue With</h4>
					<div class="social_icons agileinfo">
					   <section class="social">
						  <a href="https://facebook.com" class="icon fb"><img src="./images/f.png" alt=""></a>
						  <a href="https://twitter.com" class="icon tw"><img src="./images/t.png" alt=""></a>
						  <a href="https://plus.google.com" class="icon gp"><img src="./images/g.png" alt=""></a>
						</section>
					</div>-->
					<h5>Don't have an account? <a href="file:///media/dhairya/F/Connecting%20Schools/Templates/web/login.html#">Sign Up</a></h5>
				</div>
			</div>
			<div class="agile-info_w3ls third hvr-buzz-out">
				<h3>Signup Student</h3>
				<div class="agile-info_w3ls_grid third">
					<form action="login.php" method="post">
						<input type="text" name="Name" placeholder="Name" required=" ">
						<input type="text" name="UserName" placeholder="User Name" required=" " style="
    margin-top: 21px;
    margin-bottom: 21px;
">
						<input type="text" name="SchoolName" placeholder="School Name" required=" " style="
    margin-bottom: 21px;
">
						<input type="text" name="RollNumber" placeholder="Roll Number" required=" ">
						<input type="password" name="Password" placeholder="Password" required=" " style="
    margin-top: 21px;
">
						<input type="password" name="ConfirmPassword" placeholder="Confirm Password" required=" " style="
    margin-top: 21px;
    <!--margin-bottom: 21px;-->
">
						<input type="email" name="Email" placeholder="Email" required=" ">
						<div class="check">
							<label>
									<p><?=$student_error?></p>
								</label>
						</div>
						<input type="submit" value="Sign Up" name="SignupStudent">
					</form>
					<h5 class="rest">Already a member? <a href="file:///media/dhairya/F/Connecting%20Schools/Templates/web/login.html#">Sign In</a></h5>
				</div>
			</div>
			<div class="clear"> </div>
		</div>
		<div class="agileits_copyright">
			<p>© 2016 Connecting Schools. All rights reserved </p>
		</div>
	</div>
<?php
	$m->close();
?>
</body></html>
