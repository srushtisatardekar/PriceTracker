
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
<body>
<div id="main-wrapper">
	<h3><p align ="center">Login Form</p></h3>
		<div class="imgcontainer">
			<!-- <img src="images/WISHLIST.png" alt="Avatar" class="avatar"> -->
            <p>Welcome to Price Tracker</p>
		</div>
		<form action ="" method="post">
			<div class="inner_container">
			<label><b>Username</b></label>
				<input type="text" class= "space" placeholder="Enter Username" name="User_name" required>
				<label><b>Password</b></label>
				<input type="password" class="space" placeholder="Enter Password" name="password" required>
				<button class="login_button" name="login" type="submit">Login</button>
				<a href="view/signup.php"><button type="button" class="register_btn">Register</button></a>
			</div>
		</form>
		
		
		<?php

			if(isset($_POST['login']))
			{
				@$User_name=$_POST['User_name'];
				@$password=$_POST['password'];

				//sql injection attack prevention
				//username:admin password:anything' or 'x'='x

				$User_name = stripcslashes($User_name);
				$password = stripcslashes($password);

                $con=mysqli_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
                mysqli_select_db ($con,'wishlist_pricetracker');

				$username = mysqli_real_escape_string($con, $User_name);
				$password = mysqli_real_escape_string($con, $password);



				$query = "select * from customer where User_name='$User_name' and password='$password' ";
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['User_name'] = $User_name;
                        header("location: index.php");
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