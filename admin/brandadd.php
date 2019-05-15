<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 2/27/2019
 * Time: 2:34 AM
 */
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
include ('../classes/brand.php');

?>
<?php
$brand = new brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $brandName = $_POST['brandName'];

    $insertbrand = $brand->addbrandmethod($brandName);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Brand</h2>

        <div class="block copyblock">
            <form action="brandadd.php" method="post">
                <table class="form">
                    <tr>
                        <?php
                        if (isset($insertbrand)){
                            echo $insertbrand;
                        }
                        ?>
                        <td>
                            <input type="text" name="brandName" placeholder="Enter Category Name..." class="medium" />
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
