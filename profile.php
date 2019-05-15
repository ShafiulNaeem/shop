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
            <h1>Profile</h1>
            <?php
            $id = Session::get("userid");
            $getusdata = $us->userdatashow($id);
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
                        <td width="70%"><?php echo $result['name'] ?></td>
                    </tr>
                    <tr>
                        <td width="20%">Email: </td>
                        <td width="70%"><?php echo $result['email'] ?></td>
                    </tr>
                    <tr>
                        <td width="20%">City: </td>
                        <td width="70%"><?php echo $result['city'] ?></td>
                    </tr>
                    <tr>
                        <td width="20%">Phone: </td>
                        <td width="70%"><?php echo $result['phone'] ?></td>
                    </tr>
                    <tr>
                        <td width="20%">Country: </td>
                        <td width="70%"><?php echo $result['country'] ?></td>
                    </tr>
                <tr>
                    <td width="20%"></td>
                    <td width="20%"></td>
                    <td  width="60%" style="text-align: center;">
                        <a href="proedit.php?userid=<?php echo $result['userid'] ?>">Update Profile</a>

                    </td>


                </tr>




                </table>
            <?php } } ?>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
