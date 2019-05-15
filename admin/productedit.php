<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 2/28/2019
 * Time: 1:04 AM
 */
?>
<?php include 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include ('../classes/product.php');?>
<?php include('../classes/addcategory.php');?>
<?php include ('../classes/brand.php');?>


<?php
$pd = new product();

if (!isset($_GET['proid']) || $_GET['proid']==NULL ){
    echo "<script>window.Location = 'productlist.php';</script>";
}
else{
    //$id = $_GET['catid'];
    $proid = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['proid']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){


    $updateproduct = $pd->updatepdmethod($_POST,$_FILES,$proid);
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block">
            <?php
            if (isset($updateproduct)){
                echo $updateproduct;
            }
            ?>
            <?php

            $getpdshow = $pd->getproductshow($proid);
            if ($getpdshow){
                $j = 0;
                while ($var = $getpdshow->fetch_assoc()){
                    $j++;



                    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">


                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="proname" value="<?php echo $var['proname']; ?>" " class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="catid">
                                <option>Select Category</option>
                                <?php
                                $catlist = new addcategory();
                                $getcatlist = $catlist->getCategory();
                                if (isset($getcatlist)){
                                    $count = 0;
                                    while ($result = $getcatlist->fetch_assoc()){
                                        $count++;
                                ?>
                                <option
                                    <?php
                                        if ($var['catid'] == $result['id']){
                                            ?>
                                            selected = 'selected'
                                        <?php } ?>
                                    value="<?php echo $result['id']; ?>"><?php echo $result['catname']; ?></option>
                                 <?php }} ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brandid">
                                <option>Select Brand</option>
                                <?php
                                $brandlist = new brand();
                                $getbrandlist = $brandlist->getbrand();
                                if (isset($getbrandlist)){
                                    $count = 0;
                                    while ($result = $getbrandlist->fetch_assoc()){
                                        $count++;
                                ?>

                                 <option
                                     <?php
                                     if ($var['brandid'] == $result['id']){
                                         ?>
                                         selected = 'selected'
                                     <?php } ?>
                                        value="<?php echo $result['id']; ?>"><?php echo $result['brand']; ?></option>
                                 <?php }} ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body">
                                <?php echo $var['body']; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $var['price']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $var['image']; ?>" style="max-width: 100px;">
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
                                    if ($var['type'] == 0){ ?>
                                        <option  value="1">General</option>
                                        <option selected = 'selected' value="0">Featured</option>
                                        <?php } else { ?>
                                        <option value="0">Featured</option>
                                        <option selected = 'selected' value="1">General</option>
                                        <?php } ?>


                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php }} ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>



