  <?php

    if(isset($_GET['p_id']))
    {
        $edit_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts where post_id = $edit_post_id " ;
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


    if(isset($_POST['update_post']))
    {
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category = $_POST['post_category'];
        $post_status = $_POST['status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['contents'];
        
        $post_tags = $_POST['tags'];
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        if(empty($post_image))
        {
            $query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
            $select_image_query = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image_query))
            {
                $post_image = $row['post_image'];
            }
        }
        
        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$edit_post_id} ";
        
        $update_post = mysqli_query($connection, $query);
        
        confirm_query($update_post); 
        echo "<div class='alert alert-success'>";
        echo "<strong>Post Updated </strong> <a href='../post.php?p_id={$post_id}'>See Post! </a>";
        echo "</div>";


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
                     $cat_id = $row['cat_id'];
                     $cat_title = $row['cat_title'];
                     echo "<option value='$cat_id'>{$cat_title}</option>";
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
                 <select class='form-control' name="status" id="">
             <option value='draft'>Draft</option>
             <option value = 'published'>Published</option>
        </select>
        <!-- <input type="text" class="form-control" name="status"> -->
    </div>
    
    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width="100" src="../images/<?php echo $post_image ?>" alt="">
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
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>