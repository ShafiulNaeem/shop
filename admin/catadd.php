<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
include('../classes/addcategory.php');

?>
<?php
$adcrt = new addcategory();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $categoryName = $_POST['categoryName'];

    $insertcategory = $adcrt->addcategorymethod($categoryName);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>

               <div class="block copyblock"> 
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <?php
                            if (isset($insertcategory)){
                                echo $insertcategory;
                            }
                            ?>
                            <td>
                                <input type="text" name="categoryName" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>