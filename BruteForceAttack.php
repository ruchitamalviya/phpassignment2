<?php
class BruteForceAttack
{
    public $conn;
    public function __construct() {
        $this->conn = mysqli_connect("localhost","root", "ets@123!", "loginpannel");
        if($this->conn){ 
         return $this->conn;
        }
    }
    //check user login attempt
    public function check_user_attempt($ip_address) {
        $attemptcount = 0;
        $attempt_time = date( 'Y-m-d H:i:s', strtotime("- 24 hours"));
        $email = $_SESSION['email'] ? $_SESSION['email'] : '';
        $user_id = $email ? $this->get_user_id_by_email($email)  : '';
        $attempt_time = date( 'Y-m-d H:i:s', strtotime("- 24 hours"));
        $check_login_row = "SELECT * from `login_attempt` where user_id = '".$user_id."' AND  ip_address = '".$ip_address."' AND attempt_time > '".$attempt_time."'";
        $query = mysqli_query($this->conn, $check_login_row);
        if($query){
            $attemptcount = mysqli_num_rows($query);
        }
        return $attemptcount;
    }   
    //get user ip address
    public  function get_ip_addr() {
        $ip_address = getHostByName(getHostName());
        return  $ip_address;
    }
    //get user last attempt
    public  function get_last_record($user_id, $userip) {
        $get_last_row = "SELECT * FROM `login_attempt` WHERE  `ip_address` = '".$userip."' AND `user_id` = '".$user_id."' ORDER BY id DESC limit 1";
        $query  = mysqli_query($this->conn, $get_last_row);
        if($query) {
            $getlast = mysqli_fetch_assoc($query);
            $last_attempt_time = $getlast['attempt_time'];
        }
        return  $last_attempt_time;
    }
    //get user id by email
    public  function get_user_id_by_email($email) {
        if (!$email) {
            return false;
        }
        $sql = "SELECT * FROM `user_register` where email = '".$email."'";
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