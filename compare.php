<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/23/2019
 * Time: 12:04 PM
 */
?>
<?php include 'include/header.php'; ?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Product Compare</h2>
                <span style="color: red; font-size: 18px; font-weight: bold;">
                     </span>
                <table class="tblone">
                    <tr>
                        <th width="5%">SL</th>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                    $userid =  Session::get("userid");
                    $getcart = $pd->getcomprpdtshow($userid);
                    if ($getcart){
                        $count = 0;

                        while ($result = $getcart->fetch_assoc()){
                            $count++;



                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>

                                <td><?php echo $result ['proname']; ?></td>
                                <td><img src="admin/<?php echo $result ['image']; ?>" alt="" /></td>
                                <td><?php echo $result ['price']; ?></td>

                                <td>
                                    <a href="details.php?proid=<?php echo $result ['proid']; ?>">Veiw</a>
                                </td>

                            </tr>


                        <?php } } ?>
                </table>


            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php include('include/footer.php'); ?>
