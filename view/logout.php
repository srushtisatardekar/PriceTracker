<?php
echo"in logout. please login";

if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['User_name']);
    header('Location: index.php');
}

?>