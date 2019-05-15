<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/1/2019
 * Time: 1:23 AM
 */
?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/Format.php');

?>
<?php
class user{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertuser($data,$file){


        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $pass = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $zip = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);


        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "admin/upload/" . $unique_image;

        $emailsql = "SELECT * FROM `ecom_customer` WHERE `email`='$email' LIMIT 1";
        $checkmail = $this->db->select($emailsql);
        if ($checkmail){
            $usmsg = "This ".$data['email']." Email Already Exist!!" ;
            return $usmsg;
        }

        if (empty($email) || empty($phone) || empty($name) || empty($pass)) {
            $usmsg = 'Must be filup all filed!!';
            return $usmsg;
        }
        else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO `ecom_customer`
                      (`name`, `email`,`image`, `pass`, `zip`, `country`, `city`, `phone`)
                      VALUES 
                      ('$name','$email','$uploaded_image','$pass','$zip','$country','$city','$phone')";

            $insert = $this->db->insert($query);
            if ($insert) {

                header('location:index.php');

            } else {
                $usmsg = "You Are  not Registerted!!";
                return $usmsg;
            }
        }
    }

    // login user..

    public function userLogin($data){
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $pass = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if (empty($email) || empty($pass)) {
            $usmsg = 'Must be filup all filed!!';
            return $usmsg;
        }
        else{
            $sql = "SELECT * FROM `ecom_customer` WHERE `email`='$email' AND `pass`='$pass'";
            $result = $this->db->select($sql);

            if ($result != false){
                $value = $result->fetch_assoc();
                Session::set("userlogin",true);
                Session::set("userid",$value['userid']);
                Session::set("username",$value['name']);
                header('location:cart.php');
            }
            else{
                $usmsg = 'Email And password Does not Matched!!';
                return $usmsg;
            }
        }


    }

    // profile
    public function userdatashow($id){
        $sql = "SELECT * FROM `ecom_customer` WHERE `userid`='$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    // update user data ......
    public function updateuserdata($data,$userid){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);


        if ($city == '' || $phone == '' ) {
            $usmsg = 'Must be updated all filed!!';
            return $usmsg;
        }
        else {

            $query = "UPDATE `ecom_customer` 
                      SET `name`='$name',
                      `email`='$email',
                      `country`='$country',
                      `city`='$city',
                      `phone`='$phone' WHERE `userid`='$userid'";
            $update = $this->db->update($query);
            if ($update) {


                header('location:profile.php');


            }
            else {
                $usmsg = "Data not updated!!";
                return $usmsg;
            }
        }

    }



}
?>
