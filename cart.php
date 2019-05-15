<?php include 'include/header.php'; ?>
<?php
if (isset($_GET['delcartid'])){
    //$id = $_GET['delcatid'];
    $cartid = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['delcartid']);

    $delcart = $ct->getDelcart($cartid);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cartid = $_POST['cartid'];
    $quantity = $_POST['quantity'];
    if ($quantity <= 0){
        $delcart = $ct->getDelcart($cartid);
    }

    $updatecart = $ct->uptocart($cartid,$quantity);
}
?>
<?php
    if (!isset($_GET['id'])){
        echo "<meta http-equiv='refresh' content='0;URL=?id=load'/>";
    }
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
                     <span style="color: red; font-size: 18px; font-weight: bold;">
                                                <?php
                                                if (isset($updatecart)){
                                                    echo $updatecart;
                                                }
                                                if (isset($delcart)){
                                                    echo $delcart;
                                                }
                                                ?>
                     </span>
						<table class="tblone">
							<tr>
                                <th width="5%">SL</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
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
                                        <td><img src="admin/<?php echo $result ['image']; ?>" alt="" /></td>
                                        <td><?php echo $result ['price']; ?></td>
                                        <td>

                                            <form action="" method="post">
                                                <input type="hidden" name="cartid" value="<?php echo $result ['cartid']; ?>"/>
                                                <input type="number" name="quantity" value="<?php echo $result ['quantity']; ?>"/>
                                                <input type="submit" name="submit" value="Update"/>
                                            </form>

                                        </td>
                                        <td>
                                            <?php
                                                $total = $result ['price'] *  $result ['quantity'];
                                                echo $total;
                                            ?>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('are you delete this!!')"
                                               href="?delcartid=<?php echo $result ['cartid']; ?>">X
                                            </a>
                                        </td>

                            </tr>
                                <?php
                                $sum = $sum + $total;
                                $qty = $qty + $result ['quantity'];
                                 Session::set('sum',$sum);
                                 Session::set('qty',$qty);
                                ?>

                            <?php } } ?>
						</table>
                        <?php
                            $getdata = $ct->checkcatdata();
                            if ($getdata){


                            ?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
                                    <?php
                                    $tot_vat = $sum * 0.1;
                                    echo $tot_vat;
                                    ?>
                                </td>
							</tr>
					   </table>
                <?php } else{
                                header('location:index.php');
                            } ?>
					</div>

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