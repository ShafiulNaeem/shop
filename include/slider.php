<div class="header_bottom">
    <div class="header_bottom_left">

        <div class="section group">
            <?php
            $getbrand = $pd->getbrandtopd();
            if ($getbrand){
            $count = 0;
            while ($result = $getbrand->fetch_assoc()){
            $count++;
            ?>


            <div class="listview_1_of_2 images_1_of_2" style="width: 47% !important; margin: 0px !important; padding: 0px !important; float: left!important;">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?proid=<?php echo $result ['proid']; ?>">
                        <img src="admin/<?php echo $result ['image']; ?>" alt="" />
                    </a>

                </div>
                <div class="text list_2_of_1">
                    <h2><?php echo $result ['brand']; ?></h2>
                    <p><?php echo $result ['proname']; ?></p>
                    <div class="button">
                        <span>
                            <a href="details.php?proid=<?php echo $result ['proid']; ?>">Add to cart</a>
                        </span>
                    </div>
                </div>

            </div>
            <?php } } ?>



        </div>
        <div class="section group">


        </div>

        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt=""/></li>
                    <li><img src="images/2.jpg" alt=""/></li>
                    <li><img src="images/3.jpg" alt=""/></li>
                    <li><img src="images/4.jpg" alt=""/></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>