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
                        <a href="index.php" class="btn btn-success pull-left">All Products</a>
                        <h2 class="pull-left">Product Tracking by Day</h2>
                        <?php echo "<a href='index.php?act=wishlist&User_name=".$_SESSION['User_name']."' title='View wishlist' data-toggle='tooltip'>VIEW WISHLIST</a>";?>

                    </div>
                    <?php
                  
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        //echo "<th>#</th>";                                        
                                        echo "<th>Date</th>";
                                        echo "<th>Min</th>";
                                        echo "<th>Max</th>";
                                        //echo "<th>URL</th>";
                                        
                                        

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['Date'] . "</td>";                                        
                                        echo "<td>" . $row['Min_price'] . "</td>";
                                        echo "<td>" . $row['Max_price'] . "</td>";
                                        //echo "<td>" . $row['URL'] . "</td>";
                                        
                                        
                                        
                                        //echo "<a href='pricebyhour.php'title='Track Hourly data' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";
                                        echo "</td>";
                                
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