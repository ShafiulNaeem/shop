<?php include('include/header.php'); ?>
<?php
$login =  Session::get("userlogin");
if ($login == true){
    header('location: order.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])){
    $uslogin = $us->userLogin($_POST);
}
?>


 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
                <?php
                if (isset($uslogin)){
                    echo $uslogin;
                }
                ?>
                <input type="text" name="email" placeholder="Name" />
                <input type="password" name="password" placeholder="password" />

                <div class="buttons">
                    <div>
                        <button class="grey" name="signin">Sign In</button>
                    </div>
                </div>
                 </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>

                    </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reg'])){
                $insertus = $us->insertuser($_POST,$_FILES);
            }
            ?>
    		<form method="post" action="" enctype="multipart/form-data">
                <?php
                    if (isset($insertus)){
                        echo $insertus;
                    }
                ?>
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name" />
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City" />
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Zip-Code" />
							</div>
							<div>
								<input type="text" name="email" placeholder="E-Mail" />
							</div>
		    			 </td>
		    			<td>


                            <div>
                                <input type="text" name="country" placeholder="Country" />
                            </div>

                             <div>
                             <input type="text" name="phone" placeholder="Phone" />
                             </div>

                             <div>
                                 <input type="text" name="password" placeholder="Password" />
                             </div>
                             <div>
                                    <label>Upload Image</label>
                                    <input type="file" name="image" />

                             </div>
		    	        </td>
		        </tr>
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="reg" >Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include('include/footer.php'); ?>