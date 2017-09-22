  <?php

    if(isset($_GET['p_id']))
    {
        $edit_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts";
    $edit_post_query = mysqli_query($connection, $query);
                                    
    while($row = mysqli_fetch_assoc($edit_post_query))
    {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }
                                        
  ?>  
  
  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value = "<?php echo $post_title; ?>" class="form-control" name="title">
    </div>
    
    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select class='form-control' name="post_category" id="">
            <?php
                $query = "SELECT * FROM categories";
                $select_categories_query = mysqli_query($connection, $query);
                confirm_query($select_categories_query);
            
                 while($row = mysqli_fetch_assoc($select_categories_query)){
                     $cat_title = $row['cat_title'];
                     echo "<option value=''>{$cat_title}</option>";
                 }
            ?>

        </select>
    </div>
    
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" value = "<?php echo $post_author; ?>" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" value = "<?php echo $post_status; ?>" class="form-control" name="status">
    </div>
    
    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width="100" src="../images/<?php echo $post_image?>" alt="">
        <input class='form-control' type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" value = "<?php echo $post_tags; ?>"  class="form-control" name="tags">
    </div>    
    
    <div class="form-group">
        <label for="contents">Post Contents</label>
        <textarea type="text" class="form-control" name="contents" cols="30" rows="10"><?php echo $post_content; ?>
        </textarea>
    </div> 
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Update Post">
    </div>
</form>