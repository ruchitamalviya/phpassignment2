<?php include 'conn.php';
session_start();
$msg = " ";
if (isset($_POST['email']) && isset($_POST['password']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM user_register where email='$email'";
    $query = mysqli_query($conn, $sql);
    $emailcount = mysqli_num_rows($query);
    if ($emailcount)
    {
        $emailpass = mysqli_fetch_assoc($query);
        $dbpass = $emailpass['password'];
        $_SESSION['id'] = $emailpass['id'];
        $_SESSION['fname'] = $emailpass['fname'];

        $passdecode = password_verify($password, $dbpass);
        if ($passdecode)
        {

            if (isset($_POST['rememberme']))
            {
                setcookie('emailcookie', $email, time() + 86400);
                setcookie('passwordcookie', $password, time() + 86400);
                $msg = '<div class="alert alert-succcess" role="alert">
						Successfully Login!
						</div>';
                header("location:home.php");
            }
            else
            {
                $msg = '<div class="alert alert-succcess" role="alert">
						Successfully Login!
						</div>';
                header("location:home.php");
            }

        }
        else
        {
            $msg = '<div class="alert alert-danger" role="alert">
					Password Do Not Match!
					</div>';
        }
    }
    else
    {
        $msg = '<div class="alert alert-danger" role="alert">
				Email Not Exist!</div>';

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
		<link rel="stylesheet" type="text/css" href="assests/css/style.css">
	</head>

	<body>
		<div class="container">
			<div class="row centered-form">
				<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Login Form</h3>
							<?php

							if(isset($_SESSION['msg'])){
							echo $_SESSION['msg'];
							unset($_SESSION['msg']);
							}

							?>
						</div>
						<div class="panel-body">
							<form role="form" method="post">
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="<?php echo $email?><?php  if(isset($_COOKIE['emailcookie'])){ 
										echo $_COOKIE['emailcookie']; }?>"> </div>
								<div class="form-group">
									<input type="Password" name="password" id="password" class="form-control input-sm" placeholder="Password" value="<?php  if(isset($_COOKIE['passwordcookie'])){ 
										echo $_COOKIE['passwordcookie']; }?>"> </div>
									<div class="form-group">
									<input type="checkbox" name="rememberme" >Remember me </div>
								<input type="submit" value="Register" name="login" id="submit" class="btn btn-info btn-block">
								<div>
									<?php echo $msg ?>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>