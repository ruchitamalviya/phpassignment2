<?php
class BruteforceAttack
{
    public $conn;
    public function __construct(){
        $this->conn=mysqli_connect("localhost","root", "ets@123!", "loginpannel");
        if($this->conn){
         return $this->conn;
        }
    }
    function check_userAttempt($Ip){
        $attemptcount = 0;
        $attempt_time = date( 'Y-m-d H:i:s', strtotime("- 24 hours"));
        $check_login_row = "SELECT * from login_attempt where ip_address='".$Ip."' AND attempt_time > '".$attempt_time."'";
        $query = mysqli_query($this->conn, $check_login_row);
        if($query){
            $attemptcount = mysqli_num_rows($query);
        }
        return $attemptcount;
    }	

    function getIpAddr(){
        $myIp = getHostByName(getHostName());
        return $myIp;
    }

    function getLastRecord($user_id, $userIp){
        $get_last_row = "SELECT * FROM `login_attempt` WHERE  `ip_address` = '".$userIp."' AND `user_id` = '".$user_id."' ORDER BY id DESC limit 1";
        $query  = mysqli_query($this->conn, $get_last_row);
        if($query){
            $getlast = mysqli_fetch_assoc($query);
            $last_attempt_time = $getlast['attempt_time'];
        }
        return  $last_attempt_time;
    }
    //get user id using email address.
    function get_user_id_by_email($email) {
        if (!$email) {
            return false;
        }
        $sql = "SELECT * FROM user_register where email='".$email."'";
        $query = mysqli_query($this->conn, $sql);
        $emailcount = mysqli_num_rows($query);
        if ($emailcount) {
            $emailpass = mysqli_fetch_assoc($query);
            $user_id = $emailpass['id'];
            return $user_id;
        }
    }

}



?>