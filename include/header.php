<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/session.php');
Session::init();
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/Format.php');

spl_autoload_register(function ($classes){
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../classes/'.$classes.'.php');
});
$db = new Database();
$fm = new Format();
$pd = new product();
$cat = new addcategory();
$ct = new cart();
$us = new user();

?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function($){
            $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
        });
    </script>
</head>
<body>
<div class="wrap">
    <div class="header_top">
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="" /></a>
        </div>
        <div class="header_top_right">
            <div class="search_box">
                <form>
                    <input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
                </form>
            </div>
            <div class="shopping_cart">
                <div class="cart">
                    <a href="#" title="View my shopping cart" rel="nofollow">
                        <span class="cart_title">Cart</span>
                        <span class="no_product">
                            <?php
                            $getdata = $ct->checkcatdata();
                            if ($getdata){
                                $sum = Session::get('sum');
                                $qty = Session::get('qty');
                                echo "$ ".$sum." |Qty: ".$qty;
                            }
                            else{
                                echo 'Empty';
                            }

                            ?>
                        </span>
                    </a>
                </div>
            </div>
            <?php
                if (isset($_GET['uid'])){
                    $userid =  Session::get("userid");
                    $deletedata = $ct->delusercart();
                    $delcompr = $pd->delcomprdata($userid);
                    Session::destroy();
                }
            ?>
            <div class="login">

                    <?php
                        $login =  Session::get("userlogin");
                        if ($login == false) { ?>
                            <a href="login.php">Login</a>
                    <?php } else { ?>
                            <a href="?uid=<?php Session::get("userid"); ?>">Logout</a>

                <?php } ?>


            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="menu">
        <ul id="dc_mega-menu-orange" class="dc_mm-orange">
            <li><a href="index.php">Home</a></li>

            <li><a href="topbrands.php">Top Brands</a></li>
            <?php
            $Checkcart =  $ct->checkcatdata();
            if ($Checkcart == true){?>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="payment.php">Payment</a></li>
            <?php } ?>

            <?php
            $userid =  Session::get("userid");
            $Checkod =  $ct->checkoddata($userid);
            if ($Checkod == true){?>
                <li><a href="order.php">Order</a></li>

            <?php } ?>

            <?php
            $login =  Session::get("userlogin");
            if ($login == true){?>

            <li><a href="profile.php">Profile</a></li>
            <?php } ?>
            <?php
            $userid =  Session::get("userid");
            $getcart = $pd->getcomprpdtshow($userid);
            if ($getcart){
                ?>
                <li><a href="compare.php">Products Compare</a> </li>
            <?php } ?>
            <li><a href="contact.php">Contact</a> </li>

            <div class="clear"></div>
        </ul>
    </div>