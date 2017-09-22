<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->

<?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        
                        <div class="col-xs-6">
                           <?php
                                insert_categories();
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                   <label for="cat_title">Add a Category:</label>
                                    <input type="text" id="cat_title" class = "form-control" name="cat_title">
                                </div>
                                 <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category!">
                                </div>
                            </form>
                            
                              <form action="" method="post">
                                <div class="form-group">
                                   <label for="cat_title">Edit a Category:</label>
                                   <?php 
                                        if(isset($_GET['edit']))
                                        {
                                            $edit_cat_id = $_GET['edit'];
                                            $query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id} ";
                                            $edit_query = mysqli_query($connection, $query);
                                            while($row = mysqli_fetch_assoc($edit_query)){
                                                $cat_id = $row['cat_id'];
                                                $cat_title = $row['cat_title'];
                                    ?>
                                    <input value="<?php if(isset($cat_title)){echo $cat_title; } ?>" type="text" id="cat_title" class = "form-control" name="cat_title_2">
                                    <?php } } ?>
                                </div>
                                 <div class="form-group">
                                   
                                   <?php
                                     //update query
                                     if(isset($_POST['cat_title_2']))
                                     {
                                         $cat_title = $_POST['cat_title_2'];
                                         //$edit_cat_id_db = $_POST['cat_title'];
                                         $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$edit_cat_id} ";
                                         $edit_query_db = mysqli_query($connection, $query);
                                         header("Location: categories.php");
                                     }
                                   ?>
                                    <input type="submit" class="btn btn-primary" name="edit" value="Update Category!">
                                </div>
                            </form>
                        </div>
                        <?php 
                             $query = "SELECT * FROM categories ORDER BY cat_id ASC";
                             $select_categories = mysqli_query($connection, $query);

                        ?>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                   <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                   <?php 
                                        while($row = mysqli_fetch_assoc($select_categories)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            
                                            echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_title}</td>";
                                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                            echo "<tr>";
                                        }
                                    ?>
                                    
                                    <?php delete_query(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/footer.php"; ?>
