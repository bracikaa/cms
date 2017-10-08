<?php include "includes/header.php" ?>
    <div id="wrapper">


<?php include "includes/navigation.php" ?>
      
       
       
       
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php if(isset($_GET['msg'])) { ?>
                                <div class="alert alert-success">
                                      <strong>Welcome back!</strong> You have successfully logged in <?php echo $_SESSION['user_name']; ?>!
                                </div>
                           <?php } ?>
                            <h1 class="page-header">
                                Blank Page
                                <small><?php echo $_SESSION['user_name']; ?></small>
                            </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM posts ";
                                            $count_posts = mysqli_query($connection, $query);
                                            
                                            $num_rows = mysqli_num_rows($count_posts);
                                        ?>
                                      <div class='huge'><?php echo $num_rows; ?></div>
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="./posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM comments ";
                                            $count_comments = mysqli_query($connection, $query);
                                            
                                            $num_comments = mysqli_num_rows($count_comments);
                                        ?>
                                         <div class='huge'><?php echo $num_comments; ?></div>
                                          <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM users ";
                                            $count_users = mysqli_query($connection, $query);
                                            
                                            $num_users = mysqli_num_rows($count_users);
                                        ?>
                                        <div class='huge'><?php echo $num_users; ?></div>
                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                           <?php 
                                                $query = "SELECT * FROM categories ";
                                                $count_categories = mysqli_query($connection, $query);
                                            
                                                $num_categories = mysqli_num_rows($count_categories);
                                            ?>
                                            <div class='huge'><?php echo $num_categories; ?></div>
                                             <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">   
                       <?php
                        
                        $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                        $count_draft_posts_query = mysqli_query($connection, $query);                
                        $num_draft = mysqli_num_rows($count_draft_posts_query);
                        
                        $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                        $count_unnaproved_comments_query = mysqli_query($connection, $query);                
                        $num_unapproved = mysqli_num_rows($count_unnaproved_comments_query);
                        
                        $query = "SELECT * FROM users WHERE user_role = 'user' ";
                        $count_users_query = mysqli_query($connection, $query);                
                        $num_regular_users = mysqli_num_rows($count_users_query);
                        
                        $chart_name = ['Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Total Users', 'Regular Users', 'Categories'];
                        $chart_count = [$num_rows, $num_draft, $num_comments, $num_unapproved, $num_users, $num_regular_users, $num_categories];
                        $arr = "";
                         for($i = 0; $i < 7; $i++){
                              $arr.= "['{$chart_name[$i]}'" . ", " . "{$chart_count[$i]}], ";
                            }
                        


                        ?>
                        <script type="text/javascript">

                            google.charts.load('current', {'packages':['bar']});
                            google.charts.setOnLoadCallback(drawChart);

                              function drawChart() {
                                var data = google.visualization.arrayToDataTable([

                                  ['Data', 'Posts'],

                                 <?php  echo $arr; ?>
                                ]);


                                var options = {
                                  chart: {
                                    title: '',
                                    subtitle: '',
                                  }
                                };


                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                              }
                        </script>  
                                                    
                        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    </div>
   
                                    <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/footer.php"; ?>
