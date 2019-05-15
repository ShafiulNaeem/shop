
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/Format.php');

?>

<?php
    class addcategory{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function addcategorymethod($categoryName){
            $categoryName = $this->fm->validation($categoryName);

            $categoryName = mysqli_real_escape_string($this->db->link,$categoryName);

            if (empty($categoryName)){
                $catemsg = 'Must be decleared Category Name!!';
                return $catemsg;
            }
            else{
                $query = "INSERT INTO `ecom_category`(`catname`) VALUES ('$categoryName')";

                $insert = $this->db->insert($query);
                if ($insert){
                    $catemsg = "Ctegory inserted successfully!!";
                    return $catemsg;
                }
                else{
                    $catemsg = "Ctegory not inserted!!";
                    return $catemsg;
                }
            }
        }

        // category list method ......

        public function getCategory(){
            $query = "SELECT * FROM `ecom_category`";
            $result = $this->db->select($query);
            return $result;


        }

        // show category with id ......

        public function getCategoryshow($id){
            $query = "SELECT * FROM `ecom_category` where `id`='$id'";
            $result = $this->db->select($query);
            return $result;
        }


        // update category....
        public function updatecategorymethod($categoryName,$id){
            $categoryName = $this->fm->validation($categoryName);
            $id = $this->fm->validation($id);

            $categoryName = mysqli_real_escape_string($this->db->link,$categoryName);
            $id = mysqli_real_escape_string($this->db->link,$id);

            if (empty($categoryName)){
                $catemsg = 'Must be decleared Category Name!!';
                return $catemsg;
            }
            else{
                $query = "UPDATE `ecom_category` SET `catname`='$categoryName' WHERE `id`='$id'";
                $updaterow = $this->db->update($query);
                if ($updaterow){
                    $catemsg = "Ctegory updated successfully!!";
                    return $catemsg;
                }
                else{
                    $catemsg = "Ctegory not updated!!";
                    return $catemsg;
                }
            }
        }

        // Delete Category .......
        public function getDelCategory($id){
            $query = "DELETE FROM `ecom_category` WHERE `id`='$id'";
            $deleteData = $this->db->delete($query);
            if ($deleteData){
                $catemsg = "Ctegory deleted successfully!!";
                return $catemsg;
            }
            else{
                $catemsg = "Ctegory not deleted!!";
                return $catemsg;
            }
        }
    }
?>
