<?php
/**
 * Created by PhpStorm.
 * User: Rifat Neem
 * Date: 3/20/2019
 * Time: 4:42 PM
 */
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/user.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php

if (!isset($_GET['userid']) || $_GET['userid']==NULL ){
    echo "<script>window.Location = 'inbox.php';</script>";
}
else{
    //$id = $_GET['catid'];
    $id = preg_replace('/[^A-Za-z0-9_]/', '',$_GET['userid']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<script>window.Location = 'inbox.php';</script>";
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Details </h2>


        <div class="block copyblock">
            <form action="" method="post">
                        <?php
                        $us = new user();
                        $getusdata = $us->userdatashow($id);
                        if ($getusdata){
                        $count = 0;
                        while ($result = $getusdata->fetch_assoc()){
                        $count++;

                        ?>
                        <table class="tblone" style="border: 2px solid rosybrown;">


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
                        </table>
                <a href="inbox.php" type="primary">OK</a>

            </form>
            <?php }} ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>


