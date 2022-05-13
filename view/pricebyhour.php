<?php session_unset();?>
<?php include "view/header.php" ?>
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
    <div class="main-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <a href="index.php" class="btn btn-success pull-left">Home</a>
                        <h2 class="pull-left">Product Details</h2>
                        <a href="" class="btn btn-success pull-right">View Products</a>
                    </div>
                    <?php
                        
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        //echo "<th>#</th>";                                        
                                        echo "<th>Date</th>";
                                        echo "<th>Time</th>";
                                        echo "<th>Price</th>";
                                        //echo "<th>URL</th>";
                                        
                                        

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                
                                echo "</tbody>";                            
                            echo "</table>";
                        
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>