<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 2/27/2019
 * Time: 3:01 AM
 */
?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
include ('../classes/brand.php');

?>
<?php
$brand = new brand();

if (!isset($_GET['brandid']) || $_GET['brandid']==NULL ){
    echo "<script>window.Location = 'brandlist.php';</script>";
}
else{
    //$id = $_GET['catid'];
    $id = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['brandid']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $brandName = $_POST['brandName'];

    $updatebrand = $brand->updatebrandymethod($brandName,$id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <?php
        if (isset($updatebrand)){
            echo $updatebrand;
        }
        ?>

        <div class="block copyblock">
            <form action="" method="post">
                <table class="form">
                    <tr>

                        <?php

                        $getbrandupshow = $brand->getbrandshow($id);
                        if ($getbrandupshow){
                        $j = 0;
                        while ($result = $getbrandupshow->fetch_assoc()){
                        $j++;



                        ?>
                        <td>
                            <input type="text" name="brandName" value="<?php echo $result['brand']; ?>" class="medium" />
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


