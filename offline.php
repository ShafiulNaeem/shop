<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/6/2019
 * Time: 9:45 PM
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
    if (isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $userid =  Session::get("userid");
        $insertorder = $ct->getorderdata($userid);
        $deletedata = $ct->delusercart();
        header('location: successes.php');
    }
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="division" style="float: left; margin: 10px 5px; width: 50%;">
                <h2>Your Cart</h2>
                <span style="color: red; font-size: 18px; font-weight: bold;">
                <table class="tblone">
                    <tr>
                        <th width="5%">SL</th>
                        <th width="20%">Product Name</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                    </tr>
                    <?php
                    $getcart = $ct->getcartshow();
                    if ($getcart){
                        $count = 0;
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getcart->fetch_assoc()){
                            $count++;



                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>

                                <td><?php echo $result ['proname']; ?></td>
                                <td>$<?php echo $result ['price']; ?></td>
                                <td><?php echo $result ['quantity']; ?></td>

                                <td>
                                    <?php
                                    $total = $result ['price'] *  $result ['quantity'];
                                    echo $total;
                                    ?>
                                </td>

                            </tr>
                            <?php
                            $sum = $sum + $total;
                            $qty = $qty + $result ['quantity'];

                            ?>

                        <?php } } ?>
                </table>

                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td><?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <th>VAT : 10%</th>
                        <td> <?php
                            $tot_vat = $sum * 0.1;
                            echo $tot_vat;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td>
                            <?php
                            $tot = $sum + $tot_vat;
                            echo $tot;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="division" style="float: left; margin: 10px 5px; width: 45%;">
                <h1>Profile</h1>
                <?php
                $id = Session::get("userid");
                $getusdata = $us->userdatashow($id);
                if ($getusdata){
                    $count = 0;
                    while ($result = $getusdata->fetch_assoc()){
                        $count++;

                        ?>
                        <table class="tblone" style="border: 2px solid rosybrown;">
                            <tr>
                                <td  width="20%">Name: </td>
                                <td width="70%"><?php echo $result['name'] ?></td>
                            </tr>
                            <tr>
                                <td width="20%">Email: </td>
                                <td width="70%"><?php echo $result['email'] ?></td>
                            </tr>
                            <tr>
                                <td width="20%">City: </td>
                                <td width="70%"><?php echo $result['city'] ?></td>
                            </tr>
                            <tr>
                                <td width="20%">Phone: </td>
                                <td width="70%"><?php echo $result['phone'] ?></td>
                            </tr>
                            <tr>
                                <td width="20%">Country: </td>
                                <td width="70%"><?php echo $result['country'] ?></td>
                            </tr>





                        </table>
                    <?php } } ?>
            </div>
        </div>
        <div class="shopright" style="text-align: center; margin-top: 30px;">
            <a href="?orderid=order" style="font-size: 20px; background-color: red; padding: 8px 13px; color: white;">Order</a>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>


