<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/1/2019
 * Time: 1:24 AM
 */
?>
<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php
    class cart{
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        // add to cart.....
        public function addtocart($quantity,$proid){
            $quantity = $this->fm->validation($quantity);
            $proid = $this->fm->validation($proid);

            $quantity = mysqli_real_escape_string($this->db->link,$quantity);

            $sid = session_id();

            $query = "SELECT * FROM `ecom_product` where `proid`='$proid'";

            $value = $this->db->select($query)->fetch_assoc();
            $proname = $value['proname'];
            $price = $value['price'];
            $image = $value['image'];

            $chquery = "SELECT * FROM `ecom_cart` where `proid`='$proid' AND `sid` = '$sid'";
            $checkvalue = $this->db->select($chquery);



            if ($checkvalue){
                $qtmsg = 'Allready added your Product!!';
                return $qtmsg;
            }
            else{


                $query = "INSERT INTO `ecom_cart`(`sid`, `proid`, `proname`, `price`, `quantity`, `image`) 
                           VALUES ('$sid','$proid','$proname','$price','$quantity','$image')";
                $insertcat = $this->db->insert($query);

                if ($insertcat){
                    header('location: cart.php');
                }
                else{
                    header('location: 404.php');
                }
            }
        }

        // show cart
        public function getcartshow(){
            $sid = session_id();
            $query = "SELECT * FROM `ecom_cart` WHERE `sid` = '$sid'";
            $result = $this->db->select($query);
            return $result;
        }

       // update caet
        public function uptocart($cartid,$quantity){
            $quantity = mysqli_real_escape_string($this->db->link,$quantity);
            $cartid = mysqli_real_escape_string($this->db->link,$cartid);

            $query = "UPDATE `ecom_cart` 
                SET `quantity` = '$quantity'
                WHERE `cartid` = '$cartid'";

            $update = $this->db->update($query);
            if ($update) {
                header('location:cart.php');

            } else {
                $promsg = "Quantity not updated!!";
                return $promsg;
            }
        }

        //Delete cart product..
        public function getDelcart($cartid){
            $query = "DELETE FROM `ecom_cart` WHERE `cartid`='$cartid'";
            $deleteData = $this->db->delete($query);
            if ($deleteData){
                header('location: cart.php');
            }
            else{
                $promsg = "Product not deleted!!";
                return $promsg;
            }
        }

        // cart total price show
        public function checkcatdata(){
            $sid = session_id();
            $query = "SELECT * FROM `ecom_cart` WHERE `sid` = '$sid'";
            $result = $this->db->select($query);
            return $result;
        }

        // Delete data
        public function delusercart(){
            $sid = session_id();
            $query = "DELETE FROM `ecom_cart` WHERE `sid` = '$sid'";
            $this->db->delete($query);
        }

        // ordered data paymrnt
        public function getorderdata($userid){
            $sid = session_id();
            $query = "SELECT * FROM `ecom_cart` WHERE `sid` = '$sid'";
            $getctdata = $this->db->select($query);

            if ($getctdata){
                $count = 0;
                while ($result = $getctdata->fetch_assoc()){
                    $proid = $result['proid'];
                    $proname = $result['proname'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $quantity ;
                    $image = $result['image'];

                    $query = "INSERT INTO `ecom_customer_order`
                          (`userid`, `productid`, `price`, `quantity`, `productname`, `image`) 
                           VALUES ('$userid','$proid','$price','$quantity','$proname','$image')";
                    $insertcat = $this->db->insert($query);

                }

            }
        }

        // show price

        public function getuserpdprice($userid){

            $query = "SELECT `price` FROM `ecom_customer_order` WHERE `userid` = '$userid'";
            $result = $this->db->select($query);
            return $result;
        }

        //show full order list
        public function getordershow($userid){
            $query = "SELECT * FROM `ecom_customer_order` WHERE `userid` = '$userid' ORDER BY `date` DESC ";
            $result = $this->db->select($query);
            return $result;
        }
        // check order
        public function checkoddata($userid){
            $query = "SELECT * FROM `ecom_customer_order` WHERE `userid` = '$userid'";
            $result = $this->db->select($query);
            return $result;
        }
        // control order...
        public function getOrddatashow(){
            $query = "SELECT * FROM `ecom_customer_order` ORDER BY `date`";
            $result = $this->db->select($query);
            return $result;
        }
        //shifting data
        public function upsfitdata($id,$proid,$date){
            $id      = mysqli_real_escape_string($this->db->link,$id);
            $proid   = mysqli_real_escape_string($this->db->link,$proid);
            $date   = mysqli_real_escape_string($this->db->link,$date);

            $query = "UPDATE `ecom_customer_order` 
                SET `status` = '1'
                WHERE `userid` = '$id' AND `productid` = '$proid'";

            $update = $this->db->update($query);
            if ($update) {
                $promsg = "Status updated!!";
                return $promsg;

            }
            else {
                $promsg = "Not updated!!";
                return $promsg;
            }
        }
        // shifted data delete
        public function updeletedata($id,$proid,$date){
            $id      = mysqli_real_escape_string($this->db->link,$id);
            $proid   = mysqli_real_escape_string($this->db->link,$proid);
            $date   = mysqli_real_escape_string($this->db->link,$date);
            $query = "DELETE FROM `ecom_customer_order` WHERE `userid` = '$id' AND `productid` = '$proid'";
            $delete = $this->db->delete($query);
            if ($delete) {
                $promsg = "Data Removed Successfully!!";
                return $promsg;

            }
            else {
                $promsg = "Data did not Removed!!";
                return $promsg;
            }
        }
        //confirm form customer

        public function confirmdata($id,$proid,$date){
            $id      = mysqli_real_escape_string($this->db->link,$id);
            $proid   = mysqli_real_escape_string($this->db->link,$proid);
            $date   = mysqli_real_escape_string($this->db->link,$date);

            $query = "UPDATE `ecom_customer_order` 
                SET `status` = '2'
                WHERE `userid` = '$id' AND `productid` = '$proid'";

            $update = $this->db->update($query);
            if ($update) {
                $promsg = "Status confirm!!";
                return $promsg;

            }
            else {
                $promsg = "Not confirm!!";
                return $promsg;
            }
        }



    }
?>
