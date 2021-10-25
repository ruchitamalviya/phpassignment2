<?php
include 'conn.php';
require_once 'BruteForceAttack.php';
$bruteforce = new BruteForceAttack();
session_start();
$msg = " ";
$rem_attempt = '';
$user_ip = $bruteforce->get_ip_addr();
$attempt_time = time();
$_SESSION['email'] = isset($_POST['email']) ? $_POST['email'] : '';
$user_attepmt_count = $bruteforce->check_user_attempt($user_ip);
if (isset($_POST['email']) && isset($_POST['password'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM `user_register` where email = '" . $email . "'";
    $query = mysqli_query($conn, $sql);
    $emailcount = mysqli_num_rows($query);
    if ($emailcount){
        $emailpass = mysqli_fetch_assoc($query);
        $dbpass = $emailpass['password'];
        $user_id = $emailpass['id'];
        $passdecode = password_verify($password, $dbpass);
        $attempt_last_time = $bruteforce->get_last_record($user_id, $user_ip);
        if ($user_attepmt_count == 5){
            $msg = '<div class="alert alert-danger" role="alert">
						Your Account Is Blocked For 24 Hours<br> Login After 24 Hours.
						</div>';

        }
        else{
            $_SESSION['id'] = $emailpass['id'];
            $_SESSION['fname'] = $emailpass['fname'];
            if ($passdecode && ($user_attepmt_count <= 2 || $user_attepmt_count == 4 || $user_attepmt_count == 5)){
                $sql = "DELETE FROM `login_attempt` WHERE ip_address = '" . $user_ip . "' AND user_id = '" . $emailpass['id'] . "'";
                $query = mysqli_query($conn, $sql);
                header("location:home.php");
            }
            else if ($passdecode && $user_attepmt_count == 3){
                $user_ip = $bruteforce->get_ip_addr();
                if (!empty($_POST['g-recaptcha-response'])){

                    $secret = '6LcDesUcAAAAACrE7jSafTEjQfSLjPO3xz58CkcA';
                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
                    $responseData = json_decode($verifyResponse);
                    $status = $responseData->success;
                    $user_id = $bruteforce->get_user_id_by_email($email);
                    $attempt_last_id = $bruteforce->get_last_record($user_id, $user_ip);
                    $last_attempt_id = $attempt_last_id['id'];
                    if ($status){
                        $user_ip = $bruteforce->get_ip_addr();
                        $sql = "DELETE FROM `login_attempt` WHERE ip_address ='$user_ip' AND user_id = '" . $emailpass['id'] . "'";
                        $query = mysqli_query($conn, $sql);
                        header("location:home.php");

                    }
                    else{
                        $sql = "UPDATE `login_attempt` SET `recaptcha_status` = false WHERE `id` = '" . $last_attempt_id . "' ";
                        $query = mysqli_query($conn, $sql);
                        $message = "g-recaptcha not varified";
                    }
                }
                else{

                    $msg = '<div class="alert alert-danger" role="alert">
					Captcha Not Verified!
					</div>';
                }
            }
            else if (!$passdecode && $user_attepmt_count == 3){
                $user_ip = $bruteforce->get_ip_addr();

                if (!empty($_POST['g-recaptcha-response'])){
                    $secret = '6LcDesUcAAAAACrE7jSafTEjQfSLjPO3xz58CkcA';
                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
                    $responseData = json_decode($verifyResponse);

                    $status = $responseData->success;
                    $user_id = $bruteforce->get_user_id_by_email($email);
                    $attempt_last_id = $bruteforce->get_last_record($user_id, $user_ip);
                    $last_attempt_id = $attempt_last_id['id'];
                    if ($status){
                        $user_attepmt_count++;
                        $rem_attempt = 5 - $user_attepmt_count;
                        $user_ip = $bruteforce->get_ip_addr();
                        $current_time = date('Y-m-d H:i:s');

                        $sql = "INSERT INTO `login_attempt` ( `user_id`,`ip_address`,`attempt_time`) VALUES ( '" . $emailpass['id'] . "','$user_ip', ' $current_time')";
                        $query = mysqli_query($conn, $sql);

                        $msg = '<div class="alert alert-danger" role="alert">
							Password Do Not Match! ' . $rem_attempt . ' Remaining Attempts.
							</div>';

                    }
                    else{
                        $sql = "UPDATE `login_attempt` SET `recaptcha_status` = false WHERE `id` = '" . $last_attempt_id . "' ";
                        $query = mysqli_query($conn, $sql);
                        $message = "g-recaptcha not varified";
                    }
                }
                else{

                    $msg = '<div class="alert alert-danger" role="alert">
					Captcha Not Verified!
					</div>';

                }
            }
            else{
                $user_attepmt_count++;
                $rem_attempt = 5 - $user_attepmt_count;
                $user_ip = $bruteforce->get_ip_addr();
                $current_time = date('Y-m-d H:i:s');
                $msg = '<div class="alert alert-danger" role="alert">
				Password Do Not Match! ' . $rem_attempt . ' Remaining Attempts.
				</div>';
                $sql = "INSERT INTO `login_attempt` ( `user_id`,`ip_address`,`attempt_time`) VALUES ( '" . $emailpass['id'] . "','$user_ip', ' $current_time')";
                $query = mysqli_query($conn, $sql);

            }
        }

    }
    else{
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
		<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
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
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="<?php echo $email?>"> </div>
								<div class="form-group">
									<input type="Password" name="password" id="password" class="form-control input-sm" placeholder="Password" value=""> </div>
									
									<?php 
									if ($user_attepmt_count == 3)
						            {

						            	?>
						            	
										   <div class="g-recaptcha" data-sitekey="6LcDesUcAAAAADqMHJ_lY_SQU4h83egtm_dV5Xff"></div>
										  						            	
						            	<?php
						               
						            }?>
						            

								<input type="submit" value="Login" name="login" id="submit" class="btn btn-info btn-block">
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