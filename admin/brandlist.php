<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 2/27/2019
 * Time: 2:50 AM
 */
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include ('../classes/brand.php');?>

<?php

$brandlist = new brand();

if (isset($_GET['delbrandid'])){
    //$id = $_GET['delcatid'];
    $id = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['delbrandid']);

    $delbrand = $brandlist->getDelbrand($id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <div class="block">
            <?php
            if (isset($delbrand)){
                echo $delbrand;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $getbrandlist = $brandlist->getbrand();
                         if (isset($getbrandlist)){
                             $count = 0;
                            while ($result = $getbrandlist->fetch_assoc()){
                                 $count++;
                ?>
                        <tr class="odd gradeX">
                            <td><?php echo $count; ?></td>
                            <td><?php echo $result['brand']; ?></td>
                            <td><a href="brandedit.php?brandid=<?php echo $result['id']; ?>">Edit</a> ||
                                <a onclick="return confirm('Are sure Delete this!!')" href="?delbrandid=<?php echo $result['id']; ?>">Delete</a></td>
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


