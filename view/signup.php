
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
	<h2>Sign Up Form</h2>
		<form action="signup.php" method="post">
			<div class="imgcontainer">
				<img src="images/WISHLIST.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
            <label><b>Email</b></label>
				<input type="email" class= "space" placeholder="Enter Email" name="email" required>
				<label><b>Username</b></label>
				<input type="text" class= "space"  placeholder="Enter Username" name="User_name" required>
				<label><b>Password</b></label>
				<input type="password" class= "space"  placeholder="Enter Password" name="password" required>
				<label><b>Confirm Password</b></label>
				<input type="password" class= "space" placeholder="Enter Password" name="cpassword" required>
				
                
				<button class="create_acc" name="register"  type="submit">Sign Up</button>
				
				<a href="/Applications/XAMPP/xamppfiles/htdocs/PT2/index.php"><button type="button" class="back_btn"><< Back to Login</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
				@$User_name=$_POST['User_name'];
				@$password=$_POST['password'];
				@$cpassword=$_POST['cpassword'];
                @$email= $_POST['email'];
				
				//checking email
				$sql = "SELECT * FROM customer WHERE email='$email'";
  				$res = mysqli_query($con,$sql);

  				
  			if($res)
					{
						if(mysqli_num_rows($res)>0)//returned any record
						{
							echo '<script type="text/javascript">alert("Sorry... email already taken")</script>';
						}
 
   				
   				
				if($password!=$cpassword){
					echo '<script type="text/javascript">alert("Passwords do not match")</script>';
				}

				if($password==$cpassword)
				{

					$query = "select * from customer where User_name='$User_name'";
					//echo $query;
				    $query_run = mysqli_query($con,$query);
				    //echo mysql_num_rows($query_run);

				
  				
				if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)//returned any record
						{
							echo '<script type="text/javascript">alert("This Username Already exists.. Please try another username!")</script>';
						}
						
						
						
						else
						{
							$query = "insert into customer values('$email','$User_name','$password',CURRENT_TIMESTAMP())";
							$query_run = mysqli_query($con,$query);
                            echo $query_run;
                            echo $query;
                            echo '<script type="text/javascript">alert("This", $query_run)</script>';

                            
							if($query_run)
							{
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
								$_SESSION['User_name'] = $User_name;
								$_SESSION['password'] = $password;
                                $_SESSION['email'] = $email;
								
								
								header( "Location: login.php");
							}
							else
							{
                                

								echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("DB error")</script>';
					}
				}
			}
				else
				{
					echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
				}
				
			}
			else
			{
			}
		?>
	</div>
<footer>
  <p class="p-3 bg-dark text-white text-center" align="center">&copy; WISHTLIST- THE PRICE TRACKER</p>
</footer>
</body>
</html>

		