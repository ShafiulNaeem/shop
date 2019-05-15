<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include ('../classes/product.php');?>
<?php include('../classes/addcategory.php');?>
<?php include ('../classes/brand.php');?>


<?php
$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $insertpd = $pd->insertproduct($_POST,$_FILES);
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">
            <?php
                if (isset($insertpd)){
                    echo $insertpd;
            }
            ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="proname" placeholder="Enter Product Name..." class="medium" />
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
                            <option value="<?php echo $result['id']; ?>"><?php echo $result['catname']; ?></option>
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

                            <option value="<?php echo $result['id']; ?>"><?php echo $result['brand']; ?></option>
                            <?php }} ?>

                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
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
                            <option value="0">Featured</option>
                            <option value="1">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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


