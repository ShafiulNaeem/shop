<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 2/27/2019
 * Time: 4:00 AM
 */
?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php
    class product
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insertproduct($data, $file){
//            $proname = $this->fm->validation($data['proname']);
//            $catid = $this->fm->validation($data['catid']);
//            $brandid = $this->fm->validation($data['brandid']);
//            $body = $this->fm->validation($data['body']);
//            $price = $this->fm->validation($data['price']);
//            $type = $this->fm->validation($data['type']);

            $proname = mysqli_real_escape_string($this->db->link, $data['proname']);
            $catid = mysqli_real_escape_string($this->db->link, $data['catid']);
            $brandid = mysqli_real_escape_string($this->db->link, $data['brandid']);
            $body = mysqli_real_escape_string($this->db->link, $data['body']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);


                $permited = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $file['image']['name'];
                $file_size = $file['image']['size'];
                $file_temp = $file['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                $uploaded_image = "upload/" . $unique_image;


                if (empty($price)) {
                    $promsg = 'Must be filup all filed!!';
                    return $promsg;
                }
                else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO `ecom_product`(`proname`, `catid`, `brandid`, `body`, `price`, `image`, `type`) VALUES ('$proname','$catid','$brandid','$body','$price','$uploaded_image','$type')";

                    $insert = $this->db->insert($query);
                    if ($insert) {

                        header('location:productlist.php');

                    } else {
                        $promsg = "Product not inserted!!";
                        return $promsg;
                    }
                }
            }

            // product list............
            public function getproduct()
            {

                $query = "SELECT p.*, c.catname, b.brand
                 FROM ecom_product AS p, ecom_category AS c, ecom_brand AS b 
                 WHERE p.catid = c.id AND p.brandid = b.id ORDER BY p.proid DESC ";

//                $query = "SELECT `ecom_product`.*,`ecom_category`.`catname`,`ecom_brand`.`brand`
//                 FROM `ecom_product`
//                 INNER JOIN `ecom_category`
//                 ON `ecom_product`.`catid` = `ecom_category`.`id`
//                 INNER JOIN `ecom_brand`
//                 ON `ecom_product`.`brandid` = `ecom_brand`.`id` ORDER BY `ecom_product`.`proid` DESC ";
                $result = $this->db->select($query);
                return $result;
            }

            // show show and edit
            public function getproductshow($proid){
                $query = "SELECT * FROM `ecom_product` where `proid`='$proid'";
                $result = $this->db->select($query);
                return $result;
            }

            // update product.........
            public function updatepdmethod($data,$file,$proid){
            //$proid = mysqli_real_escape_string($this->db->link, $data['proid']);
            $proname = mysqli_real_escape_string($this->db->link, $data['proname']);
            $catid = mysqli_real_escape_string($this->db->link, $data['catid']);
            $brandid = mysqli_real_escape_string($this->db->link, $data['brandid']);
            $body = mysqli_real_escape_string($this->db->link, $data['body']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);


            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;


            if (empty($price)) {
                $promsg = 'Must be updated all filed!!';
                return $promsg;
            }
            else {
                //move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE `ecom_product` 
                SET `proname` = '$proname',
                `catid` = '$catid',
                `brandid` = '$brandid',
                `body` = '$body',
                `price` = '$price',
                `type` = '$type' 
                WHERE `proid` = $proid";
                $update = $this->db->update($query);
                if ($update) {


                   header('location:productlist.php');


                }
                else {
                    $promsg = "Product not updated!!";
                    return $promsg;
                }
            }

        }

            // dlete product ..........
                 public function getDelproduct($proid){
                    $query = "DELETE FROM `ecom_product` WHERE `proid`='$proid'";
                    $deleteData = $this->db->delete($query);
                    if ($deleteData){
                         $promsg = "Product deleted successfully!!";
                         return $promsg;
                     }
                     else{
                         $promsg = "Product not deleted!!";
                         return $promsg;
                     }
            }

             // get general product ..database to index file
             public function getGeneproduct(){
                $query = "SELECT * FROM `ecom_product` where `type`= '1' ORDER BY `proid` DESC LIMIT 4";
                $result = $this->db->select($query);
                return $result;
            }

            // get general product ..database to index file
            public function getfetproduct(){
                $query = "SELECT * FROM `ecom_product` ORDER BY `proid` DESC LIMIT 4";
                $result = $this->db->select($query);
                return $result;
            }
            public function getDetailspd($proid)
            {

                $query = "SELECT p.*, c.catname, b.brand
                     FROM ecom_product AS p, ecom_category AS c, ecom_brand AS b 
                     WHERE p.catid = c.id AND p.brandid = b.id AND p.proid = '$proid'";

                $result = $this->db->select($query);
                return $result;
            }

            // brand to product....
            public function getbrandtopd(){
                $query = "SELECT p.*, b.brand
                     FROM ecom_product AS p, ecom_brand AS b 
                     WHERE p.brandid = b.id ORDER BY p.proid DESC LIMIT 4";

                $result = $this->db->select($query);
                return $result;
            }

            // category to product..
        public function getcattopd($id){
            $query = "SELECT * FROM `ecom_product` WHERE `catid`= '$id' ";

            $result = $this->db->select($query);
            return $result;
        }

        // product compare and insert

        public function getcomaredata($proid,$userid){
            $userid = mysqli_real_escape_string($this->db->link,$userid);
            $proid = mysqli_real_escape_string($this->db->link,$proid);

            $cquery = "SELECT * FROM `ecom_compare` WHERE `userid` = '$userid' AND  `proid` = '$proid'";
            $check = $this->db->select($cquery);
            if ($check){
                $promsg = "Allready added this Product!!";
                return $promsg;
            }

            $query = "SELECT * FROM `ecom_product` WHERE `proid` = '$proid'";
            $getctdata = $this->db->select($query);
            if ($getctdata){
                while ($result = $getctdata->fetch_assoc()) {
                    $proid = $result['proid'];
                    $proname = $result['proname'];
                    $price = $result['price'];
                    $image = $result['image'];

                    $query = "INSERT INTO `ecom_compare`
                          (`userid`, `proid`, `proname`, `price`, `image`) 
                           VALUES ('$userid','$proid','$proname','$price','$image')";
                    $insertcat = $this->db->insert($query);

                    if ($insertcat) {
                        $promsg = "Product Added successfully check product and compare!!";
                        return $promsg;
                    } else {
                        $promsg = "Product did not added !";
                        return $promsg;
                    }
                }



            }
        }

        // compare product show
        public function getcomprpdtshow($userid){
            $query = "SELECT * FROM `ecom_compare` WHERE `userid` = '$userid'";
            $result = $this->db->select($query);
            return $result;
        }

        // Delete Compare data
        public function delcomprdata($userid){
            $query = "DELETE FROM `ecom_compare` WHERE `userid`='$userid'";
            $deleteData = $this->db->delete($query);
            return $deleteData;
        }









    }
?>
