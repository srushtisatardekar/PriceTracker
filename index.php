<?php
    session_unset();
    require_once  'controller/trackerController.php';
    $controller = new trackerController();
    $controller->mvcHandler();
?>