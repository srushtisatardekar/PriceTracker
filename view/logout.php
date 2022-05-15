<?php
session_start();
echo"in logout. please login";

    //session_unset();
    session_destroy();
    unset($_SESSION['User_name']);
    header('Location: http://localhost/PT2/index.php');


?>