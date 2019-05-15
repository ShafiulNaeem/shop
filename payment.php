<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/6/2019
 * Time: 9:07 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/5/2019
 * Time: 4:58 AM
 */
?>
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
<div class="main">
    <div class="content">
        <div class="section group">
            <h1 style="text-align: center; font-size: 40px;">Chose your Payment</h1>
                    <table class="tblone" style="border: 2px solid rosybrown;">
                        <tr>


                            <td width="20%" style="font-size: 25px; background-color: #2B6FB6; padding: 8px 13px;">
                                <a href="offline.php">Offline Payment</a>
                            </td>
                            <td width="20%" style="font-size: 25px; background-color: red; padding: 8px 13px; color: white;">
                                <a href="online.php">Online Payment</a>
                            </td>

                        </tr>






                    </table>

            <div class="shopright" style="text-align: center; margin-top: 100px;">
                <a href="cart.php" style="font-size: 20px; background-color: #1b1b1b; padding: 8px 13px; color: white;">Privious</a>
            </div>

        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>

