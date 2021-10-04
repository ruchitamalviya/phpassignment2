<?php include 'conn.php';
session_start();
$msg = "";
if (isset($_POST['submit']))
{
    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['password_confirmation']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $weburl = mysqli_real_escape_string($conn, $_POST['weburl']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $sql = "SELECT * FROM user_register where email ='$email' ";
    $query = mysqli_query($conn, $sql);
    $emailcount = mysqli_num_rows($query);
    if ($emailcount > 0)
    {
        $msg = '<div class="alert alert-success" role="alert">
				Your Email is Already Exist!
				</div>';
	}
    else
    {
        if ($password == $cpassword)
        {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $cpass = password_hash($cpassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `user_register` ( `fname`, `lname`, `email`, `phone`, `password`,`gender`,`weburl`,`address`) VALUES ( '$fname', '$lname', '$email', '$phone', '$pass','$gender','$weburl','$address')";

            if (mysqli_query($conn, $sql))
            {
            	$_SESSION['msg']= '<div class="alert alert-success" role="alert">
						You Are Successfully Register!
						</div>';
       			header("Location:login.php");

            }
            else
            {
                $msg = '<div class="alert alert-danger" role="alert">
						incorrect Information!
						</div>';
            }
        }
        else
        {
            $msg = '<div class="alert alert-danger" role="alert">
					Your Password Is Incorrect!
					</div>';
        }
    }
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assests/js/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" type="text/css" href="assests/css/style.css">
	</head>
	<body>
		<div class="container">
			<div class="row centered-form">
				<div class="col-xs-12 col-sm-10 col-md-6 col-sm-offset-2 col-md-offset-3">
					<div class="panel panel-default">
						 <div class="panel-heading">
							<h3 class="panel-title">Registration Form</h3></div>
						<div class="panel-body">
							<form role="form" method="post" action="#">
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="first_name" id="first_name" value="<?php echo $fname?>" class="form-control input-sm" placeholder="First Name*" value="<?php echo $fname?>"> 
										</div>
										<h6 id="first_error" class="field_error"></h6> 
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name*" value="<?php echo $lname?>"> 
										</div>
										<h6 id="last_error" class="field_error"></h6>
									</div>
								</div>
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address*" value="<?php echo $email?>"> 
								</div>
								<h6 id="email_error" class="field_error"></h6>
								<div class="form-group">
									<input type="tel" name="phone" id="phone" class="form-control input-sm" placeholder="Phone Number*" value="<?php echo $phone?>">
								 </div>
								<h6 id="phone_error" class="field_error"></h6>
								<div class="form-group">
									<input type="Password" name="password" id="password" class="form-control input-sm" placeholder="Password*">
								 </div>
								<h6 id="pass_error" class="field_error"></h6>
								<div class="form-group">
									<input type="Password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password *"> 
								</div>
								<h6 id="cpass_error" class="field_error"></h6>
								<div class="form-group">
									<input type="url" name="weburl" id="weburl" class="form-control input-sm" placeholder="weburl" value="<?php echo $weburl?>">
								 </div>
								<h6 id="web_error" class="field_error"></h6>
								<div class="form-group">
									<label>Gender</label>
									<input type="radio" name="gender" value="Male" checked>Male
									<input type="radio" name="gender" value="Female">Female </div>
								<h6 id="gender_error" class="field_error"></h6>
								<div class="form-group">
									<textarea name="address" id="address" rows="4" cols="50" placeholder="Address*" value="<?php echo $address?>"></textarea>
								</div>
								<h6 id="address_error" class="field_error"></h6>
								<input type="submit" value="Register" name="submit" id="submit" class="btn btn-info btn-block">
								<h6>If You have Register <a href="login.php">Login</a></h6>
								<div>
									<?php echo $msg ?>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="assests/js/custom.js"></script>
	</body>
</html>