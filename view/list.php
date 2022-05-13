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
<body>
    <div class="main-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <!-- <a href="index.php" class="btn btn-success pull-left">Home</a> -->
                        <h2 class="pull-left">Product Details</h2>
                        <a href="view/wishlist.php" class="btn btn-success pull-right">View My Wishlist</a>

                    </div>
                    <?php
                    echo "<a href='index.php?act=wishlist&User_name=". '' ."' class="btn btn-success pull-right">View My Wishlist</a>";
                

                    //echo "<a href='index.php?act=wishlist&User_name=". '' ."' title='display wishlist' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";
                    //echo "<a href='index.php?act=wishlist title='display wishlist' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";

                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        //echo "<th>#</th>";                                        
                                        echo "<th>Prod_id</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Vendor</th>";
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
                                        
                                        //add below comment to wishlist display page
                                        //echo "<a href='index.php?act=Track_Hourly&User_name=". $row['User_name'] ."' title='Track Record Hourly' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";

                                        //echo "<a href='pricebyhour.php'title='Track Hourly data' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";
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