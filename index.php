<?php include('include/header.php'); ?>
<?php include('include/slider.php'); ?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
              <?php
                $getgeneralpd = $pd->getGeneproduct();
                if ($getgeneralpd){
                    $count = 0;

                     while ($result = $getgeneralpd->fetch_assoc()){
                      $count++;


              ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result ['proid']; ?>"><img src="admin/<?php echo $result ['image']; ?>" alt="" /></a>
					 <h2><?php echo $result ['proname']; ?> </h2>
					 <p><?php echo $fm->textShorten($result ['body'],50); ?></p>
					 <p><span class="price"><?php echo $result ['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php
                             echo $result ['proid']; ?>" class="details">Details</a>
                         </span>
                     </div>
				</div>
              <?php }} ?>

			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <div class="section group">
            <?php
            $getfetralpd = $pd->getfetproduct();
            if ($getfetralpd){
                $count = 0;

                while ($result = $getfetralpd->fetch_assoc()){
                    $count++;


                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?proid=<?php echo $result ['proid']; ?>">
                            <img src="admin/<?php echo $result ['image']; ?>" alt="" /></a>
                        <h2><?php echo $result ['proname']; ?> </h2>
                        <p><?php echo $fm->textShorten($result ['body'],50); ?></p>
                        <p><span class="price"><?php echo $result ['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?proid=<?php
                                echo $result ['proid']; ?>" class="details">Details</a>
                         </span>
                        </div>
                    </div>
                <?php }} ?>

        </div>
    </div>
 </div>
</div>
<?php include('include/footer.php'); ?>
