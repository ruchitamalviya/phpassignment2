<?php 
include 'conn.php';
require_once 'BruteforceAttack.php';
$bruteforce = new BruteforceAttack();
session_start();
$msg = " ";
$rem_attempt = '';
$userIp = $bruteforce->getIpAddr();
$attempt_time = time();
$userAttepmtCount = $bruteforce->check_userAttempt($userIp);
if (isset($_POST['email']) && isset($_POST['password'])){
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$sql = "SELECT * FROM user_register where email = '".$email."'";
	$query = mysqli_query($conn, $sql);
	$emailcount = mysqli_num_rows($query);
	if ($emailcount){
		$emailpass = mysqli_fetch_assoc($query);
		$dbpass = $emailpass['password'];
		$user_id = $emailpass['id'];
		$passdecode = password_verify($password, $dbpass);
		$attempt_last_time = $bruteforce->getLastRecord($user_id, $userIp);
		if($userAttepmtCount == 5){
			$msg = '<div class="alert alert-danger" role="alert">
						your Account is block for 24 hours<br> Login after 24 hours.
						</div>';

		}else{
			
			$_SESSION['id'] = $emailpass['id'];
			$_SESSION['fname'] = $emailpass['fname'];
			if ($passdecode && ($userAttepmtCount <= 2 || $userAttepmtCount == 4 || $userAttepmtCount == 5)){
				$sql = "DELETE FROM `login_attempt` WHERE ip_address ='$userIp' AND user_id = '" . $emailpass['id'] . "'";
				$query = mysqli_query($conn, $sql);
				header("location:home.php"); 
			}else if($passdecode && $userAttepmtCount == 3){
				$userIp = $bruteforce->getIpAddr();
				//print_r($_POST['g-recaptcha-response']); die;
				if(!empty($_POST['g-recaptcha-response'])){

					$secret = '6LcDesUcAAAAACrE7jSafTEjQfSLjPO3xz58CkcA';
					$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
					$responseData = json_decode($verifyResponse);
					$status = $responseData->success;
					$user_id = $bruteforce->get_user_id_by_email($email);
					$attempt_last_id = $bruteforce->getLastRecord($user_id, $userIp);
					$last_attempt_id = $attempt_last_id['id'];
					if($status){
						$userIp = $bruteforce->getIpAddr();
						$sql = "DELETE FROM `login_attempt` WHERE ip_address ='$userIp' AND user_id = '" . $emailpass['id'] . "'";
						$query = mysqli_query($conn, $sql);
						header("location:home.php");
						
					}else{
						$sql = "UPDATE `login_attempt` SET `recaptcha_status` = false WHERE `id` = '".$last_attempt_id."' ";
						$query = mysqli_query($conn, $sql);
						$message = "g-recaptcha not varified";
					}
				}else{
					
					$msg = '<div class="alert alert-danger" role="alert">
					Captcha Not Verified!
					</div>';
					
				}
			}else if(!$passdecode && $userAttepmtCount==3){
				$userIp = $bruteforce->getIpAddr();
				
				if(!empty($_POST['g-recaptcha-response'])){
					$secret = '6LcDesUcAAAAACrE7jSafTEjQfSLjPO3xz58CkcA';
					$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
					$responseData = json_decode($verifyResponse);
					
					$status = $responseData->success;
					$user_id = $bruteforce->get_user_id_by_email($email);
					$attempt_last_id = $bruteforce->getLastRecord($user_id, $userIp);
					$last_attempt_id = $attempt_last_id['id'];
					if($status){
						$userAttepmtCount++;
						$rem_attempt = 5 - $userAttepmtCount; 
						$userIp = $bruteforce->getIpAddr();
						$current_time = date( 'Y-m-d H:i:s' );

						$sql = "INSERT INTO `login_attempt` ( `user_id`,`ip_address`,`attempt_time`) VALUES ( '" . $emailpass['id'] . "','$userIp', ' $current_time')";
						$query = mysqli_query($conn, $sql);
						
						$msg = '<div class="alert alert-danger" role="alert">
							Password Do Not Match! '.$rem_attempt.' remaining attempts.
							</div>';
						
						
					}else{
						$sql = "UPDATE `login_attempt` SET `recaptcha_status` = false WHERE `id` = '".$last_attempt_id."' ";
						$query = mysqli_query($conn, $sql);
						$message = "g-recaptcha not varified";
					}
				}else{
					
					$msg = '<div class="alert alert-danger" role="alert">
					Captcha Not Verified!
					</div>';
					
				}
			}
			else{
				$userAttepmtCount++;
				$rem_attempt = 5 - $userAttepmtCount; 
				$userIp = $bruteforce->getIpAddr();
				$current_time = date( 'Y-m-d H:i:s' );
				$msg = '<div class="alert alert-danger" role="alert">
				Password Do Not Match! '.$rem_attempt.' remaining attempts.
				</div>';


				$sql = "INSERT INTO `login_attempt` ( `user_id`,`ip_address`,`attempt_time`) VALUES ( '" . $emailpass['id'] . "','$userIp', ' $current_time')";
				$query = mysqli_query($conn, $sql);
			}	
		}
		
	}else{
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
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="<?php echo $email?><?php  if(isset($_COOKIE['emailcookie'])){ 
										echo $_COOKIE['emailcookie']; }?>"> </div>
								<div class="form-group">
									<input type="Password" name="password" id="password" class="form-control input-sm" placeholder="Password" value="<?php  if(isset($_COOKIE['passwordcookie'])){ 
										echo $_COOKIE['passwordcookie']; }?>"> </div>
									
									<?php 
									if ($userAttepmtCount == 3)
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