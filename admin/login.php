
<?php
include ('../classes/Adminlogin.php');

?>
<?php
$amdin = new Adminlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $adminuser = $_POST['username'];
    $adminpass = md5($_POST['password']);

    $logincheck = $amdin->Adminloginmethod($adminuser,$adminpass);
}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
            <span style="color: red; font-size: 20px; font-weight: bold;">

                <?php
                if (isset($logincheck)){
                    echo $logincheck;
                }
                ?>
            </span>
			<div>
				<input type="text" placeholder="Username" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="password"/>
			</div>

			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->

	</section><!-- content -->
</div><!-- container -->
</body>
</html>