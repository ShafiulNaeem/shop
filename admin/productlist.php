<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include ('../classes/product.php');?>
<?php include_once('../helpers/Format.php');?>

<?php
$pd = new product();
$fm = new Format();

if (isset($_GET['delproid'])){
    //$id = $_GET['delcatid'];
    $proid = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['delproid']);

    $deletpd = $pd->getDelproduct($proid);
}

?>
<div class="grid_10">
    <div class="box round first grid">

        <h2>Post List</h2>
        <div class="block">
            <?php
            if (isset($deletpd)){
                echo $deletpd;
            }
            ?>
            <table class="data display datatable" id="example">

			<thead>
				<tr>
					<th>SL NO:</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                    <?php
                    $getpdlist = $pd->getproduct();
                    if (isset($getpdlist)){
                        $count = 0;
                        while ($result = $getpdlist->fetch_assoc()){
                        $count++;



                    ?>

				<tr class="gradeU">
                    <td><?php echo $count; ?></td>
                    <td><?php echo $result['proname']; ?></td>
                    <td><?php echo $result['catname']; ?></td>
                    <td><?php echo $result['brand']; ?></td>
                    <td><?php echo $fm->textShorten($result['body'],20); ?></td>
                    <td>$<?php echo $result['price']; ?></td>
                    <td><img src="<?php echo $result['image']; ?>" style="max-width: 100px;"></td>
                    <td>
                        <?php
                            if ($result['type']==1){
                                echo "General";
                            }
                            else{
                                echo "Fetured";
                            }
                            ?>
                    </td>
                    <td>
                        <a href="productedit.php?proid=<?php echo $result['proid']; ?>">Edit</a> ||
                        <a onclick="return confirm('Are sure Delete this!!')"
                           href="?delproid=<?php echo $result['proid']; ?>">Delete</a>
                    </td>

                </tr>
                    <?php }} ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
