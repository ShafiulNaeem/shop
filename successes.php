<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/7/2019
 * Time: 4:43 AM
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


}
?>

<div class="main">
    <div class="content">
        <div class="section group" style="text-align: center;">
            <h1 style="color: darkgreen; font-size: 40px; margin-top:30px; margin-bottom: 30px; ">
                YOur Order Successfully Done!!! </h1>
            <?php
                $userid = Session::get("userid");
                //echo $userid;
                $showprice = $ct->getuserpdprice($userid);



                if ($showprice) {
                    $sum = 0;
                    while ($result = $showprice->fetch_assoc()) {

                        $price = $result['price'];
                        $sum = $sum + $price;
                    }
                }
            ?>

            <style>
                .color{
                    color: red;
                }
            </style>

            <h2 style="color: dodgerblue; font-size: 20px; margin-top:0px; margin-bottom: 5px; ">
                Your total price with Vat: $<span class='color'>
                    <?php
                    $vat = $sum * 0.1;
                    $total = $sum + $vat;
                    echo $total;
                    ?>
                </span>


            </h2>

            <h2 style="color: dodgerblue; font-size: 20px; margin-top:0px; margin-bottom: 20px; ">
                Visit Your Order Details...<a class="color" href="order.php">Continue Details....</a>
            </h2>

            <h3 style="color: dodgerblue; font-size: 30px; margin-top:0px; margin-bottom: 20px; ">
                Thank you Sir for buy Product from Ecomerce.com</h3>
            <p style="color: red; font-size: 18px; margin-top:5px; margin-bottom: 30px; line-height: 30px;">
                If your product working bad or, <br>
                You can find any problem of our product within 30 Days.<br>
                please contact us!!! </p>

        </div>

    </div>
</div>
<?php include('include/footer.php'); ?>



