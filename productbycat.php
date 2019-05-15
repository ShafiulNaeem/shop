<?php include('include/header.php'); ?>
<?php
if (!isset($_GET['catid']) || $_GET['catid']==NULL ){
    echo "<script>window.Location = '404.php';</script>";
}
else{
    $id = $_GET['catid'];
    $id = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['catid']);
}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Iphone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
                <?php
                $getcat = $pd->getcattopd($id);
                if ($getcat){
                    $count = 0;
                    while ($result = $getcat->fetch_assoc()){
                        $count++;
                ?>

				<div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result ['proid']; ?>">
                        <img src="admin/<?php echo $result ['image']; ?>" alt="" />
                    </a>

					 <h2><?php echo $result ['proname']; ?></h2>
					 <p><?php echo $fm->textShorten($result ['body'],30); ?></p>
					 <p><span class="price"><?php echo $result ['price']; ?></span></p>
				     <div class="button">
                         <span>
                             <a href="details.php?proid=<?php echo $result ['proid']; ?>" class="details">Details
                             </a>
                         </span>
                     </div>
				</div>
                <?php } } else{
                    echo "<span>Category not found</span>";
                } ?>
			</div>

	
	
    </div>
 </div>
<?php include('include/footer.php'); ?>