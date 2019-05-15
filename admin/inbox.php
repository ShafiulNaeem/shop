<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/cart.php');
    include_once ($filepath.'/../helpers/Format.php');

?>

<?php
    $ct = new cart();
    $fm = new Format();
    if (isset($_GET['shiftid'])){
        $id = $_GET['shiftid'];
        $proid = $_GET['proid'];
        $date = $_GET['date'];

        $shift = $ct->upsfitdata($id,$proid,$date);
    }
    if (isset($_GET['deletid'])){
        $id = $_GET['deletid'];
        $proid = $_GET['proid'];
        $date = $_GET['date'];

        $delete = $ct->updeletedata($id,$proid,$date);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
                            <th>Order Time</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Customer ID</th>
                            <th>Address</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    if (isset($shift)){
                        echo $shift;
                    }
                    if (isset($delete)){
                        echo $delete;
                    }
                    ?>
                    <?php

                        $orddata = $ct->getOrddatashow();
                        if ($orddata) {
                            while ($result = $orddata->fetch_assoc()){

                    ?>
                            <tr class="odd gradeX" >
                                <td><?php echo $result ['id']; ?></td>
                                <td><?php echo $fm->formatDate($result ['date']); ?></td>
                                <td><?php echo $result ['productname']; ?></td>
                                <td>$<?php echo $result ['price']; ?></td>
                                <td><?php echo $result ['quantity']; ?></td>
                                <td><?php echo $result ['userid']; ?></td>
                                <td >
                                    <a href = "customer.php?userid=<?php echo $result ['userid']; ?> ">View
                                    </a>
                                </td >
                                <?php
                                if ($result ['status'] == 0){ ?>
                                    <td >
                                        <a href = "?shiftid=<?php echo $result ['userid']; ?>&proid=<?php echo $result ['productid']; ?>&date=<?php echo $result ['date']; ?>
                                        ">Shifted
                                        </a >
                                    </td >
                                <?php } elseif ($result ['status'] == 1) { ?>
                                    <td>Pending</td>

                                <?php } else{ ?>
                                    <td >
                                        <a href = "?deletid=<?php echo $result ['userid']; ?> &proid=<?php echo $result ['productid']; ?> &date=<?php echo $result ['date']; ?>
                                        ">Remove
                                        </a >
                                    </td >
                              <?php  } ?>

						    </tr >
					<?php } } ?>

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
