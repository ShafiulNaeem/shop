<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 2/25/2019
 * Time: 4:14 PM
 */
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
include('../classes/addcategory.php');

?>
<?php
$adcrt = new addcategory();

if (!isset($_GET['catid']) || $_GET['catid']==NULL ){
    echo "<script>window.Location = 'catlist.php';</script>";
}
else{
    //$id = $_GET['catid'];
    $id = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['catid']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $categoryName = $_POST['categoryName'];

    $updatecategory = $adcrt->updatecategorymethod($categoryName,$id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <?php
        if (isset($updatecategory)){
            echo $updatecategory;
        }
        ?>

        <div class="block copyblock">
            <form action="" method="post">
                <table class="form">
                    <tr>

                        <?php

                            $getcatupshow = $adcrt->getCategoryshow($id);
                            if ($getcatupshow){
                                $j = 0;
                                while ($result = $getcatupshow->fetch_assoc()){
                                    $j++;



                        ?>
                        <td>
                            <input type="text" name="categoryName" value="<?php echo $result['catname']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php }} ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>

