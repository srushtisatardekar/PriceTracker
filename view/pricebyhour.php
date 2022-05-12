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
                        <a href="" class="btn btn-success pull-right">View My Wishlist</a>
                    </div>
                    <?php
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        //echo "<th>#</th>";                                        
                                        echo "<th>Date</th>";
                                        echo "<th>Time</th>";
                                        echo "<th>Price</th>";
                                        //echo "<th>URL</th>";
                                        echo "<th>Action</th>";
                                        

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['Prod_id'] . "</td>";                                        
                                        echo "<td>" . $row['Description'] . "</td>";
                                        echo "<td>" . $row['Vendor'] . "</td>";
                                        //echo "<td>" . $row['URL'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='". $row['URL'] ."'> VIEW </a>";
                                        //echo "<a href='index.php?act=add&id=". $row['VENDOR'] ."' title='Add to wishlist' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";

                                        echo "</td>";
                                        

                                        // echo "<td>";
                                        // echo "<a href='index.php?act=update&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";
                                        // echo "<a href='index.php?act=delete&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='fa fa-trash'></i></a>";
                                        // echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>