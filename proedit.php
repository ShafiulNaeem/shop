<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/5/2019
 * Time: 8:50 PM
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

<?php
if (!isset($_GET['userid']) || $_GET['userid']==NULL ){
    echo "<script>window.Location = '404.php';</script>";
}
else{
    //$id = $_GET['catid'];
    $userid = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['userid']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){


    $update = $us->updateuserdata($_POST,$userid);
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <h1>Update User Profile</h1>
            <?php
                if (isset($update)){
                    echo $update;
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <?php

            $getusdata = $us->userdatashow($userid);
            if ($getusdata){
                $count = 0;
                while ($result = $getusdata->fetch_assoc()){
                    $count++;

                    ?>
                    <table class="tblone" style="border: 2px solid rosybrown;">

                        <tr>

                            <td width="20%" rowspan="6">
                                <img src="<?php echo $result['image']; ?>" style="min-width: 200px; height: auto;"></td>

                        </tr>

                        <tr>
                            <td  width="20%">Name: </td>
                            <td width="70%">
                                <input type="text" name="name" value="<?php echo $result['name'] ?>" " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Email: </td>
                            <td width="70%">
                                <input type="text" name="email" value="<?php echo $result['email'] ?>" " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">City: </td>
                            <td width="70%">
                                <input type="text" name="city" value="<?php echo $result['city'] ?>" " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Phone: </td>
                            <td width="70%">
                                <input type="text" name="phone" value="<?php echo $result['phone'] ?>" " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Country: </td>
                            <td width="70%">
                                <input type="text" name="country" value="<?php echo $result['country'] ?>" " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"></td>
                            <td width="20%">
                                <input type="submit" name="submit" Value="Save" />
                            </td>


                        </tr>




                    </table>
                <?php } } ?>
            </form>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>

