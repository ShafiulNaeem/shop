<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 2/24/2019
 * Time: 2:29 AM
 */
?>
<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/session.php');
Session::checkLogin();
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php



    class Adminlogin{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function Adminloginmethod($adminuser,$adminpass){
            $adminuser = $this->fm->validation($adminuser);
            $adminpass = $this->fm->validation($adminpass);

            $adminuser = mysqli_real_escape_string($this->db->link,$adminuser);
            $adminpass = mysqli_real_escape_string($this->db->link,$adminpass);

            if ($adminuser == '' || $adminpass == ''){
                $loginmsg = 'UserName and Userpassword must not be empty !!';
                return $loginmsg;
            }
            else{
                $query = "SELECT * FROM `ecom_admin` WHERE `adminusername`='$adminuser' AND `adminpass`='$adminpass'";

                $result = $this->db->select($query);
                if ($result == true ){
                    $value = $result->fetch_assoc();
                    session::set('login',true);
                    session::set('id',$value['id']);
                    session::set('adminusername',$value['adminusername']);
                    session::set('adminname',$value['adminname']);

                    header('location: dashboard.php');


                }
                else{
                    $loginmsg = 'UserName or Userpassword is nt matched!!';
                    return $loginmsg;
                }

            }

        }

    }
?>
