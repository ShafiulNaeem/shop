<?php include('include/header.php'); ?>
<?php
    if (isset($_GET['proid'])){
//        echo "<script>window.Location = '404.php';</script>";
//    }
//    else{
//        //$id = $_GET['catid'];
        $proid = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['proid']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $quantity = $_POST['quantity'];

        $addcart = $ct->addtocart($quantity,$proid);
    }
?>
<?php
    $userid =  Session::get("userid");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){

        $proid =$_POST['proid'];
        $insertcmpr = $pd->getcomaredata($proid,$userid);
    }
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
                    <?php

                        $getpd = $pd->getDetailspd($proid);
                        if ($getpd){
                            $count = 0;

                            while ($result = $getpd->fetch_assoc()){
                                $count++;

                    ?>
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result ['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2>Lorem Ipsum is simply dummy text </h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>					
					<div class="price">
						<p>Price: <span><?php echo $result ['price']; ?></span></p>
						<p>Category: <span><?php echo $result ['catname']; ?></span></p>
						<p>Brand:<span><?php echo $result ['brand']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">

						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>
                    <span style="color: red; font-size: 18px; font-weight: bold;">
                        <?php
                        if (isset($addcart)){
                            echo $addcart;
                        }
                        ?>
                    </span>
				</div>

                <div class="add-cart">

                    <?php
                        if (isset($insertcmpr)){
                            echo $insertcmpr;
                        }
                    ?>
                    <?php
                    $login =  Session::get("userlogin");
                    if ($login == true){
                    ?>
                    <form action="" method="post">

                        <input type="hidden" class="buyfield" name="proid" value="<?php echo $result ['proid']; ?>"/>
                        <input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
                    </form>
                    <?php } ?>

			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
                <p><?php echo $result ['body']; ?></p>
            </div>
                    <?php }} ?>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
                        <?php
                            $getAllcat = $cat->getCategory();
                            if ($getAllcat){
                            $count = 0;

                            while ($result = $getAllcat->fetch_assoc()){
                            $count++;

                        ?>
				       <li><a href="productbycat.php?catid=<?php echo $result ['id']; ?>">
                               <?php echo $result ['catname']; ?>
                           </a>
                       </li>
                        <?php } } ?>

    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
<?php include('include/footer.php'); ?>
