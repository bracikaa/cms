            <div class="col-md-4">
 
                <!-- Blog Search Well -->
                
                <div class="well wellbgcolor">
                   <?php if(isset($_GET['msg'])) { ?>
                                <div class="alert alert-danger">
                                      <strong>Danger!</strong> Username or Password is incorrect!
                                </div>
                           <?php } ?>
                    <h4>Log In</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                       <label for="username">Username: </label>
                        <input name="username" type="text" class="form-control" placeholder="Enter username...">
                    </div>
                    
                    
                      <div class="form-group">
                       <label for="password">Password:</label>
                        <input name="password" type="password" class="form-control" placeholder = "Enter password...">
                     
                        
                    </div>
                    
                    <div class = "form-group">
                            <button name="login" type="submit" class="btn btn-primary">Log In</button>
                    </div>

                    </form>
                    <!-- /.input-group -->
                </div>
                
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                   
                   <?php 
                        $query = "SELECT * FROM categories";
                        $select_all_categories_query = mysqli_query($connection, $query);
                                            
                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                               <?php
                                    while($row = mysqli_fetch_assoc($select_all_categories_query))
                                    {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        
                                        echo "<li><a href='category.php?category={$cat_id}&category_title={$cat_title}'>{$cat_title}</a></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>