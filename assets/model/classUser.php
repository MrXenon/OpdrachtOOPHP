<?php

class User{
    protected $db;
    public function __construct(){
        $this->db = new DB_con();
        $this->db = $this->db->ret_obj();
    }

    /*** for registration process ***/

    public function reg_user($name,$username,$password,$email){
        //echo "k";

        $password = md5($password);

        //checkt of gebruikersnaam en email beschikbaar zijn
        $query = "SELECT * FROM users WHERE uname='$username' OR uemail='$email'";

        $result = $this->db->query($query) or die($this->db->error);

        $count_row = $result->num_rows;

        //if gebruikersnaam beschikbaar is, insert into database

        if($count_row == 0){
            $query = "INSERT INTO users SET uname='$username', upass='$password', fullname='$name', uemail='$email'";

            $result = $this->db->query($query) or die($this->db->error);

            return true;
        }
        else{return false;}


    }


    /*** for login process ***/
    public function check_login($emailusername, $password){
        $password = md5($password);

        $query = "SELECT uid from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";

        $result = $this->db->query($query) or die($this->db->error);


        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        $count_row = $result->num_rows;

        if ($count_row == 1) {
            $_SESSION['login'] = true; // deze login gebruikt het sessie ding
            $_SESSION['uid'] = $user_data['uid'];
            return true;
        }

        else{return false;}


    }


    public function get_fullname($uid){
        $query = "SELECT fullname FROM users WHERE uid = $uid";

        $result = $this->db->query($query) or die($this->db->error);

        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['fullname'];

    }

    public function get_uname($uid){
        $query = "SELECT uname FROM users WHERE uid = $uid";

        $result = $this->db->query($query) or die($this->db->error);

        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['uname'];
    }

    public function get_uemail($uid){
        $query = "SELECT uemail FROM users WHERE uid = $uid";

        $result = $this->db->query($query) or die($this->db->error);

        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['uemail'];

    }

    /*** starting the session ***/
    public function get_session(){
        return $_SESSION['login'];
    }

    public function user_logout() {
        $_SESSION['login'] = FALSE;
        unset($_SESSION);
        session_destroy();
    }
}