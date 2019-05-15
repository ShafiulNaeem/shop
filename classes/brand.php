
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/Format.php');

?>
<?php
    class brand{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function addbrandmethod($brandName){
            $brandName = $this->fm->validation($brandName);

            $brandName = mysqli_real_escape_string($this->db->link,$brandName);

            if (empty($brandName)){
                $brndmsg = 'Must be decleared Brand Name!!';
                return $brndmsg;
            }
            else{
                $query = "INSERT INTO `ecom_brand`(`brand`) VALUES ('$brandName')";

                $insert = $this->db->insert($query);
                if ($insert){
                    $brndmsg = "Brand inserted successfully!!";
                    return $brndmsg;
                }
                else{
                    $brndmsg = "Brand not inserted!!";
                    return $brndmsg;
                }
            }
        }

        //brand list......
        public function getbrand(){
            $query = "SELECT * FROM `ecom_brand`";
            $result = $this->db->select($query);
            return $result;


        }

        // show brand data.....
        public function getbrandshow($id){
            $query = "SELECT * FROM `ecom_brand` where `id`='$id'";
            $result = $this->db->select($query);
            return $result;
        }

        // update brand Name.....
        public function updatebrandymethod($brandName,$id){
            $brandName = $this->fm->validation($brandName);
            $id = $this->fm->validation($id);

            $brandName = mysqli_real_escape_string($this->db->link,$brandName);
            $id = mysqli_real_escape_string($this->db->link,$id);

            if (empty($brandName)){
                $brandmsg = 'Must be decleared Category Name!!';
                return $brandmsg;
            }
            else{
                $query = "UPDATE `ecom_brand` SET `brand`='$brandName' WHERE `id`='$id'";
                $updaterow = $this->db->update($query);
                if ($updaterow){
                    $brandmsg = "Brand updated successfully!!";
                    return $brandmsg;
                }
                else{
                    $brandmsg = "Brand not updated!!";
                    return $brandmsg;
                }
            }
        }

        // Delete brand....

        public function getDelbrand($id){
            $query = "DELETE FROM `ecom_brand` WHERE `id`='$id'";
            $deleteData = $this->db->delete($query);
            if ($deleteData){
                $brandmsg = "Brand deleted successfully!!";
                return $brandmsg;
            }
            else{
                $brandmsg = "Brand not deleted!!";
                return $brandmsg;
            }
        }
    }
?>
