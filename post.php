<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
        <div class="col-md-8">
            
            <?php
            
                if(isset($_GET['p_id']))
                {
                    $the_post_id = $_GET['p_id'];
                }
                $query = "SELECT * FROM posts where post_id = {$the_post_id} ";
            
                $select_all_posts_query = mysqli_query($connection, $query);
            
                while($row = mysqli_fetch_assoc($select_all_posts_query))
                {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    
                    
            ?>
                
            <h2>
                <a href="#"><?php echo $post_title ?></a>
            </h2>
            
            <p><span class="glyphicon glyphicon-time"></span>Posted on <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="<?php echo "images/$post_image"; ?>" alt="">
            <hr>
            <p class="lead">
                by <?php echo $post_author ?>
            </p>
            <hr>
            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
                
            <?php } ?>
            
            <!-- Blog Comments -->
                
                <?php 
                    if(isset($_POST['create_comment']))
                    {
                    
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() )";
                        
                        $create_comment_query = mysqli_query($connection, $query);
                        
                        
                        if($create_comment_query)
                        {
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            $query .= "WHERE post_id = {$the_post_id} ";
                            
                            $update_comment_count_query = mysqli_query($connection, $query);
                        }
                        else if(!$create_comment_query)
                        {
                            die('QUERY FAILED '. mysqli_error($connection));
                        }
                    }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                          <label for="comment_author">Author</label>
                           <input type="text" class="form-control" name="comment_author">
                        </div>
                          <div class="form-group">
                          <label for="comment_email">Email</label>
                           <input type="email" class="form-control" name="comment_email">
                           </div>
                           <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <?php 
                    $query = "SELECT * FROM comments where comment_post_id = {$the_post_id} ";
                    $query .= "AND comment_status ='approved' ";
                    $query .= "ORDER BY comment_id DESC ";
                    
                    
                    $select_approved_comments = mysqli_query($connection, $query);
            
                    while($row = mysqli_fetch_array($select_approved_comments))
                    {
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];
                        
                        $number = rand(1, 4); 
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="admin/images/icon (<?php echo $number ?>).png" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4><?php echo $comment_content ?>
                    </div>
                </div>
                
                <?php } ?>
        </div>
            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"; ?>

