<?php session_unset();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="~/../libs/fontawesome/css/font-awesome.css" rel="stylesheet" />    
    <link rel="stylesheet" href="~/../libs/bootstrap.css"> 
    <script src="~/../libs/jquery.min.js"></script>
    <script src="~/../libs/bootstrap.js"></script>
    <script src="libs/style.css"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<div id="main-wrapper">
	<h3><p align ="center">Login Form</p></h3>
		<div class="imgcontainer">
			<img src="images/WISHLIST.png" alt="Avatar" class="avatar">
		</div>
		<form action ="login.php" method="post">
			<div class="inner_container">
			<label><b>Username</b></label>
				<input type="text" class= "space" placeholder="Enter Username" name="username" required>
				<label><b>Password</b></label>
				<input type="password" class="space" placeholder="Enter Password" name="password" required>
				<button class="login_button" name="login" type="submit">Login</button>
				<a href="signup.php"><button type="button" class="register_btn">Register</button></a>
			</div>
		</form>
		
		
		<?php
			if(isset($_POST['login']))
			{
				@$username=$_POST['username'];
				@$password=$_POST['password'];

				//sql injection attack prevention
				//username:admin password:anything' or 'x'='x

				$username = stripcslashes($username);
				$password = stripcslashes($password);
				$username = mysqli_real_escape_string($con, $username);
				$password = mysqli_real_escape_string($con, $password);



				$query = "select * from customer where username='$username' and password='$password' ";
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					
					header( "Location: products.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Database Error")</script>';
				}
			}
			else
			{
			}
		?>
		
	</div>

</body>
</html>