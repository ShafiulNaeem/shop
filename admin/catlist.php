<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include('../classes/addcategory.php');?>

<?php

$catlist = new addcategory();

if (isset($_GET['delcatid'])){
    //$id = $_GET['delcatid'];
    $id = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['delcatid']);

    $deletcat = $catlist->getDelCategory($id);
}

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
                    <?php
                        if (isset($deletcat)){
                            echo $deletcat;
                        }
                    ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $getcatlist = $catlist->getCategory();
                        if (isset($getcatlist)){
                            $count = 0;
                            while ($result = $getcatlist->fetch_assoc()){
                                $count++;



                    ?>
						<tr class="odd gradeX">
							<td><?php echo $count; ?></td>
							<td><?php echo $result['catname']; ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['id']; ?>">Edit</a> ||
                                <a onclick="return confirm('Are sure Delete this!!')" href="?delcatid=<?php echo $result['id']; ?>">Delete</a></td>
						</tr>
                    <?php }}?>

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

