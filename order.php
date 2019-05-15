<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/5/2019
 * Time: 3:57 AM
 */
?>
<?php include('include/header.php'); ?>
<?php
$login =  Session::get("userlogin");
if ($login == false){
    header('location: login.php');
}
?>

<?php

if (isset($_GET['confirmid'])){
    $id = $_GET['confirmid'];
    $proid = $_GET['proid'];
    $date = $_GET['date'];

    $confirm = $ct->confirmdata($id,$proid,$date);
}
if (isset($_GET['deletid'])){
    $id = $_GET['deletid'];
    $proid = $_GET['proid'];
    $date = $_GET['date'];

    $delete = $ct->updeletedata($id,$proid,$date);
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="order">
                <h1 style="text-align: center;">Your Ordered Details Page</h1>

                <table class="tblone">
                    <tr>
                        <th width="5%">SL</th>
                        <th width="20%">Product Name</th>
                        <th width="20%">Image</th>
                        <th width="5%">Quantity</th>
                        <th width="15%">Price</th>
                        <th width="15%">Total Price</th>
                        <th width="20%">Date</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                        if (isset($confirm)){
                            echo $confirm;
                        }
                        if (isset($delete)){
                            echo $delete;
                        }
                    ?>
                    <?php
                    $userid = Session::get("userid");
                    $getod = $ct->getordershow($userid);
                    if ($getod){
                        $count = 0;
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getod->fetch_assoc()){
                            $count++;



                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>

                                <td><?php echo $result ['productname']; ?></td>
                                <td><img src="admin/<?php echo $result ['image']; ?>" alt="" /></td>
                                <td><?php echo $result ['quantity']; ?></td>
                                <td>$<?php echo $result ['price']; ?></td>

                                <td>$
                                    <?php
                                    $total = $result ['price'] *  $result ['quantity'];
                                    echo $total;
                                    ?>
                                </td>
                                <td><?php echo $fm->formatDate($result ['date']); ?></td>
                                <td><?php
                                        if ($result ['status'] == 0){
                                            echo "pending";
                                        }
                                        elseif ($result ['status'] == 1){ ?>
                                            <a href = "?confirmid=<?php echo $result ['userid']; ?>&proid=<?php echo $result ['productid']; ?>&date=<?php echo $result ['date']; ?>
                                        "> Shifted
                                               </a >
                                       <?php }
                                        else{
                                            echo "Confirm";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($result ['status'] == 2){
                                        ?>
                                        <a onclick="return confirm('are you delete this!!')"
                                          href = "?deletid=<?php echo $result ['userid']; ?>&proid=<?php echo $result ['productid']; ?>&date=<?php echo $result ['date']; ?>">X
                                        </a>
                                        <?php
                                    }
                                    else{
                                        echo "N/A";
                                    }
                                    ?>

                                </td>

                            </tr>

                        <?php } } ?>
                </table>

            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>